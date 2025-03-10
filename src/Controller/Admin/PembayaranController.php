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
class PembayaranController extends AppController
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
        return $this->JadwalPembayaran->find('all')->toList();
    }

    public function getDetailPembayaran($id){
        $pembayaran = $this->Pembayaran->find('all',
        [
            'conditions'=>
            [
                'id'=>$id,
            ]
        ])
        ->first();

        $JadwalPembayaran = $this->JadwalPembayaran->find('all',
        [
            'conditions'=>
            [
                'id'=>$pembayaran->id_jadwal_pembayaran,
            ]
        ])
        ->first();

        $Siswa = $this->Siswa->find('all',
        [
            'conditions'=>
            [
                'id'=>$pembayaran->id_siswa,
            ]
        ])
        ->first();

        $data = [
            "no_record"         => $id,
            'nama_siswa'        => $Siswa->nama_siswa,
            'keterangan'        => $JadwalPembayaran->keterangan,
            'jumlah_tagihan'    => $JadwalPembayaran->jumlah_tagihan,
            'jumlah_pembayaran' => $pembayaran->jumlah_pembayaran,
            'tanggal'           => $pembayaran->tanggal_pembayaran
        ];

        return $data;
    }

    public function display()   
    {
        $session   = $this->request->getSession();
        $username  = $session->read('username');
        $level     = $session->read('level');
        $id_user   = $session->read('id_user');  

        if(isset($id_user)){
            $jadwalPembayaran = $this->jadwalPembayaran();

            $page = "Pembayaran";
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

    public function cetakPembayaran($id)   
    {

        $session   = $this->request->getSession();
        $username  = $session->read('username');
        $level     = $session->read('level');
        $jadwalPembayaran = $this->jadwalPembayaran();
        $detailPembayaran = $this->getDetailPembayaran($id);

        $page = "Cetak Pembayaran";
        $this->set(compact('page','username','level','jadwalPembayaran','detailPembayaran'));
        try {
            $this->viewBuilder()->setLayout('CetakTemplate');
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function ajaxSavePembayaran(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        //form input
        $tanggal_pembayaran = trim($this->request->getData('tanggal_pembayaran'));
        $jumlah_pembayaran  = preg_replace("/[^0-9]/", "",$this->request->getData('jumlah_pembayaran'));
        $id                 = trim($this->request->getData('id'));
        
        if ($this->request->is('ajax')):
                $data = 
                [
                    'status_pembayaran'  => "sudah dibayar",
                    'jumlah_pembayaran'  => $jumlah_pembayaran,
                    'tanggal_pembayaran' => $tanggal_pembayaran,
                    'updated_at'         => $updated_at,
                ];
                $pembayaran = $this->Pembayaran->newEmptyEntity();
                if(!empty($id)):
                    $pembayaran = $this->Pembayaran->get($id, [
                        'contain' => [],
                    ]);
                endif;
                $pembayaran = $this->Pembayaran->patchEntity($pembayaran, $data);
                if ($this->Pembayaran->save($pembayaran)) :

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

    public function ajaxViewPembayaran(){
        if ($this->request->is('ajax')):

        
            $data = $this->Pembayaran->find()->toList();
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
                    'jumlah_pembayaran' => $jumlah_pembayaran,
                    'tanggal_pembayaran'=> $tanggal_pembayaran,
                ];
                array_push($output,$set);
            }
            $arr['data'] = $output;
        endif;
        echo json_encode($arr);
        exit;
    }

    public function ajaxGetPembayaran(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            
            $checkData = $this->Pembayaran->find('all',
                [
                    'conditions'=>
                    [
                        'id'=> $id,
                    ]
                ]);
            if($checkData->count() > 0 ):
                $res = $checkData->first();
            else:
                $res = [
                    'id' => null,
                    'tanggal_pembayaran' => null,
                    'jumlah_pembayaran' => null,
                ]; 
            endif;
        endif;
        echo json_encode($res);
        exit;
    }

}