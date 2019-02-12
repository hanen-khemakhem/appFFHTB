<?php
/**
 * @var \App\View\AppView $this
 *
 */

use Cake\Core\Configure;

$this->Menu->id('menu');

$this->Menu->add('Membres')
    ->denyByRole('entreprise')
    ->link(array('controller' => 'membres', 'action' => 'index'))

    ->add('Ajouter un nouveau membre')
    ->link(array('controller' => 'membres', 'action' => 'add'));
echo $this->Menu;
