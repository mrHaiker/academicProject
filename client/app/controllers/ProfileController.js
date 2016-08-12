/**
 * Created by Sergey on 12.08.2016.
 */
app.controller('ProfileCtrl', function ($scope, Profile) {
    $scope.data = {}
    $scope.avatar = ''
    $scope.test = 'test'
    $scope.userDetails = false

    $scope.getProfile = function () {
        Profile.query(function (data) {
            $scope.data = data[0]
            $scope.avatar = `/server/web/images/avatars/${data[0].avatar}-mid.jpg`
        })
    }
    $scope.getProfile();
    $scope.edit = function () {
        Profile.edit($scope.data, function () {})
    }
    var upload = document.getElementById('profile-upload');
    upload.addEventListener('upload-before', function(e) {
        e.detail.file.uploadTarget = serviceBase + 'identity/upload';
    });
    upload.addEventListener('upload-success', function() {
        $scope.getProfile();
    });
});