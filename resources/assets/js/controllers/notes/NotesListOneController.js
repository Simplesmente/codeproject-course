angular.module('app.controllers')
        .controller('NotesListOneController',['$scope','$routeParams','Notes',function($scope,$routeParams,Notes){
          
          console.log($routeParams);
          
          var params = {
                        idProject:$routeParams.idProject,
                        id:$routeParams.id
                      };

          var result = Notes.query(params,function(data){
                 $scope.note = data;
                 console.log(data);
          });



}]);
