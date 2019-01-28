<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Membre[]|\Cake\Collection\CollectionInterface $membres
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Ajouter un membre'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="membres index large-9 medium-8 columns content">
    <h3><?= __('Membres') ?></h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_referant') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adresse1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code_postal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ville') ?></th>
                <th scope="col"><?= $this->Paginator->sort('telephone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('site_web') ?></th>
                <th scope="col"><?= $this->Paginator->sort('installed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('departement') ?></th>
                <th scope="col"><?= $this->Paginator->sort('region') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($membres as $membre): ?>
            <tr>
                <td><?= $this->Number->format($membre->id) ?></td>
                <td><?= $this->Number->format($membre->is_referant) ?></td>
                <td><?= h($membre->nom) ?></td>
                <td><?= h($membre->title) ?></td>
                <td><?= h($membre->adresse1) ?></td>
                <td><?= h($membre->code_postal) ?></td>
                <td><?= h($membre->ville) ?></td>
                <td><?= h($membre->telephone) ?></td>
                <td><?= h($membre->site_web) ?></td>
                <td><?= h($membre->installed) ?></td>
                <td><?= h($membre->departement) ?></td>
                <td><?= h($membre->region) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $membre->id], ['class' => 'btn btn-sm btn-default']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $membre->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $membre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $membre->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
