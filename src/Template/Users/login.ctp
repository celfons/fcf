<!-- File: src/Template/Users/login.ctp -->

<div flex layout="column" layout-align="center center" class="text-center">
<md-content>
<div layout="row" layout-align="center center">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
<h1>FCF</h1>
<md-input-container class='md-block'>
<?= $this->Form->input('username', array('placeholder'=>'Usuario')) ?>
</md-input-container>
<md-input-container class='md-block'>
<?= $this->Form->input('password', array('placeholder' => 'Senha')) ?>
</md-input-container>
<md-button class="md-raised md-primary" type="submit">
Entrar
</md-button>
<!--<?= $this->Form->button(__('Entrar')); ?>-->
<?= $this->Form->end() ?>  
</div>
</md-content>
</div>