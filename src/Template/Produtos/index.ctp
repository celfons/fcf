<md-content flex layout-padding class="height-100">
    <md-card style="padding: 0">
        <md-toolbar class="md-table-toolbar md-default" ng-show="!selected.length">
            <div class="md-toolbar-tools actions">
                <span>Demandas - TOTAL: {{ total | totalFilter | currency  }} </span>
                <div flex></div>
                <md-button class="md-icon-button" ng-click="grafico()">
                    <md-icon md-svg-icon="img/icons/grafico.svg" ></md-icon>
                </md-button>
                <md-button class="md-icon-button" ng-click="showModal('new')">
                    <md-icon md-svg-icon="img/icons/ic_add_circle_outline_black_24px.svg" ></md-icon>
                </md-button>
                <md-button class="md-icon-button" ng-click="refresh()" aria-label="Atualizar">
                    <md-icon md-svg-icon="img/icons/ic_refresh_black_24px.svg"></md-icon>
                </md-button>
            </div>
        </md-toolbar>
        <md-toolbar class="md-table-toolbar md-accent" ng-show="selected.length">
          <div class="md-toolbar-tools">
            <span>{{selected.length}} {{selected.length > 1 ? 'itens selecionados' : 'item selecionado'}}</span>
            <div flex></div>
            <md-button class="md-icon-button" ng-click="pdf(<?= $usuario ?>)" ng-show="selected.length == 1">
                <md-icon md-svg-icon="img/icons/pdf.svg"></md-icon>
            </md-button>
            <md-button class="md-icon-button" ng-click="showModal('edit')" ng-show="selected.length == 1">
                <md-icon md-svg-icon="img/icons/ic_mode_edit_white_24px.svg"></md-icon>
            </md-button>
            <md-button class="md-icon-button" ng-click="delete()" ng-show="selected.length > 0">
                <md-icon md-svg-icon="img/icons/ic_delete_white_24px.svg"></md-icon>
            </md-button>
          </div>
        </md-toolbar>
        <md-input-container class="md-block" flex-gt-xs>
           <input name="filter" id="filter"ng-model="filter" class="form-control" placeholder="PESQUISAR">
        </md-input-container>
        <md-table-container>
            <table md-table md-row-select multiple ng-model="selected" md-progress="promise">
                <thead md-head md-order="query.order" md-on-reorder="logOrder">
                    <tr md-row>
                        <th md-column md-order-by="cd_produto">Código</th>
                        <th md-column md-order-by="dc_descricao">Descrição</th>
                        <th md-column md-order-by="cliente">Cliente</th>
                        <th md-column md-order-by="data">Data de Entrada</th>
                        <th md-column md-numeric md-order-by="nm_saldo">Quantidade</th>
                        <th md-column md-numeric md-order-by="vl_preco">Preço</th>
                        <th md-column width="50">Total</th>
                        <th md-column md-numeric md-order-by="id_status" width="50">Concluido?</th>
                    </tr>
                </thead>
                <tbody md-body>
                    <tr md-row md-select="produto" md-select-id="produto"
                        ng-repeat="produto in (total = (produtos |  orderBy: query.order | filter:filter))">

                        <td md-cell>{{produto.cd_produto}}</td>
                        <td md-cell>{{produto.dc_descricao | uppercase}}</td>
                        <td md-cell>{{produto.cliente | uppercase}}</td>
                        <td md-cell>{{produto.data | date :  "dd/MM/yyyy"}}</td>
                        <td md-cell>{{produto.nm_saldo | number: 0}}</td>
                        <td md-cell>{{produto.vl_preco | currency }}</td>
                        <td md-cell>{{produto.vl_preco * produto.nm_saldo | currency }}</td>
                        <td md-cell>
                            <md-switch class="md-success" md-no-ink aria-label="Status"
                                       ng-model="produto.id_status"
                                       ng-click="status(produto.cd_produto,produto.id_status); produto.id_status = !produto.id_status">
                            </md-switch>
                        </td>
                    </tr>
                    <tr md-row>
                        <td md-cell colspan="6" ng-show="produtos.length === 0">
                            Nenhum registro encontrado
                        </td>
                    </tr>
                </tbody>
            </table>
        </md-table-container>
        <md-table-pagination md-limit="query.limit" md-limit-options="limitOptions"
            md-page="query.page" md-total="{{produtos.count}}"
            md-page-select="options.pageSelect"
            md-boundary-links="options.boundaryLinks"
            md-on-paginate="logPagination"
            md-label="{page: 'Página:', rowsPerPage: 'Registros por página:', of: 'de'}">
        </md-table-pagination>
    </md-card>
    <div flex></div>
    <div flex></div>
    <div flex></div>
</md-content>
