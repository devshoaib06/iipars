@php
$excluded_page = ['resellerlogin', 'resellerforgotpassword', 'reseller-sign-up', 'reseller-change-password', 'contributorlogin', 'contributorforgotpassword', 'sign-up'];

@endphp
<footer id="footer" class="footer">

    <div class="container">

        <div class="row border-bottom-black">

            <div class="col-sm-6 col-md-3">

                <div class="widget">

                    <h5 class="widget-title line-bottom">Legal Links</h5>

                    <ul class="list-border">

                        <li><a href="{{ config('path.iipars_base_url') }}/cms/page/privacy_policy">Privacy Policy</a>
                        </li>

                        <li><a href="{{ config('path.iipars_base_url') }}/cms/page/terms-conditions">Terms &
                                Conditions</a></li>

                    </ul>

                </div>

                <div class="widget">

                    <h5 class="widget-title mb-10">Connect With Us</h5>

                    <ul class="styled-icons icon-dark mt-20">



                        <?php
                        // $social= $this->common->select($table_name='tbl_social_link',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                        ?>

                        <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".1s" data-wow-offset="10"><a
                                href="https://www.facebook.com/iipars_ugcnet/" data-bg-color="#3B5998"><i
                                    class="fa fa-facebook"></i></a></li>

                        <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".2s" data-wow-offset="10"><a
                                href="<?php echo @$social[0]->twitter_link; ?>" data-bg-color="#02B0E8"><i class="fa fa-twitter"></i></a>
                        </li>

                        <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".3s" data-wow-offset="10"><a
                                href="<?php echo @$social[0]->instagram_link; ?>" data-bg-color="#05A7E3"><i class="fa fa-skype"></i></a>
                        </li>

                        <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".4s" data-wow-offset="10"><a
                                href="<?php echo @$social[0]->googleplus_link; ?>" data-bg-color="#A11312"><i class="fa fa-google-plus"></i></a>
                        </li>

                        <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".5s" data-wow-offset="10"><a
                                href="<?php echo @$social[0]->youtube_link; ?>" data-bg-color="#C22E2A"><i class="fa fa-youtube"></i></a>
                        </li>

                    </ul>

                </div>

            </div>
            <div class="col-sm-6 col-md-3">

                <div class="widget">

                    <h5 class="widget-title line-bottom">Important Links</h5>

                    <ul class="list-border">

                        <li><a href="{{ config('path.iipars_base_url') }}/cms/page/upcoming_courses">Upcoming
                                Courses</a></li>

                        <!--<li><a href="<?php //echo $this->url->link(14);
?>">Plan</a></li>-->

                    </ul>

                </div>

            </div>

            <div class="col-sm-6 col-md-3">

                <div class="widget">

                    <!--<h5 class="widget-title line-bottom">News</h5>-->

                    <!--<ul class="list-border">

              

              <li><a href="<?php //echo base_url();
?>manage_ebook">Invitation for E-Book</a></li> -->

                    <!--</ul>-->

                </div>

            </div>

            <div class="col-sm-6 col-md-3">

                <div class="widget">
                    <h5 class="widget-title line-bottom">Contact Us</h5>

                    <ul class="list-inline mt-5">



                        <?php
                        
                        // $contact=  $this->common_model->common($table_name = 'tbl_contact', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                        ?>
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-colored2 mr-5"></i> <a
                                class="text-gray" href="#"><?php echo @$contact[0]->primary_email; ?></a> </li>
                        <br>
                        <?php
                        //  $counter = $this->common_model->common($table_name = 'tbl_no_of_visitor', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                        ?>
                        <li class="number_of_view_cls"><span class="number_of_view">No. of
                                Visitor:<?php echo @$counter[0]->count; ?></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom bg-black-222">
        <div class="container pt-10 pb-10 pb-0">
            <div class="row">
                <div class="col-md-7 sm-text-center text-white">
                    <p class="font-13 m-0">Copyright &copy;<?php echo date('Y'); ?> International Institute For
                        Providing Academic And Research Supports. All Rights Reserved</p>
                </div>
                <div class="col-md-5 text-right flip sm-text-center text-white">
                    <div class="widget no-border m-0 company-link">
                        Design By: <a rel="nofollow" href="https://www.exprolab.com/" traget="_blank" rel="">Expro
                            Lab</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</div>
