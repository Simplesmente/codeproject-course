angular.module('app.controllers')
        .controller('ProjectListController',['$scope','Project','$routeParams',function($scope,Project,$routeParams){

          Project.query({},function(data){
            $scope.projects = data;
          });

}]);
