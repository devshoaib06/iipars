
<div class="ans_sect" style="overflow-y: auto; max-height:200px;">
    

@forelse ($allquestions->questionDetails->questionAnswers as $answer)
    <label class="option"><span>{{$answer->serial_no}}</span>
    <input type="radio" name="answer" value="{{$answer->serial_no}}" {{$allquestions->answer==$answer->serial_no?'checked':''}} >{{$answer->answer}} 
    </label>
   
@empty
    <p>No Options</p>
    
@endforelse
</div>



       