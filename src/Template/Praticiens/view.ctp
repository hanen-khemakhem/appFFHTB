<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Praticien $praticien
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des praticiens'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Modifier praticien'), ['action' => 'edit', $praticien->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer praticien'), ['action' => 'delete', $praticien->id], ['confirm' => __('Are you sure you want to delete # {0}?', $praticien->id)]) ?> </li>
        <li><?= $this->Html->link(__('Nouveau praticien'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="praticiens view large-9 medium-8 columns content">
    <h3><?= h($praticien->nom) ?></h3>
    <table class="vertical-table">

        <tr>
            <th scope="row"><?= __('Formation') ?></th>
            <td><?= h($praticien->niveau) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adresse') ?></th>
            <td><?= h($praticien->adresse).", ".h($praticien->ville).", ".h($praticien->pays) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Année de Certification') ?></th>
            <td><?= h($praticien->annee_certif) ?></td>
        </tr>

    </table>
    <?php
/*    echo $this->Html->link("Ajouter dans l'annuaire ffhtb",
        array('controller' => 'Praticiens','action'=> 'exportPrat', $praticien->id),
        array( 'class' => 'button'));*/?>
</div>
