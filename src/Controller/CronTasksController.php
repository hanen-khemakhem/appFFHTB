<?php
namespace App\Controller;


/**
 * CronTasks Controller
 *
 * @property \App\Model\Table\CronTasksTable $CronTasks
 * @property \App\Model\Table\MembresTable $Membres
 * @property \App\Model\Table\PraticiensTable $Praticiens
 *
 * @method \App\Model\Entity\CronTask[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CronTasksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $cronTasks = $this->paginate($this->CronTasks);

        $this->set(compact('cronTasks'));
    }

    /**
     * View method
     *
     * @param string|null $id Cron Task id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cronTask = $this->CronTasks->get($id, [
            'contain' => []
        ]);

        $this->set('cronTask', $cronTask);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cronTask = $this->CronTasks->newEntity();
        if ($this->request->is('post')) {
            $cronTask = $this->CronTasks->patchEntity($cronTask, $this->request->getData());
            if ($this->CronTasks->save($cronTask)) {
                $this->Flash->success(__('The cron task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cron task could not be saved. Please, try again.'));
        }
        $this->set(compact('cronTask'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cron Task id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cronTask = $this->CronTasks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cronTask = $this->CronTasks->patchEntity($cronTask, $this->request->getData());
            if ($this->CronTasks->save($cronTask)) {
                $this->Flash->success(__('The cron task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cron task could not be saved. Please, try again.'));
        }
        $this->set(compact('cronTask'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cron Task id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cronTask = $this->CronTasks->get($id);
        if ($this->CronTasks->delete($cronTask)) {
            $this->Flash->success(__('The cron task has been deleted.'));
        } else {
            $this->Flash->error(__('The cron task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    function exportMembresFFHTB(){
        $this->loadModel('Membres');
        $controller = $this->request->getQuery('controller');
        $action = $this->request->getQuery('action');
        $this->CronTasks->membreJson($controller,$action);

    }
    function exportPraticiensFFHTB(){
        $this->loadModel('Praticiens');
        $controller = $this->request->getQuery('controller');
        $action = $this->request->getQuery('action');
        $this->CronTasks->praticienJson($controller,$action);

    }
}