<div class="modal fade login-modal" id="logmod" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-sm vertical-align-center" role="document">
            <div class="modal-content">
                <div class="logincont">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <div class="poplogo"><img src="{{ config('path.iipars_base_url') }}/assets/images/new-aeducation-logo.png" alt="India’s no.1 online study material for UGC NET
                    " /></div>
                    <h2>Login</h2>

                    <form method="post" id="frmx" action="{{ route('loginAction') }}">
                        @csrf
                        <div class="errormsg"></div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remberme"> Remember Me
                            </label>
                        </div>
                        <button type="submit" class="submitbut">Log In</button>


                    </form>

                    <div class="row bottomlink">
                        <div class="col-sm-6"><a href="{{ route('sign-up') }}">Don't have an account? Sign up
                                now</a>
                        </div>
                        <div class="col-sm-6"><a href="javascript:void(0)" data-toggle="modal"
                                data-target=".forget-pass-modal" class="forgetpass">Lost Your Password?</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade forget-pass-modal" id="formod" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-sm vertical-align-center" role="document">
            <div class="modal-content">
                <div class="logincont">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <div class="poplogo"><img src="{{ asset('public/frontend/images/logo.png') }}" alt="India’s no.1 online study material for UGC & CSIR NTA NET/SET/JRF
                    " /></div>
                    <h2>Forget Password</h2>

                    <form method="post" id="forgotp">
                        {{ csrf_field() }}
                        <div class="errormsg"></div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" class="form-control" name="femail" id="femail">
                        </div>

                        <button type="submit" class="submitbut" id="rset">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ------------------Alert------------------------- -->

{{-- <div class="down-banner">
    <div class="down-banner-text">
      SITE IS DOWN FOR REGULAR MAINTENANCE.<br>
      WE WILL BE BACK SOON. PLEASE CHECK THE SITE LATER.
      Your webhost is expired. Please renew it.
    </div>
    

</div> --}}
{{-- <div class="down-banner-expired">
  <div class="down-banner-text">
   
    Your webhost is expired. Please renew it.
  </div>
  

</div> --}}
<!-- ------------------Alert------------------------- -->




<!-- external javascripts -->
<script src="{{ asset('public/frontend/js/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('public/frontend/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
<!-- JS | jquery plugin collection for this theme -->
<script src="{{ asset('public/frontend/js/jquery-plugin-collection.js') }}"></script>

<!-- Revolution Slider 5.x SCRIPTS -->
<script src="{{ asset('public/frontend/js/revolution-slider/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('public/frontend/js/revolution-slider/js/jquery.themepunch.revolution.min.js') }}"></script>

<!-- END REVOLUTION SLIDER -->
<script type="text/javascript">
    var tpj = jQuery;
    var revapi34;
    tpj(document).ready(function() {
        if (tpj("#rev_slider_home").revolution == undefined) {
            revslider_showDoubleJqueryError("#rev_slider_home");
        } else {
            revapi34 = tpj("#rev_slider_home").show().revolution({
                sliderType: "standard",
                jsFileLocation: "assets/js/revolution-slider/js/",
                sliderLayout: "fullwidth",
                dottedOverlay: "none",
                delay: 9000,
                navigation: {
                    keyboardNavigation: "on",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation: "off",
                    onHoverStop: "on",
                    touch: {
                        touchenabled: "on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    },
                    arrows: {
                        style: "zeus",
                        enable: true,
                        hide_onmobile: true,
                        hide_under: 600,
                        hide_onleave: true,
                        hide_delay: 200,
                        hide_delay_mobile: 1200,
                        tmp: '<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
                        left: {
                            h_align: "left",
                            v_align: "center",
                            h_offset: 30,
                            v_offset: 0
                        },
                        right: {
                            h_align: "right",
                            v_align: "center",
                            h_offset: 30,
                            v_offset: 0
                        }
                    },
                    bullets: {
                        enable: true,
                        hide_onmobile: true,
                        hide_under: 600,
                        style: "metis",
                        hide_onleave: true,
                        hide_delay: 200,
                        hide_delay_mobile: 1200,
                        direction: "horizontal",
                        h_align: "center",
                        v_align: "bottom",
                        h_offset: 0,
                        v_offset: 30,
                        space: 5,
                        tmp: '<span class="tp-bullet-img-wrap"><span class="tp-bullet-image"></span></span>'
                    }
                },
                viewPort: {
                    enable: true,
                    outof: "pause",
                    visible_area: "80%"
                },
                responsiveLevels: [1240, 1024, 778, 480],
                gridwidth: [1240, 1024, 778, 480],
                gridheight: [350, 350, 300, 350],
                lazyType: "none",
                parallax: {
                    type: "scroll",
                    origo: "enterpoint",
                    speed: 400,
                    levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50],
                },
                shadow: 0,
                spinner: "off",
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                shuffle: "off",
                autoHeight: "off",
                hideThumbsOnMobile: "off",
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: "off",
                    nextSlideOnWindowFocus: "off",
                    disableFocusListener: false,
                }
            });
        }
    }); /*ready*/
</script>
<!-- END REVOLUTION SLIDER -->


