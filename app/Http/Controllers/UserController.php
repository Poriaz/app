<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Input;
use App\Models\User;
use App\Models\Post;
use App\Models\Postimage;
use App\Models\Posttag;
use Auth;
use DB;
use View;
use Validator;
use Response;
class UserController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(Route::getCurrentRoute()->getPath() != 'userwall/{userid}'){
            $this->middleware('auth');
        }
    }
	
	public function profile(){
		return View::make('users/profile');
	}
	
	public function notifications(){
                DB::table('notifications')->where('notification_for', Auth::user()->id)->update(['is_seen' => '1']);
		return View::make('users/notifications');
	}
	
	public function messages(){
		return View::make('users/messages');
	}
	
	public function associates(){
		return View::make('users/associates');
	}
	
	public function followers(){
		return View::make('users/followers');
	}
	
	public function following(){
		return View::make('users/following');
	}
	
	public function settings(){
		return View::make('users/settings');
	}
	
        public function albums(){
		return View::make('users/albums');
	}
        
        public function album_details($id){
		return View::make('users/album_files', array('id' => $id));
	}
        
	public function getprofiledetails(){
		return User::whereId(Auth::user()->id)->first();
	}
	
	public function update_aboutme(){
		$about_me =  Input::get('about_me');
                DB::table('users')->where('id', Auth::user()->id)->update(['about_me' => $about_me]);
	}
	public function get_aboutme(){
		return User::whereId(Auth::user()->id)->select('about_me')->first();
	}
	
	public function update_profiledetails(){
		$address =  Input::get('address');
		$business_type =  Input::get('business_type');
		$dob =  Input::get('dob');
		$email =  Input::get('email');
		$gender =  Input::get('gender');
		$interested_in =  Input::get('interested_in');
		$name =  Input::get('name');
		$phone =  Input::get('phone');
                DB::table('users')->where('id', Auth::user()->id)->update(['address' => $address,'business_type' => $business_type,'dob' => $dob,'email' => $email,'gender' => $gender,'interested_in' => $interested_in,'name' => $name,'phone' => $phone]);
	}
        
        public function addprofilepic(){
             $file = array('image' => Input::file('file'));
             $rules = array('image' => 'required');
             $validator = Validator::make($file, $rules);
             if (!$validator->fails()) {
                    if (Input::file('file')->isValid()) {
                        $destinationPath = 'public/uploads/profile_pic/'; 
                        $extension = Input::file('file')->getClientOriginalExtension(); 
                        $fileName = rand('11111111111','99999999999').'.'.$extension;
                        Input::file('file')->move($destinationPath, $fileName);
                        DB::table('users')->where('id', Auth::user()->id)->update(['profile_pic' => $fileName]);
                        return $fileName;
                    }
             }
        }
        
		public function addwallpic(){
             $file = array('image' => Input::file('file'));
			 $rules = array('image' => 'required');
             $validator = Validator::make($file, $rules);
             if (!$validator->fails()) {
                    if (Input::file('file')->isValid()) {
                        $destinationPath = 'public/uploads/wall_pic/'; 
                        $extension = Input::file('file')->getClientOriginalExtension(); 
                        $fileName = rand('11111111111','99999999999').'.'.$extension;
                        Input::file('file')->move($destinationPath, $fileName);
                        DB::table('users')->where('id', Auth::user()->id)->update(['wall_pic' => $fileName]);
                        return $fileName;
                    }
             }
        }
		
        public function userwall($id){
            return View::make('users/userwall', array('user_id' => $id));
        }
		
		public function share_post(){
			$post_id = Input::get('post_id');
			$original_post = Post::where('posts.post_id','=',$post_id)->first();
			$newRecord = $original_post->replicate();
			$newRecord->post_id = "";
			$newRecord->parent_id = $original_post->post_id;
			$newRecord->parent_post_user_id = $original_post->user_id;
			$newRecord->user_id = Auth::user()->id;
			$newRecord->push();
			$original_post->relations = [];
			$original_post->load('images', 'tags');
			$relations = $original_post->getRelations();
			foreach ($relations as $relation) {
				foreach ($relation as $relationRecord) {
					$newRelationship = $relationRecord->replicate();
					if(isset($newRelationship->post_image_id)){
						$newRelationship->post_image_id = "";
					}
					if(isset($newRelationship->post_tag_id)){
						$newRelationship->post_tag_id = "";
					}
					$newRelationship->post_id = $newRecord->id;
					$newRelationship->push();
				}
			}
		}
}