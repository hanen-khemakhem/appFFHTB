<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Praticien[]|\Cake\Collection\CollectionInterface $praticiens
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
                    style="width: 256px;"><?= $this->Paginator->sort('nom') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('niveau', 'Niveau de cértification') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('annee_certif', 'Année de cértification') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('adresse') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('pays') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= $this->Paginator->sort('codepostal') ?></th>
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-userlist" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="User : activate to sort column descending"
                    style="width: 256px;"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody role="row">
            <?php foreach ($praticiens as $praticien): ?>
                <tr>
                    <td><?= h($praticien->nom) ?></td>
                    <td><?= h($praticien->niveau) ?></td>
                    <td><?= h($praticien->annee_certif) ?></td>
                    <td><?= h($praticien->adresse) ?></td>
                    <td><?= h($praticien->pays) ?></td>
                    <td><?= h($praticien->codepostal) ?></td>

                    <td class="actions">
                        <?= $this->Html->link(
                            '<span class="fa fa-search"></span><span class="sr-only">' . __('View') . '</span>',
                            ['action' => 'view', $praticien->id],
                            ['escape' => false, 'class' => 'btn btn-circle btn-primary']
                        ) ?>
                        <?= $this->Html->link(
                            '<span class="fa fa-edit"></span><span class="sr-only">' . __('edit') . '</span>',
                            ['action' => 'edit', $praticien->id],
                            ['escape' => false, 'class' => 'btn btn-circle btn-info']
                        ) ?>

                        <?= $this->Html->link(
                            '<span class="fa fa-trash-o"></span><span class="sr-only">' . __('Supprimer') . '</span>',
                            ['action' => 'delete', $praticien->id],
                            ['escape' => false,
                                'class' => 'btn btn-circle btn-danger ',
                                'confirm' => __('Voulez-vous supprimer l\'adhérent # {0}?', $praticien->id)]
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
