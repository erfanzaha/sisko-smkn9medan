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
class ForgetPasswordController extends AppController
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
        $cakeDescription = "Sistem Informasi Sekolah";
        $this->set(compact('cakeDescription'));
        try {
            $this->viewBuilder()->setLayout('AuthTemplate');
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function ajaxProsesForgetPassword(){
        if ($this->request->is('ajax')) {
            $username = $this->request->getData('username');            
            $getUsername = $this->Auth->find('all',
                [
                    'conditions'=>
                    [
                        'username'=>$username,                        
                    ]
                ]);
            if($getUsername->count() > 0){
                $session=$this->getRequest()->getSession();
                $getData = $getUsername->first();
                $session->write( [
                        'id_user'   =>$getData->id,
                    ]);
                $msg = array(
                    'msg'  => 'Lanjutkan reset password anda',
                    'icon' => 'success',
                    'link' => '/auth/reset-password',
                );
            }else{
                $msg = array(
                    'msg'  => "Username tidak terdaftar",
                    'icon' => 'warning',
                );
            }
            
        }
        echo json_encode($msg);
        exit;
    }
}