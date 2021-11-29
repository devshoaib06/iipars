@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')


<section class="member-details searchsec bodycont">	
<section class="innerpage" >
	<div class="container">
		<?php if(Session::has('msg')) { ?>
			<div class="alert <?php if(Session::has('msg_class')) echo Session::get('msg_class'); ?>">
				{{ Session::get('msg') }}
			</div>
		<?php } ?>
		<div class="resetdiv">
			<h1>Reset new password</h1>
			<form name="frm" id="resetform" action="{{ route('reset_password_action') }}" method="post">
			{{ csrf_field() }}
			  
			  <div class="form-group">
			    <input type="password" name="password" id="password" class="form-control" placeholder="Choose a Password">
			  </div>
			  <div class="form-group">
			    <input type="password" name="re_password" class="form-control" placeholder="Confirm Password">
			  </div>
			  <button type="submit" class="btn resetbutton ">RESET</button>
			  @if($user)
			  <div class="loginbotton">
				  Already have an account?  
				  @if($user->user_type_id==2)
					  <a href="#" class="btn btn-primary" data-toggle="modal" data-target=".login-modal">login</a>
					  @elseif($user->user_type_id==3)
			  			<a href="{{route('contributorlogin')}}" class="btn btn-primary" >login</a>
				  @endif	
			  </div>
			  @endif
			  <input type="hidden" name="verify_token" value="<?php if(isset($token)) echo $token; ?>">

			</form>
		</div>
	</div>
</section>
</section>

@endsection


@push('page_js')
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

<script type="text/javascript">

jQuery.validator.addMethod("lettersonly", function(value, element) {
	return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "Only alphabetical characters");

$("#resetform").validate({
	errorElement: 'span',
	rules: {

		password:{
			required: true,
			minlength: 6
		},
		re_password:{
			required: true,
			equalTo: '#password'
		}
	},
	messages: {

		password:{
			required: 'Password is required.',
			minlength: 'Minimum length is 6'
		},
		re_password:{
			required: 'Confirm password is required.',
			equalTo: 'Password not match.'
		}
	},
	submitHandler: function(form) {
    // do other things for a valid form
    	form.submit();
  	}
});
</script>
@endpush