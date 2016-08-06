<!DOCTYPE html>
<html lang="en">
<head>
<script>
    <?php if(Auth::user()){ ?>
    window.user = <?php echo Auth::user(); ?> 
    <?php } else { ?>
    window.user =  {"id":0,"name":"Hi Guest","email":"","created_at":"","updated_at":"","address":"","phone":"","gender":"","dob":"","business_type":"","interested_in":"","about_me":"","profession":"","profile_pic":"","wall_pic":"","last_login":"","is_active":1,"is_admin":0,"allowed_access":1} 
    <?php } ?>
    var map;
</script>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="../../favicon.ico">
<title>Business Development</title>

<!-- Bootstrap core CSS -->
<!-- Custom styles for this template -->
<!--link href="{{ URL::asset('public/assets/css/navbar-fixed-top.css') }}" rel="stylesheet"-->
<link href="{{ URL::asset('public/assets/css/style.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/assets/css/font.css') }}" rel="stylesheet">
<!--ng-dialog-->
    <link rel="stylesheet" href="{{ URL::asset('public/assets/ng-dialog/css/ngDialog.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/assets/ng-dialog/css/ngDialog-theme-default.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/assets/ng-dialog/css/ngDialog-theme-plain.csscss/font.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/assets/ng-dialog/css/ngDialog-custom-width.css') }}">
<!--ng-dialog-->
<link rel="stylesheet" href="{{ URL::asset('//maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css') }}">
<link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.css' type='text/css' media='all' />

<script src="{{ URL::asset('//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js') }}"></script> 
<script src="https://code.angularjs.org/1.4.2/angular.min.js" type="text/javascript"></script>
    <script src="https://flowjs.github.io/ng-flow/bower_components/flow.js/dist/flow.js"></script>
    <script src="https://flowjs.github.io/ng-flow/bower_components/fusty-flow.js/src/fusty-flow.js"></script>
    <script src="https://flowjs.github.io/ng-flow/bower_components/fusty-flow.js/src/fusty-flow-factory.js"></script>
    <script src="https://flowjs.github.io/ng-flow/bower_components/ng-flow/dist/ng-flow.js"></script>
     <script src="{{ URL::asset('public/assets/angular_modules/commentService.js') }}"></script>
     <script src="{{ URL::asset('public/assets/angular_modules/timeago.js') }}"></script>
<script src="{{ URL::asset('public/assets/angular_modules/ng-infinite-scroll.js') }}"></script>
     <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-animate.min.js"></script>
    <script type='text/javascript' src='//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.js'></script>
     <script src="{{ URL::asset('public/assets/ng-dialog/js/ngDialog.js') }}"></script>
	 <script src="https://code.angularjs.org/1.4.2/angular-sanitize.min.js"></script>
	  <script src="{{ URL::asset('public/assets/angular-emoji-filter-master/dist/emoji.min.js') }}"></script>  
          <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-resource.min.js"></script> 
    <script src="{{ URL::asset('public/assets/js/app.js') }}"></script>
    <script src="http://www.justgoscha.com/allmighty-autocomplete/script/autocomplete.js" type="text/javascript"></script>
   <script src="https://code.angularjs.org/1.4.2/angular-sanitize.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('public/assets/tags_plugin/ng-tags-input.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ URL::asset('public/assets/angular-emoji-filter-master/dist/emoji.min.css') }}">
  
</head>
@if (Request::path() == 'home' || Route::getCurrentRoute()->getPath() == 'album_details/{id}' )
	<body ng-app="app" flow-init
      flow-file-added="!!{png:1,gif:1,jpg:1,jpeg:1}[$file.getExtension()]"
      flow-files-submitted="$flow.upload()">
@else 
	<body ng-app="app">
