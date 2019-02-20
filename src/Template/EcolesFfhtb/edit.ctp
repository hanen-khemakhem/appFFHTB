<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EcolesFfhtb $ecolesFfhtb
 * @var $users
 * @var $Pays
 */
?>
<ol class="breadcrumb">
    <li><a href="javascript:void(0)">Page d'accueil</a></li>
    <li class="active">Ecoles FFHTB</li>
    <li class="active">modification</li>
</ol>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"> Ajouter une Ecole </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->Form->create($ecolesFfhtb) ?>
                        <div class="col-lg-12">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <?php echo $this->Form->control('nom',['label'=>'Nom de l\'école','class'=>'form-control','placeholder'=>'Entrez votre nom']); ?>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <?php echo $this->Form->control('email',['label'=>'Email','class'=>'form-control','placeholder'=>'exemple@yahoo.fr']); ?>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <?php echo $this->Form->control('telephone',['label'=>'Numéro de télephone','class'=>'form-control','placeholder'=>'12 34 56 789']); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php echo $this->Form->control('logo',['label'=>'Logo de l\'école','class'=>'form-control']); ?>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php echo $this->Form->control('site',['label'=>'Site web','class'=>'form-control','placeholder'=>'http://']); ?>

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <?php echo $this->Form->control('sujet',['label'=>'Sujet','class'=>'form-control']); ?>

                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <?php echo $this->Form->control('presentation',['label'=>'Présentation de l\'école','class'=>'form-control','type'=>'textarea']); ?>

                                </div>
                            </div>

                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php echo $this->Form->control('adresse',['label'=>'Adresse','class'=>'form-control']); ?>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php echo $this->Form->control('ville',['label'=>'Ville','class'=>'form-control']); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php echo $this->Form->control('pays',['label'=>'Pays','class'=>'form-control','options' => $Pays]); ?>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php echo $this->Form->control('code_postal',['label'=>'Code postal','class'=>'form-control']); ?>

                                </div>
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
