/**
 * Created by Sergey on 10.08.2016.
 */

app.factory('Product', function ($resource) {
    return $resource(serviceBase+'product', {

    }, {
        create: {
            url: serviceBase + 'product/create',
            method: "POST"
        }
    })
})