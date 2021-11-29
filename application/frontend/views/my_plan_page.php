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
						<h2>My Plan</h2>
						
						<div class="prof-name-wrap">
							<div class="table-wrap-renew">
							<table class="table table-bordered">
								<thead>
								  <tr>
									<th>Plane name</th>
									<th>Subscription date</th>
									<th>Expiry Date</th>
									<th>Renew Now</th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>Monthly Plan</td>
									<td>23/06/2020</td>
									<td>29/06/2020</td>
									<td><a class="btn btn-dark btn-sm" href="<?php  echo $this->url->link(9);?>">Renew Plan</a></td>
								  </tr>
								</tbody>
							  </table>
							  </div>
						</div>
					</div>
					<!-- <div class="row for-renew">
						<div class="col-lg-6 col-md-12">
							<div class="plane-name colr-bg-1">
								<h3>Monthly Plan</h3>
							</div>
							<div class="pln-date colr-tx-1">
								<p>Expairy Date<span>23/06/2020</span></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-12">
							<div class="renew-pln">
								<div class="renew-pln-btn">
									<div class="choose-btn">
										<a href="#" class="btn btn-dark colr-bg-1 btn-sm">Renew Plan</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row for-renew">
						<div class="col-lg-6 col-md-12">
							<div class="plane-name colr-bg-2">
								<h3>Half Yearly Plan</h3>
							</div>
							<div class="pln-date colr-tx-2">
								<p>Expairy Date<span>23/06/2020</span></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-12">
							<div class="renew-pln">
								<div class="renew-pln-btn">
									<div class="choose-btn">
										<a href="#" class="btn btn-dark colr-bg-2 btn-sm">Renew Plan</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row for-renew">
						<div class="col-lg-6 col-md-12">
							<div class="plane-name colr-bg-3">
								<h3>Annually Plan</h3>
							</div>
							<div class="pln-date colr-tx-3">
								<p>Expairy Date<span>23/06/2020</span></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-12">
							<div class="renew-pln">
								<div class="renew-pln-btn">
									<div class="choose-btn">
										<a href="#" class="btn btn-dark colr-bg-3 btn-sm">Renew Plan</a>
									</div>
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</section>

  </div>
  <!-- end main-content -->