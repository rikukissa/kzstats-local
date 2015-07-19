'use strict';

/**
 * Server service
 */
module.exports = function($http) {

  // API query for server info
  this.getInfo = function() {
    return $http.get('api/server/').then(function(res) { return res.data; });
  };

};