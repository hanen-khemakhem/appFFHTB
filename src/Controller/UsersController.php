<?php

namespace App\Controller;

use Cake\ORM\Query;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if (!$id) {
            $this->Flash->error(__('Utilisateur introuvable.'));
            return $this->redirect(['action' => 'index']);
        }
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if (($user->id != $this->Auth->user('id') && $this->Auth->user('role') == 'ecole')) {
            $this->Flash->error(__('Vous n\'avez pas le droit de voir cet utilisateur. '));
            return $this->redirect(['action' => 'index']);
        }

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Utilisateur enregistré'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Enregistrement impossible.'));
        }
        $this->set(compact('user'));
        $this->set('userTypes', $this->Users->types);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if (!$id) {
            $this->Flash->error(__('Utilisateur introuvable.'));
            return $this->redirect(['action' => 'index']);
        }
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if (($user->id != $this->Auth->user('id') && $this->Auth->user('role') == 'ecole')) {
            $this->Flash->error(__('Vous n\'avez pas le droit de modifier l\'utilisateur'));
            return $this->redirect(['action' => 'index']);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Utilisateur sauvegardé.'));
                if ($user->role == 'admin')
                    return $this->redirect(['action' => 'index']);
                else
                    return $this->redirect(['action' => 'view', $user->id]);
            }
            $this->Flash->error(__('Enregistrement imossible'));
        }
        $this->set(compact('user'));
        $this->set('userTypes', $this->Users->types);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!$id) {
            $this->Flash->error(__('Utilisateur introuvable.'));
            return $this->redirect(['action' => 'index']);
        }
        //$this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('Utilisateur supprimé avec succès.'));
        } else {
            $this->Flash->error(__('Suppression impossible.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                if ($user['role'] == 'ecole')
                    $user = $this->Users->find()
                        ->select(['Users.id', 'Users.username', 'Users.role'])
                        ->where(['Users.id' => $user['id']])
                        ->contain(['EcolesFfhtb' => function (Query $query) {
                            return $query->enableAutoFields(true);
                        }])
                        ->first();
                $this->Auth->setUser($user);
                if (!empty($this->referer()))
                    return $this->redirect($this->referer());
                else
                    return $this->redirect(['controller' => 'Praticiens', 'action' => 'index']);
            }
            $this->Flash->error(__('Votre identifiant ou votre mot de passe est incorrect'));
        }

        $this->viewBuilder()->setLayout('login');
    }

    public function logout()
    {
        $this->viewBuilder()->setLayout('login');
        return $this->redirect($this->Auth->logout());
    }
}
