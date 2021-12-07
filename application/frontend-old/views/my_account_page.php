<!-- Start main-content -->
  <div class="main-content">

    
    
    <section class="acc-sec">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-12">
					<div class="acc-lt-panel">
						<div class="user-name">
							<h3><?php echo @$user_details[0]->first_name." ".@$user_details[0]->last_name;?></h3>
							<p><?php echo @$user_details[0]->login_email;?></p>
						</div>
						<div class="prof-tab">
							<ul>
								<li <?php if($active=='profile') { ?> class="prof-active" <?php } ?>><a href="<?php  echo $this->url->link(5);?>">Profile Update</a></li>
                                <li <?php if($active=='my_plan') { ?> class="prof-active" <?php } ?>><a href="<?php  echo $this->url->link(8);?>">My Plan</a></li>
                                
                                <li <?php if($active=='reset_psw') { ?> class="prof-active" <?php } ?>"><a href="<?php  echo $this->url->link(7);?>">Reset Password</a></li>
                                <li><a href="<?php  echo $this->url->link(6);?>">Logout</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-md-12">
					<div class="acc-rt-panel">
						<h2>My Account</h2>
						<div class="prof-name-wrap">
							<ul>
								<li>
									<div class="name-wrap-lt">
										Name:
									</div>
									<div class="name-wrap-rt">
										<?php echo @$user_details[0]->first_name." ".@$user_details[0]->last_name;?>
									</div>
								</li>
								<li>
									<div class="name-wrap-lt">
										Email:
									</div>
									<div class="name-wrap-rt">
										<?php echo @$user_details[0]->login_email;?>
									</div>
								</li>
								<li>
									<div class="name-wrap-lt">
										Phone No:
									</div>
									<div class="name-wrap-rt">
										<?php
											if(@$user_details[0]->mobile!="")
											{
												echo @$user_details[0]->mobile;
											}
											else
											{
												echo "N/A";
											}

										?>
									</div>
								</li>
								<li>
									<div class="name-wrap-lt">
										Address:
									</div>
									<div class="name-wrap-rt">
										 <?php
											if(@$user_details[0]->address!="")
											{
												echo @$user_details[0]->address;
											}
											else
											{
												echo "N/A";
											}

										?>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

  </div>
  <!-- end main-content -->