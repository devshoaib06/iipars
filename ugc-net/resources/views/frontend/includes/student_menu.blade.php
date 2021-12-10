@php 
	$segment1 =  Request::segment(2);
@endphp	

<div class="dashlink">
	<ul>
		<li ><a @if($segment1 == 'dashboard') class="active" @endif href="{{ route('dashboard') }}">Dashboard </a></li>
		{{-- <li ><a @if($segment1 == 'mock-test') class="active" @endif href="{{ route('studentMocktest') }}">Mock Test </a></li> --}}
		<li ><a @if($segment1 == 'myAccount') class="active" @endif href="{{ route('my_account') }}">My Account</a></li>
		<li ><a @if($segment1 == 'orders') class="active" @endif href="{{ route('myOrders') }}">My Orders  </a></li>
		{{-- <li ><a @if($segment1 == 'mock-tests') class="active" @endif href="{{ route('my_mock_tests') }}">My Mock Test  </a></li> --}}
		<li ><a @if($segment1 == 'changePassword') class="active" @endif href="{{ route('change-password') }}">Change Password  </a></li>
	</ul>
</div>