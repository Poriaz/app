@include('includes.header')
<section id="profile-cover"  ng-controller="wallController" ng-init="userwallgetdetails({{ $user_id }})"> 
     <img ng-if="walluser.wall_pic !== '' && walluser.wall_pic !== ' '" id="cover-bg" ng-src="<% baseurl + '/public/uploads/wall_pic/' + walluser.wall_pic %>" alt="cover-photo" />
	<img ng-if="walluser.wall_pic === '' || walluser.wall_pic === ' '" id="cover-bg" ng-src="{{ URL::asset('public/assets/images/cover-photo.jpg') }}" alt="cover-photo" />
    <div class="container">
      <div class="row">
        <div class="profile-cover">
          <div class="update-cover">
            
          </div>
          <div class="profile-pic-section">
            <div class="col-md-6">
              <div class="profile-pic" ng-if="walluser.profile_pic !== '' && walluser.profile_pic !== ' '">
                  <img src="<% baseurl + '/public/uploads/profile_pic/' + walluser.profile_pic %>" alt="profile-pic" />
                 
                    
              </div>
              <div class="profile-pic" ng-if="walluser.profile_pic === '' || walluser.profile_pic === ' '">
                  <img src="{{ URL::asset('public/assets/images/profile-image.png') }}" alt="profile-pic" />
                
                    
              </div>
              <div class="profile-text">
                <h2><% walluser.name %></h2>
                <p>( <% walluser.business_type %> )</p>
              </div>
            </div>
            <div class="col-lg-6 pull-right">
              <div class="profile-follow">
                <h2><% following_count %></h2>
                <p>Following</p>
              </div>
              <div class="profile-follow">
                <h2><% follower_count %></h2>
                <p>Followers</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

 @yield('content')
 
 

<script src="{{ URL::asset('public/assets/js/bootstrap.min.js') }}"></script> 
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js'></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />
<script type='text/javascript' src="http://xoxco.com/examples/jquery.tagsinput.js"></script>
<!-- /twwet-post tab --> 
<script>jQuery(function () {
    jQuery('#myModal').on('shown.bs.modal', function (){
        google.maps.event.trigger(map, "resize");
    });
    jQuery('#myTab a:last').tab('show')
})</script> 

<!-- /upload image --> 
<script>
$(function () {
    $(":file").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
    $('#tags_1').tagsInput({width:'auto'});
});

function imageIsLoaded(e) {
    $('#myImg').attr('src', e.target.result);
};
</script> 

<!-- /*/ NAV TOGGLE ONCLICK WITH SLIDE*/--> 

<script>
<!-- /*/ map-popup*/-->
$("#open_popup").click(function(){
    $("#popup").css("display", "block");
  });

  $("#close_popup").click(function(){
    $("#popup").css("display", "none");
  }); 
  
  $("#open_cats_popup").click(function(){
    $("#popup_cats").css("display", "block");
  });

  $("#close_popup_cats").click(function(){
    $("#popup_cats").css("display", "none");
  }); 
  
  $("#open_tags_popup").click(function(){
    $("#popup_tags").css("display", "block");
  });

  $("#close_popup_tags").click(function(){
    $("#popup_tags").css("display", "none");
  }); 
  
</script>
<style>

</style>
</body>
</html>
