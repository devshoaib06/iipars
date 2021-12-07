<!-- Start main-content -->
  <div class="main-content">

    
    
    <section class="checkout-sec">
		<div class="container">
			<div class="col-lg-8 col-lg-12">
                <div class="billing-details">
                  <h3 class="mb-30">Customer Information</h3>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="checkuot-form-fname">First Name</label>
                      <input id="checkuot-form-fname" type="email" class="form-control" placeholder="First Name" value="<?php echo @$user_details[0]->first_name; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="checkuot-form-lname">Last Name</label>
                      <input id="checkuot-form-lname" type="email" class="form-control" placeholder="Last Name" value="<?php echo @$user_details[0]->last_name; ?>">
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="checkuot-form-email">Email Address</label>
                        <input id="checkuot-form-email" type="email" class="form-control" placeholder="Email Address" value="<?php echo @$user_details[0]->login_email; ?>">
                      </div>
                      <div class="form-group">
                        <label for="checkuot-form-address">Address</label>
                        <input id="checkuot-form-address" type="email" class="form-control" placeholder="Street address" value="<?php echo @$user_details[0]->address; ?>">
                      </div>
                      <div class="form-group">
                        <input type="email" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="checkuot-form-city">City</label>
                      <input id="checkuot-form-city" type="email" class="form-control" placeholder="City" value="<?php echo @$user_details[0]->city; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="checkuot-form-zip">Zip/Postal Code</label>
                      <input id="checkuot-form-zip" type="email" class="form-control" placeholder="Zip/Postal Code" value="<?php echo @$user_details[0]->zip_postal_code; ?>">
                    </div>
                    <div class="form-group col-lg-12">
                      <label>State</label>
                      <select name="state" id="state" class="form-control">
                      	<option value="">Choose State</option>
                      	<?php foreach($state as $s) { ?>
						<option value="<?php echo $s->id; ?>"<?php if($s->id==@$user_details[0]->state_id){echo 'selected';} ?>><?php echo $s->name; ?></option>

					<?php } ?>
				
						</select>
                    </div>
                  </div>
                </div>
              </div>
			  <div class="col-lg-4 col-lg-12">
				<div class="ord-sum">
					<h3>Order Summary</h3>
					<div class="sum-dtl">
						<ul>
							<li>
								<div class="lt-summ">
									<?php echo @$package[0]->package_name; ?>
								</div>
								<div class="rt-summ">
									<i class="fa fa-inr" aria-hidden="true"></i><?php echo @$package[0]->price; ?>
								</div>
							</li>
							
							
							<li>
								<div class="lt-summ strong-text">
									Total:
								</div>
								<div class="rt-summ strong-text">
									<i class="fa fa-inr" aria-hidden="true"></i><?php echo @$package[0]->price; ?>
								</div>
							</li>
						</ul>
						<div class="srv-btn">
							<a href="javascript:void(0)" onclick="make_payment('<?php echo @$user_details[0]->user_id; ?>','<?php echo @$package[0]->id; ?>')" class="btn btn-dark btn-sm mt-15">Make Payment</a>
						</div>
					</div>
				</div>
			  </div>
		</div>
	</section>

  </div>
  <!-- end main-content -->






  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>




<!-- <script type="text/javascript">
  function university_list(val,sub,ser)
  {
    // alert(ser);
         // $("#header_id").css("display","block");

 var userid = $("#checkLogin").val();
if(userid == ''){
window.location.href='<?php echo $this->url->link(2); ?>';
}
else
{

   $.ajax({
      url:'<?php echo base_url();?>manage_service/fetch_all_university_data',
      data:{query:val,sub_id:sub,ser_id:ser},
      dataType:'html',
      type:'post',
      success: function(data)
      {
        // alert(data);
         $('#college_list').html(data);
       


         var getCurrentactivebuttonid= $('#activebuttonid').val();
         if(getCurrentactivebuttonid!='')
         {
               $('#btnuni'+getCurrentactivebuttonid).removeClass('p_colorrr');
         }

         $('#btnuni'+val).addClass('p_colorrr');
         $('#activebuttonid').val(val);



      }
    });

}



   
  }
</script> -->



<script type="text/javascript">
  function make_payment(user_id,plan_id)
  {
    // alert(plan_id);

       

         


    $.ajax({
      url:'<?php echo base_url();?>Manage_my_plan/make_payment_package',
      data:{user_id:user_id,plan_id:plan_id},
      dataType:'json',
      type:'post',
      success: function(data)
      {
          

           var perform= data.changedone;

                 if(perform==1)

                 {

                   alert('Payment Successfully Done');

                   location.reload();

                 }

          

              // window.location="<?php echo base_url(); ?>Manage_my_plan/make_payment_package";



      }
    });
  }
</script>