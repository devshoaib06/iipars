<!-- Start main-content --> 
  <div class="main-content">

    
    
    <section class="plan-sec">
		<div class="container">
			<div class="row">

				<?php 
				$i=1;
				foreach($package_details as $key=>$row) {

				 ?>

				<div class="col-lg-4 col-md-12">
					<div class="main-plan">
						<div class="plane-name colr-bg-<?php echo $i ; ?>">
							<h3><?php echo $row->package_name ; ?></h3>
						</div>
						<div class="pln-rate colr-tx-<?php echo $i ;?>">
							<p><i class="fa fa-inr" aria-hidden="true"></i><?php echo $row->price; ?><span>/<?php echo $row->package_type; ?></span></p>
						</div>
						<div class="plane-list">
							<ul>
								<?php echo $row->description ; ?>
								<!-- <li><i class="fa fa-check" aria-hidden="true"></i>Lorem Ipsum is simply dummy text</li>
								<li><i class="fa fa-check" aria-hidden="true"></i>of the printing and</li>
								<li><i class="fa fa-check" aria-hidden="true"></i>typesetting industry. Lorem Ipsum</li>
								<li><i class="fa fa-check" aria-hidden="true"></i>has been the industry's standard  </li>
								<li><i class="fa fa-check" aria-hidden="true"></i>when an unknown printer</li> -->
							</ul>
						</div>
						<div class="choose-btn">
							<a href="<?php  echo $this->url->link(9);?>?id=<?php echo $row->id; ?>" class="btn btn-dark colr-bg-<?php echo $i ;?> btn-sm">Choose Plan</a>
						</div>
					</div>
				</div>

			<?php 
			$i++;
		} ?>


				<!-- <div class="col-lg-4 col-md-12">
					<div class="main-plan">
						<div class="plane-name colr-bg-2">
							<h3>Half Yearly Plan</h3>
						</div>
						<div class="pln-rate colr-tx-2">
							<p><i class="fa fa-inr" aria-hidden="true"></i>2500<span>/half yearly</span></p>
						</div>
						<div class="plane-list">
							<ul>
								<li><i class="fa fa-check" aria-hidden="true"></i>Lorem Ipsum is simply dummy text</li>
								<li><i class="fa fa-check" aria-hidden="true"></i>of the printing and</li>
								<li><i class="fa fa-check" aria-hidden="true"></i>typesetting industry. Lorem Ipsum</li>
								<li><i class="fa fa-check" aria-hidden="true"></i>has been the industry's standard  </li>
								<li><i class="fa fa-check" aria-hidden="true"></i>when an unknown printer</li>
							</ul>
						</div>
						<div class="choose-btn">
							<a href="checkout.html" class="btn btn-dark colr-bg-2 btn-sm">Choose Plan</a>
						</div>
					</div>
				</div> -->

				<!-- <div class="col-lg-4 col-md-12">
					<div class="main-plan">
						<div class="plane-name colr-bg-3">
							<h3>Annually Plan</h3>
						</div>
						<div class="pln-rate colr-tx-3">
							<p><i class="fa fa-inr" aria-hidden="true"></i>5000<span>/yearly</span></p>
						</div>
						<div class="plane-list">
							<ul>
								<li><i class="fa fa-check" aria-hidden="true"></i>Lorem Ipsum is simply dummy text</li>
								<li><i class="fa fa-check" aria-hidden="true"></i>of the printing and</li>
								<li><i class="fa fa-check" aria-hidden="true"></i>typesetting industry. Lorem Ipsum</li>
								<li><i class="fa fa-check" aria-hidden="true"></i>has been the industry's standard  </li>
								<li><i class="fa fa-check" aria-hidden="true"></i>when an unknown printer</li>
							</ul>
						</div>
						<div class="choose-btn">
							<a href="checkout.html" class="btn btn-dark colr-bg-3 btn-sm">Choose Plan</a>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</section>

  </div>
 <!-- end main-content  -->







<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>








<script type="text/javascript">
  function package_id(id)
  {
    alert(id);

       

         


    $.ajax({
      url:'<?php echo base_url();?>Manage_my_plan/plan_id',
      data:{plan_id:id},
      dataType:'json',
      type:'post',
      success: function(data)
      {
          // alert(data);

          

              window.location="<?php echo base_url(); ?>Manage_my_plan/checkout";


          

        



      }
    });
  }
</script>


