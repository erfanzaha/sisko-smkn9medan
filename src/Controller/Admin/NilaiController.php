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
class NilaiController extends AppController
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
        $this->loadModel("JadwalPembayaran"); 
        $this->loadModel("Nilai");  
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
            $page = "Nilai";
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

    public function ajaxSaveNilai(){
       $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        //form input
        $id_siswa   = trim($this->request->getData('id_siswa'));
        $id_kelas   = trim($this->request->getData('id_kelas_nilai'));
        $id_guru    = trim($this->request->getData('id_guru_nilai'));
        $nilai_tugas= trim($this->request->getData('nilai_tugas'));
        $nilai_mid  = trim($this->request->getData('nilai_mid'));
        $nilai_uas  = trim($this->request->getData('nilai_uas'));
        $id         = trim($this->request->getData('id'));
        
        if ($this->request->is('ajax')):

            $getGuru = $this->Guru->find('all',
                [
                    'conditions'=>
                    [
                        'id'   =>$id_guru,                        
                    ]
                ])
                ->first();

            
            if(!empty($id)):
                $data = 
                [
                    'id_mapel'    => $getGuru->id_mapel,
                    'id_guru'     => $id_guru,
                    'id_kelas'    => $id_kelas,
                    'id_siswa'    => $id_siswa,
                    'nilai_tugas' => $nilai_tugas,
                    'nilai_mid'   => $nilai_mid,
                    'nilai_uas'   => $nilai_uas,
                    'updated_at'  => $updated_at,
                ];
            else:
                $data = 
                [
                    'id_mapel'    => $getGuru->id_mapel,
                    'id_guru'     => $id_guru,
                    'id_kelas'    => $id_kelas,
                    'id_siswa'    => $id_siswa,
                    'nilai_tugas' => $nilai_tugas,
                    'nilai_mid'   => $nilai_mid,
                    'nilai_uas'   => $nilai_uas,
                    'created_at'  => $created_at,
                    'updated_at'  => $updated_at,
                ];
            endif;
                $nilai = $this->Nilai->newEmptyEntity();
                if(!empty($id)):
                    $nilai = $this->Nilai->get($id, [
                        'contain' => [],
                    ]);
                endif;
                $nilai = $this->Nilai->patchEntity($nilai, $data);
                if ($this->Nilai->save($nilai)) :

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

    public function ajaxViewNilai(){
        if ($this->request->is('ajax')):
            $id_kelas = $this->request->getData('id_kelas');
            $id_guru  = $this->request->getData('id_guru');
            $id_tahun_ajaran  = $this->request->getData('id_tahun_ajaran');

            $getGuru  = $this->Guru->find('all',
            [
                'conditions'=>
                [
                    'id_auth'=>$id_guru,
                ]
            ])
            ->first();
        
            $data = $this->SiswaKelas->find('all',
                    [
                        'conditions'=>
                        [
                            'id_kelas'=>$id_kelas,
                        ]
                    ]);
            $output = [];
            foreach ($data as $key => $value) {
                
                $getSiswa = $this->Siswa->find('all',
                    [
                        'conditions'=>
                        [
                            'id'=>$value->id_siswa,
                        ]
                    ])
                    ->first();
                $getNilai = $this->Nilai->find('all',
                    [
                        'conditions'=>
                        [
                            'id_kelas'=>$id_kelas,
                            'id_guru' =>$id_guru,
                            'id_siswa'=>$value->id_siswa
                        ]
                    ]);
                if($getNilai->count()){
                    $dataNilai = $getNilai->first();
                    $nilaiTugas = $dataNilai->nilai_tugas;
                    $nilaiMid   = $dataNilai->nilai_mid;
                    $nilaiuas   = $dataNilai->nilai_uas;
                }else{
                    $nilaiTugas = 0;
                    $nilaiMid   = 0;
                    $nilaiuas   = 0;
                }

                $set = [
                    'id_siswa'   => $getSiswa->id,
                    'nama_siswa' => $getSiswa->nama_siswa,
                    'nilai_tugas'=> $nilaiTugas,
                    'nilai_mid'  => $nilaiMid,
                    'nilai_uas'  => $nilaiuas,
                    'id_guru'    => $id_guru,
                ];
                array_push($output,$set);
            }
            $arr['data'] = $output;
        endif;
        echo json_encode($arr);
        exit;
    }

    public function ajaxGetNilai(){
        if ($this->request->is('ajax')):
            $id_siswa = $this->request->getData('id_siswa');
            $id_kelas = $this->request->getData('id_kelas');
            $id_user  = $this->request->getData('id_guru');
            
            $checkData = $this->Nilai->find('all',
                [
                    'conditions'=>
                    [
                        'id_siswa'=> $id_siswa,
                        'id_guru' => $id_user
                    ]
                ]);
            if($checkData->count() > 0 ):
                $res = $checkData->first();
            else:
                $res = [
                    'id' => null,
                    'nilai_tugas' => null,
                    'nilai_mid' => null,
                    'nilai_uas' => null,
                ]; 
            endif;
        endif;
        echo json_encode($res);
        exit;
    }

}