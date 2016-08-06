@extends('layouts.usersafterlogin')

@section('content')
<div class="profile associates" ng-controller="associatesController" ng-init="loadassociates();">
          <div class="item-body">
            <div class="profile_noti">
              <div class="friends">
                <ul role="main" class="item-list" id="members-list">
		 <li ng-if="Associates.length < 1"> You don't have any associates</li>  	
                  <li ng-repeat="associate in Associates">
                    <div class="item-avatar" ng-if="associate.request_from.profile_pic !== '' && associate.request_from.profile_pic !== ' '"> 
                        <a href="#">
                            <img width="70" height="70" alt="Profile picture of BuddyBoss" class="avatar user-2-avatar avatar-70 photo" src="<% baseurl + '/public/uploads/profile_pic/' + associate.request_from.profile_pic %>">
                        </a> 
                    </div>
                      <div class="item-avatar" ng-if="associate.request_from.profile_pic === '' || associate.request_from.profile_pic === ' '"> 
                        <a href="#">
                            <img width="70" height="70" alt="Profile picture of BuddyBoss" class="avatar user-2-avatar avatar-70 photo" src="{{ URL::asset('public/assets/images/profile-image.png') }}">
                        </a> 
                    </div>
                    <div class="item">
                      <div class="item-title"> <a href="#"><% associate.request_from.name %></a> </div>
                     <div class="item-meta">
                        <div class="activity"> <% associate.request_from.business_type %> </div>
                       <span>active <% associate.request_from.last_login | timeago  %></span> </div>
                    </div>
                    <div class="action">
                      <div class="action-wrap">
                        <div id="friendship-button-2" class="generic-button friendship-button is_friend"> <a class="friendship-button is_friend remove" rel="remove" id="friend-2" title="Cancel Friendship" href="#" ng-click="drop_associate_from_accociates_page(associate.id)">Remove Associate</a> </div>
                        
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