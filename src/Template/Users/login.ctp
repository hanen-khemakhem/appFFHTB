<!-- <h3>Identification</h3>
<?php
/*echo $this->Flash->render();*/
echo $this->Form->create();
echo $this->V->input('username', array('label' => "Login"));
echo $this->V->input('password', array('label' => "Mot de passe"));
?>
<?= $this->Form->button('Connexion') ?>
<?php 
echo $this->Form->end();
?> -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<body>
    <div id="login">
       
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                      
                            <?= $this->Form->create();?>
                            <h3 class="text-center text-info">Authentification</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Login:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Mot de passe:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                               
                                <?= $this->Form->button('Connexion',array('class'=>'btn btn-info btn-md')) ?>

                            </div>
                            
                        <?php 
						echo $this->Form->end();
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
	body {
  margin: 0;
  padding: 0;
  
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
</style>