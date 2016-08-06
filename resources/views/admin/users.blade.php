@extends('layouts.adminside')

@section('content')

<div class="container-fluid" ng-controller="usersController" ng-init="getUsers()">
                <div class="side-body">
                    <div class="page-title">
                        <span class="title">Users</span>
                        <div class="description">Users in the system</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                                
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Created On</th>
                                                <th>Deny Access</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr ng-repeat="user in users">
                                                <th scope="row"><% 10 *(currentPage-1)+$index+1 %></th>
                                                <td><% user.name %></td>
                                                <td><% user.email %></td>
                                                <td><% user.address %></td>
                                                 <td><% user.created_at %></td>
                                                 <td>
                                                     <span ng-if="user.allowed_access == '1'" ><button role="button" class="btn btn-primary" ng-click="allowAccess($index,user.id,0);">Revoke Access </button></span>
                                                     <span ng-if="user.allowed_access == '0'"  ><button role="button" class="btn btn-primary" ng-click="allowAccess($index,user.id,1);">Allow Access</button></span>
                                                 </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    <ul class="pagination">
                                        <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getUsers(1)">«</a></li>
                                        <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getUsers(currentPage-1)">‹ Prev</a></li>
                                        <li ng-repeat="i in range" ng-class="{active : currentPage == i}">
                                            <a href="javascript:void(0)" ng-click="getUsers(i)"><% i%></a>
                                        </li>
                                        <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getUsers(currentPage+1)">Next ›</a></li>
                                        <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getUsers(totalPages)">»</a></li>
                                    </ul>
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
			
@endsection 