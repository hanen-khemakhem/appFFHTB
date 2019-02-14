<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Praticien $praticien
 * @var $Pays
 * @var $specialites
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des adhérents'), ['action' => 'index']) ?></li>

    </ul>
</nav>
<div class="membres form large-9 medium-8 columns content">
    <?php if($this->Session->read('Auth.User.role')=="admin"):?>
    <h2>Ajouter un praticien</h2>
    <?php else: ?>
        <h2>Ajouter un adhérent</h2>
    <?php endif;?>
 <?= $this->Form->create($praticien) ?>
<fieldset class="pano bleu">
    <h3>Informations générales</h3>
    <?php

    echo $this->V->input('nom',array('label'=>"Nom et Prénom du praticien"));
    echo $this->V->input('email',array('label'=>"Email"));
    echo $this->V->input('telephone',array('label'=>"Numéro de téléphone"));
echo $this->V->input('in_annuaire',array('label'=>'Voulez-vous ajouter à l\'annuaire FFHTB?','type'=>'checkbox','default'=>0));

    ?>
     <h3>Compléments</h3>
    <?php
     echo $this->V->input('niveau',array('label'=>"Niveau de cértification"));
    echo $this->V->input('specialite',array('label'=>"Spécialité",'type'=>'select','options'=>$specialites,'empty'=>true));
      echo $this->V->input('annee_certif',array('label'=>['text' => "Année de cértification <small>(Ex: 2019)</small>",'escape' => false]));
      echo $this->V->input('pays',array('label'=>"Pays",'type'=>'select','options'=>$Pays));
        echo $this->V->input('adresse',array('label'=>"Adresse"));
        echo $this->V->input('ville',array('label'=>"Ville"));
        echo $this->V->input('codepostal',array('label'=>"Code postal"));

    ?>
    <?= $this->Form->button('Valider ') ?>

<?= $this->Form->end(); ?>

