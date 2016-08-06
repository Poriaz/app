@extends('layouts.usersafterlogin')

@section('content')
        
        
		<div class="profile settings">
        <div id="item-body">
        	<div role="navigation" id="subnav" class="item-list-tabs no-ajax">
					<ul>
						
							<li class="" id="general-personal-li"><a href="#" id="general">General</a></li><li class="current selected" id="notifications-personal-li "><a href="#" id="notifications">Email</a></li><li id="profile-personal-li"><a href="#" id="profile">Profile Visibility</a></li>
							</ul>
				</div>
				<div class="email-noti">
				<p>Send an email notice when:</p>
				<form>
				<div class="email-noti-heading">
				<li><span class="email-activity">ACTIVITY</span><span class="yes">YES</span><span class="no">NO</span></li>

				</div>
				<li><span class="email-activity">A member mentions you in an update using </span><span class="yes"><div class="group">
				<input type="radio" checked="checked" value="First Option" name="Radios" id="Radio1">
				<label for="Radio1"><i aria-hidden="true" class="fa fa-circle-o"></i></label>


				</div>
				</span><span class="no"><div class="group">
				<input type="radio" value="Other Option" name="Radios" id="Radio2">
				<label for="Radio2" class="center"><i aria-hidden="true" class="fa fa-circle-o"></i></label>

				</div></span></li><li><span class="email-activity">A member mentions you in an update using </span><span class="yes"><div class="group">
				<input type="radio" checked="checked" value="First Option" name="Radios" id="Radio3">
				<label for="Radio3"><i aria-hidden="true" class="fa fa-circle-o"></i></label>


				</div>
				</span><span class="no"><div class="group">
				<input type="radio" value="Other Option" name="Radios" id="Radio4">
				<label for="Radio4" class="center"><i aria-hidden="true" class="fa fa-circle-o"></i></label>

				</div></span></li><li><span class="email-activity">A member mentions you in an update using </span><span class="yes"><div class="group">
				<input type="radio" checked="checked" value="First Option" name="Radios" id="Radio5">
				<label for="Radio5"><i aria-hidden="true" class="fa fa-circle-o"></i></label>


				</div>
				</span><span class="no"><div class="group">
				<input type="radio" value="Other Option" name="Radios" id="Radio6">
				<label for="Radio6" class="center"><i aria-hidden="true" class="fa fa-circle-o"></i></label>

				</div></span></li>


				<div class="email-noti-heading">
				<li><span class="email-activity">Messages</span><span class="yes">YES</span><span class="no">NO</span></li>

				</div>
				<li><span class="email-activity">A member sends you a new message </span><span class="yes"><div class="group">
				<input type="radio" checked="checked" value="First Option" name="Radios" id="Radio111">
				<label for="Radio111"><i aria-hidden="true" class="fa fa-circle-o"></i></label>


				</div>
				</span><span class="no"><div class="group">
				<input type="radio" value="Other Option" name="Radios" id="Radio222">
				<label for="Radio222" class="center"><i aria-hidden="true" class="fa fa-circle-o"></i></label>

				</div></span></li><li><span class="email-activity">A member mentions you in an update using </span><span class="yes"><div class="group">
				<input type="radio" checked="checked" value="First Option" name="Radios" id="Radio333">
				<label for="Radio333"><i aria-hidden="true" class="fa fa-circle-o"></i></label>


				</div>
				</span><span class="no"><div class="group">
				<input type="radio" value="Other Option" name="Radios" id="Radio4444">
				<label for="Radio4444" class="center"><i aria-hidden="true" class="fa fa-circle-o"></i></label>

				</div></span></li><li><span class="email-activity">A member mentions you in an update using </span><span class="yes"><div class="group">
				<input type="radio" checked="checked" value="First Option" name="Radios" id="Radio555">
				<label for="Radio555"><i aria-hidden="true" class="fa fa-circle-o"></i></label>


				</div>
				</span><span class="no"><div class="group">
				<input type="radio" value="Other Option" name="Radios" id="Radio66">
				<label for="Radio66" class="center"><i aria-hidden="true" class="fa fa-circle-o"></i></label>

				</div></span></li>


				<div class="email-noti-heading">
				<li><span class="email-activity">Friends</span><span class="yes">YES</span><span class="no">NO</span></li>

				</div>
				<li><span class="email-activity">A member sends you a friendship request </span><span class="yes"><div class="group">
				<input type="radio" checked="checked" value="First Option" name="Radios" id="Radio5a">
				<label for="Radio5a"><i aria-hidden="true" class="fa fa-circle-o"></i></label>


				</div>
				</span><span class="no"><div class="group">
				<input type="radio" value="Other Option" name="Radios" id="Radio6a">
				<label for="Radio6a" class="center"><i aria-hidden="true" class="fa fa-circle-o"></i></label>

				</div></span></li>



				<div class="email-noti-heading">
				<li><span class="email-activity">Follow</span><span class="yes">YES</span><span class="no">NO</span></li>

				</div>
				<li><span class="email-activity">A member starts following your activity</span><span class="yes"><div class="group">
				<input type="radio" checked="checked" value="First Option" name="Radios" id="Radio33">
				<label for="Radio33"><i aria-hidden="true" class="fa fa-circle-o"></i></label>


				</div>
				</span><span class="no"><div class="group">
				<input type="radio" value="Other Option" name="Radios" id="Radio44">
				<label for="Radio44" class="center"><i aria-hidden="true" class="fa fa-circle-o"></i></label>

				</div></span></li>
				<div class="submit">
						<input type="submit" class="auto" id="submit" value="Save Changes" name="submit">
					</div>
				</form>
				</div></div>


        	
        </div>
      
		
	
@endsection