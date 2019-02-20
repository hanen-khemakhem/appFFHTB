<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EcolesFfhtb[]|\Cake\Collection\CollectionInterface $ecolesFfhtbs
 * @var \App\Model\Entity\Praticien[]|\Cake\Collection\CollectionInterface $praticiens
 *
 */
?>
<ol class="breadcrumb">
    <li><a href="javascript:void(0)">Home</a></li>
    <li class="active">Ecoles FFHTB</li>
    <li class="active">index</li>
</ol>
<div class="row">
    <?php if($this->Session->read('Auth.User.role')=='admin'): ?>
    <?php $i = 0;
    foreach ($ecolesFfhtbs as $ecolesFfhtb): ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="panel panel-default userlist">
                <div class="panel-heading">
                    <h3 class="page-header small"><?= h($ecolesFfhtb->nom) ?></h3>
                    <p class="page-subtitle small"><?= h($ecolesFfhtb->pays) ?></p>
                    <a href="" class="availablity btn btn-circle btn-success"><i
                                class="fa fa-check"></i></a></div>
                <div class="panel-body text-center">
                    <div class="userprofile">
                        <div class="userpic"><img src="<?= h($ecolesFfhtb->logo) ?>" alt="" class="userpicimg"></div>
                        <p><?= h($ecolesFfhtb->adresse) . ', ' . h($ecolesFfhtb->code_postal) . ', ' . h($ecolesFfhtb->ville) ?></p>
                    </div>
                    <strong>Information</strong><br>
                    <p><?= h($ecolesFfhtb->sujet) ?><br>
                        <?= h($ecolesFfhtb->presentation) ?><br>
                        <br>
                        <a href="mailto:<?= h($ecolesFfhtb->email) ?>"><i class="fa fa-envelope"></i>&nbsp;&nbsp;<?= h($ecolesFfhtb->email) ?></a></p>
                    <a href="<?= h($ecolesFfhtb->site) ?>"><?= h($ecolesFfhtb->site) ?></a>
                    <div class="socials tex-center">
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
                        if ($this->Session->read('Auth.User.id') != $ecolesFfhtb->user_id && $this->Session->read('Auth.User.role') != 'ecole')
                            echo $this->Html->link(
                                '<span class="fa fa-trash-o"></span><span class="sr-only">' . __('Supprimer') . '</span>',
                                ['action' => 'delete', $ecolesFfhtb->id],
                                ['escape' => false,
                                    'class' => 'btn btn-circle btn-danger ',
                                    'confirm' => __('Are you sure you want to delete # {0}?', $ecolesFfhtb->id)]
                            ) ?>
                    </div>
                </div>
                <div class="panel-footer">
                    <p>
                        <i class="fa fa-phone btn btn-circle btn-warning"></i>&nbsp;&nbsp;<?= h($ecolesFfhtb->telephone) ?>
                    </p>
                </div>
            </div>

        </div>

        <?php
        $i++;
        if ($i % 4 == 0)
            echo "<hr style='width: 100%;border-color: #00000000'>";
        ?>
    <?php endforeach; else:
        foreach ($ecolesFfhtbs as $ecolesFfhtb): ?>
        <div class="col-lg-12 col-md-4 col-sm-6">
            <div class="panel panel-default userlist">
                <div class="panel-heading">
                    <h3 class="page-header small"><?= h($ecolesFfhtb->nom) ?></h3>
                    <p class="page-subtitle small"><?= h($ecolesFfhtb->pays) ?></p>
                    <a href="" class="availablity btn btn-circle btn-success"><i
                                class="fa fa-check"></i></a></div>
                <div class="panel-body text-center">
                    <div class="userprofile">
                        <div class="userpic"><img src="<?= h($ecolesFfhtb->logo) ?>" alt="" class="userpicimg"></div>
                        <p><?= h($ecolesFfhtb->adresse) . ', ' . h($ecolesFfhtb->code_postal) . ', ' . h($ecolesFfhtb->ville) ?></p>
                    </div>
                    <strong>Information</strong><br>
                    <p><?= h($ecolesFfhtb->sujet) ?><br>
                        <?= h($ecolesFfhtb->presentation) ?><br>
                        <br>
                        <a href="mailto:<?= h($ecolesFfhtb->email) ?>"><i class="fa fa-envelope"></i>&nbsp;&nbsp;<?= h($ecolesFfhtb->email) ?></a></p>
                    <a href="<?= h($ecolesFfhtb->site) ?>"> <?= h($ecolesFfhtb->site) ?></a>
                    <div class="socials tex-center">
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
                        if ($this->Session->read('Auth.User.id') != $ecolesFfhtb->user_id && $this->Session->read('Auth.User.role') != 'ecole')
                            echo $this->Html->link(
                                '<span class="fa fa-trash-o"></span><span class="sr-only">' . __('Supprimer') . '</span>',
                                ['action' => 'delete', $ecolesFfhtb->id],
                                ['escape' => false,
                                    'class' => 'btn btn-circle btn-danger ',
                                    'confirm' => __('Are you sure you want to delete # {0}?', $ecolesFfhtb->id)]
                            ) ?>
                    </div>
                </div>
                <div class="panel-footer">
                    <p>
                        <i class="fa fa-phone btn btn-circle btn-warning"></i>&nbsp;&nbsp;<?= h($ecolesFfhtb->telephone) ?>
                    </p>
                </div>
            </div>

        </div>
    <?php endforeach; endif;?>
</div>
