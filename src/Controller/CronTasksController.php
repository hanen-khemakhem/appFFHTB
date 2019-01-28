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
