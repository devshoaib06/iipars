<!-- Start main-content -->
  <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-white-8" data-bg-img="<?php echo base_url();?>assets/images/books.jpg">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title">Institute</h3>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="#">Home</a></li>
                <li><a href="#">Subject Title</a></li>
                <li class="active text-theme-colored">Institute</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
	<section class="src-section">
		<div class="container">
		<div class="src-wrap">
			<input type="text" class="src-input" placeholder="Search...">
		</div>
		</div>
	</section>
	<section class="serv-tab-sec">
		<div class="container">
			<div class="serv-tab">
				<ul>
					<?php foreach($university as $unv) { ?>

						<li><a href="javascript:void(0)" id="btnuni<?php echo $unv->cc_id;  ?>" onclick="university_list('<?php echo $unv->cc_id;  ?>','<?php echo @$sub_id; ?>','<?php echo $this->session->userdata('service_id'); ?>')"><?php echo $unv->cc_name; ?></a></li>

            <input type="hidden" id="checkLogin" value="<?php echo $this->session->userdata('user_session_id'); ?>">
					<!-- <li><a class="" href="national-lavel-university.html">NATIONAL LEVEL UNIVERSITY </a></li>
					<li><a href="foreign-university.html">FOREIGN UNIVERSITY</a></li>
					<li><a href="autonomus-college.html">AUTONOMUS COLLEGE</a></li>
					<li><a href="research-center.html">RESEARCH CENTRE</a></li>
					<li><a href="journal.html">JOURNAL</a></li> -->

				<?php } ?>
				</ul>
			</div>
		</div>
	</section>

        <!-- <div id="header_id" style="display: none;"><h2 style="text-align: center;">Institute List</h2></div> -->
  
	  
	<section class="srv-tab-open">
		<div class="container">
      <input type="hidden" id="activebuttonid">

			<div class="cl-main col-cnt3" column-count="3" id="college_list">

