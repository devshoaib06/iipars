<div class="col-sm-6">
    <div class="column-1">
        <H4>Column-I</h4>
        <ul>
            @forelse ($allquestions->questionDetails->questionOptions as $option)
            <li><span>{{$option->serial_no}}.</span>{!! $option->option_text !!}</li>
            @empty
            @endforelse
        </ul>
    </div>
</div>
<div class="col-sm-6">
    <div class="column-2">
        <H4>Column-II</h4>
        <ul>
            @forelse ($allquestions->questionDetails->questionOptions as $option)
            <li><span>{{$option->other_option_serial_no}}.</span>{!! $option->other_option_text !!}</li>
            @empty
            @endforelse
        </ul>
    </div>
</div>
<div class="cloumn-option" style="overflow-y: scroll;max-height:200px;width: 100%;">
    <table class="table table-bordered">
            <thead>
            <tr>
                <th></th>
                @forelse ($allquestions->questionDetails->questionOptions as $option)
                <th>{{$option->serial_no}}</th>
                @empty
                @endforelse
                
            </tr>
            </thead>
            <tbody>
            @forelse ($allquestions->questionDetails->questionAnswers as $answer)  
            @php
                $anwOpts=explode(',',$answer->answer);
            @endphp
            
            <tr>
                <td>
                    <div class="input_check">    
                        <input type="checkbox" id="opt_{{$answer->id}}" name="answer[]" value="{{$answer->serial_no}}" {{$allquestions->answer==$answer->serial_no?'checked':''}}> 
                        <label class="option" for="opt_{{$answer->id}}"><span>{{$answer->serial_no}}</span></label>
                        
                    </div>
                </td>
                @forelse($anwOpts as $opt)
                    <td>{!! $opt !!}</td>
                @empty
                @endforelse
                
            </tr>
            @empty
                <p>No answer</p>
                
            @endforelse
            
        </tbody>

    </table>

</div>
