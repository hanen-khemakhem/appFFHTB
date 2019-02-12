<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Entity;

/**
 * Membres Controller
 *
 * @property \App\Model\Table\MembresTable $Membres
 *
 * @method \App\Model\Entity\Membre[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MembresController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $membres = $this->paginate($this->Membres);

        $this->set(compact('membres'));
    }

    /**
     * View method
     *
     * @param string|null $id Membre id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $membre = $this->Membres->get($id, [
            'contain' => []
        ]);

        $this->set('membre', $membre);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
    $array=[];
        $membre = $this->Membres->newEntity();
        if (!empty($this->request->getData())) {
            $membre = $this->Membres->patchEntity($membre, $this->request->getData());
            if ($this->request->getData()['installed'] == date('d/m/Y'))
                $membre->installed = null;
            if (is_array($this->request->getData()['domaines']))
                $membre->domaines = implode(', ', $this->request->getData()['domaines']);

            $adress = $this->request->getData()['adresse1'] . '+' . $this->request->getData()['code_postal'] . '+' . $this->request->getData()['ville'];
            $adress = str_replace(" ", "+", $adress);
            $url = "https://api.mapbox.com/geocoding/v5/mapbox.places/" . $adress . ".json?types=address&access_token=pk.eyJ1IjoiaGFuZW4iLCJhIjoiY2pwOXA4cjR5MjV3MDNxcGhnancyaWh5aiJ9.HxFIH1iO3mvfYXtEn6WbXw";
            $content = json_decode(file_get_contents($url));

            if (isset($content->features[0])) {
                $result = $content->features[0];
                $membre->lat = $result->geometry->coordinates[1];
                $membre->lng = $result->geometry->coordinates[0];
            } else {
                $membre->lat = 0;
                $membre->lng = 0;
            }

            if ($this->Membres->save($membre)) {
                $this->Flash->success(__('Membre ajouté.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible d\'ajouter le membre.'));

        }
        $domaines = $this->Membres->domaines;
        $Pays = $this->Membres->pays;
        $civilites = $this->Membres->civilites;
        $this->set(compact('membre', 'domaines', 'Pays','civilites'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Membre id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if (!$id && empty($this->request->getData())) {
            $this->Flash->error(__('Membre inconnu.'));
            return $this->redirect(array('action' => 'index'));
        } elseif (!empty($this->request->getData())) {

            $membre = $this->Membres->get($id);
            $membre = $this->Membres->patchEntity($membre, $this->request->getData());
            if ($this->request->getData()['Annuaires']['installed'] == date('Y-m-d'))
                $membre->installed = null;

            if ($membre->getError('domaines'))
                $membre->domaines = $this->request->getData()['domaines'];
            $adress = $this->request->getData()['adresse1'] . '+' . $this->request->getData()['code_postal'] . '+' . $this->request->getData()['ville'];
            $adress = str_replace(" ", "+", $adress);
            $url = "https://api.mapbox.com/geocoding/v5/mapbox.places/" . $adress . ".json?types=address&access_token=pk.eyJ1IjoiaGFuZW4iLCJhIjoiY2pwOXA4cjR5MjV3MDNxcGhnancyaWh5aiJ9.HxFIH1iO3mvfYXtEn6WbXw";
            $content = json_decode(file_get_contents($url));

            if (isset($content->features[0])) {
                $result = $content->features[0];
                $membre->lat = $result->geometry->coordinates[1];
                $membre->lng = $result->geometry->coordinates[0];
            } else {
                $membre->lat = 0;
                $membre->lng = 0;
            }
            if ($this->Membres->save($membre)) {
                $this->Flash->success(__('The membre has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The membre could not be saved. Please, try again.'));
        } else {
            $membre = $this->Membres->find()->where(array('id' => $id))->first();
        }
        $Pays = $this->Membres->pays;
        $domaines = $this->Membres->domaines;
        $civilites = $this->Membres->civilites;
        $this->set(compact('membre', 'domaines', 'Pays','civilites'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Membre id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $membre = $this->Membres->get($id);
        if ($this->Membres->delete($membre)) {
            $this->Flash->success(__('The membre has been deleted.'));
        } else {
            $this->Flash->error(__('The membre could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function decodeJson()
    {
        $url = WWW_ROOT . 'annuaires/membres.json';
        $content = file_get_contents($url);
        $json=json_decode( $content);

        //$json = json_decode($content);

        $tab = array();
        $annuaires = $json->participant;

        $membres = [];

        foreach ($annuaires as $k => $annuaire) {


            $ann = $this->Membres->find()->where(['nom' => $annuaire->Annuaire->nom,
                'title'=>$annuaire->Annuaire->title,
                'email'=>$annuaire->Annuaire->email,
                'adresse1' => $annuaire->Annuaire->adresse1,
                'code_postal' => $annuaire->Annuaire->code_postal,
                'ville' => $annuaire->Annuaire->ville])
                ->first();

            if (!$ann) {
                
                $membre = $this->Membres->newEntity();
                $array = array();
                $membre->country_id = $annuaire->Annuaire->country_id;
                $membre->is_referant = $annuaire->Annuaire->is_referant;
                $membre->civilite=$annuaire->Civilite->title;
                $membre->nom = $annuaire->Annuaire->nom;
                $membre->email = $annuaire->Annuaire->email;
                $membre->title = $annuaire->Annuaire->title;
                $membre->telephone=$annuaire->Annuaire->telephone;
                $membre->adresse1 = $annuaire->Annuaire->adresse1;
                $membre->region = $annuaire->Annuaire->region;
                $membre->code_postal = $annuaire->Annuaire->code_postal;
                $membre->ville = $annuaire->Annuaire->ville;
                $membre->site_web = $annuaire->Annuaire->site_web;
                $membre->commentaire = $annuaire->Annuaire->commentaire;

                if (isset($annuaire->Annuaire->installed)) {
                    $membre->installed = $annuaire->Annuaire->installed;
                } elseif ($membre->installed== '0000-00-00') {
                    $membre->installed=date('Y-m-d');
                }
                else {
                    $membre->installed = null;
                }

                $membre->departement = $annuaire->Annuaire->departement;
                $membre->region = $annuaire->Annuaire->region;
                $membre->lat = $annuaire->Annuaire->lat;
                $membre->lng = $annuaire->Annuaire->lng;
                if(isset($annuaire->Annuaire->domaines))
                foreach ($annuaire->Annuaire->domaines as $domaine) {
                    $array[] = $domaine;
                }
                $formations = implode(' ,', $array);
                $membre->domaines = $formations;
                $membres[] = $membre;
            }

        }
                   dump($this->Membres->saveMany($membres));
        
           
        return;
    }
    public function annuaireCarte(){
        $formations=$this->Membres->formation;
        $regions=$this->Membres->regions;

       $annuaires= $this->Membres->find()
            ->order(['nom'])
            ->toArray();
       $domaines=$this->Membres->find()
           ->select(['domaines'])
           ->group(['domaines'])
           ->toArray();
       $tab=array();
       $tab['formation']=array();
       $tab['participant']=array();
       $tab['annuaire']=array();
       $tab['region']=array();
       $tab['formation']=$formations;
       $tab['region']=$regions;
        foreach ($annuaires as $annuaire) {
            $tab['participant'][]['AdherentsSuph'] = $annuaire;

        }
        dump($tab['participant']);
        die();



        dump(file_put_contents(WWW_ROOT.'annuaires/annuairesPrat.json', json_encode($tab)));
        die();


        $path = "/web/wp-content/plugins/annuairesTherapeutes/files/";

        $conn_id = ftp_connect("psynapse.fr");
        $ftp_user_name = "c3_sup-h";
        $ftp_user_pass = "jkAr3MM#";
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
        ftp_pasv($conn_id, true) ;

        $tmp = WWW_ROOT.'annuaires/annuairesPrat.json';
        @ftp_delete($conn_id, $path."annuairesPrat.json");
        ftp_put($conn_id, $path."annuairesPrat.json", $tmp, FTP_BINARY);

    }
    
}

