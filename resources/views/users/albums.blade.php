@extends('layouts.usersafterlogin')

@section('content')
<div class="profile albums" ng-controller="albumsController" ng-init="loadalbums();">
  <div class="item-body">
    <div class="profile_gallry">
    <div class="gallery-box add-new-item"><div class="galley-image"> <a href="#" ng-click="editable = 'add_album'"> <img src="{{ URL::asset('public/assets/images/add-album.png') }}" alt="download"> </a></div>
        <form ng-show="editable == 'add_album'" ng-submit="save_album(newalbum.title);">
          <input type="text" ng-model="newalbum.title" placeholder="Add a title"/>
          <input type="submit" ng-model="newalbum.save" value="Create"/>
          <a href="#" ng-click="editable = ''" class="cancel_save">Cancel</a>
        </form>
         <div class="galley-image-text">   <a href="#" ng-click="editable = 'add_album'">add new album</a></div>
      </div>
      <div class="gallery-box" ng-repeat="album in albums">
        <div class="cross-gallery">
          <div class="add-more"><a ng-if="album.files === null || album.files ==''" href="#" ng-click="delete_album(album.id, $index);"><i class="fa fa-times" aria-hidden="true"></i></a> </div>
        </div>
        <div class="galley-image"> <a href="{{ url('album_details/<% album.id %>') }}"> <img ng-if="album.files === null || album.files ==''" src="{{ URL::asset('public/assets/images/download.png') }}" /> <img ng-if="album.files != null" src="{{ URL::asset('public/uploads/album_files/<% album.files[0].file_name %>') }}" /> </a> </div>
        <div class="gallery-image-text">
          <h4><a href="{{ url('album_details/<% album.id %>') }}">
            <% album.title %>
            </a></h4>
          <p><small>
            <% album.files.length %>
            files</small></p>
        </div>
      </div>
      
    </div>
  </div>
  <div class="item-body" ng-if="albums.length < 1">
    <div class="profile_gallry"> You dont have any albums yet ! </div>
  </div>
</div>
@endsection