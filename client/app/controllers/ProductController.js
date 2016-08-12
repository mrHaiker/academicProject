/**
 * Created by Sergey on 12.08.2016.
 */
app.controller('ProductCtrl', function ($scope, Product, $window, $resource) {
    $scope.addNewElement = function () {
        console.log($scope.item);
        Product.create($scope.item, function (data, req) {
            $scope.addPhotography = true;
            $scope.idProduct = data.id
            $scope.access_token = `{"Authorization": "Bearer ${$window.localStorage.access_key}",
                            "Id-product": "${$scope.idProduct}"}`
        })
    }

    $scope.getPreview = function () {
        var User = $resource(serviceBase + 'products/:userId', {userId:'@id'});
        User.get({userId:$scope.idProduct}, function(data) {
            console.log(data.image);
            // console.log(data[0].image)
            $scope.preview = `/server/web/images/product/${data.image}-small.jpg`
            // console.log($scope.preview);
        });
    }

    var upload = document.getElementById('product-upload');
    upload.addEventListener('upload-before', function(e) {
        e.detail.file.uploadTarget = serviceBase + 'product/upload';
    });
    upload.addEventListener('upload-success', function() {
        $scope.getPreview()
    });
    $scope.addItem = function () {
        if ($scope.idProduct) {
            $scope.addPhotography = false
            $scope.item = {}
            $scope.idProduct = ''
        } else {
            $scope.addNewItem = ! $scope.addNewItem
        }
    }

})