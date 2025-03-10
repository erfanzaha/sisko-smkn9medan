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
class SiswaController extends AppController
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
        $this->loadModel("Kelas");
        $this->loadModel("Siswa");
        $this->loadModel("OrangTua");
        $this->loadModel("SiswaKelas");
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

            $page = "Siswa";
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
    public function ajaxSaveSiswa(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        //form input
        $nisn            = trim($this->request->getData('nisn'));
        $nipd            = trim($this->request->getData('nipd'));
        $nama_siswa      = ucwords(trim($this->request->getData('nama_siswa')));
        $email           = trim($this->request->getData('email'));
        $gender          = trim($this->request->getData('gender'));
        $tanggal_lahir   = trim($this->request->getData('tanggal_lahir'));
        $tempat_lahir    = trim($this->request->getData('tempat_lahir'));
        $agama           = trim($this->request->getData('agama'));
        $alamat          = trim($this->request->getData('alamat'));
        $no_hp           = trim($this->request->getData('no_hp'));
        $kewarganegaraan = trim($this->request->getData('kewarganegaraan'));
        $anak_ke         = trim($this->request->getData('anak_ke'));
        $jlh_saudara_kandung = trim($this->request->getData('jlh_saudara_kandung'));
        $jlh_saudara_tiri = trim($this->request->getData('jlh_saudara_tiri'));
        $jlh_saudara_angkat = trim($this->request->getData('jlh_saudara_angkat'));
        $anak_yatim_piatu = trim($this->request->getData('anak_yatim_piatu'));
        $bahasa_dirumah  = trim($this->request->getData('bahasa_dirumah'));
        $tinggal_dengan  = trim($this->request->getData('tinggal_dengan'));
        $jrk_tgl_ke_sklh = trim($this->request->getData('jrk_tgl_ke_sklh'));
        $gol_darah       = trim($this->request->getData('gol_darah'));
        $penyakit        = trim($this->request->getData('penyakit'));
        $kelainan_jasmani= trim($this->request->getData('kelainan_jasmani'));
        $tinggi_badan    = trim($this->request->getData('tinggi_badan'));
        $berat_badan     = trim($this->request->getData('berat_badan'));
        $asal_sekolah    = trim($this->request->getData('asal_sekolah'));
        $tgl_no_sttb     = trim($this->request->getData('tgl_no_sttb'));
        $lama_bljr       = trim($this->request->getData('lama_bljr'));
        $diterima_dikelas= trim($this->request->getData('diterima_dikelas'));
        $diterima_tgl    = trim($this->request->getData('diterima_tgl'));
        $jurusan         = trim($this->request->getData('jurusan'));
        $kesenian        = trim($this->request->getData('kesenian'));
        $olahraga        = trim($this->request->getData('olahraga'));
        $organisasi      = trim($this->request->getData('organisasi'));
        $lain_lain       = trim($this->request->getData('lain-lain'));
        $username        = trim($this->request->getData('username'));
        $password        = trim($this->request->getData('password'));
        $id              = trim($this->request->getData('id'));
        $id_auth         = trim($this->request->getData('id_auth'));
        $id_kelas        = trim($this->request->getData('id_kelas'));
        $id_siswa_kelas  = trim($this->request->getData('id_siswa_kelas'));
        $id_tahun_ajaran = trim($this->request->getData('id_tahun_ajaran'));
        
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
                    'id_auth'         => $id_auth,
                    'nisn'            => $nisn,
                    'nipd'            => $nipd,
                    'nama_siswa'      => $nama_siswa,
                    'email'           => $email,
                    'gender'          => $gender,
                    'tanggal_lahir'   => $tanggal_lahir,
                    'tempat_lahir'    => $tempat_lahir,
                    'alamat'          => $alamat,
                    'agama'           => $agama,
                    'no_hp'           => $no_hp,
                    'kewarganegaraan' => $kewarganegaraan,
                    'anak_ke'         => $anak_ke,
                    'jlh_saudara_kandung'=> $jlh_saudara_kandung,
                    'jlh_saudara_tiri'=> $jlh_saudara_tiri,
                    'jlh_saudara_angkat'=> $jlh_saudara_angkat,
                    'anak_yatim_piatu'=> $anak_yatim_piatu,
                    'bahasa_dirumah'  => $bahasa_dirumah,
                    'tinggal_dengan'  => $tinggal_dengan,
                    'jrk_tgl_ke_sklh' => $jrk_tgl_ke_sklh,
                    'gol_darah'       => $gol_darah,
                    'penyakit'        => $penyakit,
                    'kelainan_jasmani'=> $kelainan_jasmani,
                    'tinggi_badan'    => $tinggi_badan,
                    'berat_badan'     => $berat_badan,
                    'asal_sekolah'    => $asal_sekolah,
                    'tgl_no_sttb'     => $tgl_no_sttb,
                    'lama_bljr'       => $lama_bljr,
                    'diterima_dikelas'=> $diterima_dikelas,
                    'diterima_tgl'    => $diterima_tgl,
                    'jurusan'         => $jurusan,
                    'kesenian'        => $kesenian,
                    'olahraga'        => $olahraga,
                    'organisasi'      => $organisasi,
                    'lain_lain'       => $lain_lain,
                    'updated_at'      => $updated_at
                ];

                $dataSiswaKelas = [
                    'id_kelas'         => $id_kelas,
                    'id_tahun_ajaran'  => $id_tahun_ajaran,
                    'id_siswa'         => $id,
                    'created_at'       => $created_at,
                    'updated_at'       => $updated_at
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
            $checkDataSiswa = $this->Siswa->find('all',
                [
                    'conditions'=>
                    [
                        'nisn'   =>$nisn,
                    ]
                ])
                ->count();
            if($id == "" && ($checkDataAuth > 0 || $checkDataSiswa > 0)):
                if($checkDataAuth > 0):
                    $msg = array(
                        'msg'  => "Username sudah digunakan",
                        'icon' => "error",
                    );
                elseif($checkDataSiswa > 0):
                    $msg = array(
                        'msg'  => "NISN sudah terdaftar",
                        'icon' => "error",
                    );
                endif;
            else:
                $siswa      = $this->Siswa->newEmptyEntity();
                $auth       = $this->Auth->newEmptyEntity();
                $siswaKelas = $this->SiswaKelas->newEmptyEntity();
                if(!empty($id)): // jika input id tidak kosong
                    $auth = $this->Auth->get($id_auth, [
                        'contain' => [],
                    ]);

                    $siswa = $this->Siswa->get($id, [
                        'contain' => [],
                    ]);

                    $siswaKelas = $this->SiswaKelas->get($id_siswa_kelas, [
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
                            'id_auth'         => $getLasAuth->id,
                            'nisn'            => $nisn,
                            'nipd'            => $nipd,
                            'nama_siswa'      => $nama_siswa,
                            'email'           => $email,
                            'gender'          => $gender,
                            'tanggal_lahir'   => $tanggal_lahir,
                            'tempat_lahir'    => $tempat_lahir,
                            'alamat'          => $alamat,
                            'agama'           => $agama,
                            'no_hp'           => $no_hp,
                            'kewarganegaraan' => $kewarganegaraan,
                            'anak_ke'         => $anak_ke,
                            'jlh_saudara_kandung'=> $jlh_saudara_kandung,
                            'jlh_saudara_tiri'=> $jlh_saudara_tiri,
                            'jlh_saudara_angkat'=> $jlh_saudara_angkat,
                            'anak_yatim_piatu'=> $anak_yatim_piatu,
                            'bahasa_dirumah'  => $bahasa_dirumah,
                            'tinggal_dengan'  => $tinggal_dengan,
                            'jrk_tgl_ke_sklh' => $jrk_tgl_ke_sklh,
                            'gol_darah'       => $gol_darah,
                            'penyakit'        => $penyakit,
                            'kelainan_jasmani'=> $kelainan_jasmani,
                            'tinggi_badan'    => $tinggi_badan,
                            'berat_badan'     => $berat_badan,
                            'asal_sekolah'    => $asal_sekolah,
                            'tgl_no_sttb'     => $tgl_no_sttb,
                            'lama_bljr'       => $lama_bljr,
                            'diterima_dikelas'=> $diterima_dikelas,
                            'diterima_tgl'    => $diterima_tgl,
                            'jurusan'         => $jurusan,
                            'kesenian'        => $kesenian,
                            'olahraga'        => $olahraga,
                            'organisasi'      => $organisasi,
                            'lain_lain'       => $lain_lain,
                            'created_at'      => $created_at,
                            'updated_at'      => $updated_at
                        ];
                        
                    endif;
                    $siswa = $this->Siswa->patchEntity($siswa, $dataSiswa);    
                    if($this->Siswa->save($siswa)) :
                        $getLastSiswa = $this->Siswa->find('all',
                        [
                            'conditions'=>
                            [
                                'nisn'   =>$nisn,
                            ]
                        ])
                        ->first();
                        if($id == ""):
                            $dataSiswaKelas = [
                                'id_kelas'         => $id_kelas,
                                'id_tahun_ajaran'  => $id_tahun_ajaran,
                                'id_siswa'         => $getLastSiswa->id,
                                'created_at'       => $created_at,
                                'updated_at'       => $updated_at
                            ];
                        endif;
                        $siswaKelas = $this->SiswaKelas->patchEntity($siswaKelas, $dataSiswaKelas); 
                        if($this->SiswaKelas->save($siswaKelas)) :
                            $msg = array(   
                                'msg'  => 'Data berhasil disimpan',
                                'icon' => 'success',
                            );
                        endif;
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

    public function ajaxViewSiswa(){
        $data = $this->Auth->find('all')
                            ->contain(['Siswa'])
                            ->toList();
        $output = [];
        foreach ($data as $key => $value) {
            $checkOrangTua = $this->OrangTua->find('all',
                [
                    'conditions'=>
                    [
                        'id_siswa'   =>$value['siswa']->id,
                    ]
                ]);
            $checkSiwaKelas = $this->SiswaKelas->find('all',
                [
                    'conditions'=>
                    [
                        'id_siswa'   =>$value['siswa']->id,
                    ]
                ])
                ->order(['id' => 'DESC']);
            if($checkOrangTua->count() > 0){
                $getOrangTua = $checkOrangTua->first();
                $ayah   = $getOrangTua->nama_ayah;
                $ibu    = $getOrangTua->nama_ibu;
            }else{
                $ayah   = null;
                $ibu    = null;
            }

            if($checkSiwaKelas->count() > 0){
                $getSiswaKelas = $checkSiwaKelas->first();
                $checkKelas = $this->Kelas->find('all',
                [
                    'conditions'=>
                    [
                        'id'   =>$getSiswaKelas->id_kelas,
                    ]
                ])
                ->first();
                $kelas = $checkKelas->kelas;
            }else{
                $kelas = "-";
            }

            $set = [
                'id_auth'        => $value['siswa']->id_auth,
                'id'             => $value['siswa']->id,
                'nisn'           => $value['siswa']->nisn,
                'nipd'           => $value['siswa']->nipd,
                'nama_siswa'     => $value['siswa']->nama_siswa,
                'email'          => $value['siswa']->email,
                'gender'         => $value['siswa']->gender,
                'tanggal_lahir'  => $value['siswa']->tanggal_lahir,
                'tempat_lahir'   => $value['siswa']->tempat_lahir,
                'alamat'         => $value['siswa']->alamat,
                'agama'          => $value['siswa']->agama,
                'anak_ke'        => $value['siswa']->anak_ke,
                'anak_yatim_piatu' => $value['siswa']->anak_yatim_piatu,
                'jlh_saudara_kandung' => $value['siswa']->jlh_saudara_kandung,
                'jlh_saudara_tiri' => $value['siswa']->jlh_saudara_tiri,
                'jlh_saudara_angkat' => $value['siswa']->jlh_saudara_angkat,
                'no_hp'          => $value['siswa']->no_hp,
                'bahasa_dirumah' => $value['siswa']->bahasa_dirumah,
                'tinggal_dengan' => $value['siswa']->tinggal_dengan,
                'jrk_tgl_ke_sklh'=> $value['siswa']->jrk_tgl_ke_sklh,
                'gol_darah'      => $value['siswa']->gol_darah,
                'penyakit'       => $value['siswa']->penyakit,
                'kelainan_jasmani' => $value['siswa']->kelainan_jasmani,
                'tinggi_badan'   => $value['siswa']->tinggi_badan,
                'berat_badan'    => $value['siswa']->berat_badan,
                'asal_sekolah'   => $value['siswa']->asal_sekolah,
                'tgl_no_sttb'    => $value['siswa']->tgl_no_sttb,
                'lama_bljr'      => $value['siswa']->lama_bljr,
                'diterima_dikelas' => $value['siswa']->diterima_dikelas,
                'diterima_tgl'   => $value['siswa']->diterima_tgl,
                'jurusan'        => $value['siswa']->jurusan,
                'kesenian'       => $value['siswa']->kesenian,
                'olahraga'       => $value['siswa']->olahraga,
                'organisasi'     => $value['siswa']->organisasi,
                'lain_lain'      => $value['siswa']->lain_lain,
                'kewarganegaraan'=> $value['siswa']->kewarganegaraan,
                'kelas'          => $kelas,
                'orang_tua'      => $ayah." - ".$ibu,
            ];
            array_push($output,$set);
        }
        $arr['data'] = $output;
        echo json_encode($arr);
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
                ])
                ->order(['id' => 'DESC']);

                if($checkSiswaKelas->count() > 0 ){
                    $getSiswaKelas  = $checkSiswaKelas->first();
                    $id_kelas       = $getSiswaKelas->id_kelas;
                    $id_siswa_kelas = $getSiswaKelas->id;
                    $id_tahun_ajaran= $getSiswaKelas->id_tahun_ajaran;
                }else{
                    $id_kelas       = "";
                    $id_siswa_kelas = "";
                    $id_tahun_ajaran= "";
                }

            
            if($checkData->count() > 0 && $checkDataSiswa->count() > 0):
                $res = [
                    'id'               => $arrSiswa->id,
                    'id_auth'          => $arrSiswa->id_auth,
                    'id_tahun_ajaran'  => $id_tahun_ajaran,
                    'id_kelas'         => $id_kelas,
                    'id_siswa_kelas'   => $id_siswa_kelas,
                    'nisn'             => $arrSiswa->nisn,
                    'nipd'             => $arrSiswa->nipd,
                    'nama_siswa'       => $arrSiswa->nama_siswa,
                    'email'            => $arrSiswa->email,
                    'gender'           => $arrSiswa->gender,
                    'tanggal_lahir'    => $arrSiswa->tanggal_lahir,
                    'tempat_lahir'     => $arrSiswa->tempat_lahir,
                    'agama'            => $arrSiswa->agama,
                    'jlh_saudara_kandung' => $arrSiswa->jlh_saudara_kandung,
                    'jlh_saudara_tiri' => $arrSiswa->jlh_saudara_tiri,
                    'jlh_saudara_angkat' => $arrSiswa->jlh_saudara_angkat,
                    'no_hp'            => $arrSiswa->no_hp,
                    'alamat'           => $arrSiswa->alamat,
                    'kewarganegaraan'  => $arrSiswa->kewarganegaraan,
                    'anak_ke'          => $arrSiswa->anak_ke,
                    'anak_yatim_piatu' => $arrSiswa->anak_yatim_piatu,
                    'bahasa_dirumah'   => $arrSiswa->bahasa_dirumah,
                    'tinggal_dengan'   => $arrSiswa->tinggal_dengan,
                    'jrk_tgl_ke_sklh'  => $arrSiswa->jrk_tgl_ke_sklh,
                    'gol_darah'        => $arrSiswa->gol_darah,
                    'penyakit'         => $arrSiswa->penyakit,
                    'kelainan_jasmani' => $arrSiswa->kelainan_jasmani,
                    'tinggi_badan'     => $arrSiswa->tinggi_badan,
                    'berat_badan'      => $arrSiswa->berat_badan,
                    'asal_sekolah'     => $arrSiswa->asal_sekolah,
                    'tgl_no_sttb'      => $arrSiswa->tgl_no_sttb,
                    'lama_bljr'        => $arrSiswa->lama_bljr,
                    'diterima_dikelas' => $arrSiswa->diterima_dikelas,
                    'diterima_tgl'     => $arrSiswa->diterima_tgl,
                    'jurusan'          => $arrSiswa->jurusan,
                    'kesenian'         => $arrSiswa->kesenian,
                    'olahraga'         => $arrSiswa->olahraga,
                    'organisasi'       => $arrSiswa->organisasi,
                    'lain_lain'        => $arrSiswa->lain_lain,
                    'username'         => $arrAuth->username,
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

    public function ajaxDeleteSiswa(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->Siswa->find('all',
                [
                    'conditions'=>
                    [
                        'id_auth'=>$id
                    ]
                ]);
            if($checkData->count() > 0 ):
                $showData     = $checkData->first();
                $getDataAuth  = $this->Auth->get($showData->id_auth);
                $getDataSiswa = $this->Siswa->get($showData->id);
                if($this->Siswa->delete($getDataSiswa) && $this->Auth->delete($getDataAuth)):
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

    public function ajaxSaveKonfirmasiSiswa(){
        if ($this->request->is('ajax')):
            $created_at      = date('Y-m-d H:i:s');
            $updated_at      = date('Y-m-d H:i:s');
            $id_siswa        = $this->request->getData('id_siswa');
            $id_kelas        = $this->request->getData('id_kelas_konfirmasi_kelas');
            $id_tahun_ajaran = $this->request->getData('id_tahun_ajaran_konfirmasi_kelas');
            $status          = $this->request->getData('status_konfirmasi');       
            $checkData = $this->SiswaKelas->find('all',
                [
                    'conditions'=>
                    [
                        'id_siswa'=>$id_siswa,
                        'id_kelas'=>$id_kelas,
                        'id_tahun_ajaran'=>$id_tahun_ajaran,
                    ]
                ]);     
            if($checkData->count() <= 0 ):
                $showData     = $checkData->first();
                $dataSiswaKelas = [
                        'id_kelas'         => $id_kelas,
                        'id_tahun_ajaran'  => $id_tahun_ajaran,
                        'id_siswa'         => $id_siswa,
                        'created_at'       => $created_at,
                        'updated_at'       => $updated_at
                ];
                $siswaKelas = $this->SiswaKelas->newEmptyEntity();
                $siswaKelas = $this->SiswaKelas->patchEntity($siswaKelas, $dataSiswaKelas); 
                if($this->SiswaKelas->save($siswaKelas)) :
                    $msg = array(   
                        'msg'  => 'Data berhasil disimpan',
                        'icon' => 'success',
                    );
                else:
                    $msg = array(   
                        'msg'  => 'Data Gagal Disimpan',
                        'icon' => 'warning',
                    );
                endif;
            else:
                $msg = array(
                    'msg'  => "Data Suda Ada",
                    'icon' => "error",
                );  
            endif;
        endif;
        echo json_encode($msg);
        exit;
    }

}