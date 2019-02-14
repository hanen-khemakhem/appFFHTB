<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

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
        if($this->Auth->user('role')=='ecole')
        $praticiens = $this->paginate($this->Praticiens->find()->where(['user_id'=>$this->Auth->user('id')]));
        else if($this->Auth->user('role')=='admin' || $this->Auth->user('id')=='null')
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

            $praticien->user_id=$this->Auth->user('id');
            if($this->Auth->user('role')=='ecole')
            $praticien->in_ecole=1;
            else
                $praticien->in_ecole=0;
            if ($this->Praticiens->save($praticien)) {
                $this->Flash->success(__('Praticien ajouté.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('impossible d\'ajouter le praticien.'));
        }
        $specialites=$this->Praticiens->specialites;
        $Pays=$this->Praticiens->pays;
        $this->set(compact('praticien','Pays','specialites'));
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
        $specialites=$this->Praticiens->specialites;
        $Pays=$this->Praticiens->pays;
        $this->set(compact('praticien','Pays','specialites'));
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
         $url=WWW_ROOT.'annuaires/annuaire_ffhtb.json';
        $content=file_get_contents($url);
        $json=json_decode(str_replace("var data = ", "", $content));
        $tab=array();
        $tab['prat']=$json->annuaire;

        $praticiens = [];
        foreach ($tab['prat'] as $k => $value){


            $prat = $this->Praticiens->find()->where(['nom' => $value->nomPrenom,
                'niveau' => $value->formation,
                'annee_certif'=>$value->annee])
                ->first();



            if (!$prat) {
                $praticien = $this->Praticiens->newEntity();
                $array = array();
                $praticien->user_id=null;
                $praticien->codepostal=null;
                $praticien->in_annuaire=1;
                    $praticien->nom = $value->nomPrenom;
                if(isset($value->formation))
                    $praticien->niveau = $value->formation;
                else
                    $praticien->niveau=null;
                if(isset($value->annee))
                    $praticien->annee_certif = $value->annee;
                else
                    $praticien->annee_certif=null;
                if(isset($value->pays))
                    $praticien->pays = $value->pays;
                else
                    $praticien->pays=null;
                if(isset($value->ville))
                    $praticien->ville= $value->ville;
                else
                    $praticien->ville=null;
                if(isset($value->adresse))
                    $praticien->adresse=$value->adresse;
                else
                    $praticien->adresse=null;
                if(isset($value->tel))
                    $praticien->telephone=$value->tel;
                else
                    $praticien->telephone=null;
                if(isset($value->email))
                    $praticien->email=$value->email;
                else
                    $praticien->email=null;
                if(isset($value->specialite))
                    $praticien->specialite=$value->specialite;
                else
                    $praticien->specialite=null;
                $praticiens[] = $praticien;
            }
        }
                dump($this->Praticiens->saveMany($praticiens));
                die();
        return;
    }
   /* public function exportPrat($id=null){
        $praticien=$this->Praticiens->find()->where(['id'=>$id])
            ->first();
        $tab=array();
        $count=count($praticien);
        $tab['count']=$count;
            $tab['annuaire'][$praticien->id]['nomPrenom']=$praticien->nom;
            $tab['annuaire'][$praticien->id]['adresse']=$praticien->adresse;
            $tab['annuaire'][$praticien->id]['formation']=$praticien->niveau;
            $tab['annuaire'][$praticien->id]['ville']=$praticien->ville;
            $tab['annuaire'][$praticien->id]['annee']=$praticien->annee_certif;
            $tab['annuaire'][$praticien->id]['pays']=$praticien->pays;


        file_put_contents(WWW_ROOT.'annuaires/annuaire_prat.json', json_encode($tab));

        $path = "/web/wp-content/plugins/psyclick/data/";

        $conn_id = ftp_connect("psynapse.fr");
        $ftp_user_name = "c3_2018";
        $ftp_user_pass = "XpREf1Ywl6_";
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
        ftp_pasv($conn_id, true) ;
        $tmp = WWW_ROOT.'annuaires/annuaire_prat.json';

        @ftp_delete($conn_id, $path."annuaire_prat.json");
        if(ftp_put($conn_id, $path."annuaire_prat.json", $tmp, FTP_BINARY)){
            return $this->redirect(['action' => 'index']);
        }else{
            return $this->redirect(['action' => 'view', $praticien->id]);
        }


    }*/
}
