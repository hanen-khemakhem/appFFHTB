<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EcolesFfhtb $ecolesFfhtb
 * @var $users
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ecolesFfhtb->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ecolesFfhtb->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Ecoles Ffhtb'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="ecolesFfhtb form large-9 medium-8 columns content">
    <?= $this->Form->create($ecolesFfhtb) ?>
    <fieldset>
        <legend><?= __('Edit Ecoles Ffhtb') ?></legend>
        <?php
           // echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('nom');
            echo $this->Form->control('logo');
            echo $this->Form->control('adresse');
            echo $this->Form->control('ville');
            echo $this->Form->select('pays',['label'=>"Pays",'options'=>$Pays]);
            echo $this->Form->control('code_postal');
            echo $this->Form->control('telephone');
            echo $this->Form->control('email');
            echo $this->Form->control('presentation');
            echo $this->Form->control('sujet');
            echo $this->Form->control('site');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
