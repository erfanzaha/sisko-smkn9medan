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
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\Locator\LocatorAwareTrait;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PortalController extends AppController
{
    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function initialize(): void
    {
        parent::initialize();
        date_default_timezone_set("Asia/Jakarta");
        $this->loadModel("Berita");
        $this->loadModel("ProfilSekolah");
        $this->loadModel("Kegiatan");        
    }

    public function viewBerita(){
        $berita = $this->getTableLocator()->get('Berita');
        return $berita->find()
                        ->limit(3)
                        ->toList(); 
    }

    public function viewAllBerita(){
        $berita = $this->getTableLocator()->get('Berita');
        return $berita->find()
                        ->toList(); 
    }

    public function viewKegiatan(){
        $berita = $this->getTableLocator()->get('Kegiatan');
        return $berita->find()
                        ->limit(8)
                        ->toList(); 
    }

    public function viewAllKegiatan(){
        $berita = $this->getTableLocator()->get('Kegiatan');
        return $berita->find()
                        ->toList(); 
    }

    public function getProfilSekolah($tipe){
        $berita = $this->getTableLocator()->get('ProfilSekolah');
        return $berita->find()
                        ->where(['tipe'=>$tipe])
                        ->first(); 
    }

    public function display()
    {        
        $berita   = $this->viewBerita();
        $kegiatan = $this->viewKegiatan();

        $alamat   = $this->getProfilSekolah('alamat');
        $website   = $this->getProfilSekolah('website');
        $email    = $this->getProfilSekolah('email');
        $no_telp  = $this->getProfilSekolah('no_telp');
        $this->set(compact('berita','kegiatan','alamat','website','email','no_telp'));
        try {
            $this->viewBuilder()->setLayout('PortalTemplate');
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function kegiatan()
    {               
        $kegiatan = $this->viewAllKegiatan();

        $alamat   = $this->getProfilSekolah('alamat');
        $website  = $this->getProfilSekolah('website');
        $email    = $this->getProfilSekolah('email');
        $no_telp  = $this->getProfilSekolah('no_telp');
        $this->set(compact('kegiatan','alamat','website','email','no_telp'));
        try {
            $this->viewBuilder()->setLayout('PortalTemplate');
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function berita()
    {               
        $berita = $this->viewAllBerita();

        $alamat   = $this->getProfilSekolah('alamat');
        $website  = $this->getProfilSekolah('website');
        $email    = $this->getProfilSekolah('email');
        $no_telp  = $this->getProfilSekolah('no_telp');
        $this->set(compact('berita','alamat','website','email','no_telp'));
        try {
            $this->viewBuilder()->setLayout('PortalTemplate');
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function detailBerita($id){
        $alamat   = $this->getProfilSekolah('alamat');
        $website  = $this->getProfilSekolah('website');
        $email    = $this->getProfilSekolah('email');
        $no_telp  = $this->getProfilSekolah('no_telp');

        $getBerita = $this->getTableLocator()->get('Berita');
        $berita    = $getBerita->find()
                        ->where(['id'=>$id])
                        ->first(); 
        $this->set(compact('alamat','website','email','no_telp','berita'));
        try {
            $this->viewBuilder()->setLayout('PortalTemplate');
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
}
