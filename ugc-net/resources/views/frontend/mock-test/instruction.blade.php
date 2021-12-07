@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')

<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Mock Test Instruction</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="outerleftsection">
                        <div class="highlightsection">
                        <form action="{{route('startExam')}}" method="POST">
                            @csrf
                            <h3>Instruction:</h3>
                            <p>
                                {!! trim(getMockTestSettings('mt_instruction')) !!}
                            </p>
                            <ul class="">
                                <li>Total number of questions: <b>{{trim(getMockTestSettings('mt_noofquestion'))}}</b>.</li>
                                <li>Time alloted: <b>{{trim(getMockTestSettings('mt_duration'))}}</b> minute(s).</li>
                               
                            </ul>
                            <button type="submit" class="submitTest btn btn-primary">Start Test</button>
                        </div>
                    </div>   
                </div>
            </div>
            
        </div>
        

    </section>
</section>
@endsection

@push('page_js')

@endpush