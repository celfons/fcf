<script type="text/javascript">
		$(document).ready(function() {
			$('#fullpage').fullpage({
				anchors: ['empresa', 'portfolio', 'contato'],
				sectionsColor: ['#FFF', 'rgb(63,81,181)', '#FFF'],
				navigation: true,
				navigationPosition: 'right',
				navigationTooltips: ['empresa', 'portfolio', 'contato'],
				responsiveWidth: 900,
				afterResponsive: function(isResponsive){
					
				}

			});
		});
</script>
<div id="fullpage">
	<div class="section fp-auto-height-responsive" id="section0">
		<div class="intro">
                   <h1>SOBRE A EMPRESA</h1>
                   <p>FCF - Solucoes em Informatica</p>
                   <p>Felipe Fonseca</p>
                   <p>Franscisco Filho</p>
                   <p>Uberaba</p>
                   <p>Cuiaba</p>
                   <!--<img src='img/logo.png' class='logo'>-->     
		</div>
	</div>
	<div class="section" id="section1">
	    <div class="slide" id="slide1">
			<div class="intro">
				<h1>CLIENTES</h1>
			</div>
		</div>

	    <div class="slide" id="slide2">
			<h1>PARCEIROS</h1>
		</div>

	</div>
	<div class="section" id="section2">
		<div class="intro">
			<h1>CONTATO</h1>
                        <div layout="row" layout-margin layout-wrap layout-align="center center">
                        <!--<md-card flex="50">-->
                            <?= $this->Form->create('Post', array('action' => 'mail')) ?>
                            <md-dialog-content>
                                  <md-input-container class="md-block">
                                     <label>Email</label>
                                     <input type="email" required name="email">
                                  </md-input-container>
                                  <md-input-container class="md-block">
                                     <label>Mensagem</label>
                                     <textarea name="msg"></textarea>
                                   </md-input-container>
                               <md-button class="md-raised md-primary" type="submit">
                                  ENVIAR
                               </md-button>
                          </md-dialog-actions>
                          <?= $this->Form->end() ?>
                        <!--</md-card>-->
                        </div>
		</div>
	</div>
</div>
	