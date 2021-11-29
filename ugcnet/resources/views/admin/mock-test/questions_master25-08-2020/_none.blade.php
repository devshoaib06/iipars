@php
    $j=$k=1;
@endphp


@forelse ($question->questionAnswers as $questionAnswer)
    
        <div class="form-group cloneans clonerow"  >
            <label class="control-label col-md-3">Answer #{{$k}}
                @if ($k<3)
                    <span class="required"> * </span>
                @else   
                    <span class="required"> &nbsp; </span> 
                @endif
            </label>
            
            <div class="col-md-1">
                <input type="text" name="ans_serial_no{{$k}}" class="form-control" {{$k<3?'required':''}}  value="{{$questionAnswer->serial_no}}"/> 
                    
                </div>
            <div class="col-md-5">
            <input type="text" name="answer{{$k}}"  class="form-control" {{$k<3?'required':''}}  value="{{$questionAnswer->answer}}"/> 
                
            </div>
            <div class="col-md-1">
            <input type="checkbox" name="is_correct{{$k}}" id="ans_{{$k}}" class="form-control is_check" data-val={{$k}}  value="1" {{$questionAnswer->is_correct==1?'checked':''}}/> 
                
            </div>
            @if ($k>2 && $questionAnswer->is_correct!=1)
            <div class="col-md-1">
                <input class="btn red" type="button" value="-" onclick="removeCloneRow(this)">
            </div>
            
            @endif

            
        </div>
        <div class="form-group ansexp{{$k}} anstext {{$questionAnswer->is_correct==1?'':'is_correct_check'}}"  >
            <label class="control-label col-md-3">Answer explanation
                
            </label>
            <div class="col-md-6">
               
                <textarea name="correct_explanation{{$k}}" rows="8" class="form-control" >{{$questionAnswer->correct_explanation}}</textarea>
            </div>
            @if ($errors->has('correct_explanation'))
            <span class="help-block">
                <strong>{{ $errors->first('correct_explanation') }}</strong>
            </span>
            @endif
        </div>
    @php
        $k++;
    @endphp
@empty

    @for ($i = 1; $i <5; $i++)
        <div class="form-group cloneans" >
            <label class="control-label col-md-3">Answer #{{$i}}
                @if ($i<3)
                    <span class="required"> * </span>
                @else   
                    <span class="required"> &nbsp; </span> 
                @endif
            </label>
            
            <div class="col-md-1">
                <input type="text" name="ans_serial_no{{$i}}" class="form-control"  value="{{old('ans_serial_no'.$i)}}"/> 
                    
                </div>
            <div class="col-md-5">
            <input type="text" name="answer{{$i}}" class="form-control"  value="{{old('answer'.$i)}}"/> 
                
            </div>
            <div class="col-md-1">
            <input type="checkbox" name="is_correct{{$i}}" id="ans_{{$i}}" class="form-control is_check" data-val={{$i}} value="1"/> 
                
            </div>
            <div class="col-sm-1 removeBtn"></div>

            
        </div>
        <div class="form-group ansexp{{$i}} is_correct_check"  >
            <label class="control-label col-md-3">Answer explanation
                
            </label>
            <div class="col-md-6">
               
                <textarea name="correct_explanation{{$i}}" rows="8" class="form-control" ></textarea>
            </div>
            @if ($errors->has('correct_explanation'))
            <span class="help-block">
                <strong>{{ $errors->first('correct_explanation') }}</strong>
            </span>
            @endif
        </div>
        
    @endfor
@endforelse

