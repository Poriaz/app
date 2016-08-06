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
use Auth;
use DB;
use View;
use Response;
class FollowerController extends Controller
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
	
	
	public function follow(){
		return View::make('followers/follow');
	}
        
        public function getsuggestions(){
                return User::with(['mefollowing' => function($query){
								$query->where('request_from','=',Auth::user()->id);
								},
                                   ])->where('id','!=',Auth::user()->id)->select('id','name','business_type','profile_pic','is_active','last_login')->get();
        }
        
        public function add(){
                $user_id = Input::get('user_id');
                $check_if_already_following = Follower::Where('request_to', '=', $user_id)->where('request_from', '=', Auth::user()->id)->first();
                if ($check_if_already_following === null) {
                    $follower = new Follower();
                    $follower->request_to = $user_id;
		    $follower->request_from = Auth::user()->id;
                    $follower->save();
                    $insertedId = $follower->id;
                        
                    $notification = new Notification();
                    $notification->user_id = Auth::user()->id;
                    $notification->activity_type = 'follow';
                    $notification->parent_type = 'followers';
                    $notification->source_id = $insertedId;
                    $notification->parent_id = "";
                    $notification->notification_for = $user_id;
                    $notification->save();
                }
                return Follower::where('followers.request_to','=',$user_id)->first();
        }
        
        public function remove(){
                $id = Input::get('user_id');
                Follower::where('id','=',$id)->delete();
                return Follower::where('id','=',$id)->first();
        }
        
        public function get_followers(){
                return Follower::with(['followers' => function($query){
								$query->select('id','name','business_type','profile_pic','is_active','last_login');
								},
                                   ])->where('request_to','=',Auth::user()->id)->get();
        }
        
        public function get_following(){
                return Follower::with(['following' => function($query){
								$query->select('id','name','business_type','profile_pic','is_active','last_login');
								},
                                   ])->where('request_from','=',Auth::user()->id)->get();
        }
}