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
        $membre = $this->Membres->newEntity();
        if (!empty($this->request->getData())) {
            $membre = $this->Membres->patchEntity($membre, $this->request->getData());
            if ($this->request->getData()['installed'] == date('Y-m-d'))
                $membre->installed = null;
            if (is_array($this->request->getData()['domaines']))
                $this->request->getData()['domaines'] = implode(', ', $this->request->getData()['domaines']);

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
        $this->set(compact('membre', 'domaines', 'Pays'));
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
        $this->set(compact('membre', 'domaines', 'Pays'));
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
        $json = json_decode($content);

        $tab = array();
        $tab['membre'] = $json->annuaire;
        $count=count($tab['membre']);
        
        $membres = [];
        $a=array();
        foreach ($tab['membre'] as $k => $annuaire) {
           /* $ann = $this->Membres->find()->where(['nom' => $annuaire->nom,
                'adresse1' => $annuaire->adresse1,
                'code_postal' => $annuaire->code_postal,
                'ville' => $annuaire->ville])
                ->first();*/
                
            //if (!$ann) {
                if($membre->installed =='0000-00-00'){

                dump($membre->installed);
                die();
                }
                
                $membre = $this->Membres->newEntity();
                $array = array();
                $membre->country_id = $annuaire->country_id;
                $membre->is_referant = $annuaire->is_referant;
                $membre->nom = $annuaire->nom;
                $membre->email = $annuaire->email;
                $membre->title = $annuaire->title;
                $membre->telephone=$annuaire->telephone;
                $membre->adresse1 = $annuaire->adresse1;
                $membre->region = $annuaire->region;
                $membre->code_postal = $annuaire->code_postal;
                $membre->ville = $annuaire->ville;
                $membre->site_web = $annuaire->site_web;
                $membre->commentaire = $annuaire->commentaire;
                if (isset($annuaire->installed)) {
                    $membre->installed = $annuaire->installed;
                } elseif ($membre->installed== '0000-00-00') {
                    $membre->installed=date('Y-m-d');
                }
                else {
                    $membre->installed = null;
                }

                $membre->departement = $annuaire->departement;
                $membre->region = $annuaire->region;
                $membre->lat = $annuaire->lat;
                $membre->lng = $annuaire->lng;
                if(isset($annuaire->domaines))
                foreach ($annuaire->domaines as $domaine) {
                    $array[] = $domaine;
                }
                $formations = implode(' ,', $array);
                $membre->domaines = $formations;
                $membres[] = $membre;

                //try {
               /* } catch (\Exception $e) {
                    dump($e);
                    die();
                }*/
            //}
        }

                   dump($this->Membres->saveMany($membres));
        
           
        return;
    }
    
}

