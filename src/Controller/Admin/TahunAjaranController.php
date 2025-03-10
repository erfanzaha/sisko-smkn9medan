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
class TahunAjaranController extends AppController
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

        $this->loadModel("Kelas");
        $this->loadModel("WaliKelas");
        $this->loadModel("Guru");
        $this->loadModel("JadwalPembayaran"); 
        $this->loadModel("TahunAjaran"); 
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
        $jadwalPembayaran = $this->jadwalPembayaran()->toList();

        if(isset($id_user)){
            $page = "Tahun Ajaran";
            $this->set(compact('page','username','level','jadwalPembayaran'));
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

    public function ajaxSaveTahunAjaran(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        //form input
        $tahun_ajaran = strtoupper(trim($this->request->getData('tahun_ajaran')));
        $id      = trim($this->request->getData('id'));
        
        if ($this->request->is('ajax')):
            
            if(!empty($id)):
                $data = 
                [
                    'tahun_ajaran'  => $tahun_ajaran,
                    'updated_at'    => $updated_at
                ];
            else:
                $data = 
                [
                    'tahun_ajaran'  => $tahun_ajaran,
                    'created_at'    => $created_at,
                    'updated_at'    => $updated_at
                ];
            endif;
            $checkData = $this->TahunAjaran->find('all',
                [
                    'conditions'=>
                    [
                        'tahun_ajaran'   =>$tahun_ajaran,
                    ]
                ])
                ->count();
            if($checkData > 0):
                $msg = array(
                    'msg'  => "Data sudah ada",
                    'icon' => "error",
                );
            else:
                $tahun = $this->TahunAjaran->newEmptyEntity();
                if(!empty($id)):
                    $tahun = $this->TahunAjaran->get($id, [
                        'contain' => [],
                    ]);
                endif;
                $tahun = $this->TahunAjaran->patchEntity($tahun, $data);
                if ($this->TahunAjaran->save($tahun)) :

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
        endif;
        
        echo json_encode($msg);
        exit;
    }

    public function ajaxViewTahunAjaran(){
        $data['data'] = $this->TahunAjaran->find('all')
                            ->toList();
        echo json_encode($data);
        exit;
        
    }

    public function ajaxGetTahunAjaran(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->TahunAjaran->find('all',
                [
                    'conditions'=>
                    [
                        'id'=>$id
                    ]
                ]);
            if($checkData->count() > 0 ):
                $res = $checkData->first();
            else:
                $res = array(
                    'msg'  => "Data tidak ditemukan",
                    'icon' => "error",
                );  
            endif;
        endif;
        echo json_encode($res);
        exit;
    }

    public function ajaxDeleteTahunAjaran(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->TahunAjaran->find('all',
                [
                    'conditions'=>
                    [
                        'id'=>$id
                    ]
                ]);
            if($checkData->count() > 0 ):
                $getData  = $this->TahunAjaran->get($id);
                if($this->TahunAjaran->delete($getData)):
                    $res = array(
                        'msg'  => "Berhasil menghapus data",
                        'icon' => "success",
                    );
                else:
                    $res = array(
                        'msg'  => "Gagal menghapus data",
                        'icon' => "error",
                    );
                endif;
            else:
                $res = array(
                    'msg'  => "Data tidak ditemukan",
                    'icon' => "error",
                );  
            endif;
        endif;
        echo json_encode($res);
        exit;
    }

}