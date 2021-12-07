@php 
	$segment1 =  Request::segment(2);
	$segment =  Request::segment(1);

@endphp	

<div class="dashlink">
	<ul>
		<li ><a href="{{ route('contributordashboard') }}" @if($segment1 == 'dashboard') class="active" @endif>Dashboard </a></li>
		<li ><a href="{{ route('contributoraccount') }}" @if($segment1 == 'myAccount') class="active" @endif>My Account</a></li>
		<li ><a href="{{ route('contributor-change-password') }}" @if($segment1 == 'changePassword') class="active" @endif>Change Password  </a></li>
		<li ><a href="{{ route('frontendlogout') }}">Logout  </a></li>
	</ul>
</div>