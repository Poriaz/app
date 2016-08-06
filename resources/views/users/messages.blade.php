@extends('layouts.usersafterlogin')

@section('content')
        
        <div class="profile messages">
          <div class="item-body">
            <div class="profile_noti">
              <div class="actions"><span class="apply compose"><a href="#">Compose</a></span><span class="bulk">
                <select>
                  <option>Bulk Actions</option>
                  <option>Mark Read</option>
                  <option>Un Read</option>
                </select>
                </span><span class="apply"><a href="#">Apply</a></span></div>
              <div class="row">
                <div class="col-md-2 notice">
                  <li class="active"><a href="#">Inbox</a></li>
                  <li><a href="#">Sent</a></li>
                  <li><a href="#">Notice</a></li>
                  <li><a href="#">Froward</a></li>
                </div>
                <div class="col-md-10 notice-right">
                  <h4> <span class="noti_check">
                    <input type="checkbox" value="notification" name="Notification" id="check" class="check">
                    </span><span class="noti_profile">From</span> <span class="noti_detail"><a href="#">Subject</a></span> <span class="noti_action"><a href="#">Actions</a></span> </h4>
                  <ul>
                    <li> <span class="noti_check">
                      <input type="checkbox" value="notification" name="Notification" id="check" class="check">
                      </span> <span class="noti_profile"> <a href="#"><img alt="profile" src="{{ URL::asset('public/assets/images/profile-image.png') }}"> <i>From: Jon Greene (3)</i> <i>January 10, 2016 at 10:17 pm</i></a></span> <span class="noti_detail"><a href="#">Jon Greene sent you a new private message Jon Greene sent you a new private message Jon Greene sent you a new private message </a></span> <span class="noti_action"><a href="#">Read </a> | <a href="#"> Delete</a></span> </li>
                    <li> <span class="noti_check">
                      <input type="checkbox" value="notification" name="Notification" id="check" class="check">
                      </span> <span class="noti_profile"> <a href="#"><img alt="profile" src="{{ URL::asset('public/assets/images/profile-image.png') }}"> <i>From: Jon Greene (3)</i> <i>January 10, 2016 at 10:17 pm</i></a></span> <span class="noti_detail"><a href="#">Jon Greene sent you a new private message Jon Greene sent you a new private message</a></span> <span class="noti_action"><a href="#">Read </a> | <a href="#"> Delete</a></span> </li>
                    <li> <span class="noti_check">
                      <input type="checkbox" value="notification" name="Notification" id="check" class="check">
                      </span> <span class="noti_profile"> <a href="#"><img alt="profile" src="{{ URL::asset('public/assets/images/profile-image.png') }}"> <i>From: Jon Greene (3)</i> <i>January 10, 2016 at 10:17 pm</i></a></span> <span class="noti_detail"><a href="#">Jon Greene sent you a new private message</a></span> <span class="noti_action"><a href="#">Read </a> | <a href="#"> Delete</a></span> </li>
                    <li> <span class="noti_check">
                      <input type="checkbox" value="notification" name="Notification" id="check" class="check">
                      </span> <span class="noti_profile"> <a href="#"><img alt="profile" src="{{ URL::asset('public/assets/images/profile-image.png') }}"> <i>From: Jon Greene (3)</i> <i>January 10, 2016 at 10:17 pm</i></a></span> <span class="noti_detail"><a href="#">JJon Greene sent you a new private message Jon Greene sent you a new private message Jon Greene sent you a new private message on Greene sent you a new private message</a></span> <span class="noti_action"><a href="#">Read </a> | <a href="#"> Delete</a></span> </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
     
		
	
@endsection