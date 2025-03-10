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
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class JadwalPembayaranController extends AppController
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
        $this->loadModel("JadwalPembayaran");  
        $this->loadModel("Pembayaran");  
        $this->loadModel("OrangTua");  
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
            $page = "Jadwal Pembayaran";
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

    public function ajaxSaveJadwalPembayaran(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        //form input
        $keterangan         = trim($this->request->getData('keterangan'));
        $tanggal_jatuh_tempo= trim($this->request->getData('tanggal_jatuh_tempo'));
        $jumlah_tagihan     = preg_replace("/[^0-9]/", "",$this->request->getData('jumlah_tagihan'));
        $id                 = trim($this->request->getData('id'));
        
        if ($this->request->is('ajax')):
            
            if(!empty($id)):
                $data = 
                [
                    'keterangan'            => $keterangan,
                    'tanggal_jatuh_tempo'   => $tanggal_jatuh_tempo,
                    'jumlah_tagihan'        => $jumlah_tagihan,                    
                    'updated_at'            => $updated_at,
                ];
            else:
                $data = 
                [
                    'keterangan'            => $keterangan,
                    'tanggal_jatuh_tempo'   => $tanggal_jatuh_tempo,
                    'jumlah_tagihan'        => $jumlah_tagihan,
                    'created_at'            => $created_at,
                    'updated_at'            => $updated_at,
                ];
            endif;
                $jadwalPembayaran = $this->JadwalPembayaran->newEmptyEntity();
                if(!empty($id)):
                    $jadwalPembayaran = $this->JadwalPembayaran->get($id, [
                        'contain' => [],
                    ]);
                endif;
                $jadwalPembayaran = $this->JadwalPembayaran->patchEntity($jadwalPembayaran, $data);
                if ($this->JadwalPembayaran->save($jadwalPembayaran)) :

                    $getSiswa = $this->Siswa->find()->toList();
                    foreach ($getSiswa as $key => $value) {
                        $getOrangTua = $this->OrangTua->find('all',
                        [
                            'conditions'=>
                            [
                                'id_siswa'=> $value->id,
                            ]
                        ]);
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
                                ->setTo($value->email)
                                ->setSubject($keterangan)
                                ->deliver($keterangan."\nJumlah Tagihan Rp. ".$jumlah_tagihan);
                        
                    }

                    $getJadwalPembayaran = $this->JadwalPembayaran->find('all',
                        [
                            'conditions'=>
                            [
                                'keterangan'            => $keterangan,
                                'tanggal_jatuh_tempo'   => $tanggal_jatuh_tempo,
                                'jumlah_tagihan'        => $jumlah_tagihan,
                            ]
                        ]);
                    if($getJadwalPembayaran->count() > 0):
                        $checkJadwalPembayaran = $getJadwalPembayaran->first();
                        $getSiswa2 = $this->Siswa->find()->toList();
                        foreach ($getSiswa2 as $key => $value) :
                            $getPembayaran = $this->Pembayaran->find('all',
                            [
                                'conditions'=>
                                [
                                    'id_jadwal_pembayaran'  => $checkJadwalPembayaran->id,
                                    'id_siswa'              => $value->id,
                                ]
                            ]);
                            if($getPembayaran->count() <= 0){
                                $dataPembayaran = [
                                    'id_jadwal_pembayaran' => $checkJadwalPembayaran->id,
                                    'id_siswa'             => $value->id,
                                    'status_pembayaran'    => 'belum dibayar',
                                    'jumlah_pembayaran'    => 0,
                                    'created_at'           => $created_at,
                                    'updated_at'           => $updated_at,
                                ];
                                $pembayaran = $this->Pembayaran->newEmptyEntity();
                                $pembayaran = $this->Pembayaran->patchEntity($pembayaran, $dataPembayaran);
                                $this->Pembayaran->save($pembayaran);
                            }
                            
                        endforeach;
                    endif;
                    
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

    public function ajaxViewJadwalPembayaran(){
        if ($this->request->is('ajax')):
            $data['data'] = $this->JadwalPembayaran->find()->toList();
        endif;
        echo json_encode($data);
        exit;
    }

    public function ajaxGetJadwalPembayaran(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            
            $checkData = $this->JadwalPembayaran->find('all',
                [
                    'conditions'=>
                    [
                        'id'=> $id,
                    ]
                ]);
            if($checkData->count() > 0 ):
                $res = $checkData->first();
            else:
                $res =  array(
                    'msg'  => "Data tidak ditemukan",
                    'icon' => "error",
                );  
            endif;
        endif;
        echo json_encode($res);
        exit;
    }

    public function ajaxDeleteJadwalPembayaran(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->JadwalPembayaran->find('all',
                [
                    'conditions'=>
                    [
                        'id'=>$id
                    ]
                ]);
            if($checkData->count() > 0 ):
                $getData  = $this->JadwalPembayaran->get($id);
                if($this->JadwalPembayaran->delete($getData)):
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