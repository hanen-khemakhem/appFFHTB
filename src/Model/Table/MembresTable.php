<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Membres Model
 *
 * @method \App\Model\Entity\Membre get($primaryKey, $options = [])
 * @method \App\Model\Entity\Membre newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Membre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Membre|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Membre|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Membre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Membre[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Membre findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MembresTable extends Table
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

        $this->setTable('membres');
        $this->setDisplayField('title');
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
            ->integer('country_id')
            ->requirePresence('country_id', 'create')
            ->notEmpty('country_id');

        $validator
            ->integer('civilite')
            ->requirePresence('civilite', 'create')
            ->notEmpty('civilite');

        $validator
            ->integer('is_referant')
            ->requirePresence('is_referant', 'create')
            ->notEmpty('is_referant');

        $validator
            ->scalar('nom')
            ->maxLength('nom', 255)
            ->requirePresence('nom', 'create')
            ->notEmpty('nom');
        $validator
            ->scalar('email')
            ->maxLength('email', 255)
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('adresse1')
            ->maxLength('adresse1', 255)
            ->requirePresence('adresse1', 'create')
            ->notEmpty('adresse1');

        $validator
            ->scalar('adresse2')
            ->maxLength('adresse2', 255)
            ->allowEmpty('adresse2');

        $validator
            ->scalar('adresse3')
            ->maxLength('adresse3', 255)
            ->allowEmpty('adresse3');

        $validator
            ->scalar('code_postal')
            ->maxLength('code_postal', 255)
            ->requirePresence('code_postal', 'create')
            ->notEmpty('code_postal');

        $validator
            ->scalar('ville')
            ->maxLength('ville', 255)
            ->requirePresence('ville', 'create')
            ->notEmpty('ville');

        $validator
            ->scalar('telephone')
            ->maxLength('telephone', 255)
            ->allowEmpty('telephone');

        $validator
            ->scalar('site_web')
            ->maxLength('site_web', 255)
            ->allowEmpty('site_web');

        $validator
            ->scalar('commentaire')
            ->allowEmpty('commentaire');

        $validator
            ->date('installed')
            ->allowEmpty('installed');

        $validator
            ->scalar('departement')
            ->maxLength('departement', 255)
            ->allowEmpty('departement');

        $validator
            ->scalar('region')
            ->maxLength('region', 255)
            ->allowEmpty('region');

        $validator
            ->scalar('lat')
            ->maxLength('lat', 255)
            ->allowEmpty('lat');

        $validator
            ->scalar('lng')
            ->maxLength('lng', 255)
            ->allowEmpty('lng');

        $validator
            ->scalar('domaines')
            ->allowEmpty('domaines');
        $validator
            ->integer('in_ffhtb')
            ->requirePresence('in_ffhtb', 'create')
            ->notEmpty('in_ffhtb');

        return $validator;
    }
    var $formation=array(
        "PNL",
        "Hypnose",
        "Sophrologie",
        "Coaching",
        "Psycho-Pathologie",
        "Sexothérapie",
        "Deep Neural Repatterning",
        "Psycho-Praticien",
        "Hypnose Spécialité",
        "Diplome NGH",
        "Neuroline",
        "Heritage",
        "Thérapie Brève",
        "PNL & Hypnose",
        "Divers",
        "reservation",
        "Report Paiement en Attente de dates",
        "Congrès",
        "FORMATION"
    );
    var $regions=array(
       3 =>[
            'title'=>"Rennes",
            'lat'=>48.117266,
            'lng'=>-1.6777926
        ],
        4 =>[
            'title'=>"Lyon",
            'lat'=>45.764043,
            'lng'=>4.835659
        ],
        6 =>[
            'title'=>"Bordeaux",
            'lat'=>44.837789,
            'lng'=>-0.57918
        ],
        7 =>[
            'title'=>"Paris",
            'lat'=>48.856614,
            'lng'=>2.3522219
        ],
        8 =>[
            "title"=> "Strasbourg",
            "lat"=> 48.5734053,
            "lng"=> 7.7521113
        ],
        9 =>[
            "title"=> "Lille",
            "lat"=> 50.62925,
            "lng"=> 3.057256
        ],
        11 =>[
            "title"=> "Reunion",
            "lat"=> -21.115141,
            "lng"=> 55.536384
        ],
        13 =>[
            "title"=> "Guadeloupe Martinique Guyane",
            "lat"=> 16.268455,
            "lng"=> -61.480935
        ],
        17 =>[
            "title"=> "Marseille",
            "lat"=> 43.296482,
            "lng"=> 5.36978
        ],
        18 =>[
            "title"=> "Genève",
            "lat"=> 46.2043907,
            "lng"=> 6.1431577
        ],
        19 =>[
            "title"=> "Montpellier",
            "lat"=> 43.610769,
            "lng"=> 3.876716
        ],
        20 =>[
            "title"=> "Bruxelles",
            "lat"=> 50.8503463,
            "lng"=> 4.3517211
        ],
        21 =>[
            "title"=> "Londres",
            "lat"=> 51.5073509,
            "lng"=> -0.1277583
        ],
        22 =>[
            "title"=> "Canada",
            "lat"=> 56.130366,
            "lng"=> -106.346771
        ],
        23 =>[
            "title"=> "Perpignan",
            "lat"=> 42.6886591,
            "lng"=> 2.8948332
        ],
        24 =>[
            "title"=> "Toulouse",
            "lat"=> 43.604652,
            "lng"=> 1.444209
        ],
        25 =>[
            "title"=> "Clermont Ferrand",
            "lat"=> 45.777222,
            "lng"=> 3.087025
        ],
        33 =>[
            "title"=> "UK",
            "lat"=> 55.378051,
            "lng"=> -3.435973
        ],
        34 =>[
            "title"=> "Caen",
            "lat"=> 49.182863,
            "lng"=> -0.370679
        ],
        35 =>[
            "title"=> "Nantes",
            "lat"=> 47.218371,
            "lng"=> -1.553621
        ],
        36 =>[
            "title"=> "Luxembourg",
            "lat"=> 49.815273,
            "lng"=> 6.129583
        ],
        37 =>[
            "title"=> "Liège",
            "lat"=> 50.6325574,
            "lng"=> 5.5796662
        ],
        38 =>[
            "title"=> "Namur",
            "lat"=> 50.4673883,
            "lng"=> 4.8719854
        ],
        39 =>[
            "title"=> "Charleroi",
            "lat"=> 50.4108095,
            "lng"=> 4.444643
        ],
        40 =>[
            "title"=> "Fribourg",
            "lat"=> 46.8064773,
            "lng"=> 7.1619719
        ],
        41 =>[
            "title"=> "Lausanne",
            "lat"=> 46.5196535,
            "lng"=> 6.6322734
        ],
        42 =>[
            "title"=> "Esch-sur-Alzette",
            "lat"=> 49.5008805,
            "lng"=> 5.9860925
        ]

    );
    var $domaines = array(
        'Coaching' => 'Coaching',
        'Ennéagramme' => 'Ennéagramme',
        'Hypnose Ericksonienne' => 'Hypnose Ericksonienne',
        'Hypnose NGH' => 'Hypnose NGH',
        'PNL' => 'PNL',
        'Préparation Mentale' => 'Préparation Mentale',
        'Techniques de Nettoyage Émotionnel' => 'Techniques de Nettoyage Émotionnel',
        'Thérapie brève' => 'Thérapie brève',
        'Thérapie systémique' => 'Thérapie systémique',
        'Sexothérapie' => 'Sexothérapie',
        'Sophrologie' => 'Sophrologie',
        "DNR" => "DNR"
    );
    var $civilites=array(
        'Mlle'=>'Mademoiselle',
        'Mme'=>'Madame',
        'M'=>'Monsieur',
        'Dr'=>'Docteur',
        'Pr'=>'Professeur');
    var $pays=array("1"=>"France (métropole)",
        '2'=>'Corse',
        '3'=>'Guadeloupe',
        '4'=>'Martinique',
        '5'=>'Guyane',
        '6'=>'Réunion',
        '7'=>'Saint Pierre et M.',
        '8'=>'Mayotte',
        '9'=>'Afrique du Sud',
        '10'=>'Algérie',
        '11'=>'Angola',
        '12'=>'Bénin',
        '13'=>'Botswana',
        "14"=>'Burkina Faso',
        '15'=>'Burundi',
        '16'=>'Cameroun',
        '17'=>'Cap-Vert',
        '18'=>'Centrafricaine',
        '19'=>'Comores',
        '20'=>'Congo (République démocratique)',
        '21'=>'Congo (République populaire)',
        '22'=>'Côte d\'Ivoire',
        '23'=>'Djibouti',
        '24'=>'Égypte',
        '25'=>'Érythrée',
        '26'=>'Éthiopie',
        '27'=>'Gabon',
        '28'=>'Gambie',
        '29'=>'Ghana',
        '30'=>'Guinée',
        '31'=>'Guinée équatoriale',
        '32'=>'Guinée-Bissau',
        '33'=>'Kenya',
        '34'=>'Lesotho',
        '35'=>'Libéria',
        '36'=>'Libye',
        '37'=>'Madagascar',
        '38'=>'Malawi',
        '39'=>'Mali',
        '40'=>'Maroc',
        '41'=>'Maurice',
        '42'=>'Mauritanie',
        '43'=>'Mayotte',
        '44'=>'Mozambique',
        '45'=>'Namibie',
        '46'=>'Ngwane',
        '47'=>'Niger',
        '48'=>'Nigéria',
        '49'=>'Ouganda',
        '50'=>'Réunion',
        '51'=>'Rwanda',
        '52'=>'Sahara occidental',
        '53'=>'Sainte-Hélène',
        '54'=>'São Tomé et Principe',
        '55'=>'Sénégal',
        '56'=>'Seychelles',
        '57'=>'Sierra Leone',
        '58'=>'Somalie',
        '59'=>'Soudan',
        '60'=>'Swaziland (Ngwane)',
        '61'=>'Tanzanie',
        '62'=>'Tchad',
        '63'=>'Togo',
        '64'=>'Tunisie',
        '65'=>'Zambie',
        '66'=>'Zimbabwe',
        '67'=>'Anguilla',
        '68'=>'Antigua et Barbuda',
        '69'=>'Antilles néerlandaises',
        '70'=>'Argentine',
        '71'=>'Bahamas',
        '72'=>'Barbade',
        '73'=>'Belize',
        '74'=>'Bermude',
        '75'=>'Bolivie',
        '76'=>'Brésil',
        '77'=>'Caïmanes',
        '78'=>'Canada',
        '79'=>'Chili',
        '80'=>'Colombie',
        '81'=>'Costa Rica',
        '82'=>'Cuba',
        '83'=>'Dominicaine (République)',
        '84'=>'Dominique',
        '85'=>'El Salvador',
        '86'=>'Équateur',
        '87'=>'États-Unis d\'Amérique',
        '88'=>'Grenade',
        '89'=>'Groenland',
        '90'=>'Guadeloupe',
        '91'=>'Guatemala',
        '92'=>'Guyana',
        '93'=>'Haïti',
        '94'=>'Honduras',
        '95'=>'Îles vierges américaines',
        '96'=>'Îles vierges britanniques',
        '97'=>'Jamaïque',
        '98'=>'Mariannes du Nord',
        '99'=>'Martinique',
        '100'=>'Maurice',
        '101'=>'Mexique',
        '102'=>'Montserrat',
        '103'=>'Nicaragua',
        '104'=>'Panama',
        '105'=>'Paraguay',
        '106'=>'Pérou',
        '107'=>'Sainte-Lucie',
        '108'=>'Saint-Kitts et Nevis',
        '109'=>'Saint-Pierre et Miquelon',
        '110'=>'Saint-Vincent et les Grenadines',
        '111'=>'Suriname',
        '112'=>'Trinidad et Tobago',
        '113'=>'Turks et Caicos',
        '114'=>'Uruguay',
        '115'=>'Venezuela',
        '116'=>'Afghanistan',
        '117'=>'Arabie Saoudite',
        '118'=>'Arménie',
        '119'=>'Azerbaïdjan',
        '120'=>'Bahreïn',
        '121'=>'Bangladesh',
        '122'=>'Bhoutan',
        '123'=>'Birmanie (Myanmar)',
        '124'=>'Brunei',
        '125'=>'Cambodge',
        '126'=>'Chine',
        '127'=>'Chypre',
        '128'=>'Corée du Nord',
        '129'=>'Corée du Sud',
        '130'=>'Émirats arabes unis',
        '131'=>'Géorgie',
        '132'=>'Hongkon',
        '133'=>'Inde',
        '134'=>'Indonésie',
        '135'=>'Irak',
        '136'=>'Iran',
        '137'=>'Israël',
        '138'=>'Japon',
        '139'=>'Jordanie',
        '140'=>'Kazakhstan',
        '141'=>'Kirghizstan',
        '142'=>'Koeït',
        '143'=>'Laos',
        '144'=>'Liban',
        '145'=>'Macao',
        '146'=>'Malaisie',
        '147'=>'Maldives',
        '148'=>'Mongolie',
        '149'=>'Myanmar',
        '150'=>'Népal',
        '151'=>'Oman',
        '152'=>'Ouzbékistan',
        '153'=>'Pakistan',
        '154'=>'Palestine',
        '155'=>'Philippines',
        '156'=>'Quatar',
        '157'=>'Singapour',
        '158'=>'Sri Lanka',
        '159'=>'Syrie',
        '160'=>'Tadjikistan',
        '161'=>'Taiwan',
        '162'=>'Thaïlande',
        '163'=>'Timor Leste',
        '164'=>'Turkménistan',
        '165'=>'Turquie',
        '166'=>'Vietnam',
        '167'=>'Yémen',
        '168'=>'Albanie',
        '169'=>'Allemagne',
        '170'=>'Andorre',
        '171'=>'Autriche',
        '172'=>'Bélarus',
        '173'=>'Belgique',
        '174'=>'Bosnie-Hérzegovine',
        '175'=>'Bulgarie',
        '176'=>'Croatie',
        '177'=>'Danemark',
        '178'=>'Espagne',
        '179'=>'Estonie',
        '180'=>'Finlande',
        '181'=>'Gibraltar',
        '182'=>'Grèce',
        '183'=>'Hongrie',
        '184'=>'Irlande',
        '185'=>'Islande',
        '186'=>'Italie',
        '187'=>'Lettonie',
        '188'=>'liechtenstein',
        '189'=>'Lituanie',
        '190'=>'Luxambourg',
        '191'=>'Macédonie',
        '192'=>'Malte',
        '193'=>'Moldavie',
        '194'=>'Monaco',
        '195'=>'Norvège',
        '196'=>'Pays-Bas',
        '197'=>'Pologne',
        '198'=>'Portugal',
        '199'=>'Roumanie',
        '200'=>'Royaume-Uni',
        '201'=>'Russie',
        '202'=>'Saint-Marin',
        '203'=>'Saint-Siège',
        '204'=>'Serbie et Monténégro',
        '205'=>'Slovaquie',
        '206'=>'Slovénie',
        '207'=>'Somalie',
        '208'=>'Suède',
        '209'=>'Suisse',
        '210'=>'Tchéquie',
        '211'=>'Ukraine',
        '212'=>'Vatican',
        '213'=>'Australie',
        '214'=>'Cook',
        '215'=>'Fidji',
        '216'=>'Guam',
        '217'=>'Kiribati',
        '218'=>'Nauru',
        '219'=>'Niué',
        '220'=>'Nouvelle-Calédonie',
        '221'=>'Nouvelle-Zélande',
        '222'=>'Palau',
        '223'=>'Papouasie-Nouvelle-Guinée',
        '224'=>'Pitcairn',
        '225'=>'Polynésie française',
        '226'=>'Salomon',
        '227'=>'Samoa',
        '228'=>'Samoa Américaine',
        '229'=>'Tokelau',
        '230'=>'Tonga',
        '231'=>'Tuvalu',
        '232'=>'Vanuatu',
        '233'=>'Wallis et Futuna',
        '234'=>"Tunisie"

    );

}
