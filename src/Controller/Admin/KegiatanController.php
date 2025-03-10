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
use Cake\Event\EventInterface;
use Cake\Datasource\FactoryLocator;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class KegiatanController extends AppController
{
    
    public function initialize(): void
    {
        parent::initialize();
        date_default_timezone_set("Asia/Jakarta");
        $this->loadModel("Kegiatan");        
        $session = $this->request->getSession();
        $status  = $session->read('status');
        if($status == FALSE):
            $this->redirect('/');
        endif;
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
            $page = "Kegiatan";
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
    public function ajaxSaveKegiatan(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        //form input
        $keterangan = trim($this->request->getData('keterangan'));
        $tanggal    = trim($this->request->getData('tanggal'));        
        $gambar     = $this->request->getData('gambar');
        $id         = trim($this->request->getData('id'));
        
        if ($this->request->is('ajax')):

            if(!empty($_FILES['gambar']['name'])):
                $name = $gambar->getClientFilename();
                $type = $gambar->getClientMediaType();
                $targetPath = WWW_ROOT. 'portal'. DS . 'images'. DS. 'gallery'. DS. $name;
                if ($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png') :
                    if (!empty($name)) :
                        if ($gambar->getSize() > 0 && $gambar->getError() == 0) :
                            $gambar->moveTo($targetPath); 
                            $postData = $name;
                        endif;
                    endif;
                endif;
            else:
                $postData = "";
            endif;

            if(!empty($id)):
                if($postData != ""):
                    $dataKegiatan = [
                        'keterangan'   => $keterangan,
                        'tanggal'      => $tanggal,                    
                        'gambar'       => $postData,
                        'updated_at'   => $updated_at
                    ];
                else:
                    $dataKegiatan = [
                        'keterangan'   => $keterangan,
                        'tanggal'      => $tanggal,                    
                        'updated_at'   => $updated_at
                    ];
                endif;
            else:
                $dataKegiatan = [
                    'keterangan'   => $keterangan,
                    'tanggal'      => $tanggal,                    
                    'gambar'       => $postData,
                    'created_at'   => $created_at,
                    'updated_at'   => $updated_at
                ];
            endif;

                $kegiatan  = $this->Kegiatan->newEmptyEntity();
                if(!empty($id)): // jika input id tidak kosong
                    $kegiatan = $this->Kegiatan->get($id, [
                        'contain' => [],
                    ]);

                endif;
                
                $kegiatan = $this->Kegiatan->patchEntity($kegiatan, $dataKegiatan);
                
                if ($this->Kegiatan->save($kegiatan)):
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

    public function ajaxViewKegiatan(){
        $data['data'] = $this->Kegiatan->find('all')
                            ->toList();
        echo json_encode($data);
        exit;
        
    }

    public function ajaxGetKegiatan(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->Kegiatan->find('all',
                [
                    'conditions'=>[
                        'id'=>$id
                    ]                    
                ]);
            $arrKegiatan = $checkData->first();
            if($checkData->count() > 0 ):
                $res = [
                    'id'         => $arrKegiatan->id,
                    'keterangan' => $arrKegiatan->keterangan,                    
                    'tanggal'    => $arrKegiatan->tanggal,
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

    public function ajaxDeleteKegiatan(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->Kegiatan->find('all',
                [
                    'conditions'=>
                    [
                        'id'=>$id
                    ]
                ]);
            if($checkData->count() > 0 ):
                $showData     = $checkData->first();
                $getData  = $this->Kegiatan->get($id);
                if(unlink(WWW_ROOT. 'portal'. DS . 'images'. DS. 'gallery'. DS. $showData->gambar) && $this->Kegiatan->delete($getData)):
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