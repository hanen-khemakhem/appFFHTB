<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var $userTypes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Supprimer l\'utilisateur'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Voulez-vous supprimer l\'utlisateur # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des utilisateurs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Modifier l\'utilisateur') ?></legend>
        <?php
            echo $this->Form->control('username',['label'=>'Identiafiant']);
            echo $this->Form->control('password',['label'=>'Mot de passe']);?>
        <?php if($this->Session->read('Auth.User.role')=='admin')
            echo $this->Form->control('role', ['label' => 'Role', 'class' => 'ui-widget-content ui-corner-all', 'options' => $userTypes,'empty'=>true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Valider')) ?>
    <?= $this->Form->end() ?>
</div>
