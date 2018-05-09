angular.module('app.controllers')
.controller('ProjectEditController',['$scope','$routeParams','$location','$cookies','appConfig','Project','Client',function($scope,$routeParams,$location,$cookies,appConfig,Project,Client){

    Project.get({id:$routeParams.id},function(data){
      $scope.project = data;

      Client.get({id:data.client.data.id},function(data){
        $scope.clientSelected = data;
      });
    });

    $scope.status = appConfig.project.status;

    $scope.save = function(){
      if($scope.form.$valid) {

        $scope.project.owner_id = $cookies.getObject('user').id;
        Project.update({id:$scope.project.project_id},$scope.project,function(){
          $location.path('/projects');
        });
      }
    }

    $scope.formatName = function(model) {
      if(model) {
          return model.name;
      }
      return '';
    }

    $scope.getClients = function(name){
      return Client.query({
        search:name,
        searchFields:'name:like'
      }).$promise;
    }


}]);
