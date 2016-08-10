/**
 * Created by Sergey on 09.08.2016.
 */

app.factory('User', function ($resource) {
    return $resource(serviceBase+'user/register', {

    }, {
        register: {
            url: serviceBase+'user/register',
            method: 'POST'
        },
        login: {
            url: serviceBase+'user/login',
            method: 'POST'
        },
        edit: {
            url: serviceBase+'identity/edit',
            method: 'POST'
        }
    });
});