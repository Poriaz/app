@extends('layouts.wall')

@section('content') 
<link href="https://flowjs.github.io/ng-flow/stylesheets/main.css" rel="stylesheet"/>
<link href="http://xoxco.com/examples/jquery.tagsinput.css" rel="stylesheet"/>
 <link href="http://www.justgoscha.com/allmighty-autocomplete/style/autocomplete.css" rel="stylesheet"/>
<link href="{{ URL::asset('public/assets/tags_plugin/ng-tags-input.css') }}" rel="stylesheet">
<script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script ng-src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {
        map = new google.maps.Map(document.getElementById('post_location_map1'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
        
      }
      
      
    </script> 
<div class="wrapper">
<section id="home">
  <div class="container">
    <div class="row">
      <div class="col-md-3 pro-left">
        <div class="profile">
          <div class="profile-img" id="profile-image" ng-if="theUser.profile_pic !== '' && theUser.profile_pic !== ' '">
              <img ng-src="<% baseurl + '/public/uploads/profile_pic/' + theUser.profile_pic %>"  alt="profile-image" />
          </div>
          <div class="profile-img" id="profile-image" ng-if="theUser.profile_pic === '' || theUser.profile_pic === ' '">
              <img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image">
          </div>
          <div class="percent-bar"><img ng-src="{{ URL::asset('public/assets/images/bar.jpg') }}" alt="bar"></div>
          <div class="profile-name">
            <h3><a href="{{ url('profile') }}">
              <span class="dot1"><i class="fa fa-circle" aria-hidden="true"></i></span> <% theUser.name %>
              </a></h3>
           
          </div>
        </div>
        <div class="profile" ng-controller="wallController" ng-init="getdetails()">
          <div class="row">
            <div class="follow">
              <div class="col-md-6">
                <h3>Follow</h3>
                <h2><% following_count %></h2>
              </div>
              <div class="col-md-6">
                <h3>Followers</h3>
                <h2><% follower_count %></h2>
              </div>
            </div>
          </div>
        </div>
         <div class="profile" ng-controller="associatesController" ng-init="getsidebarassociates()">
          <h4>Associates</h4>
          <div class="associates1" ng-if="myAssociates.length < 1">
              <p>No Associates were found</p>
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
        <div class="wall">
          <div class="post-btn">
            <ul class="nav nav-radios">
              <li class="active"><a style="background-color: #eee;">Looking For</a></li>
              <li ng-if="theUser.id !='0'"><a>Advertisement</a></li>
            </ul>
            <div class="post_form" ng-controller="MyCtrl">
              <form action="{{ url('/home') }}" enctype="multipart/form-data" method="post">
                <input type="hidden" name="location" value="<% popup_location %>" id="post_location"/>
                <div class="tags_div" ng-repeat="tag in tags">
                  <input type="hidden" name="tags[]" value="<% tag.text %>" id="post_tags"  />
                </div>
                <input type="hidden" name="category" value="<% popup_category %>" id="post_category"/>
                <input type="hidden" name="images" value="<% uploaded_image %>"/>
                <input type="hidden" name="type" value="0" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="input-section">
                  <div class="write">
                    <textarea id = "your-post" maxlength="100" 
            placeholder = "You can entered upto 100 words here..."
            class = "valid" name="description"></textarea>
                  </div>
                  <div class="input-box">
                    <div class="row col-md-12"> 
                      <!-- angular file upload -->
                      
                      <div flow-init="{headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}}" flow-files-submitted="$flow.upload()" flow-file-added="!!{png:1,gif:1,jpg:1,jpeg:1}[$file.getExtension()]" flow-file-success="responseuploadedfile( $file, $message, $flow )" style="margin-top:20px;">
                        <div class="drop" flow-drop ng-class="dropClass"> <span class="btn btn-default" flow-btn>Upload Image <i class="fa fa-upload" aria-hidden="true"></i></span> <b>OR</b> Drag And Drop your images here </div>
                        <br/>
                        <div>
                          <div ng-repeat="file in $flow.files" class="gallery-box"> <span class="title">
                            <% file.name %>
                            </span>
                            <div class="thumbnail" ng-show="$flow.files.length"> <img flow-img="file" /> </div>
                            <div class="progress progress-striped" ng-class="{active: file.isUploading()}">
                              <div class="progress-bar" role="progressbar"
                                        aria-valuenow="<% file.progress() * 100 %>"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        ng-style="{width: (file.progress() * 100) + '%'}"> <span class="sr-only">
                                <% file.progress() %>
                                % Complete</span> </div>
                            </div>
                            <div class="btn-group"> <a class="btn btn-xs btn-danger" ng-click="file.cancel()"> Remove </a> </div>
                          </div>
                          <div class="clear"></div>
                        </div>
                      </div>
                      
                      <!-- angular file upload --> 
                    </div>
                  </div>
                </div>
                <div class="post-list field-tip">
                  <ul>
                    <li> <a data-toggle="modal" data-target="#popup_cats"> <i class="fa fa-briefcase" aria-hidden="true"></i> <span ng-bind-html="popup_category"> </span></a> <span class="tip-content">Select Category</span> </li>
                    <li class=""><a data-toggle="modal" data-target="#popup_tags" ><i class="fa fa-tags" aria-hidden="true"></i> <span class="tag tags_choosen" ng-repeat="tag in tags">
                      <% tag.text %>
                      </span></a> <span class="tip-content">Select Tag</span> </li>
                    <li><a data-toggle="modal" data-target="#myModal"> <i class="fa fa-map-marker" aria-hidden="true"></i> <span ng-bind-html="popup_location"></span></a> <span class="tip-content">Select Location</span> </li>
                   
                  </ul>
                    <div class="posted hvr-sweep-to-right"  ng-if="theUser.id !='0'"><input type="submit" class="wall-post-btn" name="submit" value="Post"/></div>
                   <div class="posted hvr-sweep-to-right"  ng-if="theUser.id =='0'"><input type="submit" class="wall-post-btn" name="submit" value="Post Query"/></div>
                </div>
              </form>
                
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Add Location</h4>
                        </div>
                        <div class="modal-body">
                            <input id="pac-input" class="controls" type="text" placeholder="Enter a location" ng-model="location_map" ng-keyup="add_location(location_map)"/>
                  
                            <div id="post_location_map1" style="height:400px;"></div>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>

                    </div>
                  </div>
                
               <div id="popup_tags" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Add Tags</h4>
                        </div>
                        <div class="modal-body">
                           <div class="tags_input popup_input_wrap" >
                            <tags-input ng-model="tags" ></tags-input>
                           </div>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>

                    </div>
                  </div> 
              <div id="popup_cats" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Add Category</h4>
                        </div>
                        <div class="modal-body">
                            <div class="autocomplete_input popup_input_wrap">
                            <autocomplete placeholder="i.e.Computer, Electronics, Cloths" click-activation="true" data="movies" on-type="doSomething"></autocomplete>
                          </div>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>

                    </div>
                  </div>
              
              
				  
            </div>
          </div>
        </div>
          
        <div ng-controller="postactivityController" infinite-scroll='nextposts()' infinite-scroll-disabled='postsStillLoading || noMorePosts' infinite-scroll-distance='1'>
         <div class="wall" ng-repeat="singlepost in posts | orderBy:'-post_id'" ng-init="$postIndex = $index">
             <div class="wall-img">
              <div class="wall-profile">
                <div class="wall-profile-img"> 
                     <div class="comnt-profile" ng-if="singlepost.user.profile_pic !== '' && singlepost.user.profile_pic !== ' ' &&  singlepost.user != null">
                        <a href="{{ URL::to('userwall/<% singlepost.user.id %>') }}"><img ng-src="<% baseurl + '/public/uploads/profile_pic/' + singlepost.user.profile_pic %>" alt="profile-image"></a>
                    
                    </div>
                     <div class="comnt-profile" ng-if="singlepost.user.profile_pic === '' || singlepost.user.profile_pic === ' ' || singlepost.user === null">
                        <a href="{{ URL::to('userwall/<% singlepost.user.id %>') }}"><img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image"></a>
                    </div>
					 <div class="coment-text coment-text1">
                  <h4>
                      <a ng-if="singlepost.user != null" href="{{ URL::to('userwall/<% singlepost.user.id %>') }}"><% singlepost.user.name | capitalize %></a>
                      <a ng-if="singlepost.user === null" href="#">Anonymous</a>
                      <p ng-if="singlepost.parent_id != '0'"><span> shared</span> <span ng-if="singlepost.original_author === null">a </span><a ng-if="singlepost.original_author != null" class="real_author" href="{{ URL::to('userwall/<% singlepost.original_author.id %>') }}"><% singlepost.original_author.name %>'s </a><a style="text-decoration:underline;" href="{{ URL::to('postdetails/<% singlepost.original_post.post_id %>') }}">post</a></p>
		  </h4>
                  <p class="recent-time">
                     <% singlepost.created_at | timeago %>
                  </p>
				   <div class="wall-right">
                  <li><a href="#" ng-if="singlepost.category != ''"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;
                    <% singlepost.category %>
                    </a>
                  <li><a href="#" ng-if="singlepost.location !=''"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;
                    <% singlepost.location %>
                    </a> </li>
                  </li>
                </div>
				  </div>
				  </div>
                </div>
               
			     <!----------original author of the post----------->
				 
				 <!--div class="wall-profile parent-post-author" ng-if="singlepost.parent_id != '0'">
                <div class="wall-profile-img"> 
                     <div class="comnt-profile" ng-if="singlepost.original_author.profile_pic !== '' && singlepost.original_author.profile_pic !== ' ' &&  singlepost.original_author != null">
                        <a href="{{ URL::to('userwall/<% singlepost.original_author.id %>') }}"><img ng-src="<% baseurl + '/public/uploads/profile_pic/' + singlepost.original_author.profile_pic %>" alt="profile-image"></a>
                    
                    </div>
                     <div class="comnt-profile" ng-if="singlepost.original_author.profile_pic === '' || singlepost.original_author.profile_pic === ' ' || singlepost.original_author === null">
                        <a href="{{ URL::to('userwall/<% singlepost.original_author.id %>') }}"><img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image"></a>
                    </div>
					 <div class="coment-text coment-text1">
                  <h4>
                      <a ng-if="singlepost.original_author != null" href="{{ URL::to('userwall/<% singlepost.original_author.id %>') }}"><% singlepost.original_author.name %></a>
                      <a ng-if="singlepost.original_author === null" href="#">Anonymous</a>
		  </h4>
                  <p class="recent-time">
                    <% singlepost.original_post.created_at | timeago %>
                  </p>
				  
				  </div>
				  </div>
                </div-->
				 
				 
				 <!----------original author details end-------------->
			   
			   
              </div>
              <!--div class="wall-main-img"> <img ng-src="{{ URL::asset('public/assets/images/wall-main.jpg') }}" alt="profile-image"> </div-->
              <div class="wall-main-title">
                <p ng-if="singlepost.description.length > 0" ng-bind-html="singlepost.description | emoji">
                  
                </p>
                <img ng-repeat="singleimage in singlepost.images" ng-src="{{ URL::asset('public/uploads/<% singleimage.image.trim()  %>') }}" /> </div>
              <div class="tags_list">
                <p ng-if="singlepost.tags.length > 0"> <a ng-repeat="posttag in singlepost.tags" href="#"><span class="tag">
                  <% posttag.tag %>
                  </span></a> </p>
                <p class="like-coment">
                    <a href="#" ng-click="get_comments(singlepost.post_id, $postIndex);" ng-if="singlepost.comments_count != null"> 
                    <i class="fa fa-commenting" aria-hidden="true"></i>
                  <% singlepost.comments_count.aggregate %>
                  </a> 
                    <a href="#" ng-if="singlepost.comments_count === null"> 
                    <i class="fa fa-commenting" aria-hidden="true"></i>
                  0
                  </a> 
                    <a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>
                  <% singlepost.likes.length %>
                  </a></p>
              </div>
              <div class="wall-main-icon">
                <li><i class="fa fa-thumbs-up" aria-hidden="true"> </i><a href="#" ng-click="add_like(singlepost.post_id, $index)"> Like</a></li>
                <li><a href="#"><i class="fa fa-commenting" aria-hidden="true"></i> Comment</a></li>
                <li ng-if="singlepost.parent_id != '0'"><a href="#" ng-click="share(singlepost.parent_id, $index)"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a></li>
				<li ng-if="singlepost.parent_id == '0'"><a href="#" ng-click="share(singlepost.post_id, $index)"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a></li>
                <div class="wall-profile-img" id="coment-profile">
                  <form ng-init="commentform.commenttext[$index] = ' '" ng-submit="submitComment(singlepost.post_id, $index, commentform.commenttext[$index])">
                    <div class="comnt-profile" ng-if="theUser.profile_pic !== '' && theUser.profile_pic !== ' '">
                        <a href="{{ URL::to('userwall/<% theUser.id %>') }}"><img ng-src="<% baseurl + '/public/uploads/profile_pic/' +theUser.profile_pic %>" alt="profile-image"></a>
                    </div>
                    <div class="comnt-profile" ng-if="theUser.profile_pic === '' || theUser.profile_pic === ' '">
                        <a href="{{ URL::to('userwall/<% theUser.id %>') }}"> <img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image"></a>
                    </div>
                    <div class="coment-text coment-text1">
                    <h5 class="comment_author_name">
                        <a href="{{ URL::to('userwall/<% theUser.id %>') }}"><% theUser.name | capitalize  %></a></h5>
                       <div class="smilys"> <div class="attach">
							<input type="file" onchange="angular.element(this).scope().onFileSelect(this.files)">
							<i class="fa fa-camera" aria-hidden="true"></i>
						</div> 
						
						<div class="smily">
							<i class="fa fa-smile-o" aria-hidden="true" ng-click="showEmoListOnComment = !showEmoListOnComment"></i>
							<div class="smily-box" ng-show="showEmoListOnComment">
								<div class="all_emoji">
								<span ng-repeat="emo in emojihtmlarray" ng-click="add_emoji(commentform, emo, $postIndex);" ng-bind-html="emo | emoji"></span>
								</div>
							</div>
							
						</div>
					</div>
                      <input type="text" ng-model="commentform.commenttext[$index]"/>
                      <button type="submit">Submit</button>
                    </div>
                    <div class="attact"></div>
                  </form>
                </div>
                <div class="wall-profile-img coment-profile" ng-repeat="comment in singlepost.comments" ng-include="getCommenteditTemplate(comment)"> 
                  <script type="text/ng-template" id="display">
                      <div class="comnt-profile" ng-if="comment.owner.profile_pic !== '' && comment.owner.profile_pic !== ' '">
                        <a href="{{ URL::to('userwall/<% comment.owner.id %>') }}"><img ng-src="<% baseurl + '/public/uploads/profile_pic/' + comment.owner.profile_pic %>" alt="profile-image"></a>
                     </div>
                      <div class="comnt-profile" ng-if="comment.owner.profile_pic === '' || comment.owner.profile_pic === ' '">
                        <a href="{{ URL::to('userwall/<% comment.owner.id %>') }}"><img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image"></a>
                    </div>
                    
                    <div class="coment-text">
                        <h5 class="comment_author_name"><a href="{{ URL::to('userwall/<% comment.owner.id %>') }}"><% comment.owner.name | capitalize  %></a>  
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
                      <div class="comnt-profile" ng-if="comment.owner.profile_pic !== '' && comment.owner.profile_pic !== ' '">
                        <a href="{{ URL::to('userwall/<% comment.owner.id %>') }}"><img ng-src="<% baseurl + '/public/uploads/profile_pic/' + comment.owner.profile_pic %>" alt="profile-image"></a>
                    </div>
                    <span ng-if="comment.owner.profile_pic === '' || comment.owner.profile_pic === ' '">
                        <a href="{{ URL::to('userwall/<% comment.owner.id %>') }}"><img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image"></a>
                    </span>
                    
                    <div class="coment-text" ng-if="theUser.id == comment.owner.id">
                        <form ng-submit="updateComment(comment, singlepost.post_id, $postIndex)">
                           <h5 class="comment_author_name"><a href="{{ URL::to('userwall/<% theUser.id %>') }}"><% theUser.name  | capitalize %></a></h5>
                           <input type="text" ng-model="comment.text"/> 
                           <button type="submit">Submit</button>
                        </form>
                        <br/>
                        <span class="cancel" ng-click="resetComment()">Cancel</span>
                    </div>
                    </script> 
                </div>
              </div>
            </div><div style='clear: both;'></div>
           </div>
          <div style='clear: both;'></div>
          <div class="wall post-data-load-messages" ng-show='postsStillLoading && !noMorePosts'>Loading data...</div>
          <div class="wall post-data-load-messages" ng-show='noMorePosts'>No more posts..</div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- /container --> 
  </section>
</div>
<script ng-src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKnhiklW0jal2T7pnfVAfRPaw99ZZXJoU&libraries=places&callback=initAutocomplete" async defer></script>

@endsection 