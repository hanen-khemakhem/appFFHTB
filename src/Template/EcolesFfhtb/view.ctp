<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EcolesFfhtb $ecolesFfhtb
 */
?>


<div class="row">
    <div class="col-lg-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="page-header small">
                    <div class="page-header small"><?= h($ecolesFfhtb->nom) ?>

                </h1>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">

                <div class="clearfix"></div>
                <dl class="dl-horizontal">
                    <dt>Email</dt>
                    <dd><?= h($ecolesFfhtb->email) ?></dd>
                    <dt>Téléphone</dt>
                    <dd><?= h($ecolesFfhtb->telephone) ?></dd>
                    <dt>Site web</dt>
                    <dd><?= h($ecolesFfhtb->site) ?></dd>
                    <?php if (!empty($ecolesFfhtb->logo)):?>
                    <dt>Logo</dt>
                    <dd><?php echo $this->Html->image($ecolesFfhtb->logo,['height' => 40, 'width' => 40])?></dd>
                    <?php endif;?>
                    <dt>Adresse</dt>
                    <dd><?= h($ecolesFfhtb->adresse).' ,'.h($ecolesFfhtb->ville).' ,'.h($ecolesFfhtb->code_postal).' ,'.h($ecolesFfhtb->pays) ?></dd>
                    <?php if (!empty($ecolesFfhtb->sujet)|| !empty($ecolesFfhtb->presentation)):?>
                    <dt>Présentation</dt>
                    <dd><?= h($ecolesFfhtb->sujet).": ". $this->Text->autoParagraph(h($ecolesFfhtb->presentation)) ?></dd>
                    <?php endif;?>
                </dl>
            </div>
            <div class="col-lg-12 photolist">
                <div class="row pull-right">
                    <?= $this->Html->link(
                        '<span class="fa fa-edit"></span>' . __(' Modifier'),
                        ['action' => 'edit', $ecolesFfhtb->id],
                        ['escape' => false,
                            'class' => 'btn btn-default']
                    ) ?>
                    <?php  if($this->Session->read('Auth.User.id')!=$ecolesFfhtb->user_id)
                        $this->Html->link(
                        '<span class="fa fa-trash-o"></span>' . __(' Supprimer'),
                        ['action' => 'edit', $ecolesFfhtb->id],
                        ['escape' => false,
                            'class' => 'btn btn-default',
                            'confirm' => __('Voulez-vous supprimer l\'adhérent # {0}?', $ecolesFfhtb->id)]
                    ) ?>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
