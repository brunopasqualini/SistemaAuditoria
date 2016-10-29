var appGrid = angular.module('gridApp', []);
appGrid.config(['$httpProvider', function($httpProvider) {
    $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
}]);
appGrid.controller('gridCtrl', ['$scope', '$http', '$compile', '$rootElement', function($scope, $http, $compile, $rootElement){
    $scope.records = [];
    $scope.loadRecords = function(){
        $http.get('?path=' + $rootElement.attr('path') + '&process=getRecords')
        .then(function (response){
            $scope.records = response.data;
        });
    };
    $scope.showModalInsert = function(event){
        var target = angular.element(event.currentTarget);
        loadModalForm(target.data('src'));
    };
    $scope.showModalForm = function(event, record, identifiers){
        var target  = angular.element(event.currentTarget);
        var data    = {};
        identifiers = JSON.parse(identifiers);
        angular.forEach(identifiers, function(value) {
            this[value] = record[value];
        }, data);
        loadModalForm(target.data('src'), data);
    };
    $scope.onSubmitForm = function(event){
        var form   = angular.element(event.currentTarget);
        var inputs = $('input, select', form);
        var data   = {};
        inputs.each(function() {
            data[this.name] = $(this).val();
        });
        form.find('button[type=submit], input[type=submit]').attr('disabled', '');
        $http.post(form.attr('action'), data)
        .then(function (response){
            angular.element('#modalAjaxContent').closeModal();
            $scope.loadRecords();
        });
        event.preventDefault();
    };
    function loadModalForm(src, data, fnCallback){
        var ele = angular.element('#modalAjaxContent');
        ele.find('> div').hide().filter('.modal-loading').show();
        ele.openModal();
        $http.get(src, {
            headers : {'Accept' : 'text/html'},
            params  : $.isPlainObject(data) ? data : {}
        })
        .then(function (response){
            ele.html(response.data);
            ele.find('> div').filter('.modal-loading').hide();
            ele.find('> div').filter('.modal-content').show();
            $compile(ele.contents())($scope);
            $('select').material_select();
            Materialize.updateTextFields();
            if($.isFunction(fnCallback)){ fnCallback(); }
        });
    }
    $scope.loadRecords();
}]);
