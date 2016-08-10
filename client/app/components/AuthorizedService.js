/**
 * Created by Sergey on 10.08.2016.
 */
app.service('_authorized', function ($window) {
    this.isLogin = function () {
        return $window.localStorage.access_key ? true : false
    }
    this.getName = function() {
        return ($window.localStorage.username !== undefined) ? $window.localStorage.username : 'Гость'
    }
});