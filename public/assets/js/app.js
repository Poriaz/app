/*global angular */
'use strict';

/**
 * The main app module
 * @name app
 * @type {angular.Module}
 */
var app = angular.module('app', ['angular-loading-bar', 'ngAnimate', 'ngTagsInput', 'flow', 'autocomplete', 'ngSanitize', 'commentService','MyTimeAgoModule','ngDialog','infinite-scroll','emoji','ngSanitize','ngResource'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
       }).config(['flowFactoryProvider', function (flowFactoryProvider) {
    flowFactoryProvider.defaults = {
      target: 'uploadwallstatusfiles',
      permanentErrors: [415,500, 501],
      testChunks:false
    };
    flowFactoryProvider.on('catchAll', function (event) {
      console.log('catchAll', arguments);
    });
   flowFactoryProvider.on('fileSuccess', function (event, $flow, $file, $message) {  
		console.log($flow);console.log($file);console.log($message);// $message is the json response from the post
	});
    // Can be used with different implementations of Flow.js
    flowFactoryProvider.factory = fustyFlowFactory;
  }]).run(function($rootScope) {
        $rootScope.popup_category = "";
        $rootScope.popup_tags = "";
        $rootScope.popup_location = "";
        $rootScope.uploaded_image = "";
        $rootScope.baseurl = "";
        $rootScope.theUser = window.user;
        $rootScope.date = new Date();
        
});
 
app.filter('capitalize', function() {
    return function(input) {
      return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
    }
});

app.config(['ngDialogProvider', function (ngDialogProvider) {
            ngDialogProvider.setDefaults({
                className: 'ngdialog-theme-default',
                plain: false,
                showClose: true,
                closeByDocument: true,
                closeByEscape: true,
                appendTo: false,
                preCloseCallback: function () {
                    console.log('default pre-close callback');
                }
            });
        }]); 

 
 
// the service that retrieves some movie title from an url
app.factory('MovieRetriever', function($http, $q, $timeout){
  var MovieRetriever = new Object();

  MovieRetriever.getmovies = function(i) {
    var moviedata = $q.defer();
    var movies;

    var someMovies = [];
    $http.get('/socialnetwork/home/get_categories/')
                    .success(function(getData) {
                        var moreMovies = getData;
                        if(i && i.indexOf('T')!=-1)
                          movies=moreMovies;
                        else
                          movies=moreMovies;
                    });
                    $timeout(function(){
                          moviedata.resolve(movies);
                        },2000);

                        return moviedata.promise
    //var moreMovies = ["Insurance", "Kitchen & Dining", "LCD & LED", "Mobile", "Motor Cars", "Stamps", "Telecommunication", "Tools & Hardware"]

    
  }

  return MovieRetriever;
});


app.filter('getcommaseparated', function(){
    return function (items) { 
        var filtered = [];
        angular.forEach(items, function(item){
            filtered.push(item.text);
        });
        return filtered;
    };
});
app.filter('trim', function () {
    return function(value) {
        if(!angular.isString(value)) {
            return value;
        }  
        return value.replace(/^\s+|\s+$/g, '');
    };
});

app.filter('cut', function () {
        return function (value, wordwise, max, tail) {
            if (!value) return '';

            max = parseInt(max, 10);
            if (!max) return value;
            if (value.length <= max) return value;

            value = value.substr(0, max);
            if (wordwise) {
                var lastspace = value.lastIndexOf(' ');
                if (lastspace != -1) {
                  //Also remove . and , so its gives a cleaner result.
                  if (value.charAt(lastspace-1) == '.' || value.charAt(lastspace-1) == ',') {
                    lastspace = lastspace - 1;
                  }
                  value = value.substr(0, lastspace);
                }
            }

            return value + (tail || ' …');
        };
    });

