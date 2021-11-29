<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
  <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            theme: "modern",
            menubar: "edit insert tools",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern imagetools"
            ],
            toolbar1: "undo redo | styleselect | bold italic| forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | link preview",
            image_advtab: true,
            extended_valid_elements : "span[*],i[*]",
            relative_urls : false,
            remove_script_host : false,
            convert_urls : true
        });
    </script>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Appointment Background
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>index.php/admin_dashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard</a></li>
            <li class="active"></i>Appointment Background</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <!--<div class="box-header">
                        <h3 class="box-title" style="margin-left:15px"> </h3>
                    </div>-->
                    <!-- /.box-header -->
                    <div class="box-body pad">
                        <?php
                                if($this->session->flashdata('image_error')!="")
                                {
                                    ?>
                                    <span style="color:red"><?php echo $this->session->flashdata('image_error'); ?></span>
                        <?php }?>
                        <form action="<?php echo base_url()?>index.php/admin_appointment/appointment_background_submit" class="form-horizontal" id="main" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="app_header_text" class="col-sm-2 control-label text-center">Appointment Header</label>
                                <div class="col-sm-10">
                                   <textarea id="app_header_text" name="app_header_text" rows="10" cols="80">
                                        <?php echo @$app[0]->app_header; ?>
                                    </textarea>
                                </div>
                            </div> 
                            <div class="clearfix"></div>
                        <div class="col-sm-12">
                         <div class="col-sm-4">
                               <div class="form-group" style="margin-top: 10px;">
                                        <label for="bg_img_upload" class="col-sm-3 control-label text-center">Appointment background</label>
                                        <div class="col-sm-7">resolution:(1600 x 192) px
                                            <input type="file"  name="bg_img_upload" id="bg_img_upload" onchange="bg_img(this);">
                                            <?php 
                                                if(@$app[0]->app_bg!="")
                                                {
                                            ?>
                                            <img id="bg_pic" src="<?php echo base_url()?>../uploads/app/<?php echo @$app[0]->app_bg; ?>"  alt="User Image" style="margin-top: 10px;width:100px;height:100px;" />
                                            <?php 
                                            }
                                            else
                                            {
                                                ?>
                                                 <img id="bg_pic" src="<?php echo base_url()?>../uploads/no-image.jpg"  alt="User Image" style="margin-top: 10px;width:100px;height:100px;" />
                                            <?php }?>
                                        </div>
                                </div> 
                            </div>
                           <!--  <div class="col-sm-4">
                               <div class="form-group" style="margin-top: 10px;">
                                        <label for="man_img_upload" class="col-sm-3 control-label text-center">Blog background man</label>
                                        <div class="col-sm-7">resolution:(1600 x 800) px
                                            <input type="file"  name="man_img_upload" id="man_img_upload" onchange="man_img(this);">
                                            <?php 
                                                if(@$blog[0]->bg_man!="")
                                                {
                                            ?>
                                            <img id="man_pic" src="<?php echo base_url()?>../uploads/blog_bg/<?php echo @$blog[0]->bg_man; ?>"  alt="User Image" style="margin-top: 10px;width:100px;height:100px;" />
                                            <?php 
                                            }
                                            else
                                            {
                                                ?>
                                                 <img id="man_pic" src="<?php echo base_url()?>../uploads/no-image.jpg"  alt="User Image" style="margin-top: 10px;width:100px;height:100px;" />
                                            <?php }?>
                                        </div>
                                </div> 
                            </div> -->
                        </div>
                            <div class="box-footer">
                            <a href="<?php echo base_url()?>index.php/Admin_dashboard" class="btn btn-danger" style="margin-top: 8px;margin-left:10px">Cancel</a>

                            <input type="submit" class="btn btn-primary" value="Save changes" style="margin-top: 8px;margin-right:10px">
                            </div>

                            <input type="hidden" name="app_bg" value="<?php echo @$app[0]->app_bg; ?>">

                            <div class="clearfix"></div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script>
function bg_img(input)
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#bg_pic')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>



