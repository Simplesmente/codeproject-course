angular.module('app.controllers')
        .controller('NotesListOneController',['$scope','Notes',function($scope,Notes){

          var result = Notes.query({idProject:1},function(data){
            $scope.note = data;
          });



}]);
