@extends('layouts.userdetailswall')

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
        
        
         <div class="profile" ng-controller="associatesController" ng-init="userwallgetsidebarassociates({{ $user_id }})">
          <h4>Associates</h4>
          <div class="associates1" ng-if="userwallAssociates.length < 1">
              <p>No Associates were found</p>
          </div>
           <div class="associates1" ng-repeat="associate in userwallAssociates">
            <div class="asso-profile">
                    <span class="associate-img" ng-if="associate.request_from.profile_pic !== '' && associate.request_from.profile_pic !== ' '">
                        <img ng-src="<% baseurl + '/public/uploads/profile_pic/' + associate.request_from.profile_pic %>" alt="profile-image">
                    </span>
                    <span class="associate-img" ng-if="associate.request_from.profile_pic === '' || associate.request_from.profile_pic === ' '">
                        <img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image">
                    </span>
                
            </div>
            <div class="col-md-9">
              <h4 class="small-pname"><% associate.request_from.name %></h4>
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
          
       
          
        <div ng-controller="postactivityController" infinite-scroll='userwallnextposts({{ $user_id }})' infinite-scroll-disabled='userwallpostsStillLoading || userwallnoMorePosts' infinite-scroll-distance='1'>
         <div class="wall" ng-repeat="singlepost in posts" ng-init="$postIndex = $index">
             <div class="wall-img">
              <div class="wall-profile">
                <div class="wall-profile-img"> 
                    <div class="comnt-profile" ng-if="singlepost.user.profile_pic !== '' && singlepost.user.profile_pic !== ' '">
                        <img ng-src="<% baseurl + '/public/uploads/profile_pic/' + singlepost.user.profile_pic %>" alt="profile-image">
                    </div>
                    <div class="comnt-profile" ng-if="singlepost.user.profile_pic === '' || singlepost.user.profile_pic === ' '">
                        <img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image">
                    </div>
				<div class="coment-text">
					<h4>
                                            <a ng-if="singlepost.user != null" href="{{ URL::to('userwall/<% singlepost.user.id %>') }}"><% singlepost.user.name | capitalize %></a>
                                            <a ng-if="singlepost.user === null" href="#">Anonymous</a>
                                            <p ng-if="singlepost.parent_id != '0'"><span> shared</span> <span ng-if="singlepost.original_author === null">a </span><a ng-if="singlepost.original_author != null" class="real_author" href="{{ URL::to('userwall/<% singlepost.original_author.id %>') }}"><% singlepost.original_author.name %>'s </a><a style="text-decoration:underline;" href="{{ URL::to('postdetails/<% singlepost.original_post.post_id %>') }}">post</a></p>
                                        </h4>
					<p class="recent-time">
						<% singlepost.created_at | timeago %>
					</p>
					
					<div class="wall-right">
				   <li>
						<a href="#" ng-if="singlepost.category != ''"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;
							<% singlepost.category %>
						</a>
					<li>
						<a href="#" ng-if="singlepost.location !=''"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;
							<% singlepost.location %>
						</a> 
					</li>
                  </li>
                </div>
				</div>
				
                </div>
                
              </div>
			  
			   <!----------original author of the post----------->
				 
				 <!--div class="wall-profile parent-post-author" ng-if="singlepost.parent_id != '0'">
                <div class="wall-profile-img"> 
                     <div class="comnt-profile" ng-if="singlepost.original_author.profile_pic !== '' && singlepost.original_author.profile_pic !== ' '">
                        <a href="{{ URL::to('userwall/<% singlepost.original_author.id %>') }}"><img ng-src="<% baseurl + '/public/uploads/profile_pic/' + singlepost.original_author.profile_pic %>" alt="profile-image"></a>
                    
                    </div>
                     <div class="comnt-profile" ng-if="singlepost.original_author.profile_pic === '' || singlepost.original_author.profile_pic === ' '">
                        <a href="{{ URL::to('userwall/<% singlepost.original_author.id %>') }}"><img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image"></a>
                    </div>
					 <div class="coment-text coment-text1">
                  <h4>
                      <a href="{{ URL::to('userwall/<% singlepost.original_author.id %>') }}"><% singlepost.original_author.name %></a>
				  </h4>
                  <p class="recent-time">
                    <% singlepost.original_post.created_at | timeago %>
                  </p>
				  
				  </div>
				  </div>
                </div-->
				 
				 
				 <!----------original author details end-------------->
			  
			  
              <!--div class="wall-main-img"> <img ng-src="{{ URL::asset('public/assets/images/wall-main.jpg') }}" alt="profile-image"> </div-->
              <div class="wall-main-title">
               <p ng-if="singlepost.description.length > 0" ng-bind-html="singlepost.description | emoji">
                  
                </p>
                <img ng-repeat="singleimage in singlepost.images" ng-src="{{ URL::asset('public/uploads/<% singleimage.image.trim()  %>') }}" /> 
				</div>
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
                  <form ng-submit="submitComment(singlepost.post_id, $postIndex, commentform.commenttext[$postIndex])">
                    <div class="comnt-profile" ng-if="theUser.profile_pic !== '' && theUser.profile_pic !== ' '">
                        <img ng-src="<% baseurl + '/public/uploads/profile_pic/' +theUser.profile_pic %>" alt="profile-image">
                    </div>
                    <div class="comnt-profile" ng-if="theUser.profile_pic === '' || theUser.profile_pic === ' '">
                        <img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image">
                    </div>
                    <div class="coment-text">
                      <h5 class="comment_author_name">
                        <% theUser.name %>
                        <i class="fa fa-paperclip" aria-hidden="true"></i> <i class="fa fa-smile-o" aria-hidden="true"></i> </h5>
                      <input type="text" ng-model="commentform.commenttext[$postIndex]"/>
                      <button type="submit">Submit</button>
                    </div>
                    <div class="attact"></div>
                  </form>
                </div>
                <div class="wall-profile-img coment-profile" ng-repeat="comment in singlepost.comments" ng-include="getCommenteditTemplate(comment)"> 
                  <script type="text/ng-template" id="display">
                      <div class="comnt-profile" ng-if="comment.owner.profile_pic !== '' && comment.owner.profile_pic !== ' '">
                        <img ng-src="<% baseurl + '/public/uploads/profile_pic/' + comment.owner.profile_pic %>" alt="profile-image">
                     </div>
                    <div class="comnt-profile" ng-if="comment.owner.profile_pic === '' || comment.owner.profile_pic === ' '">
                        <img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image">
                    </div>
                    
                    <div class="coment-text">
                        <h5 class="comment_author_name"><% comment.owner.name %>  
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
                        <img ng-src="<% baseurl + '/public/uploads/profile_pic/' + comment.owner.profile_pic %>" alt="profile-image">
                    </div>
                    <div class="comnt-profile" ng-if="comment.owner.profile_pic === '' || comment.owner.profile_pic === ' '">
                        <img ng-src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-image">
                    </div>
                    
                    <div class="coment-text" ng-if="theUser.id == comment.owner.id">
                        <form ng-submit="updateComment(comment, singlepost.post_id, $postIndex)">
                           <h5 class="comment_author_name"><% theUser.name %></h5>
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
          <div class="wall post-data-load-messages" ng-show='userwallpostsStillLoading && !userwallnoMorePosts'>Loading data...</div>
          <div class="wall post-data-load-messages" ng-show='userwallnoMorePosts'>No more posts..</div>
		   
        </div>
      </div>
    </div>
  </div>
  
  <!-- /container --> 
  </section>
</div>
<script ng-src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKnhiklW0jal2T7pnfVAfRPaw99ZZXJoU&libraries=places&callback=initAutocomplete" async defer></script>

@endsection 