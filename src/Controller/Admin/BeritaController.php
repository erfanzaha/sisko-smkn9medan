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
class BeritaController extends AppController
{
    
    public function initialize(): void
    {
        parent::initialize();
        date_default_timezone_set("Asia/Jakarta");
        $this->loadModel("Berita");
        $session = $this->request->getSession();
        $status  = $session->read('status');
        if($status == FALSE):
            $this->redirect('/');
        endif;
        $this->loadModel("JadwalPembayaran"); 
    }

    public function jadwalPembayaran(){
        return $this->JadwalPembayaran->find('all')->toList();
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
            $jadwalPembayaran = $this->jadwalPembayaran();
            $page = "Berita";
            $this->set(compact('page','username','level','jadwalPembayaran'));
            try {
                $this->viewBuilder()->setLayout('AdminTemplate','jadwalPembayaran');
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
    public function ajaxSaveBerita(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        $session = $this->request->getSession();
        
        //form input
        $isi_berita = trim($this->request->getData('deskripsi'));
        $title      = trim($this->request->getData('title'));  
        $admin      =  $session->read('username');
        $tanggal    = trim($this->request->getData('tanggal'));        
        $gambar     = $this->request->getData('gambar');
        $id         = trim($this->request->getData('id'));
        
        if ($this->request->is('ajax')):
            if(!empty($_FILES['gambar']['name'])):
                $name = $gambar->getClientFilename();
                $type = $gambar->getClientMediaType();
                $targetPath = WWW_ROOT. 'portal'. DS . 'images'. DS. 'blog'. DS. $name;
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
                    $dataBerita = [
                        'isi_berita'=> $isi_berita,
                        'admin'     => $admin,
                        'title'     => $title,
                        'tanggal'   => $tanggal,                    
                        'gambar'    => $postData,
                        'updated_at'=> $updated_at
                    ];
                else:
                    $dataBerita = [
                        'isi_berita'=> $isi_berita,
                        'admin'     => $admin,
                        'title'     => $title,
                        'tanggal'   => $tanggal,                        
                        'updated_at'=> $updated_at
                    ];
                endif;
            else:
                $dataBerita = [
                    'isi_berita'=> $isi_berita,
                    'admin'     => $admin,
                    'title'     => $title,
                    'tanggal'   => $tanggal,                    
                    'gambar'    => $postData,
                    'created_at'=> $created_at,
                    'updated_at'=> $updated_at
                ];
            endif;

                $berita  = $this->Berita->newEmptyEntity();
                if(!empty($id)): // jika input id tidak kosong
                    $berita = $this->Berita->get($id, [
                        'contain' => [],
                    ]);

                endif;
                
                $berita = $this->Berita->patchEntity($berita, $dataBerita);
                
                if ($this->Berita->save($berita)):
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

    public function ajaxViewBerita(){
        $data['data'] = $this->Berita->find('all')
                            ->toList();        
        echo json_encode($data);
        exit;
        
    }

    public function ajaxGetBerita(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->Berita->find('all',
                [
                    'conditions'=>[
                        'id'=>$id
                    ]                    
                ]);
            $arrBerita = $checkData->first();
            if($checkData->count() > 0 ):
                $res = [
                    'id'         => $arrBerita->id,                  
                    'tanggal'    => $arrBerita->tanggal,
                    'isi_berita' => $arrBerita->isi_berita,
                    'title'      => $arrBerita->title,
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

    public function ajaxDeleteBerita(){
        if ($this->request->is('ajax')):
            $id = $this->request->getData('id');
            $checkData = $this->Berita->find('all',
                [
                    'conditions'=>
                    [
                        'id'=>$id
                    ]
                ]);
            if($checkData->count() > 0 ):
                $showData     = $checkData->first();
                $getData  = $this->Berita->get($id);
                if(unlink(WWW_ROOT. 'portal'. DS . 'images'. DS. 'blog'. DS. $showData->gambar) && $this->Berita->delete($getData)):
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