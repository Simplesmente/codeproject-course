angular.module('app.controllers')
        .controller('ProjectListOneController',['$scope','$routeParams','Project',function($scope,$routeParams,Project){

          var params = {
                        idProject:$routeParams.idProject,
                        id:$routeParams.id
                      };

          var result = Project.query(params,function(){
            $scope.note = result[0];

          });

}]);
