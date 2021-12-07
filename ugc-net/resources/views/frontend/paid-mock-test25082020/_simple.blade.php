<div class="qus_ref">
<ul>
@forelse ($allquestions->questionDetails->questionOptions as $option)
    <li><span>{{$option->serial_no}}.</span>  {{$option->option_text}}</li>
@empty

@endforelse
</ul>
</div>
@forelse ($allquestions->questionDetails->questionAnswers as $answer)
    <label class="option"><span>{{$answer->serial_no}}</span>
    <input type="radio" name="answer" value="{{$answer->serial_no}}" {{$allquestions->answer==$answer->serial_no?'checked':''}}>{{$answer->answer}} 
    </label>
   
@empty
    <p>No Options</p>
    
@endforelse



       