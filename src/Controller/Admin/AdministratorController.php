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
class AdministratorController extends AppController
{
    
    public function initialize(): void
    {
        parent::initialize();
        date_default_timezone_set("Asia/Jakarta");
        $this->loadModel("Admin");
        $this->loadModel("Auth");
        $this->loadModel("JadwalPembayaran"); 
        $session = $this->request->getSession();
        $status  = $session->read('status');
        if($status == FALSE):
            $this->redirect('/');
        endif;
    }

    public function jadwalPembayaran(){
        return $this->JadwalPembayaran->find('all')->toList();
    }

    /**
     * display halaman
     */
    public function display()   
    {   
        $session   = $this->request->getSession();
        $username  = $session->read('username');
        $level     = $session->read('level');
        $id_user   = $session->read('id_user');  

        if(isset($id_user)){
            $jadwalPembayaran = $this->jadwalPembayaran();
            $page = "Administrator";
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

    /**
     * ajax save data
     */
    public function ajaxSaveAdministrator(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        //form input
        $nama_admin = trim($this->request->getData('nama_admin'));
        $email      = trim($this->request->getData('email'));        
        $username   = trim($this->request->getData('username'));
        $password   = trim($this->request->getData('password'));
        $id         = trim($this->request->getData('id'));
        $id_auth    = trim($this->request->getData('id_auth'));
        
        if ($this->request->is('ajax')):
            if(!empty($password)): // jika input password tidak kosong
                $dataAuth = [
                    'username'   => $username,
                    'password'   => md5($password),
                    'level'      => "admin",
                    'created_at' => $created_at,
                    'updated_at' => $updated_at
                ];
            else: // jika input password kosong
                $dataAuth = [
                    'username'   => $username,
                    'updated_at' => $updated_at
                ];
            endif;

            if(!empty($id)):
                $dataGuru = [
                    'id_auth'       => $id_auth,
                    'nama_admin'    => $nama_admin,                    
                    'email'         => $email,
                    // 'kategori'      => $kategori,
                    'updated_at'    => $updated_at
                ];
            endif;

            // jika username sudah digunakan
            $checkDataAuth = $this->Auth->find('all',
                [
                    'conditions'=>
                    [
                        'username'   =>$username,
                    ]
                ])
                ->count();
            
            // jika nip sudah diinput
            $checkDataAdmin = $this->Admin->find('all',
                [
                    'conditions'=>
                    [
                        'email'   =>$email,
                    ]
                ])
                ->count();
            if($id == "" && ($checkDataAuth > 0 || $checkDataAdmin > 0)):
                if($checkDataAuth > 0):
                    $msg = array(
                        'msg'  => "Username sudah digunakan",
                        'icon' => "error",
                    );
                elseif($checkDataAdmin > 0):
                    $msg = array(
                        'msg'  => "Email sudah terdaftar",
                        'icon' => "error",
                    );
                endif;
            else:
                $admin = $this->Admin->newEmptyEntity();
                $auth  = $this->Auth->newEmptyEntity();
                if(!empty($id)): // jika input id tidak kosong
                    $auth = $this->Auth->get($id_auth, [
                        'contain' => [],
                    ]);

                    $admin = $this->Admin->get($id, [
                        'contain' => [],
                    ]);
                endif;
                
                $auth = $this->Auth->patchEntity($auth, $dataAuth);
                
                if ($this->Auth->save($auth)):
                    
                    if($id == ""):
                        $getLasAuth = $this->Auth->find('all',
                        [
                            'conditions'=>
                            [
                                'username'   =>$username,
                            ]
                        ])
                        ->first();
                        $dataGuru = [
                            'id_auth'       => $getLasAuth->id,
                            'nama_admin'    => $nama_admin,
                            'email'         => $email,
                            'created_at'    => $created_at,
                            'updated_at'    => $updated_at
                        ];
                    endif;
                    $admin = $this->Admin->patchEntity($admin, $dataGuru);    
                    if($this->Admin->save($admin)) :
                        $msg = array(   
                            'msg'  => 'Data berhasil disimpan',
                            'icon' => 'success',
                        );
                    endif;
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

    public function ajaxViewAdministrator(){
        $data = $this->Auth->find('all')
                            ->contain(['Admin'])
                            ->toList();
        $output = [];
        foreach ($data as $key => $value) {
            $set = [
                'id_auth'    => $value['admin']->id_auth,
                'id'         => $value['admin']->id,
                'nama_admin' => $value['admin']->nama_admin,
                'email'      => $value['admin']->email,
                'username'   => $value->username,
            ];
            array_push($output,$set);
        }
        $arr['data'] = $output;
        echo json_encode($arr);
        exit;
        
    }

    public function ajaxGetAdministrator(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->Auth->find('all',
                [
                    'conditions'=>[
                        'id'=>$id
                    ]                    
                ]);
            $arrAuth = $checkData->first();
                $checkDataAdmin  = $this->Admin->find('all',
                [
                    'conditions'=>[
                        'id_auth'=>$id
                    ]                    
                ]);
            $arrAdmin = $checkDataAdmin->first();
            if($checkData->count() > 0 && $checkDataAdmin->count() > 0):
                $res = [
                    'id'            => $arrAdmin->id,
                    'id_auth'       => $arrAdmin->id_auth,                    
                    'nama_admin'    => $arrAdmin->nama_admin,
                    'email'         => $arrAdmin->email,                    
                    'username'      => $arrAuth->username,
                ];
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

    public function ajaxDeleteAdministrator(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->Admin->find('all',
                [
                    'conditions'=>
                    [
                        'id_auth'=>$id
                    ]
                ]);
            if($checkData->count() > 0 ):
                $showData     = $checkData->first();
                $getDataAuth  = $this->Auth->get($showData->id_auth);
                $getDataGuru  = $this->Admin->get($showData->id);
                if($this->Admin->delete($getDataGuru) && $this->Auth->delete($getDataAuth)):
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