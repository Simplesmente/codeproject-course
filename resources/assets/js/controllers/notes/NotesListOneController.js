angular.module('app.controllers')
        .controller('NotesListOneController',['$scope','$routeParams','Notes',function($scope,$routeParams,Notes){
                    
          var params = {
                        idProject:$routeParams.idProject,
                        id:$routeParams.id
                      };

          var result = Notes.query(params,function(){
            $scope.note = result[0];       

          });    
         
}]);
