<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<div class="row">
    <div class="col-sm-12">
        <table class="table dataTable no-footer dtr-inline" id="dataTables-userlist" role="grid"
               aria-describedby="dataTables-userlist_info" style="width: 1819px;">
            <thead>
            <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('id') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('username','Identifiant') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('password','Mot de passe') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('role') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody role="row">
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->password) ?></td>
                <td><?= h($user->role) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                        '<span class="fa fa-search"></span><span class="sr-only">' . __('View') . '</span>',
                        ['action' => 'view', $user->id],
                        ['escape' => false, 'class' => 'btn btn-circle btn-primary']
                    ) ?>
                    <?= $this->Html->link(
                        '<span class="fa fa-edit"></span><span class="sr-only">' . __('edit') . '</span>',
                        ['action' => 'edit', $user->id],
                        ['escape' => false, 'class' => 'btn btn-circle btn-info']
                    ) ?>

                    <?php  if($this->Session->read('Auth.User.id')!=$user->id)
                        echo $this->Html->link(
                        '<span class="fa fa-trash-o"></span><span class="sr-only">' . __('Supprimer') . '</span>',
                        ['action' => 'delete', $user->id],
                        ['escape' => false,
                            'class' => 'btn btn-circle btn-danger ',
                            'confirm' => __('Voulez-vous supprimer l\'adhérent # {0}?', $user->id)]
                    ) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
    <div class="row">
        <div class="col-sm-6">
            <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="paginator dataTables_paginate paging_full_numbers">
                <ul class="pagination">
                    <?= $this->Paginator->first('<< ' . __('premier')) ?>
                    <?= $this->Paginator->prev('< ' . __('précédent')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('suivant') . ' >') ?>
                    <?= $this->Paginator->last(__('dernier') . ' >>') ?>
                </ul>
            </div>
        </div>
    </div>

