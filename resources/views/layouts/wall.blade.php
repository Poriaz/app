@include('includes.header')


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
<script>
            //this function can remove a array element.
            Array.remove = function(array, from, to) {
                var rest = array.slice((to || from) + 1 || array.length);
                array.length = from < 0 ? array.length + from : from;
                return array.push.apply(array, rest);
            };
       
            //this variable represents the total number of popups can be displayed according to the viewport width
            var total_popups = 0;
           
            //arrays of popups ids
            var popups = [];
       
            //this is used to close a popup
            function close_popup(id)
            {
                for(var iii = 0; iii < popups.length; iii++)
                {
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                       
                        document.getElementById(id).style.display = "none";
                       
                        calculate_popups();
                       
                        return;
                    }
                }  
            }
       
            //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
            function display_popups()
            {
                var right = 220;
               
                var iii = 0;
                for(iii; iii < total_popups; iii++)
                {
                    if(popups[iii] != undefined)
                    {
                        var element = document.getElementById(popups[iii]);
                        element.style.right = right + "px";
                        right = right + 320;
                        element.style.display = "block";
                    }
                }
               
                for(var jjj = iii; jjj < popups.length; jjj++)
                {
                    var element = document.getElementById(popups[jjj]);
                    element.style.display = "none";
                }
            }
           
            //creates markup for a new popup. Adds the id to popups array.
            function register_popup(id, name)
            {
               
                for(var iii = 0; iii < popups.length; iii++)
                {  
                    //already registered. Bring it to front.
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                   
                        popups.unshift(id);
                       
                        calculate_popups();
                       
                       
                        return;
                    }
                }              
               
                var element = '<div class="paddy-chat-popup-box paddy-chat-chat-popup" id="'+ id +'">';
                element = element + '<div class="paddy-chat-popup-head">';
                element = element + '<div class="paddy-chat-popup-head-left">'+ name +'</div>';
                element = element + '<div class="paddy-chat-popup-head-right"><a href="javascript:close_popup(\''+ id +'\');">&#10005;</a></div>';
                element = element + '<div style="clear: both"></div></div><div class="paddy-chat-popup-messages"></div></div>';
               
                document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element; 
       
                popups.unshift(id);
                       
                calculate_popups();
               
            }
           
            //calculate the total number of popups suitable and then populate the toatal_popups variable.
            function calculate_popups()
            {
                var width = window.innerWidth;
                if(width < 540)
                {
                    total_popups = 0;
                }
                else
                {
                    width = width - 200;
                    //320 is width of a single popup box
                    total_popups = parseInt(width/320);
                }
               
                display_popups();
               
            }
           
            //recalculate when window is loaded and also when window is resized.
            window.addEventListener("resize", calculate_popups);
            window.addEventListener("load", calculate_popups);
           
        </script>
<style>
.paddy-chat-popup-box
            {
                display: none;
                position: fixed;
                bottom: 0px;
                right: 20px;
                height: 285px;
                background-color: rgb(237, 239, 244);
                width: 300px;
                border: 1px solid rgba(29, 49, 91, .3);
            }
           
            .paddy-chat-popup-box .paddy-chat-popup-head
            {
                background-color: #6d84b4;
                padding: 5px;
                color: white;
                font-weight: bold;
                font-size: 14px;
                clear: both;
            }
           
            .paddy-chat-popup-box .paddy-chat-popup-head .paddy-chat-popup-head-left
            {
                float: left;
            }
           
            .paddy-chat-popup-box .paddy-chat-popup-head .paddy-chat-popup-head-right
            {
                float: right;
                opacity: 0.5;
            }
           
            .paddy-chat-popup-box .paddy-chat-popup-head .paddy-chat-popup-head-right a
            {
                text-decoration: none;
                color: inherit;
            }
           
            .paddy-chat-popup-box .paddy-chat-popup-messages
            {
                height: 100%;
                overflow-y: scroll;
            }
</style>
</body>
</html>
