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
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;

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
        $this->loadModel("Nilai");  
        $this->loadModel("OrangTua"); 
        $this->loadModel("JadwalPembayaran"); 
        $this->loadModel("Pembayaran");  
    }

    public function jlhSiswa(){
        return $this->Siswa->find('all');
    }

    public function jlhOrangTua(){
        return $this->OrangTua->find('all');
    }

    public function jlhGuru(){
        return $this->Guru->find('all');
    }

    public function jlhKelas(){
        return $this->Kelas->find('all');
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
            $jlhSiswa  = $this->jlhSiswa()->count();
            $jlhOrangTua = $this->jlhOrangTua()->count();
            $jlhGuru   = $this->jlhGuru()->count();
            $jlhKelas  = $this->jlhKelas()->count();
            $jadwalPembayaran = $this->jadwalPembayaran()->toList();

            $page = "Dashboard";
            $this->set(compact('page','username','level','jlhSiswa','jlhOrangTua','jlhGuru','jlhKelas','jadwalPembayaran'));
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

    public function viewDashboardPembayaran(){
        if ($this->request->is('ajax')):
        
            $data = $this->Pembayaran->find('all',
            [
                'conditions'=>
                [
                    'status_pembayaran'   =>"belum dibayar",
                ]
            ])->toList();
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
                $getJadwalPembayaran = $this->JadwalPembayaran->find('all',
                    [
                        'conditions'=>
                        [
                            'id'=>$value->id_jadwal_pembayaran,
                        ]
                    ])
                    ->first();
                if(isset($value->jumlah_pembayaran)){
                    $jumlah_pembayaran  = $value->jumlah_pembayaran;
                    $tanggal_pembayaran = $value->tanggal_pembayaran;
                }else{
                    $jumlah_pembayaran  = 0;
                    $tanggal_pembayaran = "-";
                }

                $set = [
                    'id'                => $value->id,
                    'nama_siswa'        => $getSiswa->nama_siswa,
                    'keterangan'        => $getJadwalPembayaran->keterangan,
                    'status_pembayaran' => $value->status_pembayaran,
                    'jumlah_tagihan'    => $getJadwalPembayaran->jumlah_tagihan,                    
                ];
                array_push($output,$set);
            }
            $arr['data'] = $output;
        endif;
        echo json_encode($arr);
        exit;
    }

    public function ajaxSendMailDashboard(){
        // $getJadwalPembayaran = $this->JadwalPembayaran->find('all',
        // [
        //     'conditions'=>
        //     [
        //         'jumlah_pembayaran'     => "",
        //     ]
        // ]);
        // if($getJadwalPembayaran->count() > 0):
            $getSiswa2 = $this->Siswa->find()->toList();
            $getPembayaran = $this->Pembayaran->find('all',
                [
                    'conditions'=>
                    [
                        'status_pembayaran'  => "belum dibayar",
                    ]
                ]);
            foreach ($getPembayaran->toList() as $key => $value) :
                
                if($getPembayaran->count() > 0):
                    $getOrangTua = $this->OrangTua->find('all',
                        [
                            'conditions'=>
                            [
                                'id_siswa'=> $value->id_siswa,
                            ]
                        ]);
                    $getSiswa = $this->Siswa->find('all',
                        [
                            'conditions'=>
                            [
                                'id'=> $value->id_siswa,
                            ]
                        ])
                        ->first();
                    $getJadwalPembayaran = $this->JadwalPembayaran->find('all',
                        [
                            'conditions'=>
                            [
                                'id'=> $value->id_jadwal_pembayaran,
                            ]
                        ])
                        ->first();
                        $keterangan     = $getJadwalPembayaran->keterangan;
                        $jumlah_tagihan = $getJadwalPembayaran->jumlah_tagihan;
                        if($getOrangTua->count() > 0){
                            $dataOrangTua = $getOrangTua->first();
                            $mailer = new Mailer('default');
                            $mailer->setFrom(['me@example.com' => 'MTsS YPI Subulul Huda'])
                                ->setTo($dataOrangTua->email_ayah)
                                ->setSubject($keterangan)
                                ->deliver($keterangan."\nJumlah Tagihan Rp. ".$jumlah_tagihan);
                        }
                        $mailer = new Mailer('default');
                        $mailer->setFrom(['me@example.com' => 'MTsS YPI Subulul Huda'])
                                ->setTo($getSiswa->email)
                                ->setSubject($keterangan)
                                ->deliver($keterangan."\nJumlah Tagihan Rp. ".$jumlah_tagihan);
                    $res = array(
                    'msg'  => "Berhasil data",
                    'icon' => "success",
                );
                echo json_encode($res);
                endif;
                
            endforeach;
        // endif;
        exit;
        
    }

}
