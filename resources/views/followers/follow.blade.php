@extends('layouts.usersafterlogin')

@section('content')
        
 
        
        <div class="profile associates"  ng-controller="followerController" ng-init="loadsuggestions()">
          <div class="item-body">
            <div class="profile_noti">
              <div class="friends">
                  <ul role="main" class="item-list" id="members-list">
                     
                     <li ng-repeat="singleuser in followSuggestions" ng-init="$userIndex = $index">
                      <div class="item-avatar" ng-if="singleuser.profile_pic !== '' && singleuser.profile_pic !== ' '"> 
                        <a href="#">
                            <img width="70" height="70" alt="Profile picture of BuddyBoss" class="avatar user-2-avatar avatar-70 photo" src="<% baseurl + '/public/uploads/profile_pic/' + singleuser.profile_pic %>">
                        </a> 
                    </div>
                      <div class="item-avatar" ng-if="singleuser.profile_pic === '' || singleuser.profile_pic === ' '"> 
                        <a href="#">
                            <img width="70" height="70" alt="Profile picture of BuddyBoss" class="avatar user-2-avatar avatar-70 photo" src="{{ URL::asset('public/assets/images/profile-image.png') }}">
                        </a> 
                    </div>
                    <div class="item">
                      <div class="item-title"> <a href="#"><% singleuser.name %></a> </div>
                      <div class="item-meta">
                        <div class="activity"> <% singleuser.business_type %> </div>
                       <span>active <% singleuser.last_login | timeago  %></span> </div>
                    </div>
                    <div class="action">
                      <div class="action-wrap">
                        
                          
                          <div class="generic-button friendship-button is_friend" ng-if="singleuser.mefollowing.id"> 
                            <a class="friendship-button is_friend remove" rel="remove" href="#" ng-click="unfollow($userIndex,singleuser.id,'follow');">Unfollow</a> 
			  </div>
			 <div class="generic-button friendship-button is_friend" ng-if="!singleuser.mefollowing.id"> 
                            <a class="friendship-button is_friend remove" rel="remove" href="#" ng-click="follow($userIndex,singleuser.id);">Follow</a> 
			  </div>			
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