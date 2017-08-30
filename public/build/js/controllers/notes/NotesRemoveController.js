angular.module('app.controllers')
.controller('NotesRemoveController',
                ['$scope','$location','$routeParams','Notes',function($scope,$location,$routeParams,Notes){
          
                    $scope.note = {};
                    
                         Notes.query({idProject:$routeParams.idProject,id:$routeParams.id},function(res){
                            
                            $scope.note.project_id = $routeParams.idProject;
                            $scope.note = res[0];
                    
                            $scope.remove = function(){

                                    let confirmation = confirm("Deseja realmente excluir a nota: "+ $scope.note.title);
                                    if(confirmation) {
                                        Notes.delete({idProject:$routeParams.idProject,id:$routeParams.id},$scope.note,function(){
                                            $location.path('/project/'+ $routeParams.idProject+'/notes/');
                                        });

                                    }    
         
                            };
                    
                    
                        });


}]);