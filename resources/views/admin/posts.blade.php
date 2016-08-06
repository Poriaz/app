@extends('layouts.adminside')

@section('content')

<div class="container-fluid" ng-controller="postsController" ng-init="getPosts()">
                <div class="side-body">
                    <div class="page-title">
                        <span class="title">Posts</span>
                        <div class="description">Posts added by users in the system</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                               
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Location</th>
                                                <th>Created on</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr ng-repeat="post in posts ">
                                                <th scope="row"><% 10 *(currentPage-1)+$index+1 %></th>
                                                <td><% post.description %></td>
                                                <td><% post.category %></td>
                                                <td><% post.location %></td>
                                                <td><% post.created_at %></td>
                                                <td>  
                                                    <span ng-if="post.is_published == '1'" ><button role="button" class="btn btn-primary" ng-click="publishPost($index,post.post_id,0);">Unpublish </button></span>
                                                     <span ng-if="post.is_published == '0'"  ><button role="button" class="btn btn-primary" ng-click="publishPost($index,post.post_id,1);">Publish</button></span>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                     <ul class="pagination">
                                        <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPosts(1)">«</a></li>
                                        <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPosts(currentPage-1)">‹ Prev</a></li>
                                        <li ng-repeat="i in range" ng-class="{active : currentPage == i}">
                                            <a href="javascript:void(0)" ng-click="getPosts(i)"><% i%></a>
                                        </li>
                                        <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getPosts(currentPage+1)">Next ›</a></li>
                                        <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getPosts(totalPages)">»</a></li>
                                    </ul>
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
			
@endsection 