@endif

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="main-header">
      <div class="row">
        <div class="col-md-3">
            <div class="logo"> <a href="{{ url('/home') }}"><img ng-src="{{ URL::asset('public/assets/images/logo.png') }}" alt="logo" class="img-responsive"></a> </div>
        </div>
        <div class="col-md-5">
          <div class="search">
            <input id="search" type="text" placeholder="Search here" class="search-field">
            <span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span> </div>
        </div>
        <div class="col-md-4">
          <div class="header-points" ng-controller="headerNotificationController" ng-init="getHeaderNotifications()">
            <ul>
              <li class="dot"><a href="{{ url('/home') }}"><span class="dot1"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
              <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i><span class="noti"></span></a>
                <ul class="sub-menu"  ng-if="theUser.id != '0'">
                  
                    <li>
                        No unread messages, will work on it soon
                    </li>
                 
                </ul>
              </li>
              <li><a href="{{ url('/notifications') }}"><i class="fa fa-bell" aria-hidden="true"></i>
					<span class="noti" ng-if="likecomment_notification_count != ''"><% likecomment_notification_count %></span>
					</a>
                <ul class="sub-menu"  ng-if="theUser.id != '0'">
					<li ng-if="likecomment_notification_count == ''">No unread notifications</li>
                    <li ng-repeat="noti in likeCommentNotification">
                        <a href="{{ url('/postdetails/<% noti.notification_post.post_id %>') }}"> 
							<div class="message-profile" ng-if="noti.notification_from.profile_pic !== '' && noti.notification_from.profile_pic !== ' '">
                              <img ng-src="<% baseurl + '/public/uploads/profile_pic/' + noti.notification_from.profile_pic %>"  alt="profile-image" />
                            </div>
                            <div class="message-profile" ng-if="noti.notification_from.profile_pic === '' || noti.notification_from.profile_pic === ' '">
                                  <img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image">
                             </div>
						<div class="message-text">
							<h4 class="small-pname"><% noti.notification_from.name %></h4>
							<span ng-if="noti.activity_type === 'like'"> liked your post -  "<% noti.notification_post.description | cut:true:30:' ...' %>"</span>
							<span ng-if="noti.activity_type === 'comment'"> commented on your post -  "<% noti.notification_post.description | cut:true:30:' ...' %>"</span>
							<p class="time"><% noti.created_at | timeago %></p>
						</div>
					
						</a>
                    </li>
					<a class="see_all_notifications" href="#" ng-click="allseen();">Mark all read</a>
					<a class="see_all_notifications see_all_notifications2" href="{{ url('/notifications') }}">See All</a>
                </ul>
              </li>
			  
			   <li><a href="{{ url('/notifications') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>
				<span class="noti" ng-if="associate_notification_count != ''"><% associate_notification_count %></span>
				</a>
                <ul class="sub-menu"  ng-if="theUser.id != '0'">
                    <li ng-if="associateNotification == ''">No pending requests </li>
                    <li  ng-repeat="request in associateNotification">
                      
							<div class="message-profile" ng-if="request.request_from.profile_pic !== '' && request.request_from.profile_pic !== ' '">
								<img ng-src="<% baseurl + '/public/uploads/profile_pic/' + request.request_from.profile_pic %>"  alt="profile-image" />
							</div>
							<div class="message-profile" ng-if="request.request_from.profile_pic === '' || request.request_from.profile_pic === ' '">
								<img ng-src="{{ URL::asset('public/assets/images/profile1.jpg') }}" alt="profile pic">
							</div>
							<div class="message-text">
								<h4 class="small-pname"><% request.request_from.name %></h4>
								<p class="time"><% request.created_at | timeago %></span>
								<div class="associates-top"> <button ng-click="accept_associate_header(request.id)">Add Associates</button><button ng-click="ignore_associate_request_header(request.id)">Ignore</button></div>
						    
								
							</div>
						
						
                    </li>
                 
                </ul>
              </li>
			  
			  
             
                 
              <li class="logout"><a title="logout" href="#"><i aria-hidden="true" class="fa fa-sign-out"></i></a>
              <ul class="sub-menu">
              	<li><a href="{{ url('/help') }}">Help</a></li>
		<li ng-if="theUser.id != '0'"><a href="{{ url('/settings') }}">Settings</a></li>
		<li ng-if="theUser.id != '0'"><a href="{{ url('/privacy') }}">Privacy</a></li>
		<li ng-if="theUser.id != '0'"><a href="{{ url('/profile') }}">My Profile</a></li>
                <li ng-if="theUser.id != '0'"><a href="{{ url('auth/logout') }}">Log out</a></li>
             </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>