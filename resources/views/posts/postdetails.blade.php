@extends('layouts.onlyheader')

@section('content') 
<div class="wrapper">
<section id="home">
  <div class="container">
    <div class="row">
      <div class="col-md-3 pro-left">

        
         <div class="profile" ng-controller="associatesController" ng-init="getsidebarassociates()">
          <h4>Suggestions</h4>
          <div class="associates1" ng-if="myAssociates.length < 1">
              <p>No suggestions were found</p>
          </div>
           <div class="associates1" ng-repeat="associate in myAssociates">
            <div class="asso-profile">
                    <span class="associate-img" ng-if="associate.request_from.profile_pic !== '' && associate.request_from.profile_pic !== ' '">
                        <a href="{{ URL::to('userwall/<% associate.request_from.id %>') }}"> <img ng-src="<% baseurl + '/public/uploads/profile_pic/' + associate.request_from.profile_pic %>" alt="profile-image"></a>
                    </span>
                    <span class="associate-img" ng-if="associate.request_from.profile_pic === '' || associate.request_from.profile_pic === ' '">
                        <a href="{{ URL::to('userwall/<% associate.request_from.id %>') }}"><img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image"></a>
                    </span>
                
            </div>
            <div class="col-md-9">
                <h4 class="small-pname"><a href="{{ URL::to('userwall/<% associate.request_from.id %>') }}"><% associate.request_from.name %></a></h4>
             <p class="online" ng-if="associate.request_from.is_active === 1">
                  <span class="dot1"><i aria-hidden="true" class="fa fa-circle"></i></span> Online
              </p>
              <p class="online" ng-if="associate.request_from.is_active === 0">
                  <span class="dot1 dot2"><i aria-hidden="true" class="fa fa-circle"></i></span> Offline
              </p>
             
            </div>
          </div>
          
        </div>
        
      </div>
      <div class="col-md-9 pro-right">
        
          
        <div ng-controller="postactivityController" ng-init="get_single_post({{ $post_id }});">
         <div class="wall" ng-repeat="singlepost in posts" ng-init="$postIndex = $index">
             <div class="wall-img">
              <div class="wall-profile">
                <div class="wall-profile-img"> 
                    <span ng-if="singlepost.user.profile_pic !== '' && singlepost.user.profile_pic !== ' '">
                        <a href="{{ URL::to('userwall/<% singlepost.user.id %>') }}"><img ng-src="<% baseurl + '/public/uploads/profile_pic/' + singlepost.user.profile_pic %>" alt="profile-image"></a>
                    </span>
                    <span ng-if="singlepost.user.profile_pic === '' || singlepost.user.profile_pic === ' '">
                        <a href="{{ URL::to('userwall/<% singlepost.user.id %>') }}"><img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image"></a>
                    </span>
                  <h4>
                      <a href="{{ URL::to('userwall/<% singlepost.user.id %>') }}"><% singlepost.user.name %></a>
                  </h4>
                  <p class="recent-time">
                    <% singlepost.created_at | timeago %>
                  </p>
                </div>
                <div class="wall-right">
                  <li><a href="#"><i class="fa fa-briefcase" aria-hidden="true"></i>
                    <% singlepost.category %>
                    </a>
                  <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>
                    <% singlepost.location %>
                    </a> </li>
                  </li>
                </div>
              </div>
              <!--div class="wall-main-img"> <img ng-src="{{ URL::asset('public/assets/images/wall-main.jpg') }}" alt="profile-image"> </div-->
              <div class="wall-main-title">
                <p>
                  <% singlepost.description %>
                </p>
                <img ng-repeat="singleimage in singlepost.images" ng-src="{{ URL::asset('public/uploads/<% singleimage.image.trim()  %>') }}" /> </div>
              <div class="tags_list">
                <p> <a ng-repeat="posttag in singlepost.tags" href="#"><span class="tag">
                  <% posttag.tag %>
                  </span></a> </p>
                <p class="like-coment"><a href="#"> <i class="fa fa-commenting" aria-hidden="true"></i>
                  <% singlepost.comments.length %>
                  </a> <a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>
                  <% singlepost.likes.length %>
                  </a></p>
              </div>
              <div class="wall-main-icon">
                <li><i class="fa fa-thumbs-up" aria-hidden="true"> </i><a href="#" ng-click="add_like(singlepost.post_id, $index)"> Like</a></li>
                <li><a href="#"><i class="fa fa-commenting" aria-hidden="true"></i> Comment</a></li>
                <li><a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a></li>
                <div class="wall-profile-img" id="coment-profile">
                  <form ng-submit="submitComment(singlepost.post_id, $index, commentform.commenttext[$index])">
                    <span ng-if="theUser.profile_pic !== '' && theUser.profile_pic !== ' '">
                        <a href="{{ URL::to('userwall/<% theUser.id %>') }}"><img ng-src="<% baseurl + '/public/uploads/profile_pic/' +theUser.profile_pic %>" alt="profile-image"></a>
                    </span>
                    <span ng-if="theUser.profile_pic === '' || theUser.profile_pic === ' '">
                        <a href="{{ URL::to('userwall/<% theUser.id %>') }}"> <img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image"></a>
                    </span>
                    <div class="coment-text">
                      <h5 class="comment_author_name">
                          <a href="{{ URL::to('userwall/<% theUser.id %>') }}"><% theUser.name %></a>
                        <i class="fa fa-paperclip" aria-hidden="true"></i> <i class="fa fa-smile-o" aria-hidden="true"></i> </h5>
                      <input type="text" ng-model="commentform.commenttext[$index]"/>
                      <button type="submit">Submit</button>
                    </div>
                    <div class="attact"></div>
                  </form>
                </div>
                <div class="wall-profile-img coment-profile" ng-repeat="comment in singlepost.comments" ng-include="getCommenteditTemplate(comment)"> 
                  <script type="text/ng-template" id="display">
                      <span ng-if="comment.owner.profile_pic !== '' && comment.owner.profile_pic !== ' '">
                        <a href="{{ URL::to('userwall/<% comment.owner.id %>') }}"><img ng-src="<% baseurl + '/public/uploads/profile_pic/' + comment.owner.profile_pic %>" alt="profile-image"></a>
                     </span>
                    <span ng-if="comment.owner.profile_pic === '' || comment.owner.profile_pic === ' '">
                        <a href="{{ URL::to('userwall/<% comment.owner.id %>') }}"><img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image"></a>
                    </span>
                    
                    <div class="coment-text">
                        <h5 class="comment_author_name"><a href="{{ URL::to('userwall/<% comment.owner.id %>') }}"><% comment.owner.name %></a>  
                            <span class="coment-edit" ng-if="theUser.id == comment.owner.id">
                                <i class="fa fa-pencil-square-o" aria-hidden="true" ng-click="editComment(comment)"></i>  
                                <i class="fa fa-trash" aria-hidden="true" ng-click="deletecomment($postIndex, singlepost.post_id, comment.comment_id)"></i>
                            </span>
                        </h5>
                        <p class="recent-time"><% comment.created_at | timeago %></p>
                        <p class="comment" ng-bind-html="comment.text | emoji"></p>
                    </div>
                    </script> 
                  <script type="text/ng-template" id="edit">
                      <span ng-if="comment.owner.profile_pic !== '' && comment.owner.profile_pic !== ' '">
                        <a href="{{ URL::to('userwall/<% comment.owner.id %>') }}"><img ng-src="<% baseurl + '/public/uploads/profile_pic/' + comment.owner.profile_pic %>" alt="profile-image"></a>
                    </span>
                    <span ng-if="comment.owner.profile_pic === '' || comment.owner.profile_pic === ' '">
                        <a href="{{ URL::to('userwall/<% comment.owner.id %>') }}"><img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image"></a>
                    </span>
                    
                    <div class="coment-text" ng-if="theUser.id == comment.owner.id">
                        <form ng-submit="updateComment(comment, singlepost.post_id, $postIndex)">
                           <h5 class="comment_author_name"><a href="{{ URL::to('userwall/<% theUser.id %>') }}"><% theUser.name %></a></h5>
                           <input type="text" ng-model="comment.text"/> 
                           <button type="submit">Submit</button>
                        </form>
                        <br/>
                        <span class="cancel" ng-click="resetComment()">Cancel</span>
                    </div>
                    </script> 
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  
  <!-- /container --> 
  </section>
</div>
@endsection 