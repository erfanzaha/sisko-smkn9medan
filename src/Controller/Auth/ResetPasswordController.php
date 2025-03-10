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
class ResetPasswordController extends AppController
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

    public function ajaxProsesResetPassword(){
        if ($this->request->is('ajax')) {
            $updated_at = date('Y-m-d H:i:s');

            $session = $this->request->getSession();
            $id_user = $session->read('id_user');

            $password= md5($this->request->getData('r_newpass'));
            $getUser = $this->Auth->find('all',
                [
                    'conditions'=>
                    [
                        'id'=>$id_user,
                    ]
                ]);
            if($getUser->count() > 0){
                $getData = $getUser->first();

                $dataAuth = [
                    'password'   => $password,
                    'updated_at' => $updated_at
                ];

                $auth  = $this->Auth->newEmptyEntity();
                $auth = $this->Auth->get($id_user, [
                    'contain' => [],
                ]);
                $auth = $this->Auth->patchEntity($auth, $dataAuth);
                if ($this->Auth->save($auth)):
                    $session = $this->getRequest()->getSession();
                    $session->destroy();
                    $msg = array(
                            'msg'  => 'Reset password berhasil',
                            'icon' => 'success',
                            'link' => '/auth/login',
                    );
                endif;

                
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
