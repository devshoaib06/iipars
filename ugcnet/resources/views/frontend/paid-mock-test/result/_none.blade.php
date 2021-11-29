
<div class="ans_sect" style="overflow-y: auto; max-height:200px;">

    <div class="input_check">
@forelse ($question->questionDetails->questionAnswers as $answer)
    @php
        $stanswers=explode(",",$question->answer);
        $correct_opts=[];
        if($answer->is_correct){
            $correct_opts[]=$answer->serial_no;
        }
    @endphp
    
    <label class="option
    @if (in_array($answer->serial_no,$stanswers) && $answer->is_correct==1)
    {{"right-ans"}}
    @elseif(in_array($answer->serial_no,$stanswers) && $answer->is_correct==0)
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
</div>



       