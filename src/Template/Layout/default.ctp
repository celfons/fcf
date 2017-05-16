<?php
$cakeDescription = 'FCF - Informatica';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('angular-material.min') ?>
    <?= $this->Html->css('md-data-table.min') ?>
    <?= $this->Html->css('style') ?>
    <?= $this->Html->css('jquery.fullPage') ?>
    <?= $this->Html->script('angular.min') ?>
    <?= $this->Html->script('angular-animate.min') ?>
    <?= $this->Html->script('angular-aria.min') ?>
    <?= $this->Html->script('angular-messages.min') ?>
    <?= $this->Html->script('angular-material.min') ?>
    <?= $this->Html->script('md-data-table.min') ?>
    <?= $this->Html->script('jquery.min') ?>
    <?= $this->Html->script('jquery-ui') ?>
    <?= $this->Html->script('jquery.fullPage') ?>
    <?= $this->Html->script('scrolloverflow') ?>
    <?= $this->Html->script('jspdf.debug') ?>
    <?= $this->Html->script('Chart.min') ?>
    <?= $this->Html->script('angular-chart.min') ?>
    <?= $this->Html->script('chart') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

</head>
<body ng-app="BlankApp" ng-cloak>

    <md-content ng-controller="AppCtrl">
        <md-toolbar class="md-theme-light">
            <div class="md-toolbar-tools">
                <md-button class="md-icon-button" ng-click="toggleLeft()" aria-label="Settings">
                    <md-icon md-svg-icon="img/icons/ic_view_headline_white_24px.svg"></md-icon>
                </md-button>
                    <span style="width:3%;"></span>
                    <span><a href='#empresa'>Empresa</a></span>
                    <span style="width:3%;"></span>
                    <span><a href='#portfolio'>Portifolio</a></span>
                    <span style="width:3%;"></span>
                    <span><a href='#contato'>Contato</a></span>
                <span flex></span>
            </div>
        </md-toolbar>
    </md-content>
    <div ng-controller="AppCtrl" layout="column" ng-cloak>
        <section layout="row" flex>
            <?= $this->fetch('content') ?>
            <md-sidenav class="md-sidenav-left md-whiteframe-4dp" md-component-id="sidenav-left">
                <md-toolbar class="md-theme-light">
                    <h1 class="md-toolbar-tools">Acesso</h1>
                </md-toolbar>
                <md-content ng-controller="MenuCtrl" layout-padding>
                    <md-menu-content>
                       <md-menu-item>
                            <?php
                               if($this->Session->read('Auth')) {
                                  echo $this->Html->link('SAIR', array('controller' => 'Users', 'action' => 'logout'));
                                  echo"
                                  </md-menu-item>
                                  <md-menu-item>
                                     <a class='md-button' href='produtos' title='Produtos'>DEMANDAS</a>
                                  </md-menu-item>
                                   <md-menu-item>
                                     <a class='md-button' href='doc' title='Doc'>DOCUMENTOS</a>
                                  </md-menu-item>
                                  ";
                               } else {
                                  echo $this->Html->link('ENTRAR', array('controller' => 'Users', 'action' => 'login'));
                                  echo "</md-menu-item>";
                                 }
                             ?>
                        <md-menu-item>
                            <a class="md-button" href="/acesso" title="Acesso">ACESSO REMOTO</a>
                        </md-menu-item>
                    </md-menu-content>
                </md-content>
            </md-sidenav>

        </section>
    </div>
    <center><br /><?= $this->Flash->render() ?></center>
    <?= $this->Html->script('app') ?>
    <?= $this->Html->script('controller') ?>
    <?= $this->Html->script('totalFilter') ?>
    <?= $this->fetch('script') ?>
</body>
</html>
