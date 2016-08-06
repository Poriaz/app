<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Input;
use App\Models\Post;
use App\Models\Postimage;
use App\Models\Posttag;
use App\Models\User;
use App\Models\Helpquestion;
use App\Models\Helpquestioncategory;
use Auth;
use DB;
use View;
use Response;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       if(Route::getCurrentRoute()->getPath() == 'home/getdetails'){
            $this->middleware('auth');
       }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!empty($request->input('submit')) && (!empty($request->input('images')) || !empty($request->input('description')))){
			$input = $request->all();
			$newpost = new Post();
                        if(Auth::user()){
                            $newpost->user_id = Auth::user()->id;
                        } else {
                            $newpost->user_id = 0;
                        }
                        $newpost->description = $input['description'];
			$newpost->category = $input['category'];
                        $newpost->location = $input['location'];
                        $newpost->type = 0;
                        $newpost->save();
			$last_post_id = $newpost->id;
			$post_images = $input['images'];
			$post_images = substr($post_images,1);
			if(!empty($post_images)){
					$post_images = explode(',',$post_images);
					foreach($post_images as $image){
						$postimage = new Postimage();
						$postimage->post_id = $last_post_id;
						$postimage->image = $image;
						$postimage->save();
					}
			}
			if(!empty($input['tags'])){
					foreach($input['tags'] as $tag){
						$posttag = new Posttag();
						$posttag->post_id = $last_post_id;
						$posttag->tag = $tag;
						$posttag->save();
					}
			}
			
			
        }
        
        return View::make('home');
    }
    
    public function uploadwallstatusfiles()
    {
        $input = Input::all();
        $file = array_get($input,'file');
        $destinationPath = 'public/uploads';
		$extension = $_POST['flowFilename']; 
		$fileName = rand(1111111111111111, 999999999999999) . $extension;
        $upload_success = $file->move($destinationPath, trim($fileName));
        if($upload_success){
            echo json_encode(['success' => true,'flowFilename' => $fileName]);
        } else {
            echo json_encode(['success' => false,'flowFilename' => $fileName]);
        }
    }
    
    public function userwallgetfeed($user_id, $page_number = 0){
        $offset = 10 * $page_number;
        return Post::with(['images','tags','likes','original_post' => function($query){
												$query->select('post_id','created_at');
                                                                        },
													'original_author' => function($query){
																					$query->select('id','name','profile_pic');
                                                                        },'comments_count',
												    'comments' => function($query){
																$query->with(array('owner'))->orderBy('created_at','DESC')->limit(1);
																},
													'user' => function($query){
                                                                $query->select('id','name','profile_pic');
                                                                }
									])->where('is_published','=','1')->where('posts.user_id','=',$user_id)->orderBy('posts.created_at','DESC')->offset($offset)->limit(10)->get();
        
    }
    public function getfeed($page_number = 0){
        $offset = 10 * $page_number;
        return $allfeed = Post::with(['images','tags','original_post' => function($query){
											$query->select('post_id','created_at');
                                                                        },
													'original_author' => function($query){
																					$query->select('id','name','profile_pic');
                                                                                },'likes','comments' => function($query){
																				$query->with(array('owner'))->orderBy('created_at','DESC')->limit(1);
																	},
													'comments_count',
													'user' => function($query){
                                                                           $query->select('id','name','profile_pic');
                                                              }
									])->where('is_published','=','1')->orderBy('posts.created_at','DESC')->offset($offset)->limit(10)->get();
        
    }
    
    public function fetchpost($postid){
        return DB::table('comments')->where('post_id',$postid)->orderBy('created_at','DESC')->get();
    }
	
    public function fetchlikes($postid){
        return DB::table('likes')->where('post_id',$postid)->get();
    }

    public function getdetails(){
         $following_count = DB::table('followers')->where('request_from',Auth::user()->id)->count();
         $followers_count = DB::table('followers')->where('request_to',Auth::user()->id)->count();
         $associate_count = DB::table('associates')->where('request_to',Auth::user()->id)->where('status','=','1')->orWhere('request_from',Auth::user()->id)->count();
         $notification_count =  DB::table('notifications')->where('notifications.notification_for','=',Auth::user()->id)->where('notifications.is_deleted','=','0')->where('notifications.is_seen','=','0')->count();
         return array('following_count' => $following_count,'followers_count' => $followers_count,'associate_count' => $associate_count);
    }
    
    public function userwallgetdetails($user_id){
         $following_count = DB::table('followers')->where('request_from',$user_id)->count();
         $followers_count = DB::table('followers')->where('request_to',$user_id)->count();
         $userdata = DB::table('users')->whereId($user_id)->first();
         return array('following_count' => $following_count,'followers_count' => $followers_count,'wall_user' => $userdata);
    }
	
	public function postdetails($post_id){
		return View::make('posts/postdetails')->with('post_id',$post_id);
	}
	
	public function fetch_single_post($post_id){
		return $allfeed = Post::with(['images','tags','original_post' => function($query){
														$query->select('post_id','created_at');
                                                                        },
													'original_author' => function($query){
																				$query->select('id','name','profile_pic');
                                                                                },'likes',
													'comments' => function($query){
																		$query->with(array('owner'))->orderBy('created_at','DESC')->limit(1);
																},'comments_count',
													'user' => function($query){
																	$query->select('id','name','profile_pic');
                                                              }
									])->where('posts.post_id','=',$post_id)->get();
	}
	
	public function help(){
		return View::make('home/help');
	}
	
	public function privacy(){
		return View::make('home/privacy');
	}
        
        public function get_help(){
                $categories =  Helpquestioncategory::get();
                $get_faqs = Helpquestion::get();
                return array('categories' => $categories, 'faqs' => $get_faqs);
        }
        
        public function get_categories(){
            $cats =  DB::table('categories')->select('title')->get(10);
            $new_array = array();
            foreach($cats as $cat){
                $new_array[] = $cat->title;
            }
            return $new_array;
        }
        
        public function get_category_help($category){
           return  Helpquestion::where('cat_id','=',$category)->get();
        }
        
        public function getnewfeed($post_id){
        return $allfeed = Post::with(['images','tags','original_post' => function($query){
															$query->select('post_id','created_at');
                                                                        },
													'original_author' => function($query){
																					$query->select('id','name','profile_pic');
                                                                                },'likes',
													'comments' => function($query){
																				$query->with(array('owner'))->orderBy('created_at','DESC');
																	},'comments_count',
													'user' => function($query){
                                                                           $query->select('id','name','profile_pic');
                                                              }
									])->where('is_published','=','1')->where('posts.post_id','>',$post_id)->orderBy('posts.created_at','DESC')->get();
        
    }
}
