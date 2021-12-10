@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')
<?php
    $myfunction = new App\library\myFunctions();
    $protocol = $myfunction->getYoutubeProtocol();                                                

?>

@section('page_content')
    <section class="inner-header divider parallax layer-overlay1 overlay-white-8"
        style="background-image: url({{ asset('public/frontend/images/shortbanner.jpg') }}); background-repeat: no-repeat; background-size: 100%; background-position: 0 0; height:200px">

        <div class="container pt-30 pb-30">

            <!-- Section Content -->

            <div class="section-content">



            </div>

        </div>

    </section>
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="{{ config('path.iipars_base_url') }}">Home</a></li>
                <li class="active text-theme-colored">UGC - NET </li>
            </ul>
        </div>
    </section>
    <section class="section-content__innerpage">
        <div class="container ">



            <h1>UGC NET</h1>

            <div class="row">
                @foreach ($papers as $paper)
                    <div class="col-sm-6 col-md-4">
                        <div class="course-details"><img alt=""
                                src="{{ url('public/frontend/images') }}/ugc_net_images/{{ $paper->paper_name }}.jpg"
                                style="height:220px; width:100%">
                            <div class="details-overlay">
                                <h3 class="text-white">{{ $paper->paper_name }}</h3>
                            </div>
                        </div>
                        <div class="unit">
                            <ul>
                                @php
                                    $units = $myfunction->getPaperUnits(1, $paper->id);
                                    
                                @endphp
                                @foreach ($units as $unit)
                                    @php
                                        $courses=$myfunction->getOnlyPaidCourseInfo(1,$paper->id,$unit->subject_id);
                                        $slug=$courses->slug;

                                    @endphp
                                    <li>
                                        <a href="<?= url('/')?>/course/<?= $slug.'/'.$unit->subject_slug;?>">
                                            {{ $unit->subject_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection

@push('page_js')
    <script>
        $("#newsletter-form").validate({
            errorElement: 'span',
            //   errorPlacement: function (error, element) {

            //         error.insertAfter($("#newsletter-form"));

            //  },
            rules: {

                email: {
                    required: true,
                    email: true,
                    remote: {
                        type: 'post',
                        url: "{{ url(route('newsletter-checkEmailExists')) }}",
                        data: {
                            'email': function() {
                                return $('#email').val();
                            },
                            "_token": "{{ csrf_token() }}"
                        }
                    }
                },
            },
            messages: {
                email: {
                    required: 'Email is required.',
                    email: 'Please enter valid email.',
                    remote: 'You are already subscribe.'
                },

            },
            submitHandler: function(form) {
                event.preventDefault();
                //$(".subbut").prop("disabled", true);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let url = "{{ route('insert-newsletter') }}";
                let data = $('#newsletter-form').serialize();
                $.post(url, data, function(response) {
                    //$(".subbut").prop("disabled", false);

                    if (response) {

                        let noti_text = "Thanks for subscription."
                        $('.notification-msg').text(noti_text);
                    } else {
                        let noti_text = "Some thing went wrong."
                        $('.notification-msg').text(noti_text);
                    }
                })

            }

        });

        $('.buy-now-login').click(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let product_id = $(this).data('productid')
            let url = "{{ route('visitor-buy-product') }}";
            let data = {
                product_id: product_id
            }
            $.post(url, data, function(response) {

            })
        })
        $('.login-modal').on('hidden.bs.modal', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let product_id = $(this).data('productid')
            let url = "{{ route('visitor-remove-buy-product') }}";
            $.post(url, function(response) {

            })
        })
    </script>


    @if (isset($banner) && $banner->status == 1)

        <div class="modal fade ad_modal modal-pop">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body ad_image">

                        <div class="close_icon">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img
                                    src="{{ asset('public/frontend/images/cross_icon.png') }}" alt="close"></button>
                        </div>
                        <div class="outerleftsection">
                            @if ($banner->title)
                                <div class="modal-title">
                                    <h2>{{ $banner->title }}</h2>

                                </div>
                            @endif
                            @if ($banner->description)
                                {!! html_entity_decode($banner->description) !!}
                            @endif
                        </div>
                        <div class="popupImg">
                            @if ($banner->image)
                                <img src="{{ asset('storage/uploads/banner/' . $banner->image) }}"
                                    alt="{{ $banner->title }}" style="width: 100%">
                            @endif
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('public/frontend/js/jquery.cookie.js') }}"></script>
        <script>
            $(document).ready(function() {
                if ($.cookie('pop') == null) {
                    $('.ad_modal').modal('show');
                    $.cookie('pop', '1');
                }

                // Check if user saw the modal
                // var key = 'hadModal',
                //     //hadModal = localStorage.getItem(key);
                //     hadModal =Cookies.get(key)
                //     // Show the modal only if new user
                //     if (!hadModal) {
                //         $('.ad_modal').modal('show');
                //     }

                //     // If modal is displayed, store that in localStorage
                //     $('.ad_modal').on('shown.bs.modal', function () {
                //         //localStorage.setItem(key, true);
                //         hadModal=$.cookie(key,1);
                // })


                setTimeout(function() {
                    $('.ad_modal').modal('hide');
                }, 40000);
            });
        </script>
    @endif
@endpush
