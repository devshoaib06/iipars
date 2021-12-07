@php 
	$segment1 =  Request::segment(2);
	$segment =  Request::segment(1);
@endphp	

<div class="dashlink">
	<ul>
		<li ><a href="{{ route('resellerdashboard') }}" @if($segment1 == 'dashboard' ) class="active" @endif>Dashboard </a></li>
		<li ><a href="{{ route('reselleraccount') }}" @if($segment1 == 'myAccount') class="active" @endif>My Account</a></li>
		<li ><a href="{{ route('reseller-change-password') }}" @if($segment1 == 'change-password') class="active" @endif>Change Password  </a></li>
		<li ><a href="{{ route('frontendlogout') }}">Logout  </a></li>
	</ul>
</div>