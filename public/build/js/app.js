var app = angular.module('app',['ngRoute','angular-oauth2','app.controllers','app.services','app.filters',
'ui.bootstrap.typeahead','ui.bootstrap.tpls']);

angular.module('app.controllers',['angular-oauth2','ngMessages']);
angular.module('app.services',['ngResource']);
angular.module('app.filters',[]);

app.provider('appConfig',['$httpParamSerializerProvider',function($httpParamSerializerProvider){

    var config = {
        baseUrl:'http://codeproject.test',
        project:{
          status:[
            {id:1, label: "Não Iniciado"},
            {id:2, label: "Iniciado"},
            {id:3, label: "Concluído"}
          ]
        },
        utils:{
          transformRequest: function(data,headers) {

            if(angular.isObject(data)) {
              return $httpParamSerializerProvider.$get()(data);
            }
            return data;
          },
          transformResponse: function(data,headers) {
            var headersGetters = headers();
            if(headersGetters['content-type'] == 'application/json' ||
                headersGetters['content-type'] == 'text/json') {
                  var dataJson = JSON.parse(data);
                  if(dataJson.hasOwnProperty('data')) {
                    dataJson = dataJson.data;
                  }
                  return dataJson;
                }
                return data;
          },
        }
    };

    return {
        config:config,
        $get:function() {
            return config;
        }
    };
}]);

app.config(['$routeProvider','$httpProvider','OAuthProvider','OAuthTokenProvider','appConfigProvider',
                    function($routeProvider,$httpProvider,OAuthProvider,OAuthTokenProvider,appConfigProvider){

    $httpProvider.defaults.headers.post['Content-Type'] ='application/x-www-form-urlencoded;charset=UTF-8';
    $httpProvider.defaults.headers.put['Content-Type'] ='application/x-www-form-urlencoded;charset=UTF-8';
    $httpProvider.defaults.transformResponse = appConfigProvider.config.utils.transformResponse;
    $httpProvider.defaults.transformRequest  = appConfigProvider.config.utils.transformRequest;


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
        })
        .when('/projects',{
            templateUrl:'build/views/project/list.htm',
            controller:'ProjectListController'
        })
        .when('/project/new',{
            templateUrl:'build/views/project/new.htm',
            controller:'ProjectNewController'
        })
        .when('/project/:id/edit',{
            templateUrl:'build/views/project/edit.htm',
            controller:'ProjectEditController'
        })
        .when('/project/:id/remove',{
            templateUrl:'build/views/project/remove.htm',
            controller:'ProjectRemoveController'
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
