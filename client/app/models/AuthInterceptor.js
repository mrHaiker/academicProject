app.factory('AuthInterceptor', function ($q, $window, $location) {
    return {
        request: function (config) {
            if ($window.localStorage.access_key) {
                config.headers.Authorization = 'Bearer ' + $window.localStorage.access_key;
            }
            return config;
        },
        responseError: function (rejection) {
            if (rejection.status === 401) {
                $location.path('/user/login').replace();
            }
            return $q.reject(rejection);
        }
    };
});