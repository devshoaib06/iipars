@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')

<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>404</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            <div class="row">
                    {{-- @if(Session::has('message'))                         
                    <div class="{{ Session::get('messageClass') }}">
                        <button class="close" data-close="alert"></button>
                        <span>{{ Session::get('message') }} </span>
                    </div>
                    @endif   --}}

                    {{-- @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif --}}
                <div class="col-12 col-sm-12 col-md-12 error-page text-center">
                    <h1 class="m-0">404</h1>
                @if(Session::has('message'))   
                    <h2>{{Session::get('message')}}</h2>
                @else
                    <h2>Oops, something's went wrong!</h2>
                @endif
                <h3>Don't worry, try below helpful link</h3>
                <p>&nbsp;</p>
                <p><a href="{{ route('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Home</a></p>
                <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>

              {{-- <p>Lorem ipsum dolor sit <span class="text-info">amet</span>, consectetur <span class="text-info">adipisicing</span> elit, sed do eiusmod.</p> --}}
                </div>
                
            </div>
        </div>
    </section>
</section>

@endsection