<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use App\Models\User;
use App\Models\Post;
use App\Models\Postimage;
use App\Models\Posttag;
use App\Models\Associate;
use Auth;
use DB;
use View;
use Response;
class AssociateController extends Controller
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
	
	public function find(){
		return View::make('users/find-associates');
	}
	
	public function getsuggestions(){
                return User::with(['Addedbyme' => function($query){
								$query->where('request_from','=',Auth::user()->id);
								},
                                   'Addedme'  => function($query){
								$query->where('request_to','=',Auth::user()->id);
								}])->where('id','!=',Auth::user()->id)->get();
        }
        public function request_fetch(){
                $associate_id = Input::get('associate_id');
                $check_if_already_friend = Associate::where(['request_to' => $associate_id, 'request_from' => Auth::user()->id])->orWhere(['request_from' => $associate_id, 'request_to' => Auth::user()->id])->first();
                if ($check_if_already_friend === null) {
                    $associate = new Associate();
                    $associate->request_to = $associate_id;
		    $associate->request_from = Auth::user()->id;
                    $associate->status = 0;
                    $associate->save();
                }
                return Associate::where('associates.request_to','=',$associate_id)->first();
        }
        
        public function remove_request(){
                $id = Input::get('id');
                Associate::where('id','=',$id)->delete();
                return Associate::where('id','=',$id)->first();
        }
        
        public function accept_request(){
                $id = Input::get('id');
                Associate::where('id','=',$id)->update(['status' => '1']);
                return Associate::where('id','=',$id)->first();
        }
        
        public function ignore_request(){
                $id = Input::get('id');
                Associate::where('id','=',$id)->update(['status' => '2']);
                return Associate::where('id','=',$id)->first();
        }
        
        public function remove(){
                $id = Input::get('id');
                Associate::where('id','=',$id)->delete();
                return Associate::where('id','=',$id)->first();
        }
        
        public function getmine(){
                return Associate::with(['request_from' => function($query){
							$query->select('id','name','business_type','profile_pic','is_active','last_login');
				}])->where(function ($query){
                                    return $query->where('associates.request_to','=',Auth::user()->id)->where('status','=','1');
                                })->orWhere(function ($query){
                                    return $query->where('associates.request_from','=',Auth::user()->id)->where('status','=','1');
                                })->get();
        }
        
        public function userwallassociates($userid){
                $asscociates = Associate::with(['request_from' => function($query){
							$query->select('id','name','business_type','profile_pic','is_active','last_login');
				}])->where(function ($query) use($userid){
                                    return $query->where('associates.request_to','=',$userid)->where('status','=','1');
                                })->orWhere(function ($query) use($userid){
                                    return $query->where('associates.request_from','=',$userid)->where('status','=','1');
                                })->get();
               return $asscociates;
                               
        }
		
	public function requests(){
                return Associate::with(['request_from' => function($query){
							$query->select('id','name','profile_pic');
				}])->where(function ($query){
                                    return $query->where('associates.request_to','=',Auth::user()->id)->where('status','=','0');
                                })->get();
        }
        
}