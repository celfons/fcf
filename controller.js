angular.module('BlankApp', ['ngMaterial','ngMessages','md.data.table','chart.js'])
  .controller('AppCtrl', function ($scope, $timeout, $mdSidenav,$mdDialog, $log,$http,$q,$filter) {
    var deferred;
    $scope.selected = [];

    $scope.pdf = function(id){

      var doc = new jsPDF();
      var id = id;

      var data = $filter('date')($scope.selected[0].data, "dd/MM/yyyy");
      doc.text('Data: '+data, 150, 40);
      doc.text('Cliente: '+$scope.selected[0].cliente, 10, 40);
      doc.text('Valor: '+$scope.selected[0].vl_preco+' R$', 10, 50);
      doc.text('Qtd: '+$scope.selected[0].nm_saldo, 60, 50);
      doc.text('Descritivo do servico: ', 10, 70);
      doc.text($scope.selected[0].dc_descricao, 10, 80);
      doc.text('Obs:',10, 100);

      if(id == 1){
         doc.text('FCF Solucoes em Informatica | CNPJ: 26.663.653/0001-44', 60, 10);
         doc.text('Rua Jose Pimenta Camargo, 76 - Uberaba/MG', 60, 20);
         doc.text('(34) 9 91781885', 90, 30);
         doc.text('Tecnico Felipe Fonseca',80, 130);
      }
      else{
         doc.text('FCF Solucoes em Informatica | CNPJ: 18.489.656/0001-85', 60, 10);
         doc.text(' Av. Itaparica, 244 - Cuiaba/MS', 60, 20);
         doc.text('(65) 9 9919-7009', 90, 30);
         doc.text('Tecnico Franscisco Filho',80, 130);
      }

      var ass= new Image();
      ass.src = 'img/'+this.id+'.png';
      console.log('img/'+this.id+'.png');

      var logo = new Image();
      logo .src = 'img/logo.png';

      logo.onload = function(){
         doc.addImage(logo, 'png', 10, 10, 40, 10);
         ass.onload = function(){
           doc.addImage(ass, 'png', 80, 110, 40, 10);
            doc.text('___________________',80, 120);
            doc.save('relatorio.pdf');
         };
      };

   }

    $scope.toggleLeft = buildToggler('sidenav-left');
    function buildToggler(navID) {
      return function() {
        $mdSidenav(navID)
          .toggle()
          .then(function () {
            $log.debug("toggle " + navID + " is done");
          });
      };
    };
    //opções quantidade de linhas por página
    $scope.limitOptions = [1, 5, 10, 15, 20, 25, 50, 100];
    //Opções de paginação
    $scope.options = {
        limitSelect: true,
        pageSelect: true
    };
    //Parametros para consulta
    $scope.query = {
        order: 'id_status',
        ord : 'asc',
        limit: 5,
        page: 1
    };
    //Função chamada ao ordenar registro
    $scope.logOrder = function (order) {
        $scope.query.order = order;
        all();
    };
    //Função chamada ao paginar
    $scope.logPagination = function (page, limit) {
        $scope.query.limit = limit;
        $scope.query.page = page;
        all();
    };

    /*
     * Função para controlar barra de progresso
     * progress(true); exibe a barra de progresso
     * progress(false); oculta
     */
    var progress = function(e){
        if(e){
            deferred = $q.defer();
            $scope.promise = deferred.promise;
        } else {
            deferred.resolve();
        }

    };
    /*
     * Função para selecionar todos os produtos por ajax
     * e passa o objeto para view
     */
    var all = function(){
        $scope.selected = []; // nenhum produto selecionado
        $scope.isAllSelected = false; // check master não seleciona
        progress(true);
        /*
         * Requisição ajax para selecionar todos os produtos
         */
        $http({
            method: 'POST',
            url: 'produtos/all',
            data : $scope.query
        }).then(function(response) {
            progress(false);
            $scope.produtos = response.data.produtos;
            $scope.produtos.count = response.data.count;
        }, function(response) {

        });
    };

    all(); // chama a função para selecionar os produtos

    $scope.grafico = function($event){
      $mdDialog.show({
        targetEvent: $event,
        template:'<md-button ng-click="close()">Fechar</md-button><canvas id="pie" class="chart chart-pie" chart-data="data" chart-labels="labels" chart-options="options"></canvas>',
        parent: angular.element(document.body),
        fullscreen:true,
        clickOutsideToClose: true,
        escapeToClose: true,
        scope: $scope.$new(),
        controller: function ControllerName($scope){
           $scope.close = function() {
              $mdDialog.cancel();
           };
          $scope.labels = [];
          $scope.data = [];
          angular.forEach($scope.produtos, function(value, key) {
             $scope.labels.push(value.cliente.toUpperCase());
             $scope.data.push(value.vl_preco*value.nm_saldo);     
          });
        },
     });
  }



    /*
     * Exibe o modal com o formulário de cadastro e
     * ou edição de produtos
     */
    $scope.showModal = function(e){
        progress(true);
        /*
         * Se hover somente um checkbox selecionado, busca o produto
         * no banco de dados e coloca no form para edição
         */

        if($scope.selected.length == 1 && e === 'edit'){
           $http({
              method: 'GET',
              url: 'produtos/view/'+$scope.selected[0].cd_produto
            }).then(function(response) {
                $scope.add = response.data.produto;
            });
        }
        $scope.add = {'dc_descricao':'','vl_preco':'','cliente':'','id_status':false};
        /*
         * Exibe o modal buscando o template no Controller produtos/form
         */
        $mdDialog.show({
          templateUrl: 'produtos/form',
          parent: angular.element(document.body),
          clickOutsideToClose:true,
          fullscreen: true,
          scope: $scope.$new(),
          onShowing : function(){
            progress(false);
          }
        }).then(function(){
            progress(false);
        });

    };
    /*
     * Função para salvar o produto
     */
    $scope.save = function(i){
      if(!i){ // Se clicar no botão cancelar do modal somente o oculta
          $mdDialog.hide();
      } else {

        /*
         * Monta a url de acordo com a ação, se clicou no botão editar haverá
         * um produto selecionado portanto a url da requisição será
         * produtos/edit/id_do_produto
         * Se clicou no botão novo, a url será edit/produtos/add
         */
        var action = $scope.add.cd_produto ? 'edit/' + $scope.add.cd_produto : 'add';
        /*
         * Envia os dados por ajax
         */
        progress(true);
        $http({
              method: 'POST',
              url: 'produtos/'+ action,
              data : $scope.add
            }).then(function(response) {
              $mdDialog.hide();//oculta o modal
              progress(false);
              all();//recarrega os produtos na table
            }, function(response) {
                progress(false);
                $mdDialog.hide();
            });
        }
    };
    /*
     * Função para excluir um ou mais produtos
     */
    $scope.status = function(id,status){

        /*
         * Exibe o modal de confirmação
         */
        var text = status ? 'em andamento' :  'concluido';
        var confirm = $mdDialog.confirm()
            .title('Alerta')
            .textContent('O trabalho esta '+text+' ?')
            .ariaLabel('Alerta de Status')
            //.targetEvent(ev)
            .ok('Sim')
            .cancel('Não');
        //se confirmou envia para o Controller e exclui
        $mdDialog.show(confirm).then(function() {
            progress(true);
            $http({
              method: 'POST',
              url: 'produtos/status/'+id+'/'+status,
              data : JSON.stringify($scope.selected)
            }).then(function(response) {
                progress(false);
                all();
            },function(error){
                progress(false);
            });
        });

    };

    $scope.delete = function(ev){
        /*
         * Exibe o modal de confirmação
         */
        //console.log(JSON.stringify($scope.selected));
        var text = $scope.selected.length > 1 ? 'Deseja realmente excluir os produtos?' : 'Deseja realmente excluir o produto?';
        var confirm = $mdDialog.confirm()
            .title('Alerta')
            .textContent(text)
            .ariaLabel('Alerta de exclusão')
            .targetEvent(ev)
            .ok('Sim')
            .cancel('Não');

        //se confirmou envia para o Controller e exclui
        $mdDialog.show(confirm).then(function() {
            progress(true);
            $http({
              method: 'POST',
              url: 'produtos/delete',
              data : JSON.stringify($scope.selected)
            }).then(function(response) {
                progress(false);
                all();
            },function(error){
                progress(false);
            });
        });

    };

    //Atualiza a tabela
    $scope.refresh = function(){ all();};

  })
  .controller('MenuCtrl', function ($scope, $mdSidenav) {
    $scope.close = function () {
      $mdSidenav('left').close();
    };
  });
