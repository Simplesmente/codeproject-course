angular.module('app.controllers')
        .controller('LoginController',['$scope','$location','OAuth',function($scope,$location,OAuth){

            $scope.user = {
                username:'',
                password:'',
                errors:{
                    error:false,
                    message:''
                }
            };

            $scope.doLogin = function(){

                if($scope.form.$valid) {
                   
                    OAuth.getAccessToken($scope.user)
                        .then(function(){
                            $location.path('home');
                        },function(err){
                            
                           $scope.user.errors.error=true;
                           $scope.user.errors.message= err.data.error_description;
                           
                            //$scope.user.error = 'Usuários ou senha inválidos';
                     });
                }
                
            };

        }]);