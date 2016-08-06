<?php // app/controllers/CommentController.php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use App\Models\Like;
use App\Models\Post;
use App\Models\Notification;
use Auth;
use DB;
use View;
use Response;
class LikeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Send back all comments as JSON
     *
     * @return Response
     */
    public function get($id)
    {
        return Response::json(Comment::get($id));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
		$post_id = Input::get('post_id');
		$user_id = Auth::user()->id;
		$check_record = DB::table('likes')->where('post_id', '=', $post_id)->where('author_id', '=', $user_id)->count();
		if($check_record < 1){
			$newlike = new Like();
			$newlike->post_id = $post_id;
			$newlike->author_id = $user_id;
			$newlike->save();
                        $insertedId = $newlike->id;
                        
                        $post_data = Post::where('posts.post_id','=',$post_id)->select('user_id')->first();
                        $notification = new Notification();
                        $notification->user_id = $user_id;
                        $notification->activity_type = 'like';
                        $notification->parent_type = 'likes';
                        $notification->source_id = $insertedId;
                        $notification->parent_id = $post_id;
                        $notification->notification_for = $post_data->user_id;
                        $notification->save();
			return Response::json(array('count' => 'added' ,'success' => true));
		} else {
			DB::table('likes')->where('post_id', '=', $post_id)->where('author_id', '=', $user_id)->delete();
			return Response::json(array('count' => 'removed' ,'success' => true));
		}
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    
	public function getcount($post_id){
		$count_likes = DB::table('likes')->where('post_id', '=', $post_id)->count();
		return Response::json(array('count' => $count_likes ,'success' => true));
	}

} 