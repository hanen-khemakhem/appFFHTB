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
    <h2>Ajouter un praticien</h2>
 <?= $this->Form->create($praticien) ?>
<fieldset class="pano bleu">
    <h3>Informations générales</h3>
    <?php
    echo $this->V->input('nom',array('label'=>"Nom et Prénom du praticien"));

    ?>
     <h3>Compléments</h3>
    <?php
     echo $this->V->input('niveau',array('label'=>"Niveau de cértification"));
      echo $this->V->input('annee_certif',array('label'=>['text' => "Année de cértification <small>(Ex: 2019)</small>",'escape' => false]));
      echo $this->V->input('pays',array('label'=>"Pays",'type'=>'select','options'=>$Pays));
   
    ?>
    <?= $this->Form->button('Valider ') ?>
