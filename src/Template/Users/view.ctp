<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<ol class="breadcrumb">
    <li><a href="javascript:void(0)">Page d'accueil</a></li>
    <li class="active">Utilisateurs</li>
    <li class="active">vue</li>
</ol>

<div class="row">
<div class="col-lg-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
           <h1 class="page-header small">
            <div class="page-header small">Détails de l'utilisateur

            </h1>
            <p class="page-subtitle small">les informations visibles sont limitées</p>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">

            <div class="clearfix"></div>
            <dl class="dl-horizontal">
                <dt>Id</dt>
                <dd><?= $this->Number->format($user->id) ?></dd>
                <dt>Identifiant</dt>
                <dd><?= h($user->username) ?></dd>
                <dt>Role</dt>
                <dd><?= h($user->role) ?></dd>
            </dl>
        </div>
        <div class="col-lg-12 photolist">
            <div class="row pull-right">
                <?= $this->Html->link(
                    '<span class="fa fa-edit"></span>' . __(' Modifier'),
                    ['action' => 'edit', $user->id],
                    ['escape' => false,
                        'class' => 'btn btn-default']
                ) ?>
                <?php if($this->Session->read('Auth.User.id')!=$user->id)
                echo $this->Html->link(
                    '<span class="fa fa-trash-o"></span>' . __(' Supprimer'),
                    ['action' => 'edit', $user->id],
                    ['escape' => false,
                        'class' => 'btn btn-default',
                        'confirm' => __('Voulez-vous supprimer l\'utilisateur # {0}?', $user->id)]
                ) ?>

            </div>
            <div class="row pull-left">
                <a class="btn btn-info" href="/users/index"><i class="fa fa-list"></i> liste des utilisateurs</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
</div>