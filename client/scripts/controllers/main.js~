'use strict';

angular.module('readerApp')
  .controller('MainCtrl', function($scope, $http) {
	$scope.feed_url = "";
        $scope.feed = {
          title: 'Feeds Parser',
	  process: 'Search Result:',
          items: {}
        };

	$scope.submitForm = function() {
	    var feed_url = $scope.feed_url;
	    var service_url = "http://localhost/feeds/services/web/app_dev.php/feeds?feed_url=";

	    var url = service_url + encodeURIComponent(feed_url);
	    $http.get(url).
	      success(function(data, status, headers, config) {
		$scope.feed = {
		  title: 'Feeds Parser : Results',
		  process: '',
		  items: data.result.products
		};

		// If receive an empty response
		if (data==null || data.result==null || data.result.products==null || data.result.products.length<=0){
			$scope.feed.process = "No result(s) found.";  
		}

	      }).
	      error(function(data, status, headers, config) {
		console.error('Error fetching feed:', data);
	      });
	};
  });

