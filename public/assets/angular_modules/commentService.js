angular.module('commentService', [])

.factory('Comment', function($http) {

    return {
        // get all the comments
        get : function(id) {
            return $http.get($location.$$absUrl + 'comment/get' + id);
        },

        // save a comment (pass in comment data)
        save : function(commentData) {
            return $http({
                method: 'POST',
                url: $location.$$absUrl+ '/comment/store',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(commentData)
            });
        },

        // destroy a comment
        destroy : function(id) {
            return $http.delete($location.$$absUrl +'/comment/destroy/' + id);
        }
    }

});