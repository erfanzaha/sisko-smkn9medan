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
class OrangTuaController extends AppController
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

        $this->loadModel("Auth");
        $this->loadModel("Siswa");
        $this->loadModel("OrangTua");        
        $this->loadModel("MataPelajaran");
        $this->loadModel("JadwalPembayaran"); 
    }

    public function jadwalPembayaran(){
        return $this->JadwalPembayaran->find('all');
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
            $jadwalPembayaran = $this->jadwalPembayaran()->toList();
            
            $page = "Orang Tua Siswa";
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
    public function ajaxSaveOrangTua(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        //form input
        $nama_ayah           = ucwords(trim($this->request->getData('nama_ayah')));
        $tanggal_lahir_ayah  = trim($this->request->getData('tanggal_lahir_ayah'));
        $tmpt_lhr_ayah       = trim($this->request->getData('tmpt_lhr_ayah'));
        $agama_ayah          = trim($this->request->getData('agama_ayah'));        
        $pendidikan_ayah     = trim($this->request->getData('pendidikan_ayah'));
        $pekerjaan_ayah      = trim($this->request->getData('pekerjaan_ayah'));
        $penghasilan_ayah    = trim($this->request->getData('penghasilan_ayah'));
        $no_hp_ayah          = trim($this->request->getData('no_hp_ayah'));
        $alamat_ayah         = trim($this->request->getData('alamat_ayah'));
        $hidup_meninggal_ayah= trim($this->request->getData('hidup_meninggal_ayah'));
        $nama_ibu            = ucwords(trim($this->request->getData('nama_ibu')));
        $tmpt_lhr_ibu        = trim($this->request->getData('tmpt_lhr_ibu'));
        $tanggal_lahir_ibu   = trim($this->request->getData('tanggal_lahir_ibu'));
        $agama_ibu           = trim($this->request->getData('agama_ibu'));
        $pendidikan_ibu      = trim($this->request->getData('pendidikan_ibu'));
        $pekerjaan_ibu       = trim($this->request->getData('pekerjaan_ibu'));
        $penghasilan_ibu     = trim($this->request->getData('penghasilan_ibu'));
        $no_hp_ibu           = trim($this->request->getData('no_hp_ibu'));
        $alamat_ibu          = trim($this->request->getData('alamat_ibu'));
        $hidup_meninggal_ibu = trim($this->request->getData('hidup_meninggal_ibu'));
        $nama_wali           = ucwords(trim($this->request->getData('nama_wali')));
        $tmpt_lhr_wali       = trim($this->request->getData('tmpt_lhr_wali'));
        $tanggal_lahir_wali  = trim($this->request->getData('tanggal_lahir_wali'));
        $agama_wali          = trim($this->request->getData('agama_wali'));
        $pendidikan_wali     = trim($this->request->getData('pendidikan_wali'));
        $pekerjaan_wali      = trim($this->request->getData('pekerjaan_wali'));
        $penghasilan_wali    = trim($this->request->getData('penghasilan_wali'));
        $no_hp_wali          = trim($this->request->getData('no_hp_wali'));
        $alamat_wali         = trim($this->request->getData('alamat_wali'));
        $username            = trim($this->request->getData('username'));
        $password            = trim($this->request->getData('password'));        
        $id                  = trim($this->request->getData('id'));
        $id_auth             = trim($this->request->getData('id_auth'));
        $id_siswa            = trim($this->request->getData('id_siswa'));
        
        if ($this->request->is('ajax')):
            if(!empty($password)): // jika input password tidak kosong
                $dataAuth = [
                    'username'   => $username,
                    'password'   => md5($password),
                    'level'      => "orang tua",
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
                $dataOrangTua = [
                    'id_auth'             => $id_auth,
                    'id_siswa'            => $id_siswa,
                    'nama_ayah'           => $nama_ayah,
                    'tmpt_lhr_ayah'       => $tmpt_lhr_ayah,
                    'tanggal_lahir_ayah'  => $tanggal_lahir_ayah,
                    'agama_ayah'          => $agama_ayah,
                    'pendidikan_ayah'     => $pendidikan_ayah,
                    'pekerjaan_ayah'      => $pekerjaan_ayah,
                    'penghasilan_ayah'    => $penghasilan_ayah,
                    'no_hp_ayah'          => $no_hp_ayah,
                    'alamat_ayah'         => $alamat_ayah,
                    'hidup_meninggal_ayah'=> $hidup_meninggal_ayah,
                    'nama_ibu'            => $nama_ibu,
                    'tmpt_lhr_ibu'        => $tmpt_lhr_ibu,
                    'tanggal_lahir_ibu'   => $tanggal_lahir_ibu,
                    'agama_ibu'           => $agama_ibu,
                    'pendidikan_ibu'      => $pendidikan_ibu,
                    'pekerjaan_ibu'       => $pekerjaan_ibu,
                    'penghasilan_ibu'     => $penghasilan_ibu,
                    'no_hp_ibu'           => $no_hp_ibu,
                    'alamat_ibu'          => $alamat_ibu,
                    'hidup_meninggal_ibu' => $hidup_meninggal_ibu,
                    'nama_wali'           => $nama_wali,
                    'tmpt_lhr_wali'       => $tmpt_lhr_wali,
                    'tanggal_lahir_wali'  => $tanggal_lahir_wali,
                    'agama_wali'          => $agama_wali,
                    'pendidikan_wali'     => $pendidikan_wali,
                    'pekerjaan_wali'      => $pekerjaan_wali,
                    'penghasilan_wali'    => $penghasilan_wali,
                    'no_hp_wali'          => $no_hp_wali,
                    'alamat_wali'         => $alamat_wali,
                    'updated_at'          => $updated_at
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
            $checkDataOrangTua = $this->OrangTua->find('all',
                [
                    'conditions'=>
                    [
                        'id_siswa'   =>$id_siswa,
                    ]
                ])
                ->count();
            if($id == "" && ($checkDataAuth > 0 || $checkDataOrangTua > 0)):
                if($checkDataAuth > 0):
                    $msg = array(
                        'msg'  => "Username sudah digunakan",
                        'icon' => "error",
                    );
                elseif($checkDataOrangTua > 0):
                    $msg = array(
                        'msg'  => "Orang Tua sudah terdaftar",
                        'icon' => "error",
                    );
                endif;
            else:
                $orangTua = $this->OrangTua->newEmptyEntity();
                $auth = $this->Auth->newEmptyEntity();
                if(!empty($id)): // jika input id tidak kosong
                    $auth = $this->Auth->get($id_auth, [
                        'contain' => [],
                    ]);

                    $orangTua = $this->OrangTua->get($id, [
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
                        $dataOrangTua = [
                            'id_auth'             => $getLasAuth->id,
                            'id_siswa'            => $id_siswa,
                            'nama_ayah'           => $nama_ayah,
                            'tmpt_lhr_ayah'       => $tmpt_lhr_ayah,
                            'tanggal_lahir_ayah'  => $tanggal_lahir_ayah,
                            'agama_ayah'          => $agama_ayah,
                            'pendidikan_ayah'     => $pendidikan_ayah,
                            'pekerjaan_ayah'      => $pekerjaan_ayah,
                            'penghasilan_ayah'    => $penghasilan_ayah,
                            'no_hp_ayah'          => $no_hp_ayah,
                            'alamat_ayah'         => $alamat_ayah,
                            'hidup_meninggal_ayah'=> $hidup_meninggal_ayah,
                            'nama_ibu'            => $nama_ibu,
                            'tmpt_lhr_ibu'        => $tmpt_lhr_ibu,
                            'tanggal_lahir_ibu'   => $tanggal_lahir_ibu,
                            'agama_ibu'           => $agama_ibu,
                            'pendidikan_ibu'      => $pendidikan_ibu,
                            'pekerjaan_ibu'       => $pekerjaan_ibu,
                            'penghasilan_ibu'     => $penghasilan_ibu,
                            'no_hp_ibu'           => $no_hp_ibu,
                            'alamat_ibu'          => $alamat_ibu,
                            'hidup_meninggal_ibu' => $hidup_meninggal_ibu,
                            'nama_wali'           => $nama_wali,
                            'tmpt_lhr_wali'       => $tmpt_lhr_wali,
                            'tanggal_lahir_wali'  => $tanggal_lahir_wali,
                            'agama_wali'          => $agama_wali,
                            'pendidikan_wali'     => $pendidikan_wali,
                            'pekerjaan_wali'      => $pekerjaan_wali,
                            'penghasilan_wali'    => $penghasilan_wali,
                            'no_hp_wali'          => $no_hp_wali,
                            'alamat_wali'         => $alamat_wali,
                            'created_at'          => $created_at,
                            'updated_at'          => $updated_at
                        ];
                    endif;
                    $orangTua = $this->OrangTua->patchEntity($orangTua, $dataOrangTua);    
                    if($this->OrangTua->save($orangTua)) :
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

    public function ajaxViewOrangTua(){
        $data = $this->Auth->find('all')
                            ->contain(['Siswa'])
                            ->toList();
        $output = [];
        foreach ($data as $key => $value) {
            $getOrangTua =  $this->OrangTua->find('all',
            [
                'conditions'=>[
                    'id_siswa'=>$value['siswa']->id
                ],
            ]);
            if($getOrangTua->count() > 0){
                $dataOrangTua   = $getOrangTua->first();
                $nama_ayah      = $dataOrangTua->nama_ayah;
                $nama_ibu       = $dataOrangTua->nama_ibu;
                $nama_wali      = $dataOrangTua->nama_wali;
                $alamat_ayah    = $dataOrangTua->alamat_ayah;
                $alamat_ibu     = $dataOrangTua->alamat_ibu;
                $alamat_wali    = $dataOrangTua->alamat_wali;
                $tmpt_lhr_ayah  = $dataOrangTua->tmpt_lhr_ayah;
                $tmpt_lhr_ibu   = $dataOrangTua->tmpt_lhr_ibu;
                $tmpt_lhr_wali  = $dataOrangTua->tmpt_lhr_wali;
                $tanggal_lahir_ayah = $dataOrangTua->tanggal_lahir_ayah;
                $tanggal_lahir_ibu = $dataOrangTua->tanggal_lahir_ibu;
                $tanggal_lahir_wali = $dataOrangTua->tanggal_lahir_wali;
                $no_hp_ayah     = $dataOrangTua->no_hp_ayah;
                $no_hp_ibu      = $dataOrangTua->no_hp_ibu;
                $no_hp_wali     = $dataOrangTua->no_hp_wali;
                $pendidikan_ayah= $dataOrangTua->pendidikan_ayah;
                $pendidikan_ibu = $dataOrangTua->pendidikan_ibu;
                $pendidikan_wali= $dataOrangTua->pendidikan_wali;
                $pekerjaan_ayah = $dataOrangTua->pekerjaan_ayah;
                $pekerjaan_ibu  = $dataOrangTua->pekerjaan_ibu;
                $pekerjaan_wali = $dataOrangTua->pekerjaan_wali;
                $penghasilan_ayah= $dataOrangTua->penghasilan_ayah;
                $penghasilan_ibu= $dataOrangTua->penghasilan_ibu;
                $penghasilan_wali= $dataOrangTua->penghasilan_wali;
                $agama_ayah     = $dataOrangTua->agama_ayah;
                $agama_ibu      = $dataOrangTua->agama_ibu;
                $agama_wali     = $dataOrangTua->agama_wali;
                $hidup_meninggal_ayah = $dataOrangTua->hidup_meninggal_ayah;
                $hidup_meninggal_ibu = $dataOrangTua->hidup_meninggal_ibu;
            }else{
                $nama_ayah      = "-";
                $nama_ibu       = "-";
                $nama_wali       = "-";
                $tmpt_lhr_ayah    = "-";
                $tmpt_lhr_ibu    = "-";
                $tmpt_lhr_wali    = "-";
                $tanggal_lahir_ayah    = "-";
                $tanggal_lahir_ibu    = "-";
                $tanggal_lahir_wali    = "-";
                $alamat_ayah    = "-";
                $alamat_ibu    = "-";
                $alamat_wali    = "-";
                $no_hp_ayah     = "-";
                $no_hp_ibu      = "-";
                $no_hp_wali      = "-";
                $pendidikan_ayah = "-";
                $pendidikan_ibu  = "-";
                $pendidikan_wali  = "-";
                $pekerjaan_ayah = "-";
                $pekerjaan_ibu  = "-";
                $pekerjaan_wali  = "-";
                $penghasilan_ayah = "-";
                $penghasilan_ibu  = "-";
                $penghasilan_wali  = "-";
                $agama_ayah     = "-";
                $agama_ibu      = "-";
                $agama_wali      = "-";
                $hidup_meninggal_ayah     = "-";
                $hidup_meninggal_ibu      = "-";
            }
            $set = [
                'id_auth'        => $value['siswa']->id_auth,
                'id'             => $value['siswa']->id,
                'nisn'           => $value['siswa']->nisn,
                'nama_siswa'     => $value['siswa']->nama_siswa,
                'nama_ayah'      => $nama_ayah,
                'nama_ibu'       => $nama_ibu,
                'nama_wali'      => $nama_wali,
                'tanggal_lahir_ayah'    => $tanggal_lahir_ayah,
                'tanggal_lahir_ibu'    => $tanggal_lahir_ibu,
                'tanggal_lahir_wali'    => $tanggal_lahir_wali,
                'tmpt_lhr_ayah'    => $tmpt_lhr_ayah,
                'tmpt_lhr_ibu'    => $tmpt_lhr_ibu,
                'tmpt_lhr_wali'    => $tmpt_lhr_wali,
                'alamat_ayah'    => $alamat_ayah,
                'alamat_ibu'     => $alamat_ibu,
                'alamat_wali'     => $alamat_wali,
                'no_hp_ayah'     => $no_hp_ayah,
                'no_hp_ibu'      => $no_hp_ibu,
                'no_hp_wali'      => $no_hp_wali,
                'pendidikan_ayah' => $pendidikan_ayah,
                'pendidikan_ibu'  => $pendidikan_ibu,
                'pendidikan_wali'  => $pendidikan_wali,
                'pekerjaan_ayah' => $pekerjaan_ayah,
                'pekerjaan_ibu'  => $pekerjaan_ibu,
                'pekerjaan_wali'  => $pekerjaan_wali,
                'penghasilan_ayah' => $penghasilan_ayah,
                'penghasilan_ibu'  => $penghasilan_ibu,
                'penghasilan_wali'  => $penghasilan_wali,
                'agama_ayah'     => $agama_ayah,
                'agama_ibu'      => $agama_ibu,
                'agama_wali'      => $agama_wali,
                'hidup_meninggal_ayah'     => $hidup_meninggal_ayah,
                'hidup_meninggal_ibu'      => $hidup_meninggal_ibu,
            ];
            array_push($output,$set);
        }
        $arr['data'] = $output;
        echo json_encode($arr);
        exit;
        
    }

    public function ajaxGetOrangTua(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkDataOrangTua  = $this->OrangTua->find('all',
                [
                    'conditions'=>[
                        'id_siswa'=>$id
                    ]                    
                ]);
            
            if($checkDataOrangTua->count() > 0):
                $arrOrangTua = $checkDataOrangTua->first();
                $getAuth     = $this->Auth->find('all',
                                [
                                    'conditions'=>[
                                        'id'=>$arrOrangTua->id_auth
                                    ]                    
                                ])
                                ->first();
                $res = [
                    'id'                    => $arrOrangTua->id,
                    'id_auth'               => $arrOrangTua->id_auth,
                    'nama_ayah'             => $arrOrangTua->nama_ayah,
                    'tmpt_lhr_ayah'         => $arrOrangTua->tmpt_lhr_ayah,
                    'tanggal_lahir_ayah'    => $arrOrangTua->tanggal_lahir_ayah,
                    'agama_ayah'            => $arrOrangTua->agama_ayah,
                    'pendidikan_ayah'       => $arrOrangTua->pendidikan_ayah,
                    'pekerjaan_ayah'        => $arrOrangTua->pekerjaan_ayah,
                    'penghasilan_ayah'      => $arrOrangTua->penghasilan_ayah,
                    'no_hp_ayah'            => $arrOrangTua->no_hp_ayah,
                    'alamat_ayah'           => $arrOrangTua->alamat_ayah,
                    'hidup_meninggal_ayah'  => $arrOrangTua->hidup_meninggal_ayah,
                    'nama_ibu'              => $arrOrangTua->nama_ibu,
                    'tmpt_lhr_ibu'          => $arrOrangTua->tmpt_lhr_ibu,
                    'tanggal_lahir_ibu'     => $arrOrangTua->tanggal_lahir_ibu,
                    'agama_ibu'             => $arrOrangTua->agama_ibu,
                    'pendidikan_ibu'        => $arrOrangTua->pendidikan_ibu,
                    'pekerjaan_ibu'         => $arrOrangTua->pekerjaan_ibu,
                    'penghasilan_ibu'       => $arrOrangTua->penghasilan_ibu,
                    'no_hp_ibu'             => $arrOrangTua->no_hp_ibu,
                    'alamat_ibu'            => $arrOrangTua->alamat_ibu,
                    'hidup_meninggal_ibu'   => $arrOrangTua->hidup_meninggal_ibu,
                    'nama_wali'             => $arrOrangTua->nama_wali,
                    'tmpt_lhr_wali'         => $arrOrangTua->tmpt_lhr_wali,
                    'tanggal_lahir_wali'    => $arrOrangTua->tanggal_lahir_wali,
                    'agama_wali'            => $arrOrangTua->agama_wali,
                    'pendidikan_wali'       => $arrOrangTua->pendidikan_wali,
                    'pekerjaan_wali'        => $arrOrangTua->pekerjaan_wali,
                    'penghasilan_wali'      => $arrOrangTua->penghasilan_wali,
                    'no_hp_wali'            => $arrOrangTua->no_hp_wali,
                    'alamat_wali'           => $arrOrangTua->alamat_wali,
                    'username'              => $getAuth->username
                ];
            else:
                $res = [
                    'id'                    => "",
                    'id_auth'               => "",
                    'nama_ayah'             => "",
                    'tmpt_lhr_ayah'         => "",
                    'tanggal_lahir_ayah'    => "",
                    'agama_ayah'            => "",
                    'pendidikan_ayah'       => "",
                    'pekerjaan_ayah'        => "",
                    'penghasilan_ayah'      => "",
                    'no_hp_ayah'            => "",
                    'alamat_ayah'           => "",
                    'hidup_meninggal_ayah'  => "",
                    'nama_ibu'              => "",
                    'tmpt_lhr_ibu'          => "",
                    'tanggal_lahir_ibu'     => "",
                    'agama_ibu'             => "",
                    'pendidikan_ibu'        => "",
                    'pekerjaan_ibu'         => "",
                    'penghasilan_ibu'       => "",
                    'no_hp_ibu'             => "",
                    'alamat_ibu'            => "",
                    'hidup_meninggal_ibu'   => "",
                    'nama_wali'             => "",
                    'tmpt_lhr_wali'         => "",
                    'tanggal_lahir_wali'    => "",
                    'agama_wali'            => "",
                    'pendidikan_wali'       => "",
                    'pekerjaan_wali'        => "",
                    'penghasilan_wali'      => "",
                    'no_hp_wali'            => "",
                    'alamat_wali'           => "",
                    'username'              => ""
                ];
            endif;
        endif;
        echo json_encode($res);
        exit;
    }
}