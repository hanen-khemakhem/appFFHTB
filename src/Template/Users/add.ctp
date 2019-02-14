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
        <li><?= $this->Html->link(__('Liste des Utilisateurs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Ajouter un utilisateur') ?></legend>
        <?php
            echo $this->Form->control('username',['label'=>'Identiafiant']);
            echo $this->Form->control('password',['label'=>'Mot de passe']);
            echo $this->Form->control('role', ['label' => 'Role', 'class' => 'ui-widget-content ui-corner-all', 'options' => $userTypes, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Valider')) ?>
    <?= $this->Form->end() ?>
</div>
