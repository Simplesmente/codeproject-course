angular.module('app.controllers')
        .controller('LoginController',['$scope','$location','$cookies','User','OAuth',function($scope,$location,$cookies,User,OAuth){

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

                            User.authenticated({},{},function(data){
                              $cookies.putObject('user',data);
                              $location.path('home');
                            });

                        },function(err){
                            console.log(err);
                           $scope.user.errors.error=true;
                           $scope.user.errors.message= err.data.error_description;

                            //$scope.user.error = 'Usuários ou senha inválidos';
                     });
                }

            };

        }]);
