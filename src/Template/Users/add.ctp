<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var $userTypes
 */
?>
<div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading"> Ajouter un utilisateur </div>
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