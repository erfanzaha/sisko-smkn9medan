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
namespace App\Controller\Guru;
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
        $this->loadModel("Auth");
        $this->loadModel("Guru");
        $this->loadModel("SiswaKelas");
        $this->loadModel("Kelas");
        $this->loadModel("MataPelajaran");   
        $this->loadModel("WaliKelas");    
        $this->loadModel("KelasYangDiajar");    
    }

    public function dataGuru($id_user){
        return $this->Guru->find('all',['conditions'=>['id_auth'=>$id_user]])
                          ->first();
    }

    public function mataPelajaran($id_mapel){
        return $this->MataPelajaran->find('all',['conditions'=>['id'=>$id_mapel]])
                          ->first();
    }

    public function waliKelas($id_guru){
        $dataWaliKelas = $this->WaliKelas->find('all',['conditions'=>['id_guru'=>$id_guru]])
                          ->first();
        return $this->Kelas->find('all',['conditions'=>['id'=>$dataWaliKelas->id_kelas]])
                          ->first();
    }

    public function kelasYangDiajar($id_guru){
        return $this->KelasYangDiajar->find('all',['conditions'=>['id_guru'=>$id_guru]])
                                     ->count();
    }
    
    public function jumlahSiswa($id_guru){
        $data =  $this->KelasYangDiajar->find('all',['conditions'=>['id_guru'=>$id_guru]])
                                       ->toList();
        $total = 0;
        foreach ($data as $key => $value) {
            $jumlah = $this->SiswaKelas->find('all',['conditions'=>['id_kelas'=>$value->id_kelas]])
                                       ->count();
            $total += $jumlah;
        }
        return $total;
    }

    public function display()
    {
        $session   = $this->request->getSession();
        $username  = $session->read('username');
        $level     = $session->read('level');
        $id_user   = $session->read('id_user');  

        if(isset($id_user)){
            $dataGuru  = $this->dataGuru($id_user);
            $dataMapel = $this->mataPelajaran($dataGuru->id_mapel);
            $dataWalikelas       = $this->waliKelas($dataGuru->id);
            $dataKelasYangDiajar = $this->kelasYangDiajar($dataGuru->id);
            $dataJumlahSiswa     = $this->jumlahSiswa($dataGuru->id);

            $page = "Dashboard";
            $this->set(compact('page','username','level','dataGuru','dataMapel','dataWalikelas','dataKelasYangDiajar','dataJumlahSiswa','id_user'));
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

    public function ajaxGetGuru(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->Auth->find('all',
                [
                    'conditions'=>[
                        'id'=>$id
                    ]                    
                ]);
            $arrAuth = $checkData->first();
                $checkDataGuru  = $this->Guru->find('all',
                [
                    'conditions'=>[
                        'id_auth'=>$id
                    ]                    
                ]);
            $arrGuru = $checkDataGuru->first();
            if($checkData->count() > 0 && $checkDataGuru->count() > 0):
                $res = [
                    'id'            => $arrGuru->id,
                    'id_auth'       => $arrGuru->id_auth,
                    'nip'           => $arrGuru->nip,
                    'npwp'          => $arrGuru->npwp,
                    'nuptk'         => $arrGuru->nuptk,
                    'nama_guru'     => $arrGuru->nama_guru,
                    'gender'        => $arrGuru->gender,
                    'tmpt_lhr'      => $arrGuru->tmpt_lhr,
                    'tanggal_lahir' => $arrGuru->tanggal_lahir,
                    'agama'         => $arrGuru->agama,
                    'jabatan'       => $arrGuru->jabatan,
                    'tmt_jabatan'   => $arrGuru->tmt_jabatan,
                    'pangkat'       => $arrGuru->pangkat,
                    'tmt_pangkat'   => $arrGuru->tmt_pangkat,
                    'no_hp'         => $arrGuru->no_hp,
                    'nama_pt'       => $arrGuru->nama_pt,
                    'jurusan_di_pt' => $arrGuru->jurusan_di_pt,
                    'tamat_thn_di_pt' => $arrGuru->tamat_thn_di_pt,
                    'sts_keguruan'  => $arrGuru->sts_keguruan,
                    'tmt_tugas_di_sklh' => $arrGuru->tmt_tugas_di_sklh,
                    'masa_kerja_keseluruhan' => $arrGuru->masa_kerja_keseluruhan,
                    'cttn_mutasi_kepeg' => $arrGuru->cttn_mutasi_kepeg,
                    'tgl_lulus_sertifikasi' => $arrGuru->tgl_lulus_sertifikasi,
                    'pensiun_tmt'   => $arrGuru->pensiun_tmt,
                    'kenaikan_gaji_berkala' => $arrGuru->kenaikan_gaji_berkala,
                    'id_mapel'      => $arrGuru->id_mapel,
                    'alamat'        => $arrGuru->alamat,
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

    /**
     * ajax save data
     */
    public function ajaxSaveGuru(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        //form input
        $nip             = trim($this->request->getData('nip'));
        $npwp            = trim($this->request->getData('npwp'));
        $nuptk           = trim($this->request->getData('nuptk'));
        $nama_guru       = ucwords(trim($this->request->getData('nama_guru')));
        $gender          = trim($this->request->getData('gender'));
        $tmpt_lhr        = trim($this->request->getData('tmpt_lhr'));
        $tanggal_lahir   = trim($this->request->getData('tanggal_lahir'));
        $agama           = trim($this->request->getData('agama'));
        $jabatan         = ucwords(trim($this->request->getData('jabatan')));
        $tmt_jabatan     = trim($this->request->getData('tmt_jabatan'));
        $pangkat         = ucwords(trim($this->request->getData('pangkat')));
        $tmt_pangkat     = trim($this->request->getData('tmt_pangkat'));
        $alamat          = trim($this->request->getData('alamat'));
        $no_hp           = trim($this->request->getData('no_hp'));
        $nama_pt         = trim($this->request->getData('nama_pt'));
        $jurusan_di_pt   = trim($this->request->getData('jurusan_di_pt'));
        $tamat_thn_di_pt = trim($this->request->getData('tamat_thn_di_pt'));
        $sts_keguruan    = trim($this->request->getData('sts_keguruan'));
        $tmt_tugas_di_sklh= trim($this->request->getData('tmt_tugas_di_sklh'));
        $masa_kerja_keseluruhan= trim($this->request->getData('masa_kerja_keseluruhan'));
        $cttn_mutasi_kepeg= trim($this->request->getData('cttn_mutasi_kepeg'));
        $tgl_lulus_sertifikasi= trim($this->request->getData('tgl_lulus_sertifikasi'));
        $pensiun_tmt     = trim($this->request->getData('pensiun_tmt'));
        $kenaikan_gaji_berkala= trim($this->request->getData('kenaikan_gaji_berkala'));
        $id_mapel        = trim($this->request->getData('id_mapel'));
        $username        = trim($this->request->getData('username'));
        $password        = trim($this->request->getData('password'));        
        $id              = trim($this->request->getData('id'));
        $id_auth         = trim($this->request->getData('id_auth'));
        
        if ($this->request->is('ajax')):
            if(!empty($password)): // jika input password tidak kosong
                $dataAuth = [
                    'username'   => $username,
                    'password'   => md5($password),
                    'level'      => "guru",
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
                    'nip'           => $nip,
                    'npwp'          => $npwp,
                    'nuptk'         => $nuptk,
                    'nama_guru'     => $nama_guru,
                    'gender'        => $gender,
                    'tmpt_lhr'      => $tmpt_lhr,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat'        => $alamat,
                    'agama'         => $agama,
                    'jabatan'       => $jabatan,
                    'tmt_jabatan'   => $tmt_jabatan,
                    'pangkat'       => $pangkat,
                    'tmt_pangkat'   => $tmt_pangkat,
                    'no_hp'         => $no_hp,
                    'nama_pt'       => $nama_pt,
                    'jurusan_di_pt' => $jurusan_di_pt,
                    'tamat_thn_di_pt'=> $tamat_thn_di_pt,
                    'sts_keguruan'  => $sts_keguruan,
                    'tmt_tugas_di_sklh'=> $tmt_tugas_di_sklh,
                    'masa_kerja_keseluruhan'=> $masa_kerja_keseluruhan,
                    'cttn_mutasi_kepeg'=> $cttn_mutasi_kepeg,
                    'tgl_lulus_sertifikasi'=> $tgl_lulus_sertifikasi,
                    'pensiun_tmt'   => $pensiun_tmt,
                    'kenaikan_gaji_berkala' => $kenaikan_gaji_berkala,
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
            $checkDataGuru = $this->Guru->find('all',
                [
                    'conditions'=>
                    [
                        'nip'   =>$nip,
                    ]
                ])
                ->count();
            if($id == "" && ($checkDataAuth > 0 || $checkDataGuru > 0)):
                if($checkDataAuth > 0):
                    $msg = array(
                        'msg'  => "Username sudah digunakan",
                        'icon' => "error",
                    );
                elseif($checkDataGuru > 0):
                    $msg = array(
                        'msg'  => "NIP sudah terdaftar",
                        'icon' => "error",
                    );
                endif;
            else:
                $guru = $this->Guru->newEmptyEntity();
                $auth = $this->Auth->newEmptyEntity();
                if(!empty($id)): // jika input id tidak kosong
                    $auth = $this->Auth->get($id_auth, [
                        'contain' => [],
                    ]);

                    $guru = $this->Guru->get($id, [
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
                            'nip'           => $nip,
                            'npwp'          => $npwp,
                            'nuptk'         => $nuptk,
                            'nama_guru'     => $nama_guru,
                            'gender'        => $gender,
                            'tmpt_lhr'      => $tmpt_lhr,
                            'tanggal_lahir' => $tanggal_lahir,
                            'alamat'        => $alamat,
                            'agama'         => $agama,
                            'jabatan'       => $jabatan,
                            'tmt_jabatan'   => $tmt_jabatan,
                            'pangkat'       => $pangkat,
                            'tmt_pangkat'   => $tmt_pangkat,
                            'no_hp'         => $no_hp,
                            'nama_pt'       => $nama_pt,
                            'jurusan_di_pt' => $jurusan_di_pt,
                            'tamat_thn_di_pt'=> $tamat_thn_di_pt,
                            'sts_keguruan'  => $sts_keguruan,
                            'tmt_tugas_di_sklh'=> $tmt_tugas_di_sklh,
                            'masa_kerja_keseluruhan'=> $masa_kerja_keseluruhan,
                            'cttn_mutasi_kepeg'=> $cttn_mutasi_kepeg,
                            'tgl_lulus_sertifikasi'=> $tgl_lulus_sertifikasi,
                            'pensiun_tmt'   => $pensiun_tmt,
                            'kenaikan_gaji_berkala' => $kenaikan_gaji_berkala,                            
                            'created_at'    => $created_at,
                            'updated_at'    => $updated_at
                        ];
                    endif;
                    $guru = $this->Guru->patchEntity($guru, $dataGuru);    
                    if($this->Guru->save($guru)) :
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

}
