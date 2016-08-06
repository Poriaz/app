<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use App\Models\Post;
use App\Models\Postimage;
use App\Models\Posttag;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Report;
use App\Models\Helpquestion;
use App\Models\Helpquestioncategory;
use App\Models\Contactmessage;
use Auth;
use DB;
use View;
use Response;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
class AdminController extends Controller
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
	
	public function dashboard(){
		return View::make('admin/dashboard');
	}
	
	public function users(){
		return View::make('admin/users');
	}
	
	public function posts(){
		return View::make('admin/posts');
	}
	
	public function category(){
		return View::make('admin/category');
	}
	
	public function faq_categories(){
		return View::make('admin/faq_categories');
	}
	
	public function faqs(){
		return View::make('admin/faqs');
	}
	
	public function help_faqs(){
		return View::make('admin/help_faqs');
	}
	
	public function reported_posts(){
		return View::make('admin/reported_posts');
	}
	
	public function user_messages(){
		return View::make('admin/user_messages');
	}
        
        public function profile(){
		return View::make('admin/profile');
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
        
        public function update_profile(){
            $name =  Input::get('name');
            $email =  Input::get('email');
            $profile_pic =  Input::get('profile_pic');
            DB::table('users')->where('id', Auth::user()->id)->update(['name' => $name,'email' => $email,'profile_pic' => $profile_pic]);
        }
        
        public function update_password(){
            $password =  Input::get('password');
            $old_password = Input::get('old_password');
            if (Hash::check($old_password, Auth::user()->password)) {
                 $new_pass =  Hash::make($password);
                 DB::table('users')->where('id', Auth::user()->id)->update(['password' => $new_pass]);
            } else {
                echo "no match";
            }
        }
        
        public function get_dashboard_data(){
            $posts =  Post::count();
            $users =  User::count();
            $categories =  Categorie::count();
            $help_questions = Helpquestion::count();
            $help_questions_count =  Helpquestion::count();
            $reports = Contactmessage::count();
            $messagesall = Contactmessage::with(['owner' => function($query){
                                                            $query->select('id','name','profile_pic');
                                                          }])->select('message','created_at','user_id')->orderBy('contact_us_messages.created_at','DESC')->limit(10)->get();
        
            return array('posts' => $posts,'users' => $users,'categories' => $categories,'help_questions' => $help_questions,'help_data' => $help_questions_count,'messages' => $reports,'messgaesall' => $messagesall);
        }
        
        public function get_users($currentPage){
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
             return DB::table('users')->select('id','name','email','created_at','address','allowed_access')->paginate(10);
        }
        
        public function get_posts($currentPage){
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
            return Post::with(['user' => function($query){
                                                            $query->select('id','email');
                                                          }])->select('post_id','description','location','created_at','user_id','category','is_published')->orderBy('posts.created_at','DESC')->paginate(10);
        }
        
        public function get_faqs($currentPage){
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
             //return DB::table('help_questions')->select('id','question','answer','created_at')->paginate(10);
            return Helpquestion::with(['category' => function($query){
                                                            $query->select('id','category');
                                                          }])->select('id','question','answer','cat_id','created_at')->orderBy('help_questions.created_at','DESC')->paginate(10);
        }
        
        public function get_categories($currentPage){
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
             return DB::table('categories')->paginate(10);
        }
        
        public function get_helpcategories($currentPage){
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
            return DB::table('help_question_categories')->select('id','category','created_at')->paginate(10);
        }
        
        public function get_reported_posts($currentPage){
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
             return Report::with(['owner' => function($query){
                                                            $query->select('id','email');
                                                          },
                                   'post' => function($query){
                                                            $query->select('description','post_id','user_id','is_published');
                                                          }])->select('id','post_id','created_at','user_id','message')->orderBy('reported_posts.created_at','DESC')->paginate(10);
      
        }
        
        public function get_contact_messages($currentPage){
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
            return Contactmessage::with(['owner' => function($query){
                                                            $query->select('id','email','name');
                                                          }])->select('id','message','created_at','user_id')->orderBy('contact_us_messages.created_at','DESC')->paginate(10);
        
        }
        
        public function allow_access(){
            $user_id =  Input::get('user_id');
            $allowed_access =  Input::get('value');
            DB::table('users')->where('id', $user_id)->update(['allowed_access' => $allowed_access]);
        }
        
        public function post_publish(){
            $post_id =  Input::get('post_id');
            $is_published =  Input::get('value');
            DB::table('posts')->where('post_id', $post_id)->update(['is_published' => $is_published]);
        }
        
        public function add_category(){
             $title = Input::get('title');
             if(!empty($title)){
                $newcategory = new Categorie();
                $newcategory->title = $title;
                $newcategory->save();
                $last_record_id = $newcategory->id;
                return array('cat_id' => $last_record_id,'title' => $title,'created_at' => date('Y-m-d H:i:s'));
             }
        }
        
        public function update_category(){
            $category_id =  Input::get('category_id');
            $title =  Input::get('title');
            if(!empty($title) && !empty($category_id)){
                DB::table('categories')->where('cat_id', $category_id)->update(['title' => $title]);
            }
        }
        
        public function delete_category(){
             $category_id =  Input::get('category_id');
             DB::table('categories')->where('cat_id', $category_id)->delete();
        }
        
        public function add_faq_category(){
             $title = Input::get('title');
             if(!empty($title)){
                $newcategory = new Helpquestioncategory();
                $newcategory->category = $title;
                $newcategory->save();
                $last_record_id = $newcategory->id;
                return array('id' => $last_record_id,'category' => $title,'created_at' => date('Y-m-d H:i:s'));
             }
        }
        
        public function update_faq_category(){
            $category_id =  Input::get('category_id');
            $title =  Input::get('title');
            if(!empty($title) && !empty($category_id)){
                DB::table('help_question_categories')->where('id', $category_id)->update(['category' => $title]);
            }
        }
        
        public function delete_faq_category(){
             $category_id =  Input::get('category_id');
             DB::table('help_question_categories')->where('id', $category_id)->delete();
        }
        
        public function add_faq(){
             $question = Input::get('question');
             $answer = Input::get('answer');
             $cat_id = Input::get('cat_id');
             if(!empty($question) && !empty($answer) && !empty($cat_id)){
                $newfaq = new Helpquestion();
                $newfaq->question = $question;
                $newfaq->answer = $answer;
                $newfaq->cat_id = $cat_id;
                $newfaq->save();
                $last_record_id = $newfaq->id;
                return array('id' => $last_record_id,'question' => $question,'answer'=> $answer,'cat_id'=> $cat_id,'created_at' => date('Y-m-d H:i:s'));
             }
        }
        
        public function update_faq(){
            $faq_id =  Input::get('faq_id');
            $question = Input::get('question');
            $answer = Input::get('answer');
            $cat_id = Input::get('cat_id');
            if(!empty($question) && !empty($answer) && !empty($faq_id) && !empty($cat_id)){
                DB::table('help_questions')->where('id', $faq_id)->update(['question' => $question,'answer' => $answer,'cat_id'=> $cat_id]);
            }
        }
        
        public function delete_faq(){
             $faq_id =  Input::get('faq_id');
             DB::table('help_questions')->where('id', $faq_id)->delete();
        }
        
        public function delete_report(){
             $report_id =  Input::get('report_id');
             DB::table('reported_posts')->where('id', $report_id)->delete();
        }
        
        public function delete_contact_message(){
            $message_id =  Input::get('message_id');
             DB::table('contact_us_messages')->where('id', $message_id)->delete();
        }
        
        public function get_cats(){
            return  DB::table('help_question_categories')->select('id','category')->get();
            
        }
}
