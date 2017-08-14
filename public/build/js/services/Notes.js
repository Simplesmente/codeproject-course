angular.module('app.services').service('Notes',['$resource','appConfig',function($resource,appConfig){

    var url = appConfig.baseUrl + '/project/:idProject/notes/:id';
    return $resource(url,{id:'@id',idProject:'@idProject'},{
        update: {
            method:'PUT'
        },
        getOne: {
            method: 'GET',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }
       
    });

}]);
