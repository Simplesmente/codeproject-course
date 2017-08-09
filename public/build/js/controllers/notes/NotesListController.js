angular.module('app.controllers')
        .controller('NotesListController',['$scope','Notes',function($scope,Notes){


          var result = Notes.query({idProject:1},function(data){
            $scope.notes = data;
          });



}]);
