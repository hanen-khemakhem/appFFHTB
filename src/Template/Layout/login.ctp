<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->fetch('meta') ?>
    <?= $this->Html->meta('icon') ?>
    <?php echo $this->Html->css('https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700') ?>

    <!-- Bootstrap Core CSS -->
    <?php echo $this->Html->css('bootstrap/css/bootstrap.min.css') ?>
    <!-- theme css -->
    <?php echo $this->Html->css('adminnine.css') ?>

    <!-- Custom Fonts -->
    <?php echo $this->Html->css('font-awesome/css/font-awesome.min.css') ?>

    <?= $this->fetch('css') ?>
</head>
<body class="loginpages">
<?= $this->Flash->render() ?>
<div class="container">
    <div class="row">

        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="userpic"><img src="../img/default_profile.png" alt=""></div>
                <div class="panel-body">
                    <?= $this->fetch('content') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/adminnine.js"></script>


</html>
