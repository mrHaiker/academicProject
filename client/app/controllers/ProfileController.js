/**
 * Created by Sergey on 12.08.2016.
 */
app.controller('ProfileCtrl', function ($scope, Profile, $timeout) {
    $scope.data = {}
    $scope.avatar = ''
    $scope.test = 'test'

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
    $scope.userDetails = function () {
        $scope.openDetails = true;
        $timeout(function () {
            var upload = document.getElementById('profile-upload');
            upload.addEventListener('upload-before', function(e) {
                e.detail.file.uploadTarget = serviceBase + 'identity/upload';
            });
            upload.addEventListener('upload-success', function() {
                $scope.getProfile();
            });
        },100)

    }

});