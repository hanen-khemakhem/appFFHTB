<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Praticien $praticien
 * @var $Pays
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List des praticiens'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="membres form large-9 medium-8 columns content">
    <h2>Modifier le praticien: <?php echo $praticien->prenom.' '.$praticien->nom ?></h2>
 <?= $this->Form->create($praticien) ?>
<fieldset class="pano bleu">
    <h3>Informations générales</h3>
    <?php
    echo $this->V->input('nom',array('label'=>"Nom et prénom du praticien"));
    echo $this->V->input('email',array('label'=>"Email"));
    echo $this->V->input('telephone',array('label'=>"Numéro de téléphone"));
    echo $this->V->input('in_annuaire',array('label'=>'Voulez-vous ajouter à l\'annuaire FFHTB?','type'=>'checkbox'));
    ?>
     <h3>Compléments</h3>
    <?php
    echo $this->V->input('niveau',array('label'=>"Niveau de cértification"));
    echo $this->V->input('specialite',array('label'=>"Spécialité"));
    echo $this->V->input('annee_certif',array('label'=>['text' => "Année de cértification <small>(Ex: 2019)</small>",'escape' => false]));
    echo $this->V->input('pays',array('label'=>"Pays",'type'=>'select','options'=>$Pays));
    echo $this->V->input('adresse',array('label'=>"Adresse"));
    echo $this->V->input('ville',array('label'=>"Ville"));
   
    ?>

    <?= $this->Form->button('Valider ') ?>
