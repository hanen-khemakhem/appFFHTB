<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Praticien[]|\Cake\Collection\CollectionInterface $praticiens
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Ajouter un praticien'), ['action' => 'add']) ?></li>
        <!--<li><?/*= $this->Html->link(__('Liste des membres'), ['controller'=>'membres','action' => 'index']) */?></li>-->
        <?php if($this->Session->read('Auth.User.role')=="admin"):?>
            <li><?= $this->Html->link(__('Ajouter un utilisateur'), ['controller'=>'users','action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Liste des utilisateurs'), ['controller'=>'users','action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Ajouter une école FFHTB'), ['controller'=>'ecolesFfhtb','action' => 'add']) ?></li>
        <?php endif;?>
        <li><?= $this->Html->link(__('Liste des écoles FFHTB'), ['controller'=>'ecolesFfhtb','action' => 'index']) ?></li>
    </ul>
</nav>
<div class="praticiens index large-9 medium-8 columns content">
    <?php if($this->Session->read('Auth.User.role')=="admin"):?>
    <h3><?= __('Liste des Praticiens') ?></h3>
    <?php else: ?>
        <h3><?= __('Liste des Adhérents') ?></h3>
    <?php endif;?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('niveau','Niveau de cértification') ?></th>
                <th scope="col"><?= $this->Paginator->sort('annee_certif','Année de cértification') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pays') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($praticiens as $praticien): ?>
            <tr>
                <td><?= $this->Number->format($praticien->id) ?></td>
                <td><?= h($praticien->nom) ?></td>
                <td><?= h($praticien->niveau) ?></td>
                <td><?= h($praticien->annee_certif) ?></td>
                <td><?= h($praticien->pays) ?></td>

                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['action' => 'view', $praticien->id]) ?>
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $praticien->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $praticien->id], ['confirm' => __('Are you sure you want to delete # {0}?', $praticien->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('premier')) ?>
            <?= $this->Paginator->prev('< ' . __('précédent')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('suivant') . ' >') ?>
            <?= $this->Paginator->last(__('dernier') . ' >>') ?>
        </ul>
        <!--<p><?/*= $this->Paginator->counter(['format' => __('Page {{page}} sur {{pages}}, showing {{current}} record(s) out of {{count}} total')]) */?></p>-->
    </div>
</div>
