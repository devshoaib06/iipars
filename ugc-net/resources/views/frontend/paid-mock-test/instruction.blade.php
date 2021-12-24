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
                    <h3 class="text-center">{{strtoupper($subject->papers->paper_name)}} {{strtoupper($subject->subject_name)}}</h3>
                    </div>
                <div class="col-12 col-sm-12">
                    <div class="outerleftsection">
                        <div class="highlightsection">
                        <form action="{{route('startPaidExam',['mock_test_id'=>\Hasher::encode($mock_test_id)])}}" method="POST">
                            @csrf
                            <h3>Instruction:</h3>
                            <p>
                                {!! trim(getMockTestSettings('mt_instruction')) !!}
                            </p>
                            @php
                                $duration=$template->duration;
                                $minutes=($duration % 60).' Min';
                                $hours= intdiv($duration, 60).' Hr(s) ';
                                if($minutes>0){
                                    $hours.=$minutes;
                                }
                            @endphp  
                            <ul class="">
                                <li>Total number of questions: <b>{{$noofQuestion}}</b>.</li>
                                {{-- <li>Marks per question: <b>{{$template->marks_per_question}}</b> </li> --}}
                                <li>Time alloted: <b>{{$hours}}</b>.</li>
                                <li>Level: <b>{{implode(', ',$level)}}</b>.</li>
                                <li>Total Marks: <b>{{$fullmarks}}</b>.</li>
                               
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
<script>
    var sbtclicked=0;

    window.history.forward(1);
    document.onkeydown = function(){
    switch (event.keyCode){
            case 116 : //F5 button
                event.returnValue = false;
                event.keyCode = 0;
                return false;
            case 82 : //R button
                if (event.ctrlKey){ 
                    event.returnValue = false;
                    event.keyCode = 0;
                    return false;
                }
               
            case 123 : //R button
                if (event.ctrlKey){ 
                    event.returnValue = false;
                    event.keyCode = 0;
                    return false;
                }    
        }
    }
    if (document.layers) {
        //Capture the MouseDown event.
        document.captureEvents(Event.MOUSEDOWN);
    
        //Disable the OnMouseDown event handler.
        document.onmousedown = function () {
            return false;
        };
    }
    else {
        //Disable the OnMouseUp event handler.
        document.onmouseup = function (e) {
            if (e != null && e.type == "mouseup") {
                //Check the Mouse Button which is clicked.
                if (e.which == 2 || e.which == 3) {
                    //If the Button is middle or right then disable.
                    return false;
                }
            }
        };
    }
    
    //Disable the Context Menu event.
    document.oncontextmenu = function () {
        return false;
    };


    // window.onbeforeunload = function() {
    //     if(sbtclicked==3){
    //             //alert('Are you sure you want to submit test now?');
    //             return;
    //     }
    //     if(sbtclicked==2){
            
    //         return;
    //     }
    //     return "Leave this page ?";
    // }

</script>
@endpush