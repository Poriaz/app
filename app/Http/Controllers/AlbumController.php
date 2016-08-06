<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use App\Models\Like;
use App\Models\Post;
use App\Models\Notification;
use App\Models\Album;
use App\Models\Albumfile;
use Auth;
use DB;
use View;
use Response;
class AlbumController extends Controller {

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
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
		$title = Input::get('title');
		$user_id = Auth::user()->id;
		$check_record = DB::table('albums')->where('title', '=', $title)->where('user_id', '=', $user_id)->count();
		if($check_record < 1 && !empty($title)){
			$newalbum = new Album();
			$newalbum->title = $title;
			$newalbum->user_id = $user_id;
			$newalbum->save();
			$last_record_id = $newalbum->id;
                    return array('id' => $last_record_id,'title' => $title,'user_id'=> $user_id,'created_at' => date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s'));
		}
        
    }
    
	public function get_albums(){
		return Album::with(['files'])->where('user_id', '=', Auth::user()->id)->get();
		
	}
	
	public function getalbum_details(){
		$id = Input::get('id');
		$album = DB::table('albums')->where('id', '=', $id)->first();
                $files = DB::table('album_files')->where('album_id', '=', $id)->get();
		return array('album' => $album,'files' => $files);
	}
	
	public function delete_album(){
			$album_id = Input::get('album_id');
			DB::table('albums')->where('id', $album_id)->delete();
			return array('id' => null,'title' => null,'user_id'=> null,'created_at' => null,'updated_at' => null);
	 }
         
        public function add_album_files($album_id){
            $input = Input::all();
            $file = array_get($input,'file');
            $destinationPath = 'public/uploads/album_files';
            $extension = $_POST['flowFilename']; 
            $fileName = rand(1111111111111111, 999999999999999) . $extension;
            $upload_success = $file->move($destinationPath, trim($fileName));
            if($upload_success){
                $newalbumfile = new Albumfile();
		$newalbumfile->file_name = $fileName;
		$newalbumfile->album_id = $album_id;
		$newalbumfile->save();
                echo json_encode(['success' => true,'flowFilename' => $fileName]);
            } else {
                echo json_encode(['success' => false,'flowFilename' => $fileName]);
            }
        }

        public function delete_album_file(){
			$file_id = Input::get('file_id');
			DB::table('album_files')->where('id', $file_id)->delete();
			return array('id' => null,'file_name' => null,'album_id'=> null,'created_at' => null,'updated_at' => null);
	 }
         
} 