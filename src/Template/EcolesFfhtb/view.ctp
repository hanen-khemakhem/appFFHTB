<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EcolesFfhtb $ecolesFfhtb
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ecoles Ffhtb'), ['action' => 'edit', $ecolesFfhtb->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ecoles Ffhtb'), ['action' => 'delete', $ecolesFfhtb->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ecolesFfhtb->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ecoles Ffhtb'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ecoles Ffhtb'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ecolesFfhtb view large-9 medium-8 columns content">
    <h3><?= h($ecolesFfhtb->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $ecolesFfhtb->has('user') ? $this->Html->link($ecolesFfhtb->user->id, ['controller' => 'Users', 'action' => 'view', $ecolesFfhtb->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($ecolesFfhtb->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Logo') ?></th>
            <td><?= h($ecolesFfhtb->logo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adresse') ?></th>
            <td><?= h($ecolesFfhtb->adresse) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ville') ?></th>
            <td><?= h($ecolesFfhtb->ville) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code Postal') ?></th>
            <td><?= h($ecolesFfhtb->code_postal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Telephone') ?></th>
            <td><?= h($ecolesFfhtb->telephone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($ecolesFfhtb->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sujet') ?></th>
            <td><?= h($ecolesFfhtb->sujet) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Site') ?></th>
            <td><?= h($ecolesFfhtb->site) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ecolesFfhtb->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pays') ?></th>
            <td><?= $this->Number->format($ecolesFfhtb->pays) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($ecolesFfhtb->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($ecolesFfhtb->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Presentation') ?></h4>
        <?= $this->Text->autoParagraph(h($ecolesFfhtb->presentation)); ?>
    </div>
</div>
