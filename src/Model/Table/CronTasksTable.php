<?php
namespace App\Model\Table;


use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * CronTasks Model
 *
 * @method \App\Model\Entity\CronTask get($primaryKey, $options = [])
 * @method \App\Model\Entity\CronTask newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CronTask[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CronTask|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CronTask|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CronTask patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CronTask[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CronTask findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CronTasksTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('cron_tasks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('controllers')
            ->maxLength('controllers', 255)
            ->allowEmpty('controllers');

        $validator
            ->scalar('action')
            ->maxLength('action', 255)
            ->allowEmpty('action');

        $validator
            ->scalar('data')
            ->maxLength('data', 255)
            ->allowEmpty('data');

        $validator
            ->scalar('level')
            ->maxLength('level', 50)
            ->allowEmpty('level');

        $validator
            ->dateTime('executed')
            ->allowEmpty('executed');

        $validator
            ->dateTime('succeded')
            ->allowEmpty('succeded');

        $validator
            ->dateTime('aborded')
            ->allowEmpty('aborded');

        $validator
            ->integer('tentative')
            ->allowEmpty('tentative');

        return $validator;
    }
    public function membreJson($controller=null, $action=null){
    $cron =TableRegistry::getTableLocator()->get('CronTasks')->find()
        ->where(['controllers'=>$controller,
            'action'=>$action])
        ->first();
    if (isset($cron) && !empty($cron)) {
        $c=$this->newEntity();
        $c->id = $cron['id'];
        $c->executed=date('Y-m-d H:i:s');
        $this->save($c);
    }
    $array=array();
    $array['annuaire']=array();
    //liste de tous les membres
    $membres=TableRegistry::getTableLocator()->get('Membres')->find()->toArray();
    foreach ($membres as $membre){
        $array['annuaire'][]=$membre;
    }
    $path = "/web/wp-content/plugins/psyclick/data/";

    $conn_id = ftp_connect("psynapse.fr");
    $ftp_user_name = "c3_2018";
    $ftp_user_pass = "XpREf1Ywl6_";
    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
    ftp_pasv($conn_id, true) ;

    $tmp = WWW_ROOT.'annuaires/annuaireMembre.json';
    @ftp_delete($conn_id, $path."annuaireMembre.json");
    if(ftp_put($conn_id, $path."annuaireMembre.json", $tmp, FTP_BINARY)){
        if (isset($cron) && !empty($cron)) {
            $c=$this->newEntity();
            $c->id = $cron['id'];
            $c->succeded=date('Y-m-d H:i:s');
            $this->save($c);
        }
    }else{
        if(isset($cron) && !empty($cron)){
            $c=$this->newEntity();
            $c->id = $cron['id'];
            $c->aborded=date('Y-m-d H:i:s');
            $this->save($c);
        }
    }
}
    public function praticienJson($controller=null, $action=null){
        $cron =TableRegistry::getTableLocator()->get('CronTasks')->find()
            ->where(['controllers'=>$controller,
                'action'=>$action])
            ->first();
        if (isset($cron) && !empty($cron)) {
            $c=$this->newEntity();
            $c->id = $cron['id'];
            $c->executed=date('Y-m-d H:i:s');
            $this->save($c);
        }
        $tab=array();
        $tab['count']=array();
        $tab['annuaire']=array();
        //liste de tous les membres
        $praticiens=TableRegistry::getTableLocator()->get('Praticiens')->find()
            ->where(['in_annuaire'=>1])
            ->toArray();
        $count=count($praticiens);
        $tab['count']=$count;
        foreach ($praticiens as $k => $praticien){

            $tab['annuaire'][$praticien->id]['nomPrenom']=$praticien->nom;
            $tab['annuaire'][$praticien->id]['adresse']=$praticien->adresse.'<br>'.$praticien->codepostal.'<br>'.$praticien->ville;
            $tab['annuaire'][$praticien->id]['formation']=$praticien->niveau;
            $tab['annuaire'][$praticien->id]['ville']=$praticien->ville;
            $tab['annuaire'][$praticien->id]['tel']=$praticien->telephone;
            $tab['annuaire'][$praticien->id]['email']=$praticien->email;
            $tab['annuaire'][$praticien->id]['specialite']=$praticien->specialite;
            $tab['annuaire'][$praticien->id]['annee']=$praticien->annee_certif;
            $tab['annuaire'][$praticien->id]['pays']=$praticien->pays;
        }
        $tab= "var data = " . json_encode($tab);
        dump($tab);
        die();
        file_put_contents(WWW_ROOT.'annuaires/annuaire_ffhtb.json', $tab);


        $path = "/web/wp-content/plugins/psyclick/data/";

        $conn_id = ftp_connect("psynapse.fr");
        $ftp_user_name = "c3_2018";
        $ftp_user_pass = "XpREf1Ywl6_";
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
        ftp_pasv($conn_id, true) ;
        $tmp = WWW_ROOT.'annuaires/annuaire_ffhtb.json';

        @ftp_delete($conn_id, $path."annuaire_ffhtb.json");
        if(ftp_put($conn_id, $path."annuaire_ffhtb.json", $tmp, FTP_BINARY)){
            if (isset($cron) && !empty($cron)) {
                $c=$this->newEntity();
                $c->id = $cron['id'];
                $c->succeded=date('Y-m-d H:i:s');
                $this->save($c);
            }
        }else{
            if(isset($cron) && !empty($cron)){
                $c=$this->newEntity();
                $c->id = $cron['id'];
                $c->aborded=date('Y-m-d H:i:s');
                $this->save($c);
            }
        }
    }

}
