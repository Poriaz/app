@extends('layouts.usersafterlogin')

@section('content')
        
        
        
        
        <div class="profile followers" ng-controller="followerController" ng-init="loadfollowing()">
          <div class="item-body">
            <div class="profile_noti">
              <div class="friends">
                <ul role="main" class="item-list" id="members-list">
                    <li ng-if="following.length < 1"> You are not following anyone till now</li> 
                  <li ng-repeat="singleuser in following" ng-init="$userIndex = $index">
                    <div class="item-avatar" ng-if="singleuser.following.profile_pic !== '' && singleuser.following.profile_pic !== ' '"> 
                        <a href="#">
                            <img width="70" height="70" alt="Profile picture of BuddyBoss" class="avatar user-2-avatar avatar-70 photo" src="<% baseurl + '/public/uploads/profile_pic/' + singleuser.following.profile_pic %>">
                        </a> 
                    </div>
                      <div class="item-avatar" ng-if="singleuser.following.profile_pic === '' || singleuser.following.profile_pic === ' '"> 
                        <a href="#">
                            <img width="70" height="70" alt="Profile picture of BuddyBoss" class="avatar user-2-avatar avatar-70 photo" src="{{ URL::asset('public/assets/images/profile-image.png') }}">
                        </a> 
                    </div>
                      
                    <div class="item">
                      <div class="item-title"> <a href="#"><% singleuser.following.name %></a> </div>
                      <div class="item-meta">
                        <div class="activity"> <% singleuser.following.business_type %> </div>
                       <span>active <% singleuser.following.last_login | timeago  %></span> </div>
                    </div>
                    <div class="action">
                      <div class="action-wrap">
                        <div id="follow-button-2" class="generic-button follow-button following"> <a class="unfollow" id="unfollow-2" href="#" ng-click="unfollow($userIndex,singleuser.id,'followerspage');">Unfollow</a> </div>
                      </div>
                    </div>
                    <div class="clear"></div>
                  </li>
                   
                  
                  
                </ul>
              </div>
            </div>
          </div>
        </div>
        
       
	
@endsection