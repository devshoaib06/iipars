<div class="qus_ref">
<ul>
@forelse ($question->questionDetails->questionOptions as $option)
    <li><span>{{$option->serial_no}}.</span>  {!! $option->option_text !!}</li>
@empty

@endforelse
</ul>
</div>
@forelse ($question->questionDetails->questionAnswers as $answer)
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



       