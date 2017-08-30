angular.module('app.controllers')
.controller('NotesNewController',['$scope','$routeParams','$location','Notes',function($scope,$routeParams,$location,Notes){
            
    $scope.note = new Notes();
    $scope.note.project_id = $routeParams.idProject;

    $scope.errors = null; 
    
    $scope.save = function(){

        if($scope.form.$valid) {
            $scope.note.$save({idProject:$routeParams.idProject}).then(function(){
                $location.path('/project/'+ $routeParams.idProject+'/notes/');
            },function(err){
                console.log(err['data']);
            });
        }
    }
 
}]);