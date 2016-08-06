@extends('layouts.adminside')

@section('content')

<!-- Main Content -->
<div class="container-fluid" ng-controller="dashboardController" ng-init="getDashboardData()">
                <div class="side-body padding-top">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card red summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-inbox fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><% users_count %></div>
                                            <div class="sub-title">Users</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card yellow summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-comments fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><% posts_count %></div>
                                            <div class="sub-title">Posts</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card green summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-tags fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><% help_questions_count %></div>
                                            <div class="sub-title">Help Questions</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-share-alt fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><% categories_count %></div>
                                            <div class="sub-title">Categories</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row  no-margin-bottom">
                        <div class="col-sm-6 col-xs-12">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="card primary">
                                        <div class="card-jumbotron no-padding">
                                            <canvas id="jumbotron-line-chart" class="chart no-padding"></canvas>
                                        </div>
                                        <div class="card-body half-padding">
                                            <h4 class="float-left no-margin font-weight-300">Users Joined</h4>
                                            <h2 class="float-right no-margin font-weight-300"><% users_count %></h2>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="thumbnail no-margin-bottom">
                                        <img src="{{ URL::asset('public/admin/img/picjumbo.com_IMG_4566.jpg') }}" class="img-responsive">
                                        <div class="caption">
                                            <h3 id="thumbnail-label">Thumbnail label<a class="anchorjs-link" href="#thumbnail-label"><span class="anchorjs-icon"></span></a></h3>
                                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="thumbnail no-margin-bottom">
                                        <img src="{{ URL::asset('public/admin/img/picjumbo.com_IMG_3241.jpg') }}">
                                        <div class="caption">
                                            <h3 id="thumbnail-label">Thumbnail label<a class="anchorjs-link" href="#thumbnail-label"><span class="anchorjs-icon"></span></a></h3>
                                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                            <p><a href="#" class="btn btn-success" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="card primary">
                                        <div class="card-jumbotron no-padding">
                                            <canvas id="jumbotron-bar-chart" class="chart no-padding"></canvas>
                                        </div>
                                        <div class="card-body half-padding">
                                            <h4 class="float-left no-margin font-weight-300">Users</h4>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="card primary">
                                        <div class="card-jumbotron no-padding">
                                            <canvas id="jumbotron-line-2-chart" class="chart no-padding"></canvas>
                                        </div>
                                        <div class="card-body half-padding">
                                            <h4 class="float-left no-margin font-weight-300">Website Visits</h4>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-success">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title"><i class="fa fa-comments-o"></i> Contact Messages</div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                                <div class="card-body no-padding">
                                    <ul class="message-list">
                                        
                                        <a href="#" ng-repeat="message in messgaesall">
                                            <li>
                                                <img class="profile-img pull-left" ng-if="message.owner.profile_pic !== '' && message.owner.profile_pic !== ' '" ng-src="<% baseurl + '/public/uploads/profile_pic/' + message.owner.profile_pic %>" alt="profile-image" height="50px" width="50px">
                                                
                                                <img class="profile-img pull-left" ng-if="message.owner.profile_pic === '' || message.owner.profile_pic === ' '" ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image" height="50px" width="50px">
                                                    
                                               
                                                
                                                <div class="message-block">
                                                    <div><span class="username"><% message.owner.name %></span> <span class="message-datetime"><% message.created_at %></span>
                                                    </div>
                                                    <div class="message"><% message.message %></div>
                                                </div>
                                            </li>
                                        </a>
                                       
                                        
                                        
                                        <a href="{{ url('admin/user_messages') }}" id="message-load-more">
                                            <li class="text-center load-more">
                                                <i class="fa fa-refresh"></i> See all..
                                            </li>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



@endsection 