<!DOCTYPE html>
<html>

<head>
    <title>Bizhub - Admin Control</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/admin/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/admin/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/admin/css/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/admin/css/checkbox3.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/admin/css/dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/admin/css/dataTables.bootstrap.css') }}">
   <!-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/admin/css/select2.min.css') }}">-->
    <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.css' type='text/css' media='all' />
    <!-- CSS App -->
    <script>
    window.user = <?php echo Auth::user(); ?> 
    </script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/admin/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/admin/css/themes/flat-blue.css') }}">
    <script src="https://code.angularjs.org/1.4.2/angular.min.js" type="text/javascript"></script>
    <script src="{{ URL::asset('public/assets/angular_modules/ng-infinite-scroll.js') }}"></script>
     <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-animate.min.js"></script>
    <script type='text/javascript' src='//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-resource.min.js"></script> 
     <script src="{{ URL::asset('public/assets/js/admin.js') }}"></script>
     <script src="https://code.angularjs.org/1.4.2/angular-sanitize.min.js" type="text/javascript"></script>
</head>

<body class="flat-blue" ng-app="admin">
    <div class="app-container">
        <div class="row content-container">
            <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-expand-toggle">
                            <i class="fa fa-bars icon"></i>
                        </button>
                        <ol class="breadcrumb navbar-breadcrumb">
                            <li class="active">Dashboard</li>
                        </ol>
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-th icon"></i>
                        </button>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
                        
                        
                        
                        <li class="dropdown profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><% theUser.name %><span class="caret"></span></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="profile-img">
                                                <div class="profile-pic" ng-if="theUser.profile_pic !== '' && theUser.profile_pic !== ' '">
                                                        <img src="<% baseurl + '/public/uploads/profile_pic/' + theUser.profile_pic %>" alt="profile-pic" />
                                                </div>
                                                <div class="profile-pic" ng-if="theUser.profile_pic === '' || theUser.profile_pic === ' '">
                                                        <img src="{{ URL::asset('public/admin/img/picjumbo.com_HNCK4153_resize.jpg') }}" alt="profile-pic" />
                                                </div>
                                </li>
                                <li>
                                    <div class="profile-info">
                                        <h4 class="username"><% theUser.name %></h4>
                                        <p><% thsUser.email %></p>
                                        <div class="btn-group margin-bottom-2x" role="group">
                                            <a href="{{ url('admin/profile') }}" class="btn btn-default"><i class="fa fa-user"></i> Profile</a>
                                            <a href="{{ url('auth/logout') }}" class="btn btn-default"><i class="fa fa-sign-out"></i> Logout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="side-menu sidebar-inverse">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="side-menu-container">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">
                                <div class="icon fa fa-paper-plane"></div>
                                <div class="title">Bizhub</div>
                            </a>
                            <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                <i class="fa fa-times icon"></i>
                            </button>
                        </div>
                        <ul class="nav navbar-nav">
                           
                            <li class="{{ (Route::getCurrentRoute()->getPath() == 'admin/dashboard') ? 'active' : '' }}">
                                <a href="{{ url('admin/dashboard') }}">
                                    <span class="icon fa fa-tachometer"></span><span class="title">Dashboard</span>
                                </a>
                            </li>
			   <li class="{{ (Route::getCurrentRoute()->getPath() == 'admin/users') ? 'active' : '' }}">
                                <a href="{{ url('admin/users') }}">
                                    <span class="icon fa fa-user"></span><span class="title">Users</span>
                                </a>
                            </li>
                            <li class="{{ (Route::getCurrentRoute()->getPath() == 'admin/posts') ? 'active' : '' }}">
                                <a href="{{ url('admin/posts') }}">
                                    <span class="icon fa fa-pencil-square-o"></span><span class="title">Posts</span>
                                </a>
                            </li>
                            <li class="{{ (Route::getCurrentRoute()->getPath() == 'admin/category') ? 'active' : '' }}">
                                <a href="{{ url('admin/category') }}">
                                    <span class="icon fa fa-list"></span><span class="title">Post Categories</span>
                                </a>
                            </li>
                            <li class="{{ (Route::getCurrentRoute()->getPath() == 'admin/faq_categories') ? 'active' : '' }}">
                                <a href="{{ url('admin/faq_categories') }}">
                                    <span class="icon fa fa-gear"></span><span class="title">Help/Faqs Categories</span>
                                </a>
                            </li>
                            <li class="{{ (Route::getCurrentRoute()->getPath() == 'admin/faqs') ? 'active' : '' }}">
                                <a href="{{ url('admin/faqs') }}">
                                    <span class="icon fa fa-steam-square"></span><span class="title">Faqs</span>
                                </a>
                            </li>
                            
                            <li class="{{ (Route::getCurrentRoute()->getPath() == 'admin/reported_posts') ? 'active' : '' }}">
                                <a href="{{ url('admin/reported_posts') }}">
                                    <span class="icon fa fa-bug"></span><span class="title">Reported Posts</span>
                                </a>
                            </li>
                            <li class="{{ (Route::getCurrentRoute()->getPath() == 'admin/user_messages') ? 'active' : '' }}">
                                <a href="{{ url('admin/user_messages') }}">
                                    <span class="icon fa fa-archive"></span><span class="title">Contact Messages</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
            </div>