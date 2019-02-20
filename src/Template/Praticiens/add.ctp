<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Praticien $praticien
 * @var $Pays
 * @var $specialites
 */
?>
<ol class="breadcrumb">
    <li><a href="javascript:void(0)">Page d'accueil</a></li>
    <li class="active">Praticiens</li>
    <li class="active">ajout</li>
</ol>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"> Ajouter un Adhérent </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $this->Form->create($praticien) ?>
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <?php echo $this->Form->control('nom',['label'=>'Nom et prénom','class'=>'form-control','placeholder'=>'Entrez votre nom']); ?>

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
                                <div class=" col-lg-12 form-group">
                                    <?php echo $this->Form->control('in_annuaire',
                                        array('label'=>'Voulez-vous ajouter à l\'annuaire FFHTB?',
                                            'type'=>'checkbox','default'=>0,'class'=>'checkbox-inline')); ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <?php echo $this->Form->control('niveau',['label'=>'Niveau de cerification','class'=>'form-control']); ?>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="col-lg-4 form-group">
                                        <?php echo $this->Form->control('specialite', ['label' => 'Spécialité', 'class' => 'form-control', 'options' => $specialites, 'empty' => true]);?>
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <?php echo $this->Form->control('annee_certif',['label'=>'Année de cértification','class'=>'form-control','placeholder'=>'2019']); ?>

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
                                        <?php echo $this->Form->control('codepostal',['label'=>'Code postal','class'=>'form-control']); ?>

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

