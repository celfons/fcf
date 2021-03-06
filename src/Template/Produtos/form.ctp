<md-dialog flex="50" aria-label="Cadastro"  ng-cloak>
    <form name="prodForm">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>Cadastro</h2>
                <span flex></span>
            </div>
        </md-toolbar>
        <md-dialog-content>
            <div class="md-dialog-content">
                <div>
                    <md-input-container class="md-block f-right" flex-gt-xs>
                        <md-switch class="md-primary" md-no-ink aria-label="Ativo" ng-model="add.id_status">
                            {{add.id_status ? "Concluido" : "Em andamento"}}
                        </md-switch>
                    </md-input-container>
                </div>
                <div flex-gt-sm="30">
                    <md-input-container class="md-block" flex-gt-xs>
                      <label>Código</label>
                      <input disabled ng-model="add.cd_produto">
                    </md-input-container>
                </div>
                
                
                <div layout-gt-lg="row">
                    <md-input-container class="md-block">
                        <label>Descrição</label>
                        <input ng-model="add.dc_descricao" required name="dc_descricao">
                        <div ng-messages="prodForm.dc_descricao.$error">
                            <div ng-message="required">Campo obrigatório</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout-gt-lg="row">
                    <md-input-container class="md-block">
                        <label>Cliente</label>
                        <input ng-model="add.cliente" required name="cliente">
                        <div ng-messages="prodForm.cliente.$error">
                            <div ng-message="required">Campo obrigatório</div>
                        </div>
                    </md-input-container>
                </div>
                 <div layout-gt-lg="row">
                    <md-input-container class="md-block">
                        <label>Data de Entrada</label>
                        <input ng-model="add.data" required name="data" type="date">
                        <div ng-messages="prodForm.cliente.$error">
                            <div ng-message="required">Campo obrigatório</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout-gt-lg="row">
                    <md-input-container class="md-block">
                        <label>Quantidade</label>
                        <input required type="number" step="any" min="0" 
                               ng-model="add.nm_saldo" name="nm_saldo" ng-pattern="/^\d+$/" />
                        <div ng-messages="prodForm.nm_saldo.$error" multiple md-auto-hide="true">
                            <div ng-message="required">Campo obrigatório</div>
                            <div ng-message="pattern">Apenas números</div>
                        </div>
                        
                    </md-input-container>
                </div>
                <div layout-gt-lg="row">
                    <md-input-container class="md-block">
                        <label>Preço R$</label>
                        <input required ng-model="add.vl_preco" name="vl_preco" ng-pattern="/^\$?\d+(.\d{3})*(\,\d*)?$/" />
                        <div ng-messages="prodForm.vl_preco.$error" multiple md-auto-hide="true">
                            <div ng-message="required">Campo obrigatório</div>
                            <div ng-message="pattern">Formato 1.000,00</div>
                        </div>
                    </md-input-container>
                </div>
                
            </div>
        </md-dialog-content>
        <md-dialog-actions layout="row">
            <span flex></span>
            <md-button ng-click="save(false)">
                CANCELAR
            </md-button>
            <md-button class="md-raised md-primary" ng-click="save(true)"
                       ng-disabled="!add.dc_descricao || !add.cliente || !add.nm_saldo || !add.vl_preco">
                GRAVAR
            </md-button>
        </md-dialog-actions>
    </form>
</md-dialog>