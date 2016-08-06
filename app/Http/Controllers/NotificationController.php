<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use App\Models\User;
use App\Models\Post;
use App\Models\Postimage;
use App\Models\Posttag;
use App\Models\Follower;
use App\Models\Notification;
use App\Models\Associate;
use Auth;
use DB;
use View;
use Response;
use Illuminate\Pagination\Paginator;
class NotificationController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
        public function __construct()
        {
                $this->middleware('auth');
        }
	
	
		public function header_notifications(){
                                $associate_notifications = Associate::with(['request_from' => function($query){
								$query->select('id','name','profile_pic');
					}])->where(function ($query){
						return $query->where('associates.request_to','=',Auth::user()->id)->where('status','=','0');
						})->limit(5)->get();
						
				$likecomment_notifications = Notification::with([
								'notification_from' => function($query){
											$query->select('id','name','profile_pic'); 
											},
								'notification_post' => function($query){
											$query->select('post_id','description');
											}
				])->where('notifications.notification_for','=',Auth::user()->id)->where('notifications.user_id','!=',Auth::user()->id)->where('notifications.is_deleted','=','0')->where('notifications.is_seen','=','0')->limit(5)->get();
				
				$message_notifications = "";
				$associate_notifications_count = Associate::where('associates.request_to','=',Auth::user()->id)->where('status','=','0')->get()->count();
                                $likecomment_notifications_count = Notification::where('notifications.notification_for','=',Auth::user()->id)->where('notifications.user_id','!=',Auth::user()->id)->where('notifications.is_deleted','=','0')->where('notifications.is_seen','=','0')->get()->count();
				return array('associateNotification' => $associate_notifications,'likeCommentNotification' => $likecomment_notifications, 'messageNotification' => $message_notifications,'associate_notification_count' => $associate_notifications_count,'likecomment_notification_count'=>$likecomment_notifications_count);
																
        }
		
		public function get_all_notifications($currentPage){
                                Paginator::currentPageResolver(function () use ($currentPage) {
                                    return $currentPage;
                                });
				return Notification::with(['notification_from' => function($query){
											$query->select('id','name','profile_pic'); 
											},
								'notification_post' => function($query){
											$query->select('post_id');
						}
				])->where('notifications.notification_for','=',Auth::user()->id)->where('notifications.is_deleted','=','0')->orderBy('notifications.created_at','DESC')->paginate(20);
		}
		
		public function remove_notification($id){
				DB::table('notifications')->where('id', $id)->update(['is_deleted' => '1']);
		}
		
		public function all_seen(){
				DB::table('notifications')->where('notification_for', Auth::user()->id)->update(['is_seen' => '1']);
		}
        
       
}