/**
 * Created by jaiso on 27/02/2017.
 */
angular.module('filters')
    .filter('join', function () {
        return function (input, joinStr) {
            return input.join(joinStr);
        }
    });