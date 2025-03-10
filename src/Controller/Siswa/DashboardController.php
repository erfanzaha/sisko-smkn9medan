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
namespace App\Controller\Siswa;
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
        $this->loadModel("Auth");    
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

            $siswa     = $this->Siswa->find('all',
            [
                'conditions'=>
                [
                    'id_auth'   =>$id_user,
                ]
            ])
            ->first();
            $orangTua  = $this->OrangTua->find('all',
            [
                'conditions'=>
                [
                    'id_siswa'   =>$siswa->id,
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
            $this->set(compact('page','username','level','siswa','orangTua','kelas','id_user'));
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
    public function ajaxSaveSiswa(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        //form input
        $nama_siswa      = ucwords(trim($this->request->getData('nama_siswa')));
        $email           = trim($this->request->getData('email'));
        $gender          = trim($this->request->getData('gender'));
        $tanggal_lahir   = trim($this->request->getData('tanggal_lahir'));
        $agama           = trim($this->request->getData('agama'));
        $jumlah_saudara  = trim($this->request->getData('jumlah_saudara'));
        $alamat          = trim($this->request->getData('alamat'));
        $no_hp           = trim($this->request->getData('no_hp'));
        $username        = trim($this->request->getData('username'));
        $password        = trim($this->request->getData('password'));
        $id              = trim($this->request->getData('id'));
        $id_auth         = trim($this->request->getData('id_auth'));
        
        if ($this->request->is('ajax')):
            if(!empty($password)): // jika input password tidak kosong
                $dataAuth = [
                    'username'   => $username,
                    'password'   => md5($password),
                    'level'      => "siswa",
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
                $dataSiswa = [
                    'id_auth'       => $id_auth,
                    'nama_siswa'    => $nama_siswa,
                    'email'         => $email,
                    'gender'        => $gender,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat'        => $alamat,
                    'agama'         => $agama,
                    'jumlah_saudara'=> $jumlah_saudara,
                    'no_hp'         => $no_hp,
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
        
            if($id == "" && ($checkDataAuth > 0)):
                if($checkDataAuth > 0):
                    $msg = array(
                        'msg'  => "Username sudah digunakan",
                        'icon' => "error",
                    );
                endif;
            else:
                $siswa      = $this->Siswa->newEmptyEntity();
                $auth       = $this->Auth->newEmptyEntity();                
                if(!empty($id)): // jika input id tidak kosong
                    $auth = $this->Auth->get($id_auth, [
                        'contain' => [],
                    ]);

                    $siswa = $this->Siswa->get($id, [
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
                        $dataSiswa = [
                            'id_auth'       => $getLasAuth->id,                            
                            'nama_siswa'    => $nama_siswa,
                            'email'         => $email,
                            'gender'        => $gender,
                            'tanggal_lahir' => $tanggal_lahir,
                            'alamat'        => $alamat,
                            'agama'         => $agama,
                            'jumlah_saudara'=> $jumlah_saudara,
                            'no_hp'         => $no_hp,
                            'created_at'    => $created_at,
                            'updated_at'    => $updated_at
                        ];
                        
                    endif;
                    $siswa = $this->Siswa->patchEntity($siswa, $dataSiswa);    
                    if($this->Siswa->save($siswa)) :
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

    public function ajaxGetSiswa(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->Auth->find('all',
                [
                    'conditions'=>[
                        'id'=>$id
                    ]                    
                ]);
            $arrAuth = $checkData->first();

                $checkDataSiswa  = $this->Siswa->find('all',
                [
                    'conditions'=>[
                        'id_auth'=>$id
                    ]                    
                ]);
            $arrSiswa = $checkDataSiswa->first();

                $checkSiswaKelas = $this->SiswaKelas->find('all',
                [
                    'conditions'=>
                    [
                        'id_siswa'   =>$arrSiswa->id,
                    ]
                ]);

                if($checkSiswaKelas->count() > 0 ){
                    $getSiswaKelas = $checkSiswaKelas->first();
                    $id_kelas      = $getSiswaKelas->id_kelas;
                    $id_siswa_kelas= $getSiswaKelas->id;
                }else{
                    $id_kelas      = "";
                    $id_siswa_kelas= "";
                }

            
            if($checkData->count() > 0 && $checkDataSiswa->count() > 0):
                $res = [
                    'id'            => $arrSiswa->id,
                    'id_auth'       => $arrSiswa->id_auth,
                    'id_auth'       => $arrSiswa->id_auth,
                    'id_kelas'      => $id_kelas,
                    'id_siswa_kelas'=> $id_siswa_kelas,
                    'nisn'          => $arrSiswa->nisn,
                    'nama_siswa'    => $arrSiswa->nama_siswa,
                    'email'         => $arrSiswa->email,
                    'gender'        => $arrSiswa->gender,
                    'tanggal_lahir' => $arrSiswa->tanggal_lahir,
                    'agama'         => $arrSiswa->agama,
                    'jumlah_saudara'=> $arrSiswa->jumlah_saudara,                    
                    'no_hp'         => $arrSiswa->no_hp,
                    'alamat'        => $arrSiswa->alamat,
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

}
