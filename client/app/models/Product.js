/**
 * Created by Sergey on 10.08.2016.
 */

app.factory('Product', function ($resource) {
    return $resource(serviceBase+'products', {

    }, {
        create: {
            url: serviceBase + 'product/create',
            method: "POST"
        }
    })
})