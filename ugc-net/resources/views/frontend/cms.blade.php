@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')

<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>{{$cms->heading}}</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            <div class="row">
            <div class="col-12 col-sm-12 {{count($mentors)>0?'col-md-9':'col-md-12'}}">
                    <h1>{!! $cms->heading !!}</h1>
                    {!! $cms->description !!}
                </div>
                @if (count($mentors)>0)
                    
                <div class="col-12 col-sm-12 col-md-3">
                    <div class="sidebarCont newsticker-demo">
                        <h3>Our Mentors</h3>
                        <div class="mentorWrap newsticker-jcarousellite">
                            <ul>
                                @forelse ($mentors as $mentor)
                                    <li class="{{$mentor->id}}">
                                        <div class="mentorCont">
                                            <div class="mentorImg">
                                                <img src="{{ Storage::disk(config('disk.get_mentor'))->url($mentor->image) }}" />
                                            </div>
                                            <div class="mentorInfo">
                                                <p>{{$mentor->name}}</p>
                                                <p><em>{{$mentor->qualification}}</em></p>
                                            </div>
                                        </div>
                                    </li>
                                    
                                @empty
                                    
                                @endforelse
                                
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
</section>

@endsection