<!-- Footer Scripts -->
<!-- JS | Custom script for all pages -->
<script src="{{ config('path.iipars_base_url') }}/assets/js/custom.js"></script>


<script type="text/javascript"
src="{{ asset('public/frontend/js/revolution-slider/js/extensions/revolution.extension.actions.min.js') }}">
</script>
<script type="text/javascript"
src="{{ asset('public/frontend/js/revolution-slider/js/extensions/revolution.extension.carousel.min.js') }}">
</script>
<script type="text/javascript"
src="{{ asset('public/frontend/js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js') }}">
</script>
<script type="text/javascript"
src="{{ asset('public/frontend/js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js') }}">
</script>
<script type="text/javascript"
src="{{ asset('public/frontend/js/revolution-slider/js/extensions/revolution.extension.migration.min.js') }}">
</script>
<script type="text/javascript"
src="{{ asset('public/frontend/js/revolution-slider/js/extensions/revolution.extension.navigation.min.js') }}">
</script>
<script type="text/javascript"
src="{{ asset('public/frontend/js/revolution-slider/js/extensions/revolution.extension.parallax.min.js') }}">
</script>
<script type="text/javascript"
src="{{ asset('public/frontend/js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js') }}">
</script>
<script type="text/javascript"
src="{{ asset('public/frontend/js/revolution-slider/js/extensions/revolution.extension.video.min.js') }}">
</script>
<script type="text/javascript" src="{{ asset('public/frontend/js/jquery.simpleTicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/frontend/js/owl.carousel.js') }}"></script>

<!--code for ticker-->
<script type="text/javascript">
    $(document).ready(function() {

        $.simpleTicker($("#newsTicker"), {
            speed: 1000,
            delay: 4000,
            easing: 'swing',
            effectType: 'roll'
        });
    });
</script>

<script>
    $(document).ready(function() {
        var owl = $('.owl-carousel2');
        owl.owlCarousel({
            rtl: false,
            margin: 0,
            nav: true,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            loop: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        })
    })
</script>
<script type="text/javascript">
    $("#frmx").validate({
        errorElement: 'span',
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
        },
        messages: {
            email: {
                required: 'Email is required.',
                email: 'Please enter valid email.'
            },
            password: {
                required: 'Password is required.'
            },

        },
        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let url = "{{ url('userlogin') }}";
            let data = $('#frmx').serialize();
            $.post(url, data, function(response) {

                if (response.status == false) {
                    let html = '<div class="alert alert-danger">';
                    html += response.msg;
                    html += '</div>';

                    $('.errormsg').html(html);
                } else if (response.status == true && response.redirecturl == 'billing') {
                    window.location.replace(response.redirecturl);
                } else if (response.status == true) {
                    window.location.replace(response.redirecturl);

                } else {

                    let html = '<div class="alert alert-danger">';
                    html += 'Something went wrong.';
                    html += '</div>';

                    $('.errormsg').html(html);
                }
            })

        }
    });

    $('.mock-test-login').click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //let mock_test=$(this).data('productid')
        let url = "https://teachinns.com/ajax-mocktest-login";

        $.post(url, function(response) {

        })
    })
</script>

<script type="text/javascript">
    $("#forgotp").validate({
        errorElement: 'span',
        rules: {

            femail: {
                required: true,
                email: true,
                remote: {
                    type: 'post',
                    url: "https://teachinns.com/check-useremail",
                    data: {
                        'email': function() {
                            return $('#femail').val();
                        },
                        "_token": "iJW1h3stAnZR5GqywJ5MdM50JolW97BEZu3xvrap"
                    }
                }
            },
        },
        messages: {
            femail: {
                required: 'Email is required.',
                email: 'Please enter valid email.',
                remote: 'Sorry! this email-id not registered.'
            },

        },
        submitHandler: function(form) {
            event.preventDefault();
            $(".submitbut").prop("disabled", true);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let url = "https://teachinns.com/forget-password";
            let data = $('#forgotp').serialize();
            $.post(url, data, function(response) {
                $(".submitbut").prop("disabled", false);
                console.log(response)
                if (response.status == false) {
                    let html = '<div class="alert alert-danger">';
                    html += response.msg;
                    html += '</div>';

                    $('.errormsg').html(html);
                } else if (response.status == true) {
                    let html = '<div class="alert alert-success">';
                    html += response.message;
                    html += '</div>';
                    $('.errormsg').html(html);

                } else {
                    let html = '<div class="alert alert-danger">';
                    html += "Something went wrong";
                    html += '</div>';
                    $('.errormsg').html(html);

                    //location.reload();
                }
            })

        }

    });
</script>

<script type="text/javascript">
    $('document').ready(function() {
        $('.forgetpass').click(function() {
            $('#logmod').modal('hide');
        });
    });
</script>

@stack('page_js')

</body>

</html>
