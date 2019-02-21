<?php
/**
 * @var \App\View\AppView $this
 */
?>



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
                            <?= $this->Form->button('Connexion',array('class'=>'btn btn-lg btn-primary btn-block')) ?>
                        </fieldset>

                    <?php
                    echo $this->Form->end();
                    ?>