app.controller('popupController', function ($scope, $rootScope, ngDialog, $timeout) {
            $rootScope.jsonData = '{"foo": "bar"}';
            $rootScope.theme = 'ngdialog-theme-default';

            $scope.directivePreCloseCallback = function (value) {
                if(confirm('Close it? MainCtrl.Directive. (Value = ' + value + ')')) {
                    return true;
                }
                return false;
            };

            $scope.preCloseCallbackOnScope = function (value) {
                if(confirm('Close it? MainCtrl.OnScope (Value = ' + value + ')')) {
                    return true;
                }
                return false;
            };

            $scope.open = function() {
                var new_dialog = ngDialog.open({ id: 'fromAService', template: 'firstDialogId', controller: 'InsideCtrl', data: { foo: 'from a service' } });
                // example on checking whether created `new_dialog` is open
                $timeout(function() {
                    console.log(ngDialog.isOpen(new_dialog.id));
                }, 2000)
            };
            
             $rootScope.$on('ngDialog.opened', function (e, $dialog) {
                console.log('ngDialog opened: ' + $dialog.attr('id'));
            });

            $rootScope.$on('ngDialog.closed', function (e, $dialog) {
                console.log('ngDialog closed: ' + $dialog.attr('id'));
            });

            $rootScope.$on('ngDialog.closing', function (e, $dialog) {
                console.log('ngDialog closing: ' + $dialog.attr('id'));
            });

            $rootScope.$on('ngDialog.templateLoading', function (e, template) {
                console.log('ngDialog template is loading: ' + template);
            });

            $rootScope.$on('ngDialog.templateLoaded', function (e, template) {
                console.log('ngDialog template loaded: ' + template);
            });
 });
app.controller('InsideCtrl', function ($scope, ngDialog) {
            $scope.dialogModel = {
                message : 'message from passed scope'
            };
            $scope.openSecond = function () {
                ngDialog.open({
                    template: '<h3><a href="" ng-click="closeSecond()">Close all by click here!</a></h3>',
                    plain: true,
                    closeByEscape: false,
                    controller: 'SecondModalCtrl'
                });
            };
        });
app.controller('MyCtrl', function($scope, MovieRetriever){
    $scope.movies = MovieRetriever.getmovies("...");
  
  $scope.movies.then(function(data){
    $scope.movies = data;
  });

  $scope.getmovies = function(){
    return $scope.movies;
  }

  $scope.doSomething = function(typedthings){
    console.log("Do something like reload data with this: " + typedthings );
    $scope.popup_category = typedthings;
    $scope.newmovies = MovieRetriever.getmovies(typedthings);
    $scope.newmovies.then(function(data){
      $scope.movies = data;
    });
  }

  $scope.responseuploadedfile = function( $file, $message, $flow){
	$message = JSON.parse($message);
    $scope.uploaded_image = $scope.uploaded_image +", "+$message.flowFilename;
  }
  
  $scope.add_location = function(v){
    $scope.popup_location = v;
  }
  
  $scope.add_tags = function(v){
    $scope.popup_tags = v;
  }
  
});




