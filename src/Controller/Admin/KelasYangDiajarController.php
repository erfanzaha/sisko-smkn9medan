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
class KelasYangDiajarController extends AppController
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
        $this->loadModel("KelasYangDiajar");
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
            
            $page = "Kelas Yang Diajar";
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

    public function ajaxSaveKelasYangDiajar(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        //form input
        $id_tahun_ajaran = strtoupper(trim($this->request->getData('id_tahun_ajaran')));
        $id_guru = strtoupper(trim($this->request->getData('id_guru')));
        $id_kelas= strtoupper(trim($this->request->getData('id_kelas')));
        $id      = trim($this->request->getData('id'));
        
        if ($this->request->is('ajax')):
            
            if(!empty($id)):
                $data = 
                [
                    'id_guru'         => $id_guru,
                    'id_tahun_ajaran' => $id_tahun_ajaran,
                    'id_kelas'        => $id_kelas,
                    'updated_at'      => $updated_at
                ];
            else:
                $data = 
                [
                    'id_guru'         => $id_guru,
                    'id_tahun_ajaran' => $id_tahun_ajaran,
                    'id_kelas'        => $id_kelas,
                    'created_at'      => $created_at,
                    'updated_at'      => $updated_at
                ];
            endif;
            $checkData = $this->KelasYangDiajar->find('all',
                [
                    'conditions'=>
                    [
                        'id_guru'          =>$id_guru,
                        'id_kelas'         =>$id_kelas,
                        'id_tahun_ajaran'  =>$id_tahun_ajaran,
                    ]
                ])
                ->count();
            if($checkData > 0):
                $msg = array(
                    'msg'  => "Data sudah ada",
                    'icon' => "error",
                );
            else:
                $kelasYangDiajar = $this->KelasYangDiajar->newEmptyEntity();
                if(!empty($id)):
                    $kelasYangDiajar = $this->KelasYangDiajar->get($id, [
                        'contain' => [],
                    ]);
                endif;
                $kelasYangDiajar = $this->KelasYangDiajar->patchEntity($kelasYangDiajar, $data);
                if ($this->KelasYangDiajar->save($kelasYangDiajar)) :

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

    public function ajaxViewKelasYangDiajar(){
        $data = $this->KelasYangDiajar->find('all')
                                      ->toList();
        $output = [];
        foreach ($data as $key => $value) {
                $getGuru = $this->Guru->find('all',
                [
                    'conditions'=>
                    [
                        'id'=>$value->id_guru,
                    ]
                ])
                ->first();
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
            $set = [
                'id'            => $value->id,
                'nama_guru'     => $getGuru->nama_guru,
                'kelas'         => $getKelas->kelas,
                'tahun_ajaran'  => $getTahunAjaran->tahun_ajaran,
            ];
            array_push($output,$set);
        }
        $arr['data'] = $output;
        echo json_encode($arr);
        exit;
        
    }

    public function ajaxGetKelasYangDiajar(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->KelasYangDiajar->find('all',
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

    public function ajaxDeleteKelasYangDiajar(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->KelasYangDiajar->find('all',
                [
                    'conditions'=>
                    [
                        'id'=>$id
                    ]
                ]);
            if($checkData->count() > 0 ):
                $getData  = $this->KelasYangDiajar->get($id);
                if($this->KelasYangDiajar->delete($getData)):
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