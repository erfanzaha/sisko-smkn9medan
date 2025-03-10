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
        $this->loadModel("Guru");
    }    

    public function ajaxSaveWaliKelas(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        //form input
        $id_kelas = strtoupper(trim($this->request->getData('id_kelas')));
        $id_tahun_ajaran_wali_kelas = strtoupper(trim($this->request->getData('id_tahun_ajaran_wali_kelas')));
        $id_guru  = strtoupper(trim($this->request->getData('id_guru')));
        $id       = trim($this->request->getData('id_wali_kelas'));
        
        if ($this->request->is('ajax')):
            
            if(!empty($id)):
                $data = 
                [
                    'id_kelas'          => $id_kelas,
                    'id_guru'           => $id_guru,
                    'id_tahun_ajaran'   => $id_tahun_ajaran_wali_kelas,
                    'updated_at'        => $updated_at
                ];
            else:
                $data = 
                [
                    'id_kelas'          => $id_kelas,
                    'id_guru'           => $id_guru,
                    'id_tahun_ajaran'   => $id_tahun_ajaran_wali_kelas,
                    'created_at'        => $created_at,
                    'updated_at'        => $updated_at
                ];
            endif;
            $checkData = $this->WaliKelas->find('all',
                [
                    'conditions'=>
                    [
                        'id_guru'         =>$id_guru,
                        'id_kelas'        =>$id_kelas,
                        'id_tahun_ajaran' => $id_tahun_ajaran_wali_kelas
                    ]
                ])
                ->count();
            if($checkData > 0):
                $msg = array(
                    'msg'  => "Data sudah ada",
                    'icon' => "error",
                );
            else:
                $waliKelas = $this->WaliKelas->newEmptyEntity();
                if(!empty($id)):
                    $waliKelas = $this->WaliKelas->get($id, [
                        'contain' => [],
                    ]);
                endif;
                $waliKelas = $this->WaliKelas->patchEntity($waliKelas, $data);
                if ($this->WaliKelas->save($waliKelas)) :

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

    public function ajaxGetWaliKelas(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->WaliKelas->find('all',
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

}