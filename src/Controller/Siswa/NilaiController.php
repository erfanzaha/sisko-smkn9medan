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
namespace App\Controller\Siswa;
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
        $this->loadModel("Nilai");  
    }

    public function display()   
    {
        $session   = $this->request->getSession();
        $username  = $session->read('username');
        $level     = $session->read('level');
        $id_user   = $session->read('id_user');  

        if(isset($id_user)){
            $page = "Nilai";
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

    public function ajaxViewNilai(){
        if ($this->request->is('ajax')):
            $session  = $this->request->getSession();
            $id_user  = $session->read('id_user');
            $id_tahun_ajaran = strtoupper(trim($this->request->getData('id_tahun_ajaran')));

            $getDataUser = $this->Siswa->find('all',
            [
                'conditions'=>
                [
                    'id_auth'=>$id_user
                ]
            ])
            ->first();

            $getNilai = $this->Nilai->find('all',
            [
                'conditions'=>
                [
                    'id_siswa'=>$getDataUser->id,
                    'id_tahun_ajaran' => $id_tahun_ajaran
                ]
            ])
            ->toList();
            $output = [];
            foreach ($getNilai as $key => $value) {
                $getMapel = $this->MataPelajaran->find('all',
                    [
                        'conditions'=>
                        [
                        'id'=>$value->id_mapel
                    ]
                ])
                ->first();

                $nilaiTugas = $value->nilai_tugas;
                $nilaiMid   = $value->nilai_mid;
                $nilaiuas   = $value->nilai_uas;
                $mapel      = $getMapel->mata_pelajaran;
                $set = [
                    'mapel'      => $mapel,
                    'nilai_tugas'=> $nilaiTugas,
                    'nilai_mid'  => $nilaiMid,
                    'nilai_uas'  => $nilaiuas,
                ];
                array_push($output,$set);
            }
            $arr['data'] = $output;
        endif;
        echo json_encode($arr);
        exit;
    }

}