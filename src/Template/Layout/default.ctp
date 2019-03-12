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
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html lang="fr">
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

<body>

<div id="wrapper">
    <div class="navbar-default sidebar">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle"><span class="sr-only">Toggle navigation</span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
            <a class="navbar-brand" href="/praticiens/index">Page d'accueil</a></div>
        <div class="clearfix"></div>
        <div class="sidebar-nav navbar-collapse">

            <!-- user profile pic -->
            <div class="userprofile text-center">
                <div class="userpic">
                    <img src="/img/user1.png" alt="" class="userpicimg"></div>
                <?php if ($this->Session->read('Auth.User.role') == 'ecole'): ?>
                    <h3 class="username"><?= $this->Session->read('Auth.User.ecoles_ffhtb.nom') ?></h3>
                    <p><?php echo $this->Session->read('Auth.User.ecoles_ffhtb.ville') . ', ' . $this->Session->read('Auth.User.ecoles_ffhtb.pays') ?></p>
                <?php else: ?>
                    <h3 class="username"><?= $this->Session->read('Auth.User.username') ?></h3>
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>
            <!-- user profile pic -->

            <ul class="nav" id="side-menu">
                <!--<li><a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>-->
                <li><a href="javascript:void(0)" class="menudropdown"><i class="fa fa-child"></i> Praticiens <span
                                class="badge green">2</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="/praticiens/index">Liste des Praticiens</a></li>
                        <li><a href="/praticiens/add">Ajouter un Praticien</a></li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <?php if ($this->Session->read('Auth.User.role') == 'admin'): ?>
                    <li><a href="javascript:void(0)" class="menudropdown"><i class="fa fa-users"></i> Utilisateurs <span
                                    class="badge red">2</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="/users/index">Liste des utilisateurs</a></li>
                            <li><a href="/users/add">Ajouter un utilisateur</a></li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                <?php endif; ?>
                <li><a href="javascript:void(0)" class="menudropdown">
                        <i class="fa fa-university"></i> Ecoles FFHTB
                        <?php if ($this->Session->read('Auth.User.role') == 'admin'): ?>
                            <span class="badge">2</span>
                        <?php else: ?>
                            <span class="badge">1</span>
                        <?php endif; ?>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="/ecoles-ffhtb/index">Liste des écoles</a></li>
                        <?php if ($this->Session->read('Auth.User.role') == 'admin'): ?>
                            <li><a href="/ecoles-ffhtb/add">Ajouter une école</a></li>
                        <?php endif; ?>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <div id="page-wrapper">
        <div class="row">
            <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0">
                <button class="menubtn pull-left btn "><i class="glyphicon  glyphicon-th"></i></button>

                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle userdd" data-toggle="dropdown" href="javascript:void(0)">
                            <div class="userprofile small ">
                                <span class="userpic">
                                    <img src="/img/user1.png" alt="" class="userpicimg">
                                </span>
                                <div class="textcontainer">
                                    <?php if ($this->Session->read('Auth.User.role') == 'ecole'): ?>
                                        <h3 class="username"><?= $this->Session->read('Auth.User.ecoles_ffhtb.nom') ?></h3>
                                        <p><?php echo $this->Session->read('Auth.User.ecoles_ffhtb.ville') . ', ' . $this->Session->read('Auth.User.ecoles_ffhtb.pays') ?></p>
                                    <?php else: ?>
                                        <h3 class="username"><?= $this->Session->read('Auth.User.username') ?></h3>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <?= $this->Html->link(
                                    '<span class="fa fa-user"></span>' . __(' Profile Utilisateur'),
                                    ['controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')],
                                    ['escape' => false, 'label' => 'Profile utilisateur']
                                ) ?>
                            </li>
                            <li>
                                <?= $this->Html->link(
                                    '<span class="fa fa-sign-out"></span>' . __(' Deconnexion'),
                                    ['controller' => 'users', 'action' => 'logout'],
                                    ['escape' => false, 'label' => 'Deconnexion']
                                ) ?>
                            </li>

                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12  header-wrapper">
                <h1 class="page-header"><?= $this->fetch('title') ?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <!-- /.row -->

        <div class="row">
            <div class="col-sm-12">
                <?= $this->Flash->render() ?>

                <div class="row">

                    <div class="col-sm-12">

                        <?= $this->fetch('content') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="chat-panel panel panel-default">
    <div class="panel-heading"><i class="fa fa-comments fa-fw"></i> Chat
        <div class="btn-group pull-right">
            <button type="button" class="dotbtn dropdown-toggle" data-toggle="dropdown"><i class="dots"></i></button>
            <ul class="dropdown-menu slidedown">
                <li><a href="javascript:void(0)"> <i class="fa fa-refresh fa-fw"></i> Refresh </a></li>
                <li><a href="javascript:void(0)"> <i class="fa fa-check-circle fa-fw"></i> Available </a></li>
                <li><a href="javascript:void(0)"> <i class="fa fa-times fa-fw"></i> Busy </a></li>
                <li><a href="javascript:void(0)"> <i class="fa fa-clock-o fa-fw"></i> Away </a></li>
                <li><a href="javascript:void(0)"> <i class="fa fa-sign-out fa-fw"></i> Sign Out </a></li>
            </ul>
        </div>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body no-padding">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#friends" data-toggle="tab">Friends</a></li>
            <li><a href="#chat" data-toggle="tab">Chat</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="friends">
                <table class="table table-bordered table-hover">
                    <tbody>
                    <tr>
                        <td><img src="http://placehold.it/100x100" alt="" class="gridpic">
                            <div class="textcontainer">
                                <h3 class="usernamelist">John Doe</h3>
                                <p>Designer, India</p>
                            </div>
                            <span class="online"></span></td>
                    </tr>
                    <tr>
                        <td><img src="http://placehold.it/100x100" alt="" class="gridpic">
                            <div class="textcontainer">
                                <h3 class="usernamelist">Steave Donald</h3>
                                <p>Designer, India</p>
                            </div>
                            <span class="online"></span></td>
                    </tr>
                    <tr>
                        <td><img src="http://placehold.it/100x100" alt="" class="gridpic">
                            <div class="textcontainer">
                                <h3 class="usernamelist">Astha Smith</h3>
                                <p>Designer, India</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="http://placehold.it/100x100" alt="" class="gridpic">
                            <div class="textcontainer">
                                <h3 class="usernamelist">Lucky Sans</h3>
                                <p>Designer, India</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="http://placehold.it/100x100" alt="" class="gridpic">
                            <div class="textcontainer">
                                <h3 class="usernamelist">John Doe</h3>
                                <p>Designer, India</p>
                            </div>
                            <span class="online"></span></td>
                    </tr>
                    <tr>
                        <td><img src="http://placehold.it/100x100" alt="" class="gridpic">
                            <div class="textcontainer">
                                <h3 class="usernamelist">Steave Donald</h3>
                                <p>Designer, India</p>
                            </div>
                            <span class="online"></span></td>
                    </tr>
                    <tr>
                        <td><img src="http://placehold.it/100x100" alt="" class="gridpic">
                            <div class="textcontainer">
                                <h3 class="usernamelist">Astha Smith</h3>
                                <p>Designer, India</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="http://placehold.it/100x100" alt="" class="gridpic">
                            <div class="textcontainer">
                                <h3 class="usernamelist">Lucky Sans</h3>
                                <p>Designer, India</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="http://placehold.it/100x100" alt="" class="gridpic">
                            <div class="textcontainer">
                                <h3 class="usernamelist">John Doe</h3>
                                <p>Designer, India</p>
                            </div>
                            <span class="online"></span></td>
                    </tr>
                    <tr>
                        <td><img src="http://placehold.it/100x100" alt="" class="gridpic">
                            <div class="textcontainer">
                                <h3 class="usernamelist">Steave Donald</h3>
                                <p>Designer, India</p>
                            </div>
                            <span class="online"></span></td>
                    </tr>
                    <tr>
                        <td><img src="http://placehold.it/100x100" alt="" class="gridpic">
                            <div class="textcontainer">
                                <h3 class="usernamelist">Astha Smith</h3>
                                <p>Designer, India</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="http://placehold.it/100x100" alt="" class="gridpic">
                            <div class="textcontainer">
                                <h3 class="usernamelist">Lucky Sans</h3>
                                <p>Designer, India</p>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade padding" id="chat">
                <ul class="chat">
                    <li class="left clearfix"><span class="chat-img pull-left"> <img src="http://placehold.it/100x100"
                                                                                     alt="User Avatar"
                                                                                     class="img-circle"/> </span>
                        <div class="chat-body clearfix">
                            <div class="header"><strong class="primary-font">John Smith</strong>
                                <small class="pull-right text-muted"><i class="fa fa-clock-o fa-fw"></i> 12 mins ago
                                </small>
                            </div>
                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                dolor, quis ullamcorper ligula sodales. </p>
                        </div>
                    </li>
                    <li class="right clearfix"><span class="chat-img pull-right"> <img src="http://placehold.it/100x100"
                                                                                       alt="User Avatar"
                                                                                       class="img-circle"/> </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <small class=" text-muted"><i class="fa fa-clock-o fa-fw"></i> 13 mins ago</small>
                                <strong class="pull-right primary-font">Lucky Sans</strong></div>
                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                dolor, quis ullamcorper ligula sodales. </p>
                        </div>
                    </li>
                    <li class="left clearfix"><span class="chat-img pull-left"> <img src="http://placehold.it/100x100"
                                                                                     alt="User Avatar"
                                                                                     class="img-circle"/> </span>
                        <div class="chat-body clearfix">
                            <div class="header"><strong class="primary-font">John Smith</strong>
                                <small class="pull-right text-muted"><i class="fa fa-clock-o fa-fw"></i> 14 mins ago
                                </small>
                            </div>
                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                dolor, quis ullamcorper ligula sodales. </p>
                        </div>
                    </li>
                    <li class="right clearfix"><span class="chat-img pull-right"> <img src="http://placehold.it/100x100"
                                                                                       alt="User Avatar"
                                                                                       class="img-circle"/> </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <small class=" text-muted"><i class="fa fa-clock-o fa-fw"></i> 15 mins ago</small>
                                <strong class="pull-right primary-font">Lucky Sans</strong></div>
                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                dolor, quis ullamcorper ligula sodales. </p>
                        </div>
                    </li>
                    <li class="left clearfix"><span class="chat-img pull-left"> <img src="http://placehold.it/100x100"
                                                                                     alt="User Avatar"
                                                                                     class="img-circle"/> </span>
                        <div class="chat-body clearfix">
                            <div class="header"><strong class="primary-font">John Smith</strong>
                                <small class="pull-right text-muted"><i class="fa fa-clock-o fa-fw"></i> 12 mins ago
                                </small>
                            </div>
                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                dolor, quis ullamcorper ligula sodales. </p>
                        </div>
                    </li>
                    <li class="right clearfix"><span class="chat-img pull-right"> <img src="http://placehold.it/100x100"
                                                                                       alt="User Avatar"
                                                                                       class="img-circle"/> </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <small class=" text-muted"><i class="fa fa-clock-o fa-fw"></i> 13 mins ago</small>
                                <strong class="pull-right primary-font">Lucky Sans</strong></div>
                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                dolor, quis ullamcorper ligula sodales. </p>
                        </div>
                    </li>
                    <li class="left clearfix"><span class="chat-img pull-left"> <img src="http://placehold.it/100x100"
                                                                                     alt="User Avatar"
                                                                                     class="img-circle"/> </span>
                        <div class="chat-body clearfix">
                            <div class="header"><strong class="primary-font">John Smith</strong>
                                <small class="pull-right text-muted"><i class="fa fa-clock-o fa-fw"></i> 14 mins ago
                                </small>
                            </div>
                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                dolor, quis ullamcorper ligula sodales. </p>
                        </div>
                    </li>
                    <li class="right clearfix"><span class="chat-img pull-right"> <img src="http://placehold.it/100x100"
                                                                                       alt="User Avatar"
                                                                                       class="img-circle"/> </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <small class=" text-muted"><i class="fa fa-clock-o fa-fw"></i> 15 mins ago</small>
                                <strong class="pull-right primary-font">Lucky Sans</strong></div>
                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                dolor, quis ullamcorper ligula sodales. </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /.panel-body -->
    <div class="panel-footer">
        <div class="input-group">
            <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..."/>
            <span class="input-group-btn">
      <button class="btn btn-success btn-sm" id="btn-chat"> Send </button>
      </span></div>
    </div>
    <!-- /.panel-footer -->
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
