
<div class="col-sm-6">
    <div class="column-1">
        <H4>Column-I</h4>
        <ul>
            @forelse ($question->questionDetails->questionOptions as $option)
            <li><span>{{$option->serial_no}}.</span>{!!$option->option_text!!}</li>
            @empty
            @endforelse
        </ul>
    </div>
</div>
<div class="col-sm-6">
    <div class="column-2">
        <H4>Column-II</h4>
        <ul>
            @forelse ($question->questionDetails->questionOptions as $option)
            <li><span>{{$option->other_option_serial_no}}.</span>{!! $option->other_option_text!!}</li>
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
                @forelse ($question->questionDetails->questionOptions as $option)
                <th>{{$option->serial_no}}</th>
                @empty
                @endforelse
                
            </tr>
            </thead>
            <tbody>
            @forelse ($question->questionDetails->questionAnswers as $answer)  
            @php
                $anwOpts=explode(',',$answer->answer);
            @endphp
            
            <tr>
                <td>
                    <label class="option
                        @if ($question->answer==$answer->serial_no && $question->is_correct==1)
                        {{"right-ans"}}
                        @elseif($question->answer==$answer->serial_no && $question->is_correct==0)
                        {{"wrong-ans"}}
                        @endif
                    "><span>{{$answer->serial_no}}</span>
                        @if ($question->answer==$answer->serial_no && $question->is_correct==1)
                            <i class="fa fa-check-circle"></i>
                        @elseif($question->answer==$answer->serial_no && $question->is_correct==0)
                            <i class="fa fa-times-circle"></i>
                            
                        @endif
                    {{-- <input type="radio" name="answer" value="{{$answer->serial_no}}" {{$question->answer==$answer->serial_no?'checked':''}} >{{$answer->answer}}  --}}
                    </label>
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
