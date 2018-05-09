angular.module('app.controllers')
.controller('ProjectNewController',['$scope','$location','$cookies','appConfig','Project','Client',function($scope,$location,$cookies,appConfig,Project,Client){

    $scope.project = new Project();
    $scope.project.owner_id = $cookies.getObject('user').id;
    $scope.clients = Client.query();
    $scope.status = appConfig.project.status;
    $scope.errors = null;


    $scope.save = function(){

        if($scope.form.$valid) {
            $scope.project.$save().then(function(){
                $location.path('/projects');
            },function(err){
                console.log(err['data']);
            });
        }
    }
    $scope.formatName = function(id) {
      if(id) {
        for (var index in $scope.clients) {
          if ($scope.clients[index].id == id) {
              return $scope.clients[index].name;
          }
        }
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