// inject the Comment service into our controller
app.controller('postactivityController', ['$scope', '$http','$location','$parse','$timeout', function($scope, $http, $location, $parse,$timeout) {
	 $scope.emojihtmlarray = [":bowtie:",":smile:",":laughing:",":blush:",":smiley:",":relaxed:",":smirk:",":heart_eyes:",":kissing_heart:",":kissing_closed_eyes:",":flushed:",":relieved:",":satisfied:",":grin:",":wink:",":stuck_out_tongue_winking_eye:",":stuck_out_tongue_closed_eyes:",":grinning:",":kissing:",":kissing_smiling_eyes:",":stuck_out_tongue:",":sleeping:",":worried:",":frowning:",":anguished:",":open_mouth:",":grimacing:",":confused:",":hushed:",":expressionless:",":unamused:",":sweat_smile:",":sweat:",":joy:",":astonished:",":scream:",":neckbeard:",":tired_face:",":angry:",":rage:",":triumph:",":sleepy:",":yum:",":mask:",":sunglasses:",":dizzy_face:",":imp:",":smiling_imp:",":neutral_face:",":no_mouth:",":innocent:",":alien:",":broken_heart:",":heartbeat:",":heartpulse:",":two_hearts:",":revolving_hearts:",":cupid:",":sparkling_heart:",":sparkles:",":star:",":star2:"];
	 $scope.showEmoListOnComment = "";
	 $scope.postsOffset = 0;
         $scope.posts = [];
         $scope.postsStillLoading = false;
         $scope.noMorePosts = false;
	 $scope.commentform = {};
	 $scope.showEmoListOnComment = null;
         $scope.nextposts = function(){
         if($scope.postsStillLoading === true) return; // request in progress, return
            $scope.postsStillLoading = true;
            $http.get($scope.baseurl+ '/home/getfeed/' + $scope.postsOffset)
                .success(function(data){
                    for (var i = 0; i < data.length; i++) {
                            $scope.posts.push(data[i]);
                    }
                    if(data.length < 1){
                        $scope.noMorePosts = true;
                    }
                    $scope.postsOffset += 1;
                    $scope.postsStillLoading = false; // request processed
                });
    };
    $scope.intervalFunction = function(){
        if($scope.postsStillLoading === true) return;
        $timeout(function() {
          $scope.largestpost_id = null;
          for (var i = 0; i < $scope.posts.length; i++) {
                var post = $scope.posts[i];
                if ($scope.largestpost_id == null || post.post_id > $scope.largestpost_id) {
                    $scope.largestpost_id = post.post_id;
                }
          }
          $http.get($scope.baseurl+ '/home/getnewfeed/'+$scope.largestpost_id)
                .success(function(data){
                    for (var i = 0; i < data.length; i++) {
                            $scope.posts.push(data[i]);
                    }
                        
                });
          $scope.intervalFunction();
        }, 10000)
    };

    // Kick off the interval
    $scope.intervalFunction();
    $scope.userwallpostsOffset = 0;
    $scope.posts = [];
    $scope.userwallpostsStillLoading = false;
    $scope.userwallnoMorePosts = false;
    $scope.userwallnextposts = function($user_id){
        if($scope.userwallpostsStillLoading === true) return; // request in progress, return
        $scope.userwallpostsStillLoading = true;
        $http.get($scope.baseurl+ '/home/userwallgetfeed/' + $user_id + '/' + $scope.userwallpostsOffset)
            .success(function(data){
                for (var i = 0; i < data.length; i++) {
                        $scope.posts.push(data[i]);
                }
                if(data.length < 1){
                    $scope.userwallnoMorePosts = true;
                }
                $scope.userwallpostsOffset += 1;
                $scope.userwallpostsStillLoading = false; // request processed
            });
    };
    
    $scope.selected = {};
    $scope.getCommenteditTemplate = function (comment) {
        if (comment.comment_id === $scope.selected.comment_id){
         return 'edit';
        }
        else return 'display';
       };
    $scope.editComment = function (comment) {
        $scope.selected = angular.copy(comment);
    };
    $scope.resetComment = function () {
        $scope.selected = {};
    };
    $scope.updateComment = function(comment, $post_id, $index){
         $scope.selected = {};
         var updatecommentdata = {'text':comment.text,'comment_id':comment.comment_id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/comment/update',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(updatecommentdata)
            })
            .success(function(data) {
                // if successful, we'll need to refresh the comment list
                $http.get($scope.baseurl + '/comment/get/' + $post_id)
                    .success(function(getData) {
                        $scope.posts[$index].comments = getData;
						
                    });

            })
            .error(function(data) {
                console.log(data);
            });
    };
    // function to handle submitting the form
    // SAVE A COMMENT ================
	
    $scope.submitComment = function($post_id, $index, $comment) {
        // save the comment. pass in comment data from the form
        // use the function we created in our service
            console.log($index);
            var commentdata = {'post_id':$post_id,'text':$comment};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/comment/store',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(commentdata)
            })
            .success(function(data) {
                // if successful, we'll need to refresh the comment list
                $scope.posts[$index].comments_count = [];
                $http.get($scope.baseurl + '/comment/get/' + $post_id)
                    .success(function(getData) {
                        $scope.posts[$index].comments = getData;
			//$scope.commentform.commenttext = null;
                        $scope.posts[$index].comments_count.post_id = $post_id;
                        $scope.posts[$index].comments_count.aggregate = getData.length;
                    });

            })
            .error(function(data) {
                console.log(data);
            });
    };
	// DELETE A COMMENT ====================================================
    $scope.deletecomment = function($index, $post_id,$comment_id){
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/comment/delete/'+$comment_id,
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
            })
            .success(function(data) {
		 $http.get($scope.baseurl + '/comment/get/' + $post_id)
                    .success(function(getData) {
                        $scope.posts[$index].comments = getData;
			$scope.posts[$index].comments_count.post_id = $post_id;
                        $scope.posts[$index].comments_count.aggregate = getData.length;			
                    });
            })
            .error(function(data) {
                console.log(data);
            });
	};
	
	$scope.add_like = function($post_id, $index){
		var likedata = {'post_id':$post_id};
		$http({
                method: 'POST',
                url: $scope.baseurl+ '/like/store',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(likedata)
            })
            .success(function(data) {
					$http.get($scope.baseurl + '/home/fetchpostlikes/' + $post_id)
                    .success(function(getData) {
                        $scope.posts[$index].likes = getData;
						
                    });
            })
            .error(function(data) {
                console.log(data);
            });
	};
	
	$scope.share = function($post_id, $index){
		var share_data = {'post_id':$post_id};
		$http({
                method: 'POST',
                url: $scope.baseurl+ '/share_post',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(share_data)
            })
            .success(function(data) {
					
            })
            .error(function(data) {
                console.log(data);
            });
	};
	
	$scope.get_single_post = function($post_id){
		$http.get($scope.baseurl + '/fetch_single_post/' + $post_id)
                    .success(function(getData) {
                        $scope.posts = getData;
						
        });
	};
	
	$scope.add_emoji = function(commentform, emo, $index){
			console.log(emo);
			$scope.commentform.commenttext[$index] +=  emo + ' ';
			$scope.showEmoListOnComment = null;
	};
        $scope.get_comments = function($post_id,$index){
                console.log($index);
		$http.get($scope.baseurl + '/comment/get/' + $post_id)
                    .success(function(getData) {
                        $scope.posts[$index].comments = getData;
						
                    });
	};

}]);


