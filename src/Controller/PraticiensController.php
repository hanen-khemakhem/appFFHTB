<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Praticiens Controller
 *
 *
 * @method \App\Model\Entity\Praticien[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PraticiensController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $praticiens = $this->paginate($this->Praticiens);

        $this->set(compact('praticiens'));
    }

    /**
     * View method
     *
     * @param string|null $id Praticien id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $praticien = $this->Praticiens->get($id, [
            'contain' => []
        ]);

        $this->set('praticien', $praticien);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $praticien = $this->Praticiens->newEntity();
        if (!empty($this->request->getData())) {
            $praticien = $this->Praticiens->patchEntity($praticien, $this->request->getData());
            if ($this->Praticiens->save($praticien)) {
                $this->Flash->success(__('Praticien ajouté.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('impossible d\'ajouter le praticien.'));
        }
        $Pays=$this->Praticiens->pays;
        $this->set(compact('praticien','Pays'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Praticien id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $praticien = $this->Praticiens->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $praticien = $this->Praticiens->patchEntity($praticien, $this->request->getData());
            if ($this->Praticiens->save($praticien)) {
                $this->Flash->success(__('Praticien sauvegardé.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Enregistrement impossible.'));
        }
        $Pays=$this->Praticiens->pays;
        $this->set(compact('praticien','Pays'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Praticien id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $praticien = $this->Praticiens->get($id);
        if ($this->Praticiens->delete($praticien)) {
            $this->Flash->success(__('The praticien has been deleted.'));
        } else {
            $this->Flash->error(__('The praticien could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function prat(){
         $url=WWW_ROOT.'annuaires/praticiens.json';
        $content=file_get_contents($url);
        $json=json_decode(str_replace("var data = ", "", $content))->annuaire;
        $tab=array();
        $tab['prat']=$json;
        dump(count($tab['prat']));
        die();
        $praticiens = [];
        foreach ($tab['prat'] as $k => $value){
            /*$prat = $this->Praticiens->find()->where(['nom' => $value->nomPrenom,
                'niveau' => $value->formation])
                ->first();

            if (!$prat) {*/
                $praticien = $this->Praticiens->newEntity();
                $array = array();
                $praticien->nom = $value->nomPrenom;
                $praticien->niveau = $value->formation;
                $praticien->annee_certif = $value->annee;
                $praticien->pays = $value->pays;
                $praticiens[] = $praticien;
            //}
        }
                dump($this->Praticiens->saveMany($praticiens));
                
        return;
    }
}
