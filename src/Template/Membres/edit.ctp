<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Membre $membre
 * @var domaines
 * @var $Pays
 */
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des membres'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="membres form large-9 medium-8 columns content">
    <h2>Modifier le membre: <?php echo $membre->nom ?></h2>
 <?= $this->Form->create($membre) ?>
<fieldset class="pano bleu">
    <h3>Informations générales</h3>
    <?php
    echo $this->V->input('nom',array('label'=>"Nom du thérapeute"));
    echo $this->V->input('is_referant',array('label'=>"Référant psynapse ?",'type'=>"select",'options'=>array('0'=>'Non','1'=>'Oui')));
    echo $this->V->separator();
    echo $this->V->input('domaines',array('label'=>"Thérapies pratiquées",'type'=>'select','options'=>$domaines));
    ?>
     <h3>Coordonnées du cabinet</h3>
    <?php
    echo $this->V->input('title',array('label'=>array('text' => "Nom du cabinet <small>(Ex: Sophrologue)</small>",'escape' => false)));
    echo $this->V->input('adresse1',array('label'=>"Adresse"));
    echo $this->V->input('adresse2',array('label'=>false));
    echo $this->V->input('adresse3',array('label'=>false));
    echo $this->V->input('code_postal',array('label'=>"Code postal"));
    echo $this->V->input('ville',array('label'=>"Ville"));
    echo $this->V->input('country_id',array('label'=>"Pays",'type'=>'select','options'=>$Pays));
    echo $this->V->input('departement',array('label'=>"Département"));
    echo $this->V->separator();
    echo $this->V->input('telephone',array('label'=>"Téléphone"));
    echo $this->V->input('site_web',array('label'=>"Site web"));
    echo $this->V->input('lng',array('type'=>'hidden'));
    echo $this->V->input('lat',array('type'=>"hidden"));
    ?>
     <h3>Compléments</h3>
    <?php
    echo $this->V->input('commentaire',array('label'=>"Commentaire",'type' => 'textarea'));
    echo $this->V->input('installed',array('label'=>['text' => "Date d'installation <small>(Ex: 12/01/2010 ou 2009)</small>",'escape' => false],'type'=>'datepicker','value'=>false,'div'=>array('class'=>'oneQuartWidth')));
    ?>
 <?php
    echo $this->bouton->block(array(
        'cancel'=>array('action'=>'index'),
        'submit'=>array('titre'=>'Modifier le membre','id'=>'addFfhtbClientSubmit')
    ));
    ?>
</fieldset>
</div>  
<?php echo $this->Form->end(); ?>
<script>
    $(document).ready(function() {
        $('#installed').val("<?php echo !empty($this->request->getData()['installed'])?$this->V->date('d/m/Y',$this->request->getDate()['installed']):"" ?>");
    });
</script>