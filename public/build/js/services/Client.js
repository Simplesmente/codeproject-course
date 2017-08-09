angular.module('app.services').service('Client',['$resource','appConfig',function($resource,appConfig){

    var url = appConfig.baseUrl + '/client/:id';
    
    return $resource(url,{id:'@id'},{
        update: {
            method:'PUT'
        }
    });

}]);
