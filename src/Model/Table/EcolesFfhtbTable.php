<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EcolesFfhtb Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\EcolesFfhtb get($primaryKey, $options = [])
 * @method \App\Model\Entity\EcolesFfhtb newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EcolesFfhtb[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EcolesFfhtb|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EcolesFfhtb|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EcolesFfhtb patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EcolesFfhtb[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EcolesFfhtb findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EcolesFfhtbTable extends Table
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

        $this->setTable('ecoles_ffhtb');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
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
            ->scalar('nom')
            ->maxLength('nom', 40)
            ->requirePresence('nom', 'create')
            ->notEmpty('nom');

        $validator
            ->scalar('logo')
            ->maxLength('logo', 255)
            ->allowEmpty('logo');

        $validator
            ->scalar('adresse')
            ->maxLength('adresse', 255)
            ->allowEmpty('adresse');

        $validator
            ->scalar('ville')
            ->maxLength('ville', 100)
            ->allowEmpty('ville');

        $validator
            ->scalar('pays')
            ->maxLength('pays', 255)
            ->allowEmpty('pays');

        $validator
            ->scalar('code_postal')
            ->maxLength('code_postal', 10)
            ->allowEmpty('code_postal');

        $validator
            ->scalar('telephone')
            ->maxLength('telephone', 100)
            ->allowEmpty('telephone');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('presentation')
            ->allowEmpty('presentation');

        $validator
            ->scalar('sujet')
            ->maxLength('sujet', 255)
            ->allowEmpty('sujet');

        $validator
            ->scalar('site')
            ->maxLength('site', 255)
            ->allowEmpty('site');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
    var $pays=array("France (métropole)"=>"France (métropole)",
        'Corse'=>'Corse',
        'Guadeloupe'=>'Guadeloupe',
        'Martinique'=>'Martinique',
        'Guyane'=>'Guyane',
        'Réunion'=>'Réunion',
        'Saint Pierre et M.'=>'Saint Pierre et M.',
        'Mayotte'=>'Mayotte',
        'Afrique du Sud'=>'Afrique du Sud',
        'Algérie'=>'Algérie',
        'Angola'=>'Angola',
        'Bénin'=>'Bénin',
        'Botswana'=>'Botswana',
        "Burkina Faso"=>'Burkina Faso',
        'Burundi'=>'Burundi',
        'Cameroun'=>'Cameroun',
        'Cap-Vert'=>'Cap-Vert',
        'Centrafricaine'=>'Centrafricaine',
        'Comores'=>'Comores',
        'Congo (République démocratique)'=>'Congo (République démocratique)',
        'Congo (République populaire)'=>'Congo (République populaire)',
        'Côte d\'Ivoire'=>'Côte d\'Ivoire',
        'Djibouti'=>'Djibouti',
        'Égypte'=>'Égypte',
        'Érythrée'=>'Érythrée',
        'Éthiopie'=>'Éthiopie',
        'Gabon'=>'Gabon',
        'Gambie'=>'Gambie',
        'Ghana'=>'Ghana',
        'Guinée'=>'Guinée',
        'Guinée équatoriale'=>'Guinée équatoriale',
        'Guinée-Bissau'=>'Guinée-Bissau',
        'Kenya'=>'Kenya',
        'Lesotho'=>'Lesotho',
        'Libéria'=>'Libéria',
        'Libye'=>'Libye',
        'Madagascar'=>'Madagascar',
        'Malawi'=>'Malawi',
        'Mali'=>'Mali',
        'Maroc'=>'Maroc',
        'Maurice'=>'Maurice',
        'Mauritanie'=>'Mauritanie',
        'Mozambique'=>'Mozambique',
        'Namibie'=>'Namibie',
        'Ngwane'=>'Ngwane',
        'Niger'=>'Niger',
        'Nigéria'=>'Nigéria',
        'Ouganda'=>'Ouganda',
        'Rwanda'=>'Rwanda',
        'Sahara occidental'=>'Sahara occidental',
        'Sainte-Hélène'=>'Sainte-Hélène',
        'São Tomé et Principe'=>'São Tomé et Principe',
        'Sénégal'=>'Sénégal',
        'Seychelles'=>'Seychelles',
        'Sierra Leone'=>'Sierra Leone',
        'Somalie'=>'Somalie',
        'Soudan'=>'Soudan',
        'Swaziland (Ngwane)'=>'Swaziland (Ngwane)',
        'Tanzanie'=>'Tanzanie',
        'Tchad'=>'Tchad',
        'Togo'=>'Togo',
        'Tunisie'=>'Tunisie',
        'Zambie'=>'Zambie',
        'Zimbabwe'=>'Zimbabwe',
        'Anguilla'=>'Anguilla',
        'Antigua et Barbuda'=>'Antigua et Barbuda',
        'Antilles néerlandaises'=>'Antilles néerlandaises',
        'Argentine'=>'Argentine',
        'Bahamas'=>'Bahamas',
        'Barbade'=>'Barbade',
        'Belize'=>'Belize',
        'Bermude'=>'Bermude',
        'Bolivie'=>'Bolivie',
        'Brésil'=>'Brésil',
        'Caïmanes'=>'Caïmanes',
        'Canada'=>'Canada',
        'Chili'=>'Chili',
        'Colombie'=>'Colombie',
        'Costa Rica'=>'Costa Rica',
        'Cuba'=>'Cuba',
        'Dominicaine (République)'=>'Dominicaine (République)',
        'Dominique'=>'Dominique',
        'El Salvador'=>'El Salvador',
        'Équateur'=>'Équateur',
        'États-Unis d\'Amérique'=>'États-Unis d\'Amérique',
        'Grenade'=>'Grenade',
        'Groenland'=>'Groenland',
        'Guatemala'=>'Guatemala',
        'Guyana'=>'Guyana',
        'Haïti'=>'Haïti',
        'Honduras'=>'Honduras',
        'Îles vierges américaines'=>'Îles vierges américaines',
        'Îles vierges britanniques'=>'Îles vierges britanniques',
        'Jamaïque'=>'Jamaïque',
        'Mariannes du Nord'=>'Mariannes du Nord',
        'Mexique'=>'Mexique',
        'Montserrat'=>'Montserrat',
        'Nicaragua'=>'Nicaragua',
        'Panama'=>'Panama',
        'Paraguay'=>'Paraguay',
        'Pérou'=>'Pérou',
        'Sainte-Lucie'=>'Sainte-Lucie',
        'Saint-Kitts et Nevis'=>'Saint-Kitts et Nevis',
        'Saint-Pierre et Miquelon'=>'Saint-Pierre et Miquelon',
        'Saint-Vincent et les Grenadines'=>'Saint-Vincent et les Grenadines',
        'Suriname'=>'Suriname',
        'Trinidad et Tobago'=>'Trinidad et Tobago',
        'Turks et Caicos'=>'Turks et Caicos',
        'Uruguay'=>'Uruguay',
        'Venezuela'=>'Venezuela',
        'Afghanistan'=>'Afghanistan',
        'Arabie Saoudite'=>'Arabie Saoudite',
        'Arménie'=>'Arménie',
        'Azerbaïdjan'=>'Azerbaïdjan',
        'Bahreïn'=>'Bahreïn',
        'Bangladesh'=>'Bangladesh',
        'Bhoutan'=>'Bhoutan',
        'Birmanie (Myanmar)'=>'Birmanie (Myanmar)',
        'Brunei'=>'Brunei',
        'Cambodge'=>'Cambodge',
        'Chine'=>'Chine',
        'Chypre'=>'Chypre',
        'Corée du Nord'=>'Corée du Nord',
        'Corée du Sud'=>'Corée du Sud',
        'Émirats arabes unis'=>'Émirats arabes unis',
        'Géorgie'=>'Géorgie',
        'Hongkon'=>'Hongkon',
        'Inde'=>'Inde',
        'Indonésie'=>'Indonésie',
        'Irak'=>'Irak',
        'Iran'=>'Iran',
        'Israël'=>'Israël',
        'Japon'=>'Japon',
        'Jordanie'=>'Jordanie',
        'Kazakhstan'=>'Kazakhstan',
        'Kirghizstan'=>'Kirghizstan',
        'Koeït'=>'Koeït',
        'Laos'=>'Laos',
        'Liban'=>'Liban',
        'Macao'=>'Macao',
        'Malaisie'=>'Malaisie',
        'Maldives'=>'Maldives',
        'Mongolie'=>'Mongolie',
        'Myanmar'=>'Myanmar',
        'Népal'=>'Népal',
        'Oman'=>'Oman',
        'Ouzbékistan'=>'Ouzbékistan',
        'Pakistan'=>'Pakistan',
        'Palestine'=>'Palestine',
        'Philippines'=>'Philippines',
        'Quatar'=>'Quatar',
        'Singapour'=>'Singapour',
        'Sri Lanka'=>'Sri Lanka',
        'Syrie'=>'Syrie',
        'Tadjikistan'=>'Tadjikistan',
        'Taiwan'=>'Taiwan',
        'Thaïlande'=>'Thaïlande',
        'Timor Leste'=>'Timor Leste',
        'Turkménistan'=>'Turkménistan',
        'Turquie'=>'Turquie',
        'Vietnam'=>'Vietnam',
        'Yémen'=>'Yémen',
        'Albanie'=>'Albanie',
        'Allemagne'=>'Allemagne',
        'Andorre'=>'Andorre',
        'Autriche'=>'Autriche',
        'Bélarus'=>'Bélarus',
        'Belgique'=>'Belgique',
        'Bosnie-Hérzegovine'=>'Bosnie-Hérzegovine',
        'Bulgarie'=>'Bulgarie',
        'Croatie'=>'Croatie',
        'Danemark'=>'Danemark',
        'Espagne'=>'Espagne',
        'Estonie'=>'Estonie',
        'Finlande'=>'Finlande',
        'Gibraltar'=>'Gibraltar',
        'Grèce'=>'Grèce',
        'Hongrie'=>'Hongrie',
        'Irlande'=>'Irlande',
        'Islande'=>'Islande',
        'Italie'=>'Italie',
        'Lettonie'=>'Lettonie',
        'liechtenstein'=>'liechtenstein',
        'Lituanie'=>'Lituanie',
        'Luxambourg'=>'Luxambourg',
        'Macédonie'=>'Macédonie',
        'Malte'=>'Malte',
        'Moldavie'=>'Moldavie',
        'Monaco'=>'Monaco',
        'Norvège'=>'Norvège',
        'Pays-Bas'=>'Pays-Bas',
        'Pologne'=>'Pologne',
        'Portugal'=>'Portugal',
        'Roumanie'=>'Roumanie',
        'Royaume-Uni'=>'Royaume-Uni',
        'Russie'=>'Russie',
        'Saint-Marin'=>'Saint-Marin',
        'Saint-Siège'=>'Saint-Siège',
        'Serbie et Monténégro'=>'Serbie et Monténégro',
        'Slovaquie'=>'Slovaquie',
        'Slovénie'=>'Slovénie',
        'Suède'=>'Suède',
        'Suisse'=>'Suisse',
        'Tchéquie'=>'Tchéquie',
        'Ukraine'=>'Ukraine',
        'Vatican'=>'Vatican',
        'Australie'=>'Australie',
        'Cook'=>'Cook',
        'Fidji'=>'Fidji',
        'Guam'=>'Guam',
        'Kiribati'=>'Kiribati',
        'Nauru'=>'Nauru',
        'Niué'=>'Niué',
        'Nouvelle-Calédonie'=>'Nouvelle-Calédonie',
        'Nouvelle-Zélande'=>'Nouvelle-Zélande',
        'Palau'=>'Palau',
        'Papouasie-Nouvelle-Guinée'=>'Papouasie-Nouvelle-Guinée',
        'Pitcairn'=>'Pitcairn',
        'Polynésie française'=>'Polynésie française',
        'Salomon'=>'Salomon',
        'Samoa'=>'Samoa',
        'Samoa Américaine'=>'Samoa Américaine',
        'Tokelau'=>'Tokelau',
        'Tonga'=>'Tonga',
        'Tuvalu'=>'Tuvalu',
        'Vanuatu'=>'Vanuatu',
        'Wallis et Futuna'=>'Wallis et Futuna'

    );
}
