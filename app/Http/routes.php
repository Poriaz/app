<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::post('/home', 'HomeController@index');
Route::get('/home/getdetails','HomeController@getdetails');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('/uploadwallstatusfiles', 'HomeController@uploadwallstatusfiles');
Route::post('/uploadwallstatusfiles', 'HomeController@uploadwallstatusfiles');
Route::post('comment/store', 'CommentController@store');
Route::get('comment/store', 'CommentController@store');
Route::post('comment/delete/{commentid}', 'CommentController@delete');
Route::post('comment/update', 'CommentController@update');
Route::get('comment/get/{postid}', 'CommentController@get');
Route::post('like/store', 'LikeController@store');
Route::get('like/getcount/{id}', 'LikeController@getcount');
Route::get('home/getfeed/{pageid?}', 'HomeController@getfeed');
Route::get('home/getnewfeed/{lastpostid}', 'HomeController@getnewfeed');
Route::get('home/userwallgetfeed/{userid}/{pageid?}', 'HomeController@userwallgetfeed');
Route::get('home/fetchpostcomments/{id}', 'HomeController@fetchpost');
Route::get('home/fetchpostlikes/{id}', 'HomeController@fetchlikes');
Route::get('home/userwallgetdetails/{user_id}', 'HomeController@userwallgetdetails');
Route::get('home/get_help', 'HomeController@get_help');
Route::get('home/get_categories', 'HomeController@get_categories');
Route::get('/home/get_category_help/{catid}', 'HomeController@get_category_help');
//users
Route::get('profile', 'UserController@profile');
Route::get('notifications', 'UserController@notifications');
Route::get('messages', 'UserController@messages');
Route::get('associates', 'UserController@associates');
Route::get('followers', 'UserController@followers');
Route::get('following', 'UserController@following');
Route::get('settings', 'UserController@settings');
Route::get('find-associates', 'AssociateController@find');
Route::get('albums', 'UserController@albums');
Route::get('album_details/{id}', 'UserController@album_details');

//profile
Route::get('users/getprofiledetails', 'UserController@getprofiledetails');
Route::post('users/update_aboutme', 'UserController@update_aboutme');
Route::get('users/getaboutme', 'UserController@get_aboutme');
Route::post('users/update_profiledetails', 'UserController@update_profiledetails');
Route::post('users/addprofilepic', 'UserController@addprofilepic');
Route::post('users/addwallpic', 'UserController@addwallpic');
Route::get('users/{userid}', 'UserController@userwall');
Route::get('/userwall/{userid}', 'UserController@userwall');
//associates
Route::get('/associates/getsuggestions', 'AssociateController@getsuggestions');
Route::post('/associate/request_fetch', 'AssociateController@request_fetch');
Route::post('/associate/remove_request', 'AssociateController@remove_request');
Route::post('/associate/accept_request', 'AssociateController@accept_request');
Route::post('/associate/ignore_request', 'AssociateController@ignore_request');
Route::post('/associate/remove', 'AssociateController@remove');
Route::get('/associates/mine', 'AssociateController@getmine');
Route::get('/associates/userwallassociates/{userid}', 'AssociateController@userwallassociates');
Route::get('/associates/requests', 'AssociateController@requests');
//followers
Route::get('/follow', 'FollowerController@follow');
Route::get('/follower/getsuggestions', 'FollowerController@getsuggestions');
Route::post('/follower/add', 'FollowerController@add');
Route::post('/follower/remove', 'FollowerController@remove');
Route::get('/follower/get_followers', 'FollowerController@get_followers');
Route::get('/follower/get_following', 'FollowerController@get_following');
//notifications
Route::get('/notification/get_header_notifications', 'NotificationController@header_notifications');
Route::get('/notification/get_all_notifications/{page}', 'NotificationController@get_all_notifications');
Route::get('/notification/remove_notification/{id}', 'NotificationController@remove_notification');
Route::get('/notification/all_seen', 'NotificationController@all_seen');
//post
Route::get('/postdetails/{post_id}', 'HomeController@postdetails');
Route::get('/fetch_single_post/{post_id}', 'HomeController@fetch_single_post');
Route::post('/share_post/', 'UserController@share_post');
//pages
Route::get('/privacy/', 'HomeController@privacy');
Route::get('/help/', 'HomeController@help');
//albums
Route::get('album/get_albums/', 'AlbumController@get_albums');
Route::post('album/save/', 'AlbumController@store');
Route::post('album/delete/', 'AlbumController@delete_album');
Route::post('album/getalbum_details', 'AlbumController@getalbum_details');
Route::post('album/add_album_files/{album_id}', 'AlbumController@add_album_files');
Route::post('album/delete_file', 'AlbumController@delete_album_file');
//admin
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/posts', 'AdminController@posts');
Route::get('/admin/users', 'AdminController@users');
Route::get('/admin/category', 'AdminController@category');
Route::get('/admin/faq_categories', 'AdminController@faq_categories');
Route::get('/admin/faqs', 'AdminController@faqs');
Route::get('/admin/help_faqs', 'AdminController@help_faqs');
Route::get('/admin/reported_posts', 'AdminController@reported_posts');
Route::get('/admin/user_messages', 'AdminController@user_messages');
Route::get('/admin/get_dashboard_data', 'AdminController@get_dashboard_data');
Route::get('/admin/get_users/{page}', 'AdminController@get_users');
Route::get('/admin/get_posts/{page}', 'AdminController@get_posts');
Route::get('/admin/get_faqs/{page}', 'AdminController@get_faqs');
Route::get('/admin/get_categories/{page}', 'AdminController@get_categories');
Route::get('/admin/get_helpcategories/{page}', 'AdminController@get_helpcategories');
Route::get('/admin/get_reported_posts/{page}', 'AdminController@get_reported_posts');
Route::get('/admin/get_contact_messages/{page}', 'AdminController@get_contact_messages');
Route::post('/admin/allow_access/', 'AdminController@allow_access');
Route::post('/admin/post_publish/', 'AdminController@post_publish');
Route::post('/admin/add_category/', 'AdminController@add_category');
Route::post('/admin/update_category/', 'AdminController@update_category');
Route::post('/admin/delete_category/', 'AdminController@delete_category');
Route::post('/admin/add_faq_category/', 'AdminController@add_faq_category');
Route::post('/admin/update_faq_category/', 'AdminController@update_faq_category');
Route::post('/admin/delete_faq_category/', 'AdminController@delete_faq_category');
Route::post('/admin/add_faq/', 'AdminController@add_faq');
Route::post('/admin/update_faq/', 'AdminController@update_faq');
Route::post('/admin/delete_faq/', 'AdminController@delete_faq');
Route::post('/admin/delete_report/', 'AdminController@delete_report');
Route::post('/admin/delete_contact_message/', 'AdminController@delete_contact_message');
Route::get('/admin/profile/', 'AdminController@profile');
Route::post('/admin/update_profile/', 'AdminController@update_profile');
Route::post('/admin/update_password/', 'AdminController@update_password');
Route::post('/admin/addprofilepic/', 'AdminController@addprofilepic');
Route::get('/admin/get_cats/', 'AdminController@get_cats');