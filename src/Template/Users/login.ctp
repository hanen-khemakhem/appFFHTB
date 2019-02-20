<?php
?>
<!DOCTYPE html>
<html lang="en">
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
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-6">
            <div class="login-panel panel panel-default">
                <div class="userpic"><img src="../img/default_profile.png" alt="" ></div>
                <div class="panel-body">
                    <h2 class="text-center">Authentification</h2>
                    <?= $this->Form->create();?>
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Votre identifiant" name="username" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="votre mot de passe" name="password" type="password" value="">
                            </div>
                            <br>
                            <!-- Change this to a button or input when using this as a form -->
                            <!--<a href="index.html" class="btn btn-lg btn-primary btn-block">Login</a>-->
                            <?= $this->Form->button('Connexion',array('class'=>'btn btn-lg btn-primary btn-block')) ?>
                        </fieldset>

                    <?php
                    echo $this->Form->end();
                    ?>
                </div>
            </div>
        </div>
    </div>

<!-- jQuery -->
    <?php echo $this->Html->script('jquery/jquery.min.js') ?>

    <!-- Bootstrap Core JavaScript -->
    <?php echo $this->Html->script('bootstrap/js/bootstrap.min.js') ?>

    <!-- js theme -->
    <?php echo $this->Html->script('adminnine.js') ?>
    <?= $this->fetch('script') ?>
</body>
</html>
</style>