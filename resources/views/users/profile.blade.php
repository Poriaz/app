@extends('layouts.usersafterlogin')

@section('content')

        
        
        
        <div class="profile my-profile" ng-controller="profileController" ng-init="loadprofiledata()">
          <div class="item-body">
            <div class="profile_detail">
              <h4>About Me <span class="edit-me" ng-click="editable = 'about_me'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</span></h4>
              <p ng-hide="editable == 'about_me'"><% myProfileData.about_me %></p>
			  <div ng-show="editable == 'about_me'">
					<form class="form-inline" ng-submit="updateAboutMe(myProfileData.about_me)">
						<textarea ng-model="myProfileData.about_me"></textarea>
						<span class="update_cancel">
						<button type="submit" class="btn btn-success">Update</button>
						<button type="button" class="btn btn-warning" ng-click="reloadAboutMe()">Cancel</button></span>
					</form>
			  </div>
              <h4>Basic Information <span class="edit-me" ng-click="editable = 'profile_details'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</span></h4>
              <div ng-hide="editable == 'profile_details'">
			  <p>Name <span><% myProfileData.name %></span></p>
              <p>Address<span><% myProfileData.address %></span></p>
              <p>Phone No.<span><% myProfileData.phone %></span></p>
              <p>Email<span><% myProfileData.email %></span></p>
              <p>Date of Birth<span><% myProfileData.dob | date:"medium" %></span></p>
              <p>Gender<span><% myProfileData.gender %></span></p>
              <p>Business Type<span><% myProfileData.business_type %></span></p>
              <p>Interests<span><% myProfileData.interested_in %></span></p>
			  </div>
			  <div ng-show="editable == 'profile_details'">
			  <form ng-submit="updateProfileDetails(myProfileData)">
			  <p>Name <span><input type="text" ng-model="myProfileData.name" class="profile_details_input"/></span></p>
              <p>Address<span><input type="text" ng-model="myProfileData.address" class="profile_details_input"/></span></p>
              <p>Phone No.<span><input type="text" ng-model="myProfileData.phone" class="profile_details_input"/></span></p>
              <p>Email<span><input type="text" ng-model="myProfileData.email" class="profile_details_input"/></span></p>
              <p>Date of Birth<span><input type="text" ng-model="myProfileData.dob" class="profile_details_input"/></span></p>
              <p>Gender
				  <span class="gender">
					  <select ng-options="gender for gender in gender" ng-model="myProfileData.gender"></select>
					  <i class="fa fa-angle-down" aria-hidden="true"></i>
				  </span>
			  </p>
              <p>Business Type<span><input type="text" ng-model="myProfileData.business_type" class="profile_details_input"/></span></p>
              <p>Interests<span><input type="text" ng-model="myProfileData.interested_in" class="profile_details_input"/></span></p>
			  <p><span class="update_cancel">
						<button type="submit" class="btn btn-success">Update</button>
						<button type="button" class="btn btn-warning" ng-click="reloadProfileData()">Cancel</button></span></p>
			  </form>
			  </div>
            </div>
          </div>
        </div>
        
      
	
	
@endsection