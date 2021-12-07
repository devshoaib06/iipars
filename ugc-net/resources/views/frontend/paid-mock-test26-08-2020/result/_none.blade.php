
<div class="ans_sect" style="overflow-y: auto; max-height:200px;">


@forelse ($question->questionDetails->questionAnswers as $answer)
    @php
        $correct_opts=[];
        if($answer->is_correct){
            $correct_opts[]=$answer->serial_no;
        }
    @endphp
    
    <label class="option
        @if ($question->answer==$answer->serial_no && $question->is_correct==1)
        {{"right-ans"}}
        @elseif($question->answer==$answer->serial_no && $question->is_correct==0)
        {{"wrong-ans"}}
        @endif
    
    "><span>{{$answer->serial_no}}</span>{!! $answer->answer !!}
        @if ($question->answer==$answer->serial_no && $question->is_correct==1)
            <i class="fa fa-check-circle"></i>
        @elseif($question->answer==$answer->serial_no && $question->is_correct==0)
            <i class="fa fa-times-circle"></i>
            
        @endif
    {{-- <input type="radio" name="answer" value="{{$answer->serial_no}}" {{$question->answer==$answer->serial_no?'checked':''}} >{{$answer->answer}}  --}}
    </label>
   
@empty
    <p>No Options</p>
    
@endforelse
</div>



       