angular.module('app.services').service('User',['$resource','appConfig',function($resource,appConfig){

    var url = appConfig.baseUrl + '/user';

    return $resource(url,{},{
        authenticated: {
            url: appConfig.baseUrl + '/user/authenticated',
            method:'GET'
        }
    });

}]);
