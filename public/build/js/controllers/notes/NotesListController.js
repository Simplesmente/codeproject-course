angular.module('app.controllers')
        .controller('NotesListController',['$scope','Notes','$routeParams',function($scope,Notes,$routeParams){
        
          var result = Notes.query({idProject:$routeParams.idProject},function(data){
            $scope.notes = data;
          });
}]);
