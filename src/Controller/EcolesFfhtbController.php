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
        $this->loadModel('EcolesFfhtb');
        $this->paginate = [
            'contain' => []
        ];
        if($this->Auth->user('role')=='ecole')
        $ecolesFfhtbs = $this->paginate($this->EcolesFfhtb->find()->where(['user_id'=>$this->Auth->user('id')]));
        else if($this->Auth->user('role')=='admin' || $this->Auth->user('id')=='null')
            $ecolesFfhtbs = $this->paginate($this->EcolesFfhtb);

        $this->set(compact('ecolesFfhtbs'));
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
        if(!$id){
            $this->Flash->error(__('Ecole introuvable.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->loadModel('EcolesFfhtb');
        $ecolesFfhtb = $this->EcolesFfhtb->get($id);
        if(($ecolesFfhtb->user_id!=$this->Auth->user('id') && $this->Auth->user('role')=='ecole') ){
            $this->Flash->error(__('Vous ne pouvez pas modifier l\'ecole.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set('ecolesFfhtb', $ecolesFfhtb);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('EcolesFfhtb');
        $ecolesFfhtb = $this->EcolesFfhtb->newEntity();
        if ($this->request->is('post')) {
            $ecolesFfhtb = $this->EcolesFfhtb->patchEntity($ecolesFfhtb, $this->request->getData());

            $user=$this->EcolesFfhtb->Users->newEntity();
            $user->username=strtoupper(str_replace(" ","-",$ecolesFfhtb->nom))."-2019%";
            $a=md5($ecolesFfhtb->nom.''.$ecolesFfhtb->pays);
            $user->password=$a;
            $user->role='ecole';
            $ecolesFfhtb->user = $user;
            if ($this->EcolesFfhtb->save($ecolesFfhtb)) {
                $this->Flash->success(__('Ecole FFHTb ajouté. Votre identifiant est: '.$user->username.' Votre mot de passe est: '. $a));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Enregistrement impossible.'));
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
        if(!$id ){
            $this->Flash->error(__('Ecole introuvable.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->loadModel('EcolesFfhtb');
        $ecolesFfhtb = $this->EcolesFfhtb->get($id, [
            'contain' => []
        ]);

        if(($ecolesFfhtb->user_id!=$this->Auth->user('id') && $this->Auth->user('role')=='ecole')){
            $this->Flash->error(__('Vous ne pouvez pas modifier l\'ecole.'));
            return $this->redirect(['action' => 'index']);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ecolesFfhtb = $this->EcolesFfhtb->patchEntity($ecolesFfhtb, $this->request->getData());


            if ($this->EcolesFfhtb->save($ecolesFfhtb)) {
                $this->Flash->success(__('Informations sauvegardées.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Enregistrement impossible.'));
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
        if(!$id){
            $this->Flash->error(__('Ecole introuvable.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->loadModel('EcolesFfhtb');
        //$this->request->allowMethod(['post', 'delete']);
        $ecolesFfhtb = $this->EcolesFfhtb->get($id);
        if(($ecolesFfhtb->user_id!=$this->Auth->user('id') && $this->Auth->user('role')=='ecole') ){
            $this->Flash->error(__('The ecoles ffhtb could not be saved. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }
        if ($this->EcolesFfhtb->delete($ecolesFfhtb)) {
            $this->Flash->success(__('Ecole ffhtb supprimée.'));
        } else {
            $this->Flash->error(__('Supression impssible'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
