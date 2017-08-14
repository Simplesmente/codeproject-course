angular.module('app.controllers')
        .controller('NotesListOneController',['$scope','$routeParams','Notes',function($scope,$routeParams,Notes){
          
          console.log('aquiiiiii');
          //console.log($routeParams);
          
          var params = {
                        idProject:$routeParams.idProject,
                        id:$routeParams.id
                      };



}]);
