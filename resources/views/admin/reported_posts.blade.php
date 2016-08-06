@extends('layouts.adminside')

@section('content')

<div class="container-fluid" ng-controller="reportedPostsController" ng-init="getReportedPosts()">
                <div class="side-body">
                    <div class="page-title">
                        <span class="title">Reposted Posts</span>
                        <div class="description">Users have mentioned below posts as inappropriate</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                                
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Post Title</th>
                                                <th>Message</th>
                                                <th>Created At</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="reportedpost in reportedPosts">
                                                <th scope="row"><% 10 *(currentPage-1)+$index+1 %></th>
                                                <td><% reportedpost.post.description %></td>
                                                <td><% reportedpost.message %></td>
                                                <td><% reportedpost.created_at %></td>
                                                <td>
                                                    <span ng-if="reportedpost.post.is_published == '1'" ><button role="button" class="btn btn-primary" ng-click="publishPost($index,reportedpost.post.post_id,0);">Unpublish </button></span>
                                                     <span ng-if="reportedpost.post.is_published == '0'"  ><button role="button" class="btn btn-primary" ng-click="publishPost($index,reportedpost.post.post_id,1);">Publish</button></span>
                                                    <a role="button" class="btn btn-primary" target="_blank" href="{{ url('/postdetails/<% reportedpost.post.post_id %>')}}">Visit Post</a>
                                                    <button role="button" class="btn btn-primary" ng-click="deleteReport(reportedpost.id, $index);">Delete</button>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    <ul class="pagination">
                                        <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getReportedPosts(1)">«</a></li>
                                        <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getReportedPosts(currentPage-1)">‹ Prev</a></li>
                                        <li ng-repeat="i in range" ng-class="{active : currentPage == i}">
                                            <a href="javascript:void(0)" ng-click="getReportedPosts(i)"><% i%></a>
                                        </li>
                                        <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getReportedPosts(currentPage+1)">Next ›</a></li>
                                        <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getReportedPosts(totalPages)">»</a></li>
                                    </ul>
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
			
@endsection 