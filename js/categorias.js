'use strict';
oservices.controller('CtrlCategorias', ['$scope', '$http', function ($scope, $http) {
	getCategorias();
    function getCategorias() {
        $http({
            method: 'GET',
            url: 'controllers/categorias.php',
            dataType: 'json',
            headers: { "Content-Type": "application/json" }
        }).then(function (response) {
            console.log(`categorias ${response.data}`);
            $scope.categorias = response.data;
        }, function (response) {
            console.log(response);
        });
    }
}]);