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
use Cake\ORM\Query;
use Cake\ORM\Locator\LocatorAwareTrait;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class WaliKelasController extends AppController
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
        $this->loadModel("SiswaKelas");
        $this->loadModel("Guru");
        $this->loadModel("Siswa");
        $this->loadModel("OrangTua");
    }    

    public function display()   
    {
        $session   = $this->request->getSession();
        $username  = $session->read('username');
        $level     = $session->read('level');
        $id_user   = $session->read('id_user');

        if(isset($id_user)){
            $page = "Wali Kelas";
            $this->set(compact('page','username','level'));
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

    public function ajaxViewWaliKelas(){
        if ($this->request->is('ajax')):
            $session         = $this->request->getSession();
            $id_user         = $session->read('id_user');
            $id_tahun_ajaran = $this->request->getData('id_tahun_ajaran');
            $getGuru         = $this->Guru->find('all',
                                [
                                    'conditions'=>
                                    [
                                        'id_auth'=>$id_user,                        
                                    ]
                                ])
                                ->first();
            $checkData = $this->WaliKelas->find('all',
                [
                    'conditions'=>
                    [
                        'id_guru'=>$getGuru->id,                        
                        'id_tahun_ajaran'=>$id_tahun_ajaran,
                    ]
                ])
                ->first();
            $data = $this->SiswaKelas->find('all',
                [
                    'conditions'=>
                    [
                        'id_kelas'=>$checkData->id_kelas,                        
                        'id_tahun_ajaran'=>$id_tahun_ajaran,
                    ]
                ])
                ->toList();
            $output = [];
            foreach ($data as $key => $value) {
                $checkOrangTua = $this->OrangTua->find('all',
                    [
                        'conditions'=>
                        [
                            'id_siswa'   =>$value->id_siswa,
                        ]
                    ]);
                if($checkOrangTua->count() > 0){
                    $getOrangTua = $checkOrangTua->first();
                    $ayah   = $getOrangTua->nama_ayah;
                    $ibu    = $getOrangTua->nama_ibu;
                }else{
                    $ayah   = null;
                    $ibu    = null;
                }

                $checkKelas = $this->Kelas->find('all',
                    [
                        'conditions'=>
                        [
                            'id'   =>$checkData->id_kelas,
                        ]
                    ])
                    ->first();
                $getSiswa = $this->Siswa->find('all',
                [
                    'conditions'=>
                    [
                        'id'   =>$value->id_siswa,
                    ]
                ])
                ->first();

                $set = [
                    'id_auth'        => $getSiswa->id_auth,
                    'id'             => $getSiswa->id,
                    'nisn'           => $getSiswa->nisn,
                    'nama_siswa'     => $getSiswa->nama_siswa,
                    'email'          => $getSiswa->email,
                    'gender'         => $getSiswa->gender,
                    'tanggal_lahir'  => $getSiswa->tanggal_lahir,
                    'alamat'         => $getSiswa->alamat,
                    'agama'          => $getSiswa->agama,
                    'jumlah_saudara' => $getSiswa->jumlah_saudara." orang",
                    'no_hp'          => $getSiswa->no_hp,
                    'kelas'          => $checkKelas->kelas,
                    'orang_tua'      => $ayah." - ".$ibu,
                ];
                array_push($output,$set);
            }
            $arr['data'] = $output;
        endif;
        echo json_encode($arr);
        exit;
    }    

}