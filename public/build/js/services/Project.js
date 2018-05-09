angular.module('app.services').service('Project',['$resource','$filter','$httpParamSerializer','appConfig',function($resource,$filter,$httpParamSerializer,appConfig){

    function transFormData(data,headers) {
        if(angular.isObject(data) && data.hasOwnProperty('due_date')){
          var newData = angular.copy(data);
          newData.due_date = $filter('date')(data.due_date,'yyyy-MM-dd');
          return appConfig.utils.transformRequest(newData)
        }
        return data;
    }

    return $resource(appConfig.baseUrl + '/project/:id',{id:'@id'},{
        update: {
            method:'PUT',
            transformRequest: transFormData
        },
        'query':  {method:'GET', isArray:true},
        save:{
          method: 'POST',
          transformRequest:transFormData


        },
        get: {
          method: 'GET',
          transformResponse:
          function(data,headers) {
            var obj = appConfig.utils.transformResponse(data,headers);
            if(angular.isObject(obj) && obj.hasOwnProperty('due_date')){
              var date = obj.due_date.split('-');
              var month = parseInt(date[1]) -1
              obj.due_date = new Date(date[0],month,date[2]);
            }
            return obj;
          }
        }

    });

}]);
