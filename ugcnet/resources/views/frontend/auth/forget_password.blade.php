@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')

<section class="member-details searchsec">	
<section class="innerpage" >
	<div class="container">
		<?php if(Session::has('msg')) { ?>
			<div class="alert <?php if(Session::has('msg_class')) echo Session::get('msg_class'); ?>">
				{{ Session::get('msg') }}
			</div>
		<?php } ?>
		<div class="logindiv">
			<h1>Forget Password</h1>
			<form name="frm" id="frmx" action="{{ route('forget_password_action') }}" method="post">
			{{ csrf_field() }}
			  <div class="form-group">
			    <input type="text" name="email" class="form-control" placeholder="Enter registered email-id">
			  </div>
			  
			  <button type="submit" class="loginbutton">Reset Password</button>
			  <div class="loginbotton">
			  	Don't have an account? 
			  	<a href="{{ route('registration_page') }}">Sign up</a>
			  </div>
			</form>
		</div>
	</div>
</section>
</section>

@stop
@push('page_js')
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>

<script type="text/javascript">

jQuery.validator.addMethod("lettersonly", function(value, element) {
	return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "Only alphabetical characters");

$("#frmx").validate({
	errorElement: 'span',
	rules: {

		email:{
			required: true,
			email: true
		}

	},
	messages: {

		email:{
			required: 'Please enter email-id',
			email: 'Please enter valid email-id'
		}

	}
});
</script>
@endpush