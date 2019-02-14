<?php
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

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth',[
            'authorize' => 'Controller',
            'authenticate'=>[
                'Form'=>[
                    'fields'=>[
                        'username'=>'username',
                        'password'=>'password'
                        ]
                    ]
                ],
                'loginAction'=>[
                    'controller'=>'Users',
                    'action'=>'login'
                ],
            'logoutRedirect' => [
                'controller' => 'Membres',
                'action' => 'index'
            ],
            'allowedActions' => [
                'controller' => 'Users',
                'action' => 'logout'
            ]
            ]);

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
    public function isAuthorized($user = null)
    {

        if ((bool)($user['role'] === 'ecole')){
            switch ($this->request->getParam('controller')){
                case 'EcolesFfhtb':
                    if($this->request->getParam('action')=='index' ||$this->request->getParam('action')=='edit'||$this->request->getParam('action')=='view')
                        return true;
                    else
                        return false;
                case 'Praticiens':
                    return true;
                case 'Users':
                    if($this->request->getParam('action')=='logout')
                        return true;
                    else
                        return false;
                default:
                    return false;
            }
        }
            return (bool)($user['role'] === 'admin');
    }
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(['controller'=>'Praticiens','action'=>'index']);
            }

            $this->Flash->error(__('Votre identifiant ou votre mot de passe est incorrect'));
        }

    }
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
   /* public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->set(
                __('Invalid username or password, try again', true),
                array(
                    'element' => 'growl'
                )
            );
        }
    }*/
     /*public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }*/
    /*public function isAuthorized($user)
    {
        // Admin peuvent accéder à chaque action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        // Par défaut refuser
        return false;
    }*/
}
