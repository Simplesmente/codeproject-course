var app = angular.module('app',['ngRoute','angular-oauth2','app.controllers','app.services']);

angular.module('app.controllers',['angular-oauth2','ngMessages']);
angular.module('app.services',['ngResource']);

app.provider('appConfig',function(){

    var config = {
        baseUrl:'http://codeproject.app'
    };

    return {
        config:config,
        $get:function() {
            return config;
        }
    };
});

app.config(['$routeProvider','OAuthProvider','OAuthTokenProvider','appConfigProvider',
                    function($routeProvider,OAuthProvider,OAuthTokenProvider,appConfigProvider){
    $routeProvider
        .when('/login',{
            templateUrl:'build/views/login.htm',
            controller:'LoginController'
        })
        .when('/home',{
            templateUrl:'build/views/home.htm',
            controller:'HomeController'
        })
        .when('/clients',{
            templateUrl:'build/views/client/list.htm',
            controller:'ClientListController'
        })
        .when('/clients/new',{
            templateUrl:'build/views/client/new.htm',
            controller:'ClientNewController'
        })
        .when('/clients/:id/edit',{
            templateUrl:'build/views/client/edit.htm',
            controller:'ClientEditController'
        })
        .when('/clients/:id/remove',{
            templateUrl:'build/views/client/remove.htm',
            controller:'ClientRemoveController'
        })

        .when('/project/:idProject/notes/',{
            templateUrl:'build/views/notes/list.htm',
            controller:'NotesListController'
        })
        .when('/project/:idProject/notes/new',{
            templateUrl:'build/views/notes/new.htm',
            controller:'NotesNewController'
        })
        .when('/project/:idProject/notes/:id',{
            templateUrl:'build/views/notes/listOne.htm',
            controller:'NotesListOneController'
        })
        .when('/project/:idProject/notes/:id/edit',{
            templateUrl:'build/views/notes/edit.htm',
            controller:'NotesEditController'
        })
        .when('/project/:idProject/notes/:id/remove',{
            templateUrl:'build/views/notes/remove.htm',
            controller:'NotesRemoveController'
        });



    OAuthProvider.configure({
        baseUrl: appConfigProvider.config.baseUrl,
        clientId:'appid1',
        clientSecret:'secret',
        grantPath:'oauth/access_token'
    });

    OAuthTokenProvider.configure({
        name:'token',
        options:{
            secure:false
        }
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

        return $window.location.href= '/#login?error_reason='+rejection.data.error;


    });

}]);
