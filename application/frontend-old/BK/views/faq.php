


<div class="body-content">
	<div class="container">
		<div class="checkout-box faq-page">
			<div class="row">
				<div class="col-md-12">
					<h2 class="heading-title tc-titel">Frequently Asked Questions</h2>
					<?php 

								$i=0;

								foreach($faq as $row)
								{

									$i++;

					 ?>
					<div class="panel-group checkout-steps" id="accordion">
					
		<!-- checkout-step-01  -->
					<div class="panel panel-default checkout-step-0<?php echo $i; ?>">

						<!-- panel-heading -->
						
							<div class="panel-heading">
					    	<h4 class="unicase-checkout-title">
						        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapse<?php echo $i;?>">
						          <span><?php echo $i; ?></span><?php echo $row->faq_question; ?> ?
						        </a>
						     </h4>
					    </div>
					    <!-- panel-heading -->

						<div id="collapse<?php echo $i;?>" class="panel-collapse collapse<?php if($i=='1'){ echo ' in'; } else{ echo '';} ?>">

							<!-- panel-body  -->
						    <div class="panel-body">

						    <?php echo $row->faq_answer; ?>
						    		
							</div>
							<!-- panel-body  -->

						</div><!-- row -->
					</div>

					  
					  	
					</div><!-- /.checkout-steps -->
					<?php } ?>
					
				</div>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
		
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->












