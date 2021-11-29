
<div class="ans_sect" style="overflow-y: auto; max-height:200px;">
 <div class="input_check">
 	@forelse ($allquestions->questionDetails->questionAnswers as $answer)
@php
    $chosen_answer=explode(",",$allquestions->answer);
@endphp
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


</div>



       