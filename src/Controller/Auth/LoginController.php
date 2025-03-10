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
namespace App\Controller\Auth;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class LoginController extends AppController
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
        $this->loadModel("Auth");
    }

    public function display()
    {        
        try {
            $this->viewBuilder()->setLayout('AuthTemplate');
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function ajaxProsesLogin(){
        if ($this->request->is('ajax')) {
            $user = $this->request->getData('username');
            $pass = md5($this->request->getData('password'));
            $getUser = $this->Auth->find('all',
                [
                    'conditions'=>
                    [
                        'username'=>$user,
                        'password'=>$pass,
                    ]
                ]);
            if($getUser->count() > 0){
                $session=$this->getRequest()->getSession();
                $getData = $getUser->first();
                $session->write( [
                        'id_user'   =>$getData->id,
                        'username'  =>$getData->username,
                        'level'     =>$getData->level,
                        'status'    =>true
                    ]);
                if($getData->level == "admin"){
                    $link = '/admin/dashboard';
                }elseif ($getData->level == "orang tua") {
                    $link = '/orangtua/dashboard';
                }elseif ($getData->level == "guru"){
                    $link = '/guru/dashboard';
                }else{
                    $link = '/siswa/dashboard';
                }
                $msg = array(
                    'msg'  => "Berhasil login",
                    'icon' => 'success',
                    'link' => $link,
                );
            }else{
                $msg = array(
                    'msg'  => "Username atau password salah",
                    'icon' => 'warning',
                );
            }
            
        }
        echo json_encode($msg);
        exit;
    }
}
