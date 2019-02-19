<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EcolesFfhtb[]|\Cake\Collection\CollectionInterface $ecolesFfhtb
 * @var \App\Model\Entity\Praticien[]|\Cake\Collection\CollectionInterface $praticiens
 *
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
                    style="width: 256px;"><?= $this->Paginator->sort('nom') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('logo') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('adresse') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('ville') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('pays') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('code_postal') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('telephone') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('email') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('sujet') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('site') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody role="row">
            <?php foreach ($ecolesFfhtb as $ecolesFfhtb): ?>
            <tr>
                <td><?= $this->Number->format($ecolesFfhtb->id) ?></td>
                <td><?= h($ecolesFfhtb->nom) ?></td>
                <td><?= h($ecolesFfhtb->logo) ?></td>
                <td><?= h($ecolesFfhtb->adresse) ?></td>
                <td><?= h($ecolesFfhtb->ville) ?></td>
                <td><?= h($ecolesFfhtb->pays) ?></td>
                <td><?= h($ecolesFfhtb->code_postal) ?></td>
                <td><?= h($ecolesFfhtb->telephone) ?></td>
                <td><?= h($ecolesFfhtb->email) ?></td>
                <td><?= h($ecolesFfhtb->sujet) ?></td>
                <td><?= h($ecolesFfhtb->site) ?></td>

                <td class="actions">
                    <?= $this->Html->link(
                        '<span class="fa fa-search"></span><span class="sr-only">' . __('View') . '</span>',
                        ['action' => 'view', $ecolesFfhtb->id],
                        ['escape' => false, 'class' => 'btn btn-circle btn-primary']
                    ) ?>
                    <?= $this->Html->link(
                        '<span class="fa fa-edit"></span><span class="sr-only">' . __('edit') . '</span>',
                        ['action' => 'edit', $ecolesFfhtb->id],
                        ['escape' => false, 'class' => 'btn btn-circle btn-info']
                    ) ?>

                    <?php
                    if($this->Session->read('Auth.User.id')!=$ecolesFfhtb->user_id && $this->Session->read('Auth.User.role')!='ecole' )
                   echo $this->Html->link(
                        '<span class="fa fa-trash-o"></span><span class="sr-only">' . __('Supprimer') . '</span>',
                        ['action' => 'delete', $ecolesFfhtb->id],
                        ['escape' => false,
                            'class' => 'btn btn-circle btn-danger ',
                            'confirm' => __('Are you sure you want to delete # {0}?', $ecolesFfhtb->id)]
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
