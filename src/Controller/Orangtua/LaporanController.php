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
use Cake\ORM\Query;
use Cake\ORM\Locator\LocatorAwareTrait;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class LaporanController extends AppController
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
        $this->loadModel("Nilai");  
        $this->loadModel("OrangTua");  
    }

    public function getKelasSiswa($id,$id_tahun_ajaran){
        $data = $this->OrangTua->find('all',
            [
                'conditions'=>
                [
                    'id_auth'=>$id
                ]
            ])
            ->first();

        if(isset($id_tahun_ajaran)){
            $checkData = $this->SiswaKelas->find('all',
            [
                'conditions'=>
                [
                    'id_siswa'=>$data->id_siswa,
                    'id_tahun_ajaran'=>$id_tahun_ajaran
                ]
            ]);
            if($checkData->count() > 0){
                return $checkData->first();
            }else{
                return false;
            }
            
        }else{
            return $this->SiswaKelas->find('all',
            [
                'conditions'=>
                [
                    'id_siswa'=>$data->id_siswa
                ]
            ])
            ->order(['id' => 'DESC'])
            ->first();
        }
    }

    public function display($id_tahun_ajaran = null)   
    {
        $session   = $this->request->getSession();
        $username  = $session->read('username');
        $level     = $session->read('level');
        $id        = $session->read('id_user');
        
        if(isset($id)){
            $kelas     = $this->getKelasSiswa($id,$id_tahun_ajaran);
            if($kelas == false){
                $view  = [];
            }else{
                $view  = $this->ajaxViewLaporan($kelas->id_kelas);
            }

            $page = "Report";
            $this->set(compact('page','username','level','kelas','view'));
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

    public function ajaxViewLaporan($id_kelas){
        // if ($this->request->is('ajax')):
        //     $id_kelas = $this->request->getData('id_kelas');
            $data = $this->SiswaKelas->find('all',
                    [
                        'conditions'=>
                        [
                            'id_kelas'=>$id_kelas,
                        ]
                    ])
                    ->toList();
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
                            'id_siswa'=>$value->id_siswa
                        ]
                    ]);
                $totalNilaiTugas = $getNilai->select(['total' => $getNilai->func()->sum('nilai_tugas')])->first();
                $totalNilaiMid = $getNilai->select(['total' => $getNilai->func()->sum('nilai_mid')])->first();
                $totalNilaiUas = $getNilai->select(['total' => $getNilai->func()->sum('nilai_uas')])->first();
                if($getNilai->count()){
                    $totalNilai = $totalNilaiTugas->total + $totalNilaiMid->total + $totalNilaiUas->total;
                }else{
                    $totalNilai = 0;
                }

                $set = [
                    'total_nilai'=> $totalNilai,
                    'id_siswa'   => $getSiswa->id,
                ];
                array_push($output,$set);
            }
            
            $output2 = [];
            arsort($output);
            foreach ($output as $keys => $values) {
                $getSiswa2 = $this->Siswa->find('all',
                    [
                        'conditions'=>
                        [
                            'id'=>$values['id_siswa'],
                        ]
                    ])
                    ->first();
                $getNilai2 = $this->Nilai->find('all',
                    [
                        'conditions'=>
                        [
                            'id_kelas'=>$id_kelas,
                            'id_siswa'=>$values['id_siswa']
                        ]
                    ]);
                $totalNilaiTugas2 = $getNilai2->select(['total' => $getNilai2->func()->sum('nilai_tugas')])->first();
                $totalNilaiMid2 = $getNilai2->select(['total' => $getNilai2->func()->sum('nilai_mid')])->first();
                $totalNilaiUas2 = $getNilai2->select(['total' => $getNilai2->func()->sum('nilai_uas')])->first();
                if($getNilai2->count()){
                    $nilaiTugas = $totalNilaiTugas2->total;
                    $nilaiMid   = $totalNilaiMid2->total;
                    $nilaiuas   = $totalNilaiUas2->total;
                }else{
                    $nilaiTugas = 0;
                    $nilaiMid   = 0;
                    $nilaiuas   = 0;
                }

                $set2 = [
                    'id_siswa'   => $getSiswa2->id,
                    'nama_siswa' => $getSiswa2->nama_siswa,
                    'nilai_tugas'=> $nilaiTugas,
                    'nilai_mid'  => $nilaiMid,
                    'nilai_uas'  => $nilaiuas,
                    'total_nilai'  => $values['total_nilai'],
                    // 'ranking'      => $keys + 1,
                ];
                array_push($output2,$set2);
            }
            //$arr['data'] = $output2;
            $arr = $output2;
        // endif;
        return $arr;
        // echo json_encode($arr);
        // exit;
    }

}