<!-- 				<a href="service-details.html">Lorem Ipsum is simply</a>
				<a href="service-details.html">dummy text of the printing and</a>
				<a href="service-details.html">Lorem Ipsum has been</a>
				<a href="service-details.html">the industry's standard dummy</a>
				<a href="service-details.html">text ever since the 1500s</a>
				<a href="service-details.html">Lorem Ipsum is simply</a>
				<a href="service-details.html">dummy text of the printing and</a>
				<a href="service-details.html">Lorem Ipsum has been</a>
				<a href="service-details.html">the industry's standard dummy</a>
				<a href="service-details.html">text ever since the 1500s</a>
				<a href="service-details.html">Lorem Ipsum is simply</a>
				<a href="service-details.html">dummy text of the printing and</a>
				<a href="service-details.html">Lorem Ipsum has been</a>
				<a href="service-details.html">the industry's standard dummy</a>
				<a href="service-details.html">text ever since the 1500s</a>
				<a href="service-details.html">Lorem Ipsum is simply</a>
				<a href="service-details.html">dummy text of the printing and</a>
				<a href="service-details.html">Lorem Ipsum has been</a>
				<a href="service-details.html">the industry's standard dummy</a>
				<a href="service-details.html">text ever since the 1500s</a>
				<a href="service-details.html">the industry's standard dummy</a>
				<a href="service-details.html">text ever since the 1500s</a>
				<a href="service-details.html">Lorem Ipsum is simply</a>
				<a href="service-details.html">dummy text of the printing and</a>
				<a href="service-details.html">Lorem Ipsum has been</a>
				<a href="service-details.html">the industry's standard dummy</a>
				<a href="service-details.html">text ever since the 1500s</a>
				<a href="service-details.html">Lorem Ipsum is simply</a>
				<a href="service-details.html">dummy text of the printing and</a>
				<a href="service-details.html">Lorem Ipsum has been</a>
				<a href="service-details.html">the industry's standard dummy</a>
				<a href="service-details.html">text ever since the 1500s</a>
				<a href="service-details.html">Lorem Ipsum is simply</a>
				<a href="service-details.html">dummy text of the printing and</a>
				<a href="service-details.html">Lorem Ipsum has been</a>
				<a href="service-details.html">the industry's standard dummy</a>
				<a href="service-details.html">text ever since the 1500s</a>
				<a href="service-details.html">Lorem Ipsum is simply</a>
				<a href="service-details.html">dummy text of the printing and</a>
				<a href="service-details.html">Lorem Ipsum has been</a>
				<a href="service-details.html">the industry's standard dummy</a>
				<a href="service-details.html">text ever since the 1500s</a>
				<a href="service-details.html">the industry's standard dummy</a>
				<a href="service-details.html">text ever since the 1500s</a>
				<a href="service-details.html">Lorem Ipsum is simply</a>
				<a href="service-details.html">dummy text of the printing and</a>
				<a href="service-details.html">Lorem Ipsum has been</a>
				<a href="service-details.html">the industry's standard dummy</a>
				<a href="service-details.html">text ever since the 1500s</a>
				<a href="service-details.html">Lorem Ipsum is simply</a>
				<a href="service-details.html">dummy text of the printing and</a>
				<a href="service-details.html">Lorem Ipsum has been</a>
				<a href="service-details.html">the industry's standard dummy</a>
				<a href="service-details.html">text ever since the 1500s</a>
				<a href="service-details.html">Lorem Ipsum is simply</a>
				<a href="service-details.html">dummy text of the printing and</a>
				<a href="service-details.html">Lorem Ipsum has been</a>
				<a href="service-details.html">the industry's standard dummy</a>
				<a href="service-details.html">text ever since the 1500s</a>
				<a href="service-details.html">Lorem Ipsum is simply</a>
				<a href="service-details.html">dummy text of the printing and</a>
				<a href="service-details.html">Lorem Ipsum has been</a>
				<a href="service-details.html">the industry's standard dummy</a>
				<a href="service-details.html">text ever since the 1500s</a>
				<a href="service-details.html">the industry's standard dummy</a>
				<a href="service-details.html">text ever since the 1500s</a> -->
				
			</div>
		</div>
	</section>

    <!-- Section: Upcoming Events -->
    <!-- <section id="upcoming-events" class="" data-bg-img="">
      <div class="container pb-50 pt-80">
        <div class="section-content">
          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
              <div class="schedule-box maxwidth500 bg-light mb-30">
                <div class="thumb">
                  <img class="img-fullwidth" alt="" src="images/institute/ins-01.jpg">
                </div>
                <div class="schedule-details clearfix p-15 pt-10">
                  <h5 class="font-16 title"><a href="#">Institute Name</a></h5>
                  <ul class="list-inline font-11 mb-20">
                    <li><i class="fa fa-map-marker mr-5"></i>Kolkata.</li>
                  </ul>
                  <p>Lorem ipsum dolor sit amet elit. Cum veritatis sequi nulla nihil, dolor voluptatum nemo adipisci eligendi! Sed nisi perferendis, totam harum dicta.</p>
                  <div class="mt-10">
                   <a href="#" class="btn btn-dark btn-sm mt-10">Details</a>
                  </div>
                </div>
              </div>
            </div>
			
			<div class="col-sm-6 col-md-6 col-lg-6">
              <div class="schedule-box maxwidth500 bg-light mb-30">
                <div class="thumb">
                  <img class="img-fullwidth" alt="" src="images/institute/ins-02.jpg">
                </div>
                <div class="schedule-details clearfix p-15 pt-10">
                  <h5 class="font-16 title"><a href="#">Institute Name</a></h5>
                  <ul class="list-inline font-11 mb-20">
                    <li><i class="fa fa-map-marker mr-5"></i>Kolkata.</li>
                  </ul>
                  <p>Lorem ipsum dolor sit amet elit. Cum veritatis sequi nulla nihil, dolor voluptatum nemo adipisci eligendi! Sed nisi perferendis, totam harum dicta.</p>
                  <div class="mt-10">
                   <a href="#" class="btn btn-dark btn-sm mt-10">Details</a>
                  </div>
                </div>
              </div>
            </div>
			
			<div class="col-sm-6 col-md-6 col-lg-6">
              <div class="schedule-box maxwidth500 bg-light mb-30">
                <div class="thumb">
                  <img class="img-fullwidth" alt="" src="images/institute/ins-03.jpg">
                </div>
                <div class="schedule-details clearfix p-15 pt-10">
                  <h5 class="font-16 title"><a href="#">Institute Name</a></h5>
                  <ul class="list-inline font-11 mb-20">
                    <li><i class="fa fa-map-marker mr-5"></i>Kolkata.</li>
                  </ul>
                  <p>Lorem ipsum dolor sit amet elit. Cum veritatis sequi nulla nihil, dolor voluptatum nemo adipisci eligendi! Sed nisi perferendis, totam harum dicta.</p>
                  <div class="mt-10">
                   <a href="#" class="btn btn-dark btn-sm mt-10">Details</a>
                  </div>
                </div>
              </div>
            </div>
			
			<div class="col-sm-6 col-md-6 col-lg-6">
              <div class="schedule-box maxwidth500 bg-light mb-30">
                <div class="thumb">
                  <img class="img-fullwidth" alt="" src="images/institute/ins-04.jpg">
                </div>
                <div class="schedule-details clearfix p-15 pt-10">
                  <h5 class="font-16 title"><a href="#">Institute Name</a></h5>
                  <ul class="list-inline font-11 mb-20">
                    <li><i class="fa fa-map-marker mr-5"></i>Kolkata.</li>
                  </ul>
                  <p>Lorem ipsum dolor sit amet elit. Cum veritatis sequi nulla nihil, dolor voluptatum nemo adipisci eligendi! Sed nisi perferendis, totam harum dicta.</p>
                  <div class="mt-10">
                   <a href="#" class="btn btn-dark btn-sm mt-10">Details</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
  </div>
  <!-- end main-content -->

     






<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>




<script type="text/javascript">
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
</script>



<script type="text/javascript">
  function service_details(form_id)
  {
    // alert(form_id);

       

         


    $.ajax({
      url:'<?php echo base_url();?>manage_service/form_id',
      data:{form_id:form_id},
      dataType:'json',
      type:'post',
      success: function(data)
      {
          // alert(data);

          

              window.location="<?php echo base_url(); ?>manage_service/service_details";


          

        



      }
    });
  }
</script>