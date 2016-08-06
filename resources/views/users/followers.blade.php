@extends('layouts.usersafterlogin')

@section('content')
        
        
        
        
        
        <div class="profile followers" ng-controller="followerController" ng-init="loadfollowers()">
          <div class="item-body">
            <div class="profile_noti">
              <div class="friends">
                <ul role="main" class="item-list" id="members-list">
                   <li ng-if="followers.length < 1"> You don't have any followers</li>  
                  <li ng-repeat="singleuser in followers" ng-init="$userIndex = $index">
                    <div class="item-avatar" ng-if="singleuser.followers.profile_pic !== '' && singleuser.followers.profile_pic !== ' '"> 
                        <a href="#">
                            <img width="70" height="70" alt="Profile picture of BuddyBoss" class="avatar user-2-avatar avatar-70 photo" src="<% baseurl + '/public/uploads/profile_pic/' + singleuser.followers.profile_pic %>">
                        </a> 
                    </div>
                      <div class="item-avatar" ng-if="singleuser.followers.profile_pic === '' || singleuser.followers.profile_pic === ' '"> 
                        <a href="#">
                            <img width="70" height="70" alt="Profile picture of BuddyBoss" class="avatar user-2-avatar avatar-70 photo" src="{{ URL::asset('public/assets/images/profile-image.png') }}">
                        </a> 
                    </div>
                    <div class="item">
                      <div class="item-title"> <a href="#"><% singleuser.followers.name %></a> </div>
                     <div class="item-meta">
                        <div class="activity"> <% singleuser.followers.business_type %> </div>
                       <span>active <% singleuser.followers.last_login | timeago  %></span> </div>
                    </div>
                    <div class="action">
                      
                    </div>
                    <div class="clear"></div>
                  </li>
                  
                  
                  
                </ul>
              </div>
            </div>
          </div>
        </div>
        
      
		
	
@endsection