app.controller('profileController', ['$scope', '$http','$location','$parse', function($scope, $http, $location, $parse) {
        $scope.gender =  ["Female", "Male"];
        $scope.myProfileData = [];
    // get all data from profile
	$scope.loadprofiledata = function(){
		$http.get($scope.baseurl + '/users/getprofiledetails')
        .success(function(data) {
            $scope.myProfileData = data;
         });
	};
	$scope.updateAboutMe = function($aboutme){
		var aboutme = {'about_me':$aboutme};
		$scope.editable = '';
		$http({
                method: 'POST',
                url: $scope.baseurl+ '/users/update_aboutme',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(aboutme)
            })
        .success(function(data) {
            
         })
		.error(function(data){
			console.log(data);
		})
	};
	$scope.reloadAboutMe = function($aboutme){
		$http.get($scope.baseurl + '/users/getaboutme')
        .success(function(data) {
            $scope.myProfileData.about_me = data.about_me;
			$scope.editable = '';
         })
	};
	$scope.updateProfileDetails = function($profileData){
		$scope.editable = '';
		$http({
                method: 'POST',
                url: $scope.baseurl+ '/users/update_profiledetails',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param($profileData)
            })
        .success(function(data) {
            
         })
		.error(function(data){
			console.log(data);
		})
	};
	$scope.reloadProfileData = function($aboutme){
		$http.get($scope.baseurl + '/users/getprofiledetails')
        .success(function(data) {
            $scope.myProfileData = data;
			$scope.editable = '';
         });
	};
}]);

