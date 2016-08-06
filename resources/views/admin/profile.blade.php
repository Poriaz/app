@extends('layouts.adminside')

@section('content')
<style>
    .profile-pic{
        height:150px;
    }
    .profile-pic >img{
        height:100%;
    }
</style>
<div class="container-fluid" ng-controller="usersController">
                <div class="side-body">
                    <div class="page-title">
                        <span class="title">My Details</span>
                        <div class="description"><a href="#" ng-click="editable = 'profile'">Edit</a></div>
                    </div>
                    <div class="row">
                        
                        <div class="col-xs-12" ng-hide="editable == 'profile'">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div>
                                        <ul class="list-group">
                                            <li class="list-group-item">Name - <% theUser.name %></li>
                                            <li class="list-group-item">Email - <% theUser.email %></li>
                                           
                                            
                                        </ul>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="col-xs-12" ng-show="editable == 'profile'">
                            <div class="card">
                                
                                <div class="card-body">
                                    <form class="form-horizontal" enctype="multipart/form-data" ng-submit="updateProfile(theUser)">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="inputName">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" placeholder="Name" id="inputName" class="form-control" ng-model="theUser.name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="inputEmail">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" placeholder="Email" id="inputEmail" class="form-control" ng-model="theUser.email">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button class="btn btn-default" type="submit">Update</button>
                                                <a class="btn btn-default" ng-click="editable = 'profile1'">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                </div>
                <div class="side-body">
                    <div class="page-title">
                        <span class="title">Profile Picture</span>
                        <div class="description"></div>
                    </div>
                    <div class="row">
                        
                        <div class="col-xs-12">
                            <div class="card">
                                
                                <div class="card-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="inputPicture">Profile Picture</label>
                                            <div class="col-sm-10">
                                                <input type="file" onchange="angular.element(this).scope().onFileSelect(this.files)">
                                                <div class="profile-pic" ng-if="theUser.profile_pic !== '' && theUser.profile_pic !== ' '">
                                                        <img src="<% baseurl + '/public/uploads/profile_pic/' + theUser.profile_pic %>" alt="profile-pic" />
                                                </div>
                                                <div class="profile-pic" ng-if="theUser.profile_pic === '' || theUser.profile_pic === ' '">
                                                        <img src="{{ URL::asset('public/admin/img/picjumbo.com_HNCK4153_resize.jpg') }}" alt="profile-pic" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
    
                <div class="side-body">
                    <div class="page-title">
                        <span class="title">Password</span>
                        <div class="description"><a href="#" ng-click="editable = 'password'">Change Password</a></div>
                    </div>
                    <div class="row">
                        
                        <div class="col-xs-12" ng-hide="editable == 'password'">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div>
                                        <ul class="list-group">
                                            <li class="list-group-item">Password - *******</li>
                                            
                                           
                                           
                                            
                                        </ul>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-xs-12" ng-show="editable == 'password'">
                            <div class="card">
                                
                                <div class="card-body">
                                    <form class="form-horizontal" enctype="multipart/form-data" ng-submit="updatePassword(pwd)">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="inputName">Old Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" placeholder="Old Password" id="inputName" class="form-control" ng-model="pwd.old_password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="inputName">New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" placeholder="New Password" id="inputName" class="form-control" ng-model="pwd.password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="inputEmail">Confirm New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" placeholder="New Password Again" id="inputEmail" class="form-control" ng-model="pwd.confirm_password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10" style="color:red;"><% passworderror %></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button class="btn btn-default" type="submit">Update</button>
                                                <a class="btn btn-default" ng-click="editable = 'profile1'">Cancel</a>
                                            </div>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                </div>
            </div>
			
@endsection 