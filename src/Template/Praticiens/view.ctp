<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Praticien $praticien
 */
?>

<div class="row">
    <div class="col-lg-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="page-header small">
                    <div class="page-header small"><?= h($praticien->nom) ?>

                </h1>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">

                <div class="clearfix"></div>
                <dl class="dl-horizontal">
                    <dt>Email</dt>
                    <dd><?= h($praticien->email) ?></dd>
                    <dt>Téléphone</dt>
                    <dd><?= h($praticien->telephone) ?></dd>
                    <dt>Formation</dt>
                    <dd><?= h($praticien->niveau) ?></dd>
                    <dt>Année</dt>
                    <dd><?= h($praticien->annee_certif) ?></dd>
                    <dt>Adresse</dt>
                    <dd><?= h($praticien->adresse).' ,'.h($praticien->ville).' ,'.h($praticien->codepostal).' ,'.h($praticien->pays) ?></dd>
                </dl>
            </div>
            <div class="col-lg-12 photolist">
                <div class="row pull-right">
                    <?= $this->Html->link(
                        '<span class="fa fa-edit"></span>' . __(' Modifier'),
                        ['action' => 'edit', $praticien->id],
                        ['escape' => false,
                            'class' => 'btn btn-default']
                    ) ?>
                    <?= $this->Html->link(
                        '<span class="fa fa-trash-o"></span>' . __(' Supprimer'),
                        ['action' => 'edit', $praticien->id],
                        ['escape' => false,
                            'class' => 'btn btn-default',
                            'confirm' => __('Voulez-vous supprimer l\'adhérent # {0}?', $praticien->id)]
                    ) ?>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
