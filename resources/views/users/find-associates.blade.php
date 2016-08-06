@extends('layouts.usersafterlogin')

@section('content')
        
 
        
        <div class="profile associates"  ng-controller="associatesController" ng-init="loadsuggestions()">
          <div class="item-body">
            <div class="profile_noti">
              <div class="friends">
                  <ul role="main" class="item-list" id="members-list">
                     
                     <li ng-repeat="singleuser in mySuggestions">
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
                        <div class="generic-button friendship-button is_friend" ng-if="singleuser.addedbyme === null && singleuser.addedme === null"> 
                            <a class="friendship-button is_friend remove" rel="remove" href="#" ng-click="add_associate($index, singleuser.id)">Add Associate</a> 
                        </div>
                        <div class="generic-button friendship-button is_friend" ng-if="singleuser.addedbyme.status == '0' && singleuser.addedbyme.request_from == theUser.id"> 
                            <a class="friendship-button is_friend remove" rel="remove" href="#" ng-click="drop_associate_request($index, singleuser.addedbyme.id)">Drop Request</a> 
                        </div>
                          <div class="generic-button friendship-button is_friend" ng-if="singleuser.addedme.request_to  == theUser.id && singleuser.addedme.status == '0'"> 
                            <a class="friendship-button is_friend remove" rel="remove" href="#" ng-click="accept_associate($index, singleuser.addedme.id)">Accept Request</a> 
                            <a class="friendship-button is_friend remove" rel="remove" href="#" ng-click="ignore_associate_request($index, singleuser.addedme.id)">Ignore</a>
                        </div>
                           <div class="generic-button friendship-button is_friend" ng-if="singleuser.addedbyme.status== '1'"> 
                            <a class="friendship-button is_friend remove" rel="remove" href="#" ng-click="drop_associate($index, singleuser.addedbyme.id, 'byme')">Remove Associate</a> 
                        </div>
                          <div class="generic-button friendship-button is_friend" ng-if="singleuser.addedme.status== '1'"> 
                            <a class="friendship-button is_friend remove" rel="remove" href="#" ng-click="drop_associate($index, singleuser.addedme.id, 'me')">Remove Associate</a> 
                        </div>
                           <div class="generic-button friendship-button is_friend" ng-if="singleuser.addedbyme.status == '2'"> 
                            <a class="friendship-button is_friend remove" rel="remove" href="#" ng-click="add_associate_again($index, singleuser.id)">Request Again</a> 
                        </div>
                          <div class="generic-button friendship-button is_friend" ng-if="singleuser.addedme.status == '2'"> 
                            <a class="friendship-button is_friend remove" rel="remove" href="#">Request Ignored </a> 
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