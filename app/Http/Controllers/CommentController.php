<?php // app/controllers/CommentController.php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use Auth;
use DB;
use View;
use Response;
class CommentController extends Controller {

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
    public function get($postid)
    {
        return Comment::with(['owner' => function($query){
                                                                $query->select('id','name','profile_pic');
                                                                }])->where('comments.post_id',$postid)->orderBy('comments.created_at','DESC')->get();
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
		$post_id = Input::get('post_id');
                $text = Input::get('text');
                if(!empty($text)){
                    $newcomment = new Comment();
                    $newcomment->post_id = $post_id;
                    $newcomment->author_id = Auth::user()->id;
                    $newcomment->text = $text;
                    $newcomment->save();
                    $insertedId = $newcomment->id;
                    $post_data = Post::where('posts.post_id','=',$post_id)->select('user_id')->first();
                    $notification = new Notification();
                    $notification->user_id = Auth::user()->id;
                    $notification->activity_type = 'comment';
                    $notification->parent_type = 'comments';
                    $notification->source_id = $insertedId;
                    $notification->parent_id = Input::get('post_id');
                    $notification->notification_for =  $post_data->user_id;
                    $notification->save();
                    echo json_encode(['success' => true]);
                }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($commentid)
    {
                DB::table('comments')->where('comment_id', $commentid)->delete();
                
    }
    
    public function update()
    {
        $comment =  Input::get('text');
        $comment_id =  Input::get('comment_id');
        DB::table('comments')->where('comment_id', $comment_id)->update(['text' => $comment]);
                
    }
    
} 