/**
 * Created by Sergey on 11.08.2016.
 */
app.factory('Profile', function ($resource) {
    return $resource(serviceBase + 'identity', {

    }, {
        edit: {
            url: serviceBase+'identity/edit',
            method: 'POST'
        }
    })
})