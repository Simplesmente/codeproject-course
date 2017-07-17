var app = angular.module('app',['ngRoute','angular-oauth2','app.controllers']);

angular.module('app.controllers',['angular-oauth2','ngMessages']);

app.config(['$routeProvider','OAuthProvider',function($routeProvider,OAuthProvider){

    $routeProvider
        .when('/login',{
            templateUrl:'build/views/login.htm',
            controller:'LoginController'
        })
        .when('/home',{
            templateUrl:'build/views/home.htm',
            controller:'HomeController'
        });

    
    
    OAuthProvider.configure({
        baseUrl:"http://codeproject.app",
        clientId:'appid1',
        clientSecret:'secret',
        grantPath:'oauth/access_token'
    });

}]);

// it run this instrution after angularjs has been loaded
app.run(['$rootScope','$window','OAuth',function($rootScope,$window,OAuth){

    // Ignore `invalid_grant` error - should be catched  on 'LoginController'
    $rootScope.$on('oauth:error',function(event,rejection){
        
        if('invalid_grant' === rejection.data.error){
            return;
        }

         if('invalid_token' === rejection.data.error){
            return OAuth.getRefreshToken();
        }

        return $window.location.href= '/login?error_reason='+rejection.data.error;


    });

}]);