angular.module('app.controllers')
.controller('NotesEditController',['$scope','$routeParams','$location','Notes',function($scope,$routeParams,$location,Notes){
            
    $scope.note = {};

     Notes.query({idProject:$routeParams.idProject,id:$routeParams.id},function(res){
        
        $scope.note.project_id = $routeParams.idProject;
        $scope.note = res[0];

        $scope.save = function(){
         
            if($scope.form.$valid) {
                Notes.update({idProject:$routeParams.idProject,id:$routeParams.id},$scope.note,function(){
                    $location.path('/project/'+ $routeParams.idProject+'/notes/');
                });
            }
            
        };


    });

 
}]);