<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Membre $membre
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Membre'), ['action' => 'edit', $membre->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Membre'), ['action' => 'delete', $membre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $membre->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Membres'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Membre'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="membres view large-9 medium-8 columns content">
    <h3><?= h($membre->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($membre->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($membre->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adresse1') ?></th>
            <td><?= h($membre->adresse1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adresse2') ?></th>
            <td><?= h($membre->adresse2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adresse3') ?></th>
            <td><?= h($membre->adresse3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code Postal') ?></th>
            <td><?= h($membre->code_postal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ville') ?></th>
            <td><?= h($membre->ville) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Telephone') ?></th>
            <td><?= h($membre->telephone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Site Web') ?></th>
            <td><?= h($membre->site_web) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Departement') ?></th>
            <td><?= h($membre->departement) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Region') ?></th>
            <td><?= h($membre->region) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lat') ?></th>
            <td><?= h($membre->lat) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lng') ?></th>
            <td><?= h($membre->lng) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($membre->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Referant') ?></th>
            <td><?= $this->Number->format($membre->is_referant) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Installed') ?></th>
            <td><?= h($membre->installed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($membre->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($membre->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Commentaire') ?></h4>
        <?= $this->Text->autoParagraph(h($membre->commentaire)); ?>
    </div>
    <div class="row">
        <h4><?= __('Domaines') ?></h4>
        <?= $this->Text->autoParagraph(h($membre->domaines)); ?>
    </div>
</div>
