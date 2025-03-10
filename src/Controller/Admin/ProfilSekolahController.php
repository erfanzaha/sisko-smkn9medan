<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\Admin;
use App\Controller\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\Query;
use Cake\ORM\Locator\LocatorAwareTrait;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class ProfilSekolahController extends AppController
{
    
    public function initialize(): void
    {
        parent::initialize();
        date_default_timezone_set("Asia/Jakarta");
        $session = $this->request->getSession();
        $status  = $session->read('status');
        if($status == FALSE):
            $this->redirect('/');
        endif;

        $this->loadModel("ProfilSekolah");
        $this->loadModel("JadwalPembayaran"); 
    }

    public function jadwalPembayaran(){
        return $this->JadwalPembayaran->find('all');
    }
    
    public function display()   
    {
        $session   = $this->request->getSession();
        $username  = $session->read('username');
        $level     = $session->read('level');
        $id_user   = $session->read('id_user');  

        if(isset($id_user)){
            $data = $this->ProfilSekolah->find('all')
                                        ->toList();
            $jadwalPembayaran = $this->jadwalPembayaran()->toList();

            $page = "Profil Sekolah";
            $this->set(compact('page','username','level','data','jadwalPembayaran'));
            try {
                $this->viewBuilder()->setLayout('AdminTemplate');
            } catch (MissingTemplateException $exception) {
                if (Configure::read('debug')) {
                    throw $exception;
                }
                throw new NotFoundException();
            }
        }
    }

    public function ajaxSaveProfilSekolah(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        //form input
        $alamat = trim($this->request->getData('alamat'));
        $kontak = trim($this->request->getData('kontak'));
        $email  = trim($this->request->getData('email'));
        
        if ($this->request->is('ajax')):
            // $this->ProfilSekolah->newEmptyEntity();
            $profileSekolah = $this->getTableLocator()->get('ProfilSekolah');
            
                $saveAlamat = $profileSekolah->query();
                               $saveAlamat->update()
                               ->set(['deskripsi' => $alamat])
                               ->where(['tipe' => 'alamat'])
                               ->execute();
                $saveEmail = $profileSekolah->query();
                               $saveEmail->update()
                               ->set(['deskripsi' => $email])
                               ->where(['tipe' => 'email'])
                               ->execute();
                $saveKontak = $profileSekolah->query();
                               $saveKontak->update()
                               ->set(['deskripsi' => $kontak])
                               ->where(['tipe' => 'kontak'])
                               ->execute();
                
                if ($saveAlamat && $saveEmail && $saveKontak) :

                    $msg = array(   
                        'msg'  => 'Data berhasil disimpan',
                        'icon' => 'success',
                    );
                else:
                    $msg = array(
                        'msg'  => "Gagal saat menyimpan data",
                        'icon' => "error",
                    );
                endif;
        endif;
        
        echo json_encode($msg);
        exit;
    }        

}