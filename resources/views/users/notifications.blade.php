@extends('layouts.usersafterlogin')

@section('content')
        
        
        
        <div class="profile notifications">
          <div class="item-body">
            <div class="profile_noti" ng-controller="headerNotificationController" ng-init="getAllNotifications()">
              
              <h4> <span class="noti_check">
                <input type="checkbox" value="notification" name="Notification" id="check" class="check">
                </span> <span class="noti_detail"><a href="#">Notification</a></span> <span class="noti_date">Updated On</span> <span class="noti_action"><a href="#">Actions</a></span> </h4>
              <ul>
                <li ng-repeat="notification in notifications"> 
				  <span class="noti_check">
                  <input type="checkbox" value="notification" name="Notification" id="check" class="check">
                  </span> 
				  <span class="noti_detail"><a href="{{ url('/postdetails/<% notification.notification_post.post_id %>') }}">
				  <span ng-if="notification.activity_type === 'like'"><% notification.notification_from.name %> liked your post </span>
				<span ng-if="notification.activity_type === 'comment'"><% notification.notification_from.name %> commented on your post </span></a></span> <span class="noti_date"><% notification.created_at | timeago%></span> <span class="noti_action"> <a href="#" ng-click="removeNotification(notification.id, $index)"> <i aria-hidden="true" class="fa fa-trash"></i></a>
				  </span> 
				</li>
                
              </ul>
                <ul class="pagination">
                    <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getAllNotifications(1)">«</a></li>
                    <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getAllNotifications(currentPage-1)">‹ Prev</a></li>
                    <li ng-repeat="i in range" ng-class="{active : currentPage == i}">
                        <a href="javascript:void(0)" ng-click="getAllNotifications(i)"><% i%></a>
                    </li>
                    <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getAllNotifications(currentPage+1)">Next ›</a></li>
                    <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getAllNotifications(totalPages)">»</a></li>
                </ul>
            </div>
          </div>
        </div>
        
        
        
		
	
@endsection