app.controller('associatesController', ['$scope', '$http','$location','$parse', function($scope, $http, $location, $parse) {
       
    // get all data from profile
        $scope.mySuggestions = [];
        $scope.myAssociates = [];
        $scope.userwallAssociates = [];
        $scope.Associates = [];
        $scope.associaterequests = [];
	$scope.loadsuggestions = function(){
			$http.get($scope.baseurl + '/associates/getsuggestions')
					.success(function(data) {
						$scope.mySuggestions = data;
					});
	};
	
       $scope.getsidebarassociates =  function(){
				$http.get($scope.baseurl + '/associates/mine')
                        .success(function(data1) {
                            $scope.myAssociates = data1;
                         });
                
       };
       
        $scope.userwallgetsidebarassociates =  function($user_id){
				$http.get($scope.baseurl + '/associates/userwallassociates/' + $user_id)
                        .success(function(data) {
                            $scope.userwallAssociates = data;
                         });
                
        };
	   $scope.loadassociates = function(){
				$http.get($scope.baseurl + '/associates/mine')
                        .success(function(data) {
                            $scope.Associates = data;
						});
	   };
	   //header data
	   $scope.loadassociatesrequests = function(){
				$http.get($scope.baseurl + '/associates/requests')
                        .success(function(data) {
                            $scope.associaterequests = data;
                         });
	   };
	   
	   $scope.accept_associate_header = function($id){
            var associate = {'id':$id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/associate/accept_request',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(associate)
            })
            .success(function(data) {
                $scope.loadassociatesrequests();
            })
            .error(function(data){
			console.log(data);
            })
	  }; 
	   
	   $scope.ignore_associate_request_header = function($id){
            var associate = {'id':$id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/associate/ignore_request',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(associate)
            })
            .success(function(data) {
                $scope.loadassociatesrequests();
            })
            .error(function(data){
			console.log(data);
            })
	}; 
	   
	   
	   //header data
	   $scope.drop_associate_from_accociates_page = function($id){
            var associate = {'id':$id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/associate/remove',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(associate)
            })
            .success(function(data) {
                $scope.loadassociates();
			})
            .error(function(data){
			console.log(data);
            })
	};
	   
	   
       $scope.add_associate = function($index, $associate_id){
            var associate = {'associate_id':$associate_id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/associate/request_fetch',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(associate)
            })
            .success(function(data) {
                $scope.mySuggestions[$index].addedbyme = data;
                console.log($scope.mySuggestions);
            })
            .error(function(data){
			console.log(data);
            })
	}; 
        
        $scope.drop_associate_request = function($index, $id){
            var associate = {'id':$id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/associate/remove_request',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(associate)
            })
            .success(function(data) {
                $scope.mySuggestions[$index].addedbyme = null;
                console.log($scope.mySuggestions);
            })
            .error(function(data){
			console.log(data);
            })
	}; 
        
        $scope.accept_associate = function($index, $id){
            var associate = {'id':$id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/associate/accept_request',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(associate)
            })
            .success(function(data) {
                $scope.mySuggestions[$index].addedme = data;
                console.log($scope.mySuggestions);
            })
            .error(function(data){
			console.log(data);
            })
	}; 
        
        $scope.ignore_associate_request = function($index, $id){
            var associate = {'id':$id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/associate/ignore_request',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(associate)
            })
            .success(function(data) {
                $scope.mySuggestions[$index].addedme = data;
                console.log($scope.mySuggestions);
            })
            .error(function(data){
			console.log(data);
            })
	}; 
        
        $scope.drop_associate = function($index, $id, $who){
            var associate = {'id':$id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/associate/remove',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(associate)
            })
            .success(function(data) {
                if($who == 'byme'){
                   $scope.mySuggestions[$index].addedbyme = null;
                } else {
                   $scope.mySuggestions[$index].addedme = null; 
                }
                console.log($scope.mySuggestions);
            })
            .error(function(data){
			console.log(data);
            })
	}; 
	
}]);

app.controller('followerController', ['$scope', '$http','$location','$parse', function($scope, $http, $location, $parse) {
        $scope.followSuggestions = [];
        $scope.followers = [];
        $scope.following = [];
        $scope.loadsuggestions = function(){
		$http.get($scope.baseurl + '/follower/getsuggestions')
		.success(function(data) {
			$scope.followSuggestions = data;
		});
	   };
        $scope.loadfollowers = function(){
		$http.get($scope.baseurl + '/follower/get_followers')
		.success(function(data) {
			$scope.followers = data;
		});
	   };
           
        $scope.loadfollowing = function(){
		$http.get($scope.baseurl + '/follower/get_following')
		.success(function(data) {
			$scope.following = data;
		});
	   };
           
        $scope.follow = function($index, $follow_who_id){
            var follower = {'user_id':$follow_who_id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/follower/add',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(follower)
            })
            .success(function(data) {
                console.log(data);
                $scope.followSuggestions[$index].mefollowing = data;
                
            })
            .error(function(data){
			console.log(data);
            })
	};
        
        $scope.unfollow = function($index, $unfollow_who_id, $request_from){
            var follower = {'user_id':$unfollow_who_id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/follower/remove',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(follower)
            })
            .success(function(data) {
                console.log(data);
                if($request_from == 'follow'){
                    $scope.followSuggestions[$index].mefollowing = data;
                } else {
                    $scope.loadfollowing();
                }
                
            })
            .error(function(data){
			console.log(data);
            })
	};
        
        
        
}]);

