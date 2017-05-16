angular.module('BlankApp')
.filter('totalFilter', function() {
     return function(produtos) {
         var total = 0;
         if(produtos){
         for (i=0; i<produtos.length; i++) {
             total = total + produtos[i].vl_preco*produtos[i].nm_saldo;    
          };
          }
         return total;
     };
 });	