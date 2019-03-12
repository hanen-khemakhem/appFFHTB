<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var $userTypes
 */
?>
<ol class="breadcrumb">
    <li><a href="javascript:void(0)">Page d'accueil</a></li>
    <li class="active">Utilisateurs</li>
    <li class="active">modification</li>
</ol>
<div class="text-right">
    <a class="btn btn-info" href="/users/index"><i class="fa fa-list"></i> Liste des utilisateurs</a>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"> Modifier un utilisateur </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->Form->create($user) ?>
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php echo $this->Form->control('username',['label'=>'Identiafiant','class'=>'form-control','placeholder'=>'Entrez votre identifiant']); ?>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php echo $this->Form->control('password',['label'=>'Mot de passe','class'=>'form-control','placeholder'=>'Entrez votre mot de passe']); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-lg-12 form-group">
                                <?php echo $this->Form->control('role', ['label' => 'Role', 'class' => 'form-control', 'options' => $userTypes, 'empty' => true]);?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <?= $this->Form->button(__('Valider'),['class'=>'btn btn-primary']) ?>
                            <?= $this->Form->button(__('Annuler'),['class'=>'btn btn-danger','type'=>'reset']) ?>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