app.controller('wallController', ['$rootScope','$scope', '$http','$location','$parse', function($rootScope,$scope, $http, $location, $parse) {
        $scope.follower_count = 0;
        $scope.following_count = 0;
        $scope.associate_count = 0;
        $scope.walluser = [];
        $scope.getdetails = function(){
		$http.get($scope.baseurl + '/home/getdetails')
		.success(function(data) {
			$scope.follower_count = data.followers_count;
                        $scope.following_count = data.following_count;
                        $scope.associate_count = data.associate_count;
		});
	   };
           
        $scope.userwallgetdetails = function($user_id){
		$http.get($scope.baseurl + '/home/userwallgetdetails/'+ $user_id)
		.success(function(data) {
			$scope.follower_count = data.followers_count;
                        $scope.following_count = data.following_count;
                        $scope.associate_count = data.associate_count;
                        $scope.walluser = data.wall_user;
		});
	   };
        
        $scope.onFileSelect = function(files) {
            var fd = new FormData();
            //Take the first selected file
            fd.append("file", files[0]);

            $http.post($scope.baseurl + '/users/addprofilepic', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            })
            .success(function(data){ 
                console.log(data);
                $rootScope.theUser.profile_pic =  data;
                files = null;
                
            })
            .error(function(data){ 
                console.log(data);
            });

        };
		
		$scope.onWallImageSelect = function(files,clientWidth,clientHeight) {
            var fd = new FormData();
            //Take the first selected file
            fd.append("file", files[0]);
			console.log("W" + files[0].naturalWidth);
			console.log("H" + clientHeight);
			
			$http.post($scope.baseurl + '/users/addwallpic', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            })
            .success(function(data){ 
                console.log(data);
                $rootScope.theUser.wall_pic =  data;
                files = null;
                
            })
            .error(function(data){ 
                console.log(data);
            }); 

        };
}]);

app.controller('headerNotificationController', ['$scope', '$http','$location','$parse', function($scope, $http, $location, $parse) {
        $scope.allSeenBusy = false;   
        $scope.notifications = [];
        $scope.associateNotification = [];
        $scope.likeCommentNotification = [];
        $scope.messageNotification = [];
        $scope.likecomment_notification_count = 0;
        $scope.associate_notification_count = 0;
        $scope.totalPages = 0;
        $scope.currentPage = 1;
        $scope.range = [];
	$scope.getHeaderNotifications = function(){
			$http.get($scope.baseurl + '/notification/get_header_notifications')
					.success(function(data) {
						$scope.associateNotification = data.associateNotification;
                        $scope.likeCommentNotification = data.likeCommentNotification;
                        $scope.messageNotification = data.messageNotification;
                        $scope.likecomment_notification_count = data.likecomment_notification_count;
                        $scope.associate_notification_count = data.associate_notification_count;
					});
	};
	
	$scope.getAllNotifications = function(pageNumber){
                        if(pageNumber===undefined){
                            pageNumber = '1';
                          }
			$http.get($scope.baseurl + '/notification/get_all_notifications/'+pageNumber)
					.success(function(response) {
						$scope.notifications = response.data;
                                                $scope.totalPages   = response.last_page;
                                                $scope.currentPage  = response.current_page;
                                                var pages = [];
                                                for(var i=1;i<=response.last_page;i++) {          
                                                    pages.push(i);
                                                }
                                                $scope.range = pages; 
			});
	};
	
	$scope.removeNotification = function($id, $index){
			$http.get($scope.baseurl + '/notification/remove_notification/' + $id)
					.success(function(data) {
						$scope.notifications[$index] = null;
                        
					});
	}
	
	$scope.allseen = function(){
			if($scope.allSeenBusy === true) return;
			$scope.allSeenBusy = true;
			$http.get($scope.baseurl + '/notification/all_seen')
					.success(function(data) {
						$scope.likeCommentNotification = null;
                                                $scope.allSeenBusy = false;
					});
	}
        
       $scope.accept_associate_header = function($id){
            var associate = {'id':$id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/associate/accept_request',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(associate)
            })
            .success(function(data) {
                $scope.getHeaderNotifications();
            })
            .error(function(data){
			console.log(data);
            })
	  }; 
	   
	   $scope.ignore_associate_request_header = function($id){
            var associate = {'id':$id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/associate/ignore_request',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(associate)
            })
            .success(function(data) {
                $scope.getHeaderNotifications();
            })
            .error(function(data){
			console.log(data);
            })
	}; 
}]);


