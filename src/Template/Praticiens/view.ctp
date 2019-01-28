<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Praticien $praticien
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Praticien'), ['action' => 'edit', $praticien->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Praticien'), ['action' => 'delete', $praticien->id], ['confirm' => __('Are you sure you want to delete # {0}?', $praticien->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Praticiens'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Praticien'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="praticiens view large-9 medium-8 columns content">
    <h3><?= h($praticien->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($praticien->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prenom') ?></th>
            <td><?= h($praticien->prenom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Niveau') ?></th>
            <td><?= h($praticien->niveau) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pays') ?></th>
            <td><?= h($praticien->pays) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($praticien->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Annee Certif') ?></th>
            <td><?= h($praticien->annee_certif) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($praticien->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($praticien->modified) ?></td>
        </tr>
    </table>
</div>
