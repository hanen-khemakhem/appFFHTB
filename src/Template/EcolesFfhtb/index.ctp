<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EcolesFfhtb[]|\Cake\Collection\CollectionInterface $ecolesFfhtb
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=
            __('Actions') ?></li>
        <!--<li><?/*= $this->Html->link(__('Liste des membres'), ['controller'=>'membres','action' => 'index']) */?></li>-->
        <li><?= $this->Html->link(__('Liste des praticiens'), ['controller'=>'praticiens','action' => 'index']) ?></li>
        <?php if($this->Session->read('Auth.User.role')=="admin"):?>
            <li><?= $this->Html->link(__('Ajouter une nouvelle école'), ['action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('Liste des utilisateurs'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <?php endif; ?>
    </ul>
</nav>
<div class="ecolesFfhtb index large-9 medium-8 columns content">
    <h3><?= __('Ecoles Ffhtb') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom d\'utilisateur ') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mot de passe') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('logo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adresse') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ville') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pays') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code_postal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('telephone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sujet') ?></th>
                <th scope="col"><?= $this->Paginator->sort('site') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ecolesFfhtb as $ecolesFfhtb): ?>
            <tr>
                <td><?= $this->Number->format($ecolesFfhtb->id) ?></td>
                <td><?= $ecolesFfhtb->has('user') ?h($ecolesFfhtb->user->username): '' ?></td>
                <td><?= $ecolesFfhtb->has('user') ?h($ecolesFfhtb->user->password): '' ?></td>
                <td><?= h($ecolesFfhtb->nom) ?></td>
                <td><?= h($ecolesFfhtb->logo) ?></td>
                <td><?= h($ecolesFfhtb->adresse) ?></td>
                <td><?= h($ecolesFfhtb->ville) ?></td>
                <td><?= $this->Number->format($ecolesFfhtb->pays) ?></td>
                <td><?= h($ecolesFfhtb->code_postal) ?></td>
                <td><?= h($ecolesFfhtb->telephone) ?></td>
                <td><?= h($ecolesFfhtb->email) ?></td>
                <td><?= h($ecolesFfhtb->sujet) ?></td>
                <td><?= h($ecolesFfhtb->site) ?></td>

                <td class="actions">
                    <?php if($this->Session->read('Auth.User.id')==$ecolesFfhtb->user->id ||$this->Session->read('Auth.User.role')=='admin'): ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ecolesFfhtb->id]) ?>

                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ecolesFfhtb->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ecolesFfhtb->id)]) ?>
                    <?php endif;?>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $ecolesFfhtb->id]) ?>
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