app.controller('helpController', ['$scope', '$http','$location','$parse', function($scope, $http, $location, $parse) {
        $scope.helpData = {};
        $scope.title = "";
        $scope.getHelp = function(){
                    $http.get($scope.baseurl + '/home/get_help')
					.success(function(data) {
						$scope.helpData = data;
                                                $scope.helpData.faqs.title = "All";
					});
        };
        
        $scope.get_category_help = function($category,$title){
                    $http.get($scope.baseurl + '/home/get_category_help/'+$category)
					.success(function(data) {
						$scope.helpData.faqs = data;
                                                $scope.title = "- "+ $title;
					});
        };
        
}]);
app.controller('albumsController', ['$scope', '$http','$location','$parse', function($scope, $http, $location, $parse) {
        $scope.albums = {};
        
        $scope.loadalbums = function(){
                    $http.get($scope.baseurl + '/album/get_albums')
					.success(function(data) {
						$scope.albums = data;
                    });
        };
        
        $scope.save_album = function($title){
					var album = {'title':$title};
					$http({
						method: 'POST',
						url: $scope.baseurl+ '/album/save',
						headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
						data: $.param(album)
					})
					.success(function(data) {
						$scope.albums.push(data);
						$scope.editable = "";
						console.log(data);
					})
					.error(function(data){
					console.log(data);
					})
        };
		
		$scope.delete_album = function($album_id, $index){
					var album = {'album_id':$album_id};
					$http({
						method: 'POST',
						url: $scope.baseurl+ '/album/delete',
						headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
						data: $.param(album)
					})
					.success(function(data) {
						console.log(data);
						$scope.loadalbums();
						
					})
					.error(function(data){
						console.log(data);
					})
        };
		
	$scope.loadalbumfiles = function($album_id){
					var album = {'id':$album_id};
					$http({
						method: 'POST',
						url: $scope.baseurl+ '/album/getalbum_details',
						headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
						data: $.param(album)
					})
					.success(function(data) {
						console.log(data);
						$scope.album = data.album;
                                                $scope.album_files = data.files;
						
					})
					.error(function(data){
						console.log(data);
					})
        };
        
        $scope.delete_album_file = function($album_id,$file_id){
					var album = {'album_id':$album_id,'file_id':$file_id};
					$http({
						method: 'POST',
						url: $scope.baseurl+ '/album/delete_file',
						headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
						data: $.param(album)
					})
					.success(function(data) {
						console.log(data);
						$scope.loadalbumfiles($album_id);
						
					})
					.error(function(data){
						console.log(data);
					})
        };
}]);

app.controller('menucountsController', ['$scope', '$http','$location','$parse', function($scope, $http, $location, $parse) {
        $scope.follower_count = 0;
        $scope.following_count = 0;
        $scope.associate_count = 0;
        $scope.message_count = 0;
        $scope.notification_count = 0;
        $scope.get_count = function(){
		$http.get($scope.baseurl + '/home/getdetails')
		.success(function(data) {
			$scope.follower_count = data.followers_count;
                        $scope.following_count = data.following_count;
                        $scope.associate_count = data.associate_count;
                        $scope.message_count = 0;
                        $scope.notification_count = 0;
		});
	   };
        
}]);
