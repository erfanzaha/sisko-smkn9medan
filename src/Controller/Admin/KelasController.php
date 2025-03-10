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
class KelasController extends AppController
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

        if(isset($id_user)){
            $jadwalPembayaran = $this->jadwalPembayaran()->toList();
            $page = "Kelas";
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

    public function ajaxSaveKelas(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        //form input
        $jurusan = strtoupper(trim($this->request->getData('jurusan')));
        $kelas   = strtoupper(trim($this->request->getData('kelas')));
        $id      = trim($this->request->getData('id'));
        
        if ($this->request->is('ajax')):
            
            if(!empty($id)):
                $data = 
                [
                    'jurusan'       => $jurusan,
                    'kelas'         => $kelas,
                    'updated_at'    => $updated_at
                ];
            else:
                $data = 
                [
                    'jurusan'       => $jurusan,
                    'kelas'         => $kelas,
                    'created_at'    => $created_at,
                    'updated_at'    => $updated_at
                ];
            endif;
            $checkData = $this->Kelas->find('all',
                [
                    'conditions'=>
                    [
                        'jurusan'   =>$jurusan,
                        'kelas'     =>$kelas,
                    ]
                ])
                ->count();
            if($checkData > 0):
                $msg = array(
                    'msg'  => "Data sudah ada",
                    'icon' => "error",
                );
            else:
                $kelas = $this->Kelas->newEmptyEntity();
                if(!empty($id)):
                    $kelas = $this->Kelas->get($id, [
                        'contain' => [],
                    ]);
                endif;
                $kelas = $this->Kelas->patchEntity($kelas, $data);
                if ($this->Kelas->save($kelas)) :

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

    public function ajaxViewAllKelas(){
        $data = $this->Kelas->find('all')
                            ->toList();
        $arr['data'] = $data;
        echo json_encode($arr);
        exit;
        
    }

    public function ajaxViewKelas(){
        if ($this->request->is('ajax')):
            $id_tahun_ajaran = $this->request->getData('id_tahun_ajaran');
            $data            = $this->WaliKelas->find('all',
                                                        [
                                                            'conditions'=>
                                                            [
                                                                'id_tahun_ajaran'=>$id_tahun_ajaran,
                                                            ]
                                                        ])
                                                ->toList();
            $output = [];
            foreach ($data as $key => $value) {
                $getKelas = $this->Kelas->find('all',
                [
                    'conditions'=>
                    [
                        'id'=>$value->id_kelas,
                    ]
                ])
                ->first();
                $getTahunAjaran = $this->TahunAjaran->find('all',
                [
                    'conditions'=>
                    [
                        'id'=>$value->id_tahun_ajaran,
                    ]
                ])
                ->first();
                if(isset($value->id_guru)){
                    $getGuru = $this->Guru->find('all',
                    [
                        'conditions'=>
                        [
                            'id'=>$value->id_guru,
                        ]
                    ]);
                    $dataGuru    = $getGuru->first();
                    $guru        = $dataGuru->nama_guru;
                    $idWaliKelas = $value->id;
                }else{
                    $guru        = "";
                    $idWaliKelas = "";
                }
                $set = [
                    'id'            => $value->id,
                    'id_kelas'      => $value->id_kelas,
                    'jurusan'       => $getKelas->jurusan,
                    'kelas'         => $getKelas->kelas,
                    'wali_kelas'    => $guru,
                    'tahun_ajaran'  => $getTahunAjaran->tahun_ajaran,
                    'id_wali_kelas' => $idWaliKelas,
                ];
                array_push($output,$set);
            }
            $arr['data'] = $output;
        endif;
        echo json_encode($arr);
        exit;
        
    }

    public function ajaxGetKelas(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->Kelas->find('all',
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

    public function ajaxDeleteKelas(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->Kelas->find('all',
                [
                    'conditions'=>
                    [
                        'id'=>$id
                    ]
                ]);
            if($checkData->count() > 0 ):
                $getData  = $this->Kelas->get($id);
                if($this->Kelas->delete($getData)):
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