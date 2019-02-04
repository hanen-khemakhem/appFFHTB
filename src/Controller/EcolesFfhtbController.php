<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EcolesFfhtb Controller
 *
 * @property \App\Model\Table\EcolesFfhtbTable $EcolesFfhtb
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\EcolesFfhtb[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EcolesFfhtbController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $ecolesFfhtb = $this->paginate($this->EcolesFfhtb);

        $this->set(compact('ecolesFfhtb'));
    }

    /**
     * View method
     *
     * @param string|null $id Ecoles Ffhtb id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ecolesFfhtb = $this->EcolesFfhtb->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('ecolesFfhtb', $ecolesFfhtb);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Users');
        $ecolesFfhtb = $this->EcolesFfhtb->newEntity();
        if ($this->request->is('post')) {
            $ecolesFfhtb = $this->EcolesFfhtb->patchEntity($ecolesFfhtb, $this->request->getData());

            if ($this->EcolesFfhtb->save($ecolesFfhtb)) {
                $user=$this->Users->newEntity();
                $user->username=str_replace(" ","-",$ecolesFfhtb->nom);
                $a=sprintf("E%06d",$ecolesFfhtb->id);
                $user->password=$a;
                $user->role='admin';
                $this->Users->save($user);
                $ecolesFfhtb->user_id=$user->id;
                $this->EcolesFfhtb->save($ecolesFfhtb);
                $this->Flash->success(__('Ecole FFHTb ajouté. Votre identifiant est: '.$user->username.' Votre mot de passe est: '. $a));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ecoles ffhtb could not be saved. Please, try again.'));
        }
        $users = $this->EcolesFfhtb->Users->find('list', ['limit' => 200]);
        $Pays = $this->EcolesFfhtb->pays;

        $this->set(compact('ecolesFfhtb', 'users','Pays'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ecoles Ffhtb id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ecolesFfhtb = $this->EcolesFfhtb->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ecolesFfhtb = $this->EcolesFfhtb->patchEntity($ecolesFfhtb, $this->request->getData());
            if ($this->EcolesFfhtb->save($ecolesFfhtb)) {
                $this->Flash->success(__('The ecoles ffhtb has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ecoles ffhtb could not be saved. Please, try again.'));
        }
        $Pays = $this->EcolesFfhtb->pays;
        $users = $this->EcolesFfhtb->Users->find('list', ['limit' => 200]);
        $this->set(compact('ecolesFfhtb', 'users','Pays'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ecoles Ffhtb id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ecolesFfhtb = $this->EcolesFfhtb->get($id);
        if ($this->EcolesFfhtb->delete($ecolesFfhtb)) {
            $this->Flash->success(__('The ecoles ffhtb has been deleted.'));
        } else {
            $this->Flash->error(__('The ecoles ffhtb could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
