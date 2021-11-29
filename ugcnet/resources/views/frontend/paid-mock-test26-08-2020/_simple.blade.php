<div class="qus_ref">
<ul>
@forelse ($allquestions->questionDetails->questionOptions as $option)
    <li><span>{{$option->serial_no}}.</span>  {!! $option->option_text !!}</li>
@empty

@endforelse
</ul>
</div>
<div class="input_check">
@forelse ($allquestions->questionDetails->questionAnswers as $answer)
@php
    $chosen_answer=explode(",",$allquestions->answer);
@endphp
<!-- <label class="option"><span>{{$answer->serial_no}} </span>
</label>
<input type="checkbox" name="answer[]" value="{{$answer->serial_no}}" {{in_array($answer->serial_no,$chosen_answer)?'checked':''}}>{!! $answer->answer !!}  -->
<input id="opt_{{$answer->id}}" type="checkbox" name="answer[]" value="{{$answer->serial_no}}" {{in_array($answer->serial_no,$chosen_answer)?'checked':''}}>
 <label class="option" for="opt_{{$answer->id}}" >
    <div class="d-flex">
        <div><span>{{$answer->serial_no}}</span> </div>
        <div style="width:calc(100% - 35px)">{!! $answer->answer !!}</div>
        
    </div>
    
     
    </label>
@empty
    <p>No Options</p>
    
@endforelse

</div>  

       