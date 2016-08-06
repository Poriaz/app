@extends('layouts.adminside')

@section('content')

<div class="container-fluid" ng-controller="contactMessagesController" ng-init="getContactMessages()">
                <div class="side-body">
                    <div class="page-title">
                        <span class="title">Contact Messages</span>
                        <div class="description">Messages from users</div>
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
                                                <th>Message</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="message in contactMessages">
                                                <th scope="row"><% 10 *(currentPage-1)+$index+1 %></th>
                                                <td><% message.owner.name %></td>
                                                <td><% message.owner.email %></td>
                                                <td><% message.message %></td>
                                                <td><a class="btn btn-primary" href="#" ng-click="deleteMessage(message.id,$index);">Delete</a></td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                     <ul class="pagination">
                                        <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getContactMessages(1)">«</a></li>
                                        <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getContactMessages(currentPage-1)">‹ Prev</a></li>
                                        <li ng-repeat="i in range" ng-class="{active : currentPage == i}">
                                            <a href="javascript:void(0)" ng-click="getContactMessages(i)"><% i%></a>
                                        </li>
                                        <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getContactMessages(currentPage+1)">Next ›</a></li>
                                        <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getContactMessages(totalPages)">»</a></li>
                                    </ul>
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
			
@endsection 