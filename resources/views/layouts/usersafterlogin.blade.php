@include('includes.header')

<div class="wrapper">

<section id="profile-cover"  ng-controller="wallController" ng-init="getdetails()"> 
<div class="ovelay"></div>
    <img ng-if="theUser.wall_pic !== '' && theUser.wall_pic !== ' '" id="cover-bg" ng-src="<% baseurl + '/public/uploads/wall_pic/' + theUser.wall_pic %>" alt="cover-photo" />
	<img ng-if="theUser.wall_pic === '' || theUser.wall_pic === ' '" id="cover-bg" ng-src="{{ URL::asset('public/assets/images/cover-photo.jpg') }}" alt="cover-photo" />
    <div class="container">
      <div class="row">
        <div class="profile-cover">
          <div class="update-cover">
            <div id="change-cover-photo" class="change-cover-photo"><input ng-if="theUser.id != '0'" type="file" style="cursor:pointer" onchange="angular.element(this).scope().onWallImageSelect(this.files,this.clientWidth,this.clientHeight)"><i class="fa fa-camera" aria-hidden="true"></i><span> Update Cover Photo</span></div>
            <div id="remove-cover" class="change-cover-photo"><a href="#"><i class="fa fa-times" aria-hidden="true"></i><span> Remove Cover Photo</span></a></div>
          </div>
          <div class="profile-pic-section">
            <div class="col-md-6">
              <div class="profile-pic" ng-if="theUser.profile_pic !== '' && theUser.profile_pic !== ' '">
                  <img src="<% baseurl + '/public/uploads/profile_pic/' + theUser.profile_pic %>" alt="profile-pic" />
                 <span class="profile_icon a" ng-if="theUser.id != '0'"><input type="file" onchange="angular.element(this).scope().onFileSelect(this.files)">
				 <i class="fa fa-camera" aria-hidden="true"></i></span>
                    
              </div>
              <div class="profile-pic" ng-if="theUser.profile_pic === '' || theUser.profile_pic === ' '">
                  <img src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-pic" />
                  <input ng-if="theUser.id != '0'"  type="file" onchange="angular.element(this).scope().onFileSelect(this.files)">
                    
              </div>
              <div class="profile-text">
                <h2><% theUser.name %></h2>
                <p>( <% theUser.business_type %> )</p>
              </div>
            </div>
            <div class="col-lg-6 pull-right">
              <div class="profile-follow">
                <h2><% following_count %></h2>
                <p>Following</p>
              </div>
              <div class="profile-follow">
                <h2><% follower_count %></h2>
                <p>Followers</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="profile-head">
<div class="container">



    <div class="row">
      <div class="col-md-3" ng-controller="associatesController" ng-init="getsidebarassociates()">
        <div class="profile">
          <h4>Associates</h4>
          <div class="associates1" ng-if="myAssociates.length < 1">
              <p>No Associates were found</p>
          </div>
          <div class="associates1" ng-repeat="associate in myAssociates">
            <div class="asso-profile">
                <span class="associate-img" ng-if="associate.request_from.profile_pic !== '' && associate.request_from.profile_pic !== ' '">
                        <img src="<% baseurl + '/public/uploads/profile_pic/' + associate.request_from.profile_pic %>" alt="profile-image">
                    </span>
                    <span class="associate-img" ng-if="associate.request_from.profile_pic === '' || associate.request_from.profile_pic === ' '">
                        <img src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image">
                    </span>
            </div>
            <div class="col-md-9">
              <h4 class="small-pname"><% associate.request_from.name %></h4>
              <p class="online" ng-if="associate.request_from.is_active === 1">
                  <span class="dot1"><i aria-hidden="true" class="fa fa-circle"></i></span> Online
              </p>
              <p class="online" ng-if="associate.request_from.is_active === 0">
                  <span class="dot1 dot2"><i aria-hidden="true" class="fa fa-circle"></i></span> Offline
              </p>
            </div>
          </div>
          
        </div>
      </div>
      <div class="col-md-9">
          <div class="profile-header" ng-controller="menucountsController" ng-init="get_count()">
          <ul>
            
            <li class="{{ (Route::getCurrentRoute()->getPath() == 'notifications') ? 'active' : '' }}"><a href="{{ url('notifications') }}">NOTIFICATIONS </a> <span class="count"><% notification_count %></span></li>
            <li class="{{ (Route::getCurrentRoute()->getPath() == 'messages') ? 'active' : '' }}"><a href="{{ url('messages') }}">MESSAGES </a> <span class="count"><% message_count %></span></li>
            <li class="{{ (Route::getCurrentRoute()->getPath() == 'associates') ? 'active' : '' }}"><a href="{{ url('associates') }}">ASSOCIATES </a> <span class="count"><% associate_count %></span></li>
            <li class="{{ (Route::getCurrentRoute()->getPath() == 'followers') ? 'active' : '' }}"><a href="{{ url('followers') }}">FOLLOWERS </a> <span class="count"><% following_count %></span></li>
             <li class="{{ (Route::getCurrentRoute()->getPath() == 'following') ? 'active' : '' }}"><a href="{{ url('following') }}">FOLLOWING </a><span class="count"><% follower_count %></span></li>
            
			<li class="add-more"><a href="#">
				<i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i>
				</a>
				</a>
				<ul class="sub-menu">
					<li class="{{ (Route::getCurrentRoute()->getPath() == 'profile') ? 'active' : '' }}"><a href="{{ url('profile') }}">PROFILE </a></li>
                                        <li class="{{ (Route::getCurrentRoute()->getPath() == 'find-associates') ? 'active' : '' }}"><a href="{{ url('find-associates') }}">FIND ASSOCIATES </a></li>
                                        <li class="{{ (Route::getCurrentRoute()->getPath() == 'follow') ? 'active' : '' }}"><a href="{{ url('follow') }}">FOLLOW USERS</a></li>
                                        <li class="{{ (Route::getCurrentRoute()->getPath() == 'albums') ? 'active' : '' }}"><a href="{{ url('albums') }}">AlBUMS </a></li>
                                        <li class="{{ (Route::getCurrentRoute()->getPath() == 'settings') ? 'active' : '' }}"><a href="{{ url('settings') }}">SETTINGS </a></li>
					
				</ul>
			</li>
          </ul>
        </div>
        
        @yield('content')
       
	   
	   </div>
      </div>
    </div>
	</section>
	
	</div>
 
 
 

<script src="{{ URL::asset('public/assets/js/bootstrap.min.js') }}"></script> 
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js'></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />
<script type='text/javascript' src="http://xoxco.com/examples/jquery.tagsinput.js"></script>
<script>
$('input:file').each(function(){
    var $input = $(this);
    $input.before($('<div>').height($input.height()).width($input.width()).css(
        {
            cursor: 'pointer',
            position: 'absolute',
            zIndex: $input.css('z-index')
        }).click(function(){
            $(this).hide();
            $input.click();
            $(this).show();
        }));
});
</script>
</body>
</html>
