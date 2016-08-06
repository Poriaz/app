@extends('layouts.usersafterlogin')

@section('content')
<div class="profile album_files" ng-controller="albumsController" ng-init="loadalbumfiles({{ $id }});">
  <div class="item-body">
    <div class="cross-gallery">
      <div class="add-more"><!-- ngIf: album.files === null || album.files =='' --><a href="#" ng-click="delete_album_file({{ $id }},singlefile.id);"><i class="fa fa-times" aria-hidden="true"></i></a><!-- end ngIf: album.files === null || album.files =='' --> </div>
    </div>
    <div class="album-header"> 
      <div class="album-header-title"><h3><% album.title %></h3><p>Updated 5 hours ago</p></div>
      <!-- angular file upload -->
      </div>
     <div class="row col-md-12"> 
                      <div flow-init="{target : '{{ url('album/add_album_files/'.$id) }}',headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}}" flow-files-submitted="$flow.upload()" flow-file-added="!!{png:1,gif:1,jpg:1,jpeg:1}[$file.getExtension()]" flow-file-success="responseuploadedfile( $file, $message, $flow )" style="margin-top:20px;">
                        <div class="drop" flow-drop ng-class="dropClass"> <span class="btn btn-default" flow-btn>Upload Image <i class="fa fa-upload" aria-hidden="true"></i> </span> <b>OR</b> Drag And Drop your images here </div>
                        <br/>
                        
                        <div>
                          <div ng-repeat="file in $flow.files" class="upload-galley-image gallery-box"> <div class="cross-gallery">
              <div class="add-more"><!-- ngIf: album.files === null || album.files =='' --><a href="#" ng-click="delete_album_file({{ $id }},singlefile.id);"><i class="fa fa-times" aria-hidden="true"></i></a><!-- end ngIf: album.files === null || album.files =='' --> </div>
            </div><span class="thumb-title">
                          
                            <% file.name %>
                            </span>
                            <div class="thumbnail galley-image" ng-show="$flow.files.length"> <img flow-img="file" /> </div>
                            <div class="progress progress-striped" ng-class="{active: file.isUploading()}">
                              <div class="progress-bar" role="progressbar"
                                        aria-valuenow="<% file.progress() * 100 %>"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        ng-style="{width: (file.progress() * 100) + '%'}"> <span class="sr-only">
                                <% file.progress() %>
                                % Complete</span> </div>
                            </div>
                            
                          </div>
                            
                            
                          <div class="clear"></div>
                        </div>
                      </div>
                       </div>
    
      
        
        
        <div>
        
        
          
         
          
          <div class="gallery-box" ng-repeat="singlefile in album_files">
            <div class="cross-gallery">
              <div class="add-more"><!-- ngIf: album.files === null || album.files =='' --><a href="#" ng-click="delete_album_file({{ $id }},singlefile.id);"><i class="fa fa-times" aria-hidden="true"></i></a><!-- end ngIf: album.files === null || album.files =='' --> </div>
            </div>
            <div class="galley-image" > <img src="{{ URL::asset('public/uploads/album_files/<% singlefile.file_name %>') }}" alt="download"/> </div>
          </div>
          <div class="clear"></div>
        </div>
      </div>
      
      
      <!-- angular file upload --> 
    </div>
  </div>
</div>
@endsection





