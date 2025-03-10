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
namespace App\Controller\Orangtua;
use App\Controller\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class DashboardController extends AppController
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
        $this->loadModel("Siswa");
        $this->loadModel("SiswaKelas");
        $this->loadModel("Kelas");
        $this->loadModel("OrangTua");    
    }

    public function display()
    {
        $session   = $this->request->getSession();
        $username  = $session->read('username');
        $level     = $session->read('level');
        $id_user   = $session->read('id_user');
        
        if(isset($id_user)){
            $auth     = $this->Siswa->find('all',
            [
                'conditions'=>
                [
                    'id'   =>$id_user,
                ]
            ])
            ->first();
            $orangTua  = $this->OrangTua->find('all',
            [
                'conditions'=>
                [
                    'id_auth'   =>$id_user,
                ]
            ])
            ->first();

            $siswa     = $this->Siswa->find('all',
            [
                'conditions'=>
                [
                    'id'   =>$orangTua->id_siswa,
                ]
            ])
            ->first();
            
            $siswaKelas  = $this->SiswaKelas->find('all',
            [
                'conditions'=>
                [
                    'id_siswa'   =>$siswa->id,
                ]
            ])
            ->first();
            $kelas  = $this->Kelas->find('all',
            [
                'conditions'=>
                [
                    'id'   =>$siswaKelas->id_kelas,
                ]
            ])
            ->first();

            $page = "Dashboard";
            $this->set(compact('page','username','level','siswa','orangTua','kelas'));
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

}
