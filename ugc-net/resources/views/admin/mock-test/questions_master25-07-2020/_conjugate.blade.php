@php
    $j=$k=1;
@endphp
<div class="form-group">
    <label class="col-md-3 control-label"></label>
    <div class="radio-list col-md-4">
        <label class="radio-inline" for="option_type_1">
            Column-I</label>
       
    </div>
    <div class="radio-list col-md-3">
        <label class="radio-inline" for="option_type_1">
            Column-II</label>
       
    </div>
</div>
@forelse ($question->questionOptions as $questionOption)
                                                
    <div class="form-group cloneOpt clonerow">
        <label class="control-label col-md-3">
             Option #{{$j}}
             @if ($j<3)
             <span class="required"> * </span>
            @else   
                <span class="required"> &nbsp; </span> 
            @endif
        
        </label>
        
        <div class="col-md-1">
            <input type="text" name="option_no{{$j}}" class="form-control" {{$j<3?'required':''}}   value="{{$questionOption->serial_no}}"/>
        </div>
        <div class="col-md-3">
            <input type="text" name="option_text{{$j}}" class="form-control" {{$j<3?'required':''}}  value="{{$questionOption->option_text}}"/> 
        </div>
        <div class="col-md-1">
            <input type="text" name="option_col_no{{$j}}" class="form-control"  value="{{$questionOption->other_option_serial_no}}"/> 
        </div>
        <div class="col-md-3">
            <input type="text" name="option_col_text{{$j}}" class="form-control"  value="{{$questionOption->other_option_text}}"/>  
        </div>
        @if ($j>2)
            <div class="col-sm-1 removeBtn"><input class="btn red" type="button" value="-" onclick="removeCloneRow(this)"></div>
            
        @endif
    </div>
   
    @php
        $j++;
    @endphp
@empty
@for ($i = 1; $i <=5; $i++)
    <div class="form-group ">
        <label class="control-label col-md-3">Option #{{$i}}
            @if ($i<3)
                <span class="required"> * </span>
            @else   
                <span class="required"> &nbsp; </span> 
            @endif
        </label>
        
        <div class="col-md-1">
            <input type="text" name="option_no{{$i}}" class="form-control" {{$i<3?'required':''}}  value="{{old('serial_no'.$i)}}"/> 
                
            </div>
        <div class="col-md-3">
        <input type="text" name="option_text{{$i}}" class="form-control" {{$i<3?'required':''}}  value="{{old('options'.$i)}}"/> 
            
        </div>
        <div class="col-md-1">
            <input type="text" name="option_col_no{{$i}}" class="form-control"  value="{{old('serial_no'.$i)}}"/> 
                
            </div>
        <div class="col-md-3">
        <input type="text" name="option_col_text{{$i}}" class="form-control"  value="{{old('options'.$i)}}"/> 
            
        </div>
        
    </div>
        
@endfor

@endforelse
<div id="divopt" class="divopt"></div>
<div class="form-group">
    <div class="control-label col-md-11 text-right">
        <input type="button" value="Add More Option" class="btn green" onclick="addNewConjugateOpt()" />
    </div>
</div>


@forelse ($question->questionAnswers as $questionAnswer)
    
        <div class="form-group cloneans clonerow">
            <label class="control-label col-md-3">Answer #{{$k}}
                @if ($k<3)
                <span class="required"> * </span>
                @else   
                    <span class="required"> &nbsp; </span> 
                @endif
            </label>
            
            <div class="col-md-1">
                <input type="text" name="ans_serial_no{{$k}}" class="form-control" {{$k<3?'required':''}} value="{{$questionAnswer->serial_no}}"/> 
                    
                </div>
            <div class="col-md-5">
            <input type="text" name="answer{{$k}}" class="form-control" {{$k<3?'required':''}} value="{{$questionAnswer->answer}}"/> 
                
            </div>
            <div class="col-md-1">
            <input type="checkbox" name="is_correct{{$k}}" class="form-control is_check" data-val={{$k}}  value="1" {{$questionAnswer->is_correct==1?'checked':''}}/> 
                
            @if ($k>2 && $questionAnswer->is_correct!=1)
           
                <input class="btn red" type="button" value="-" onclick="removeCloneRow(this)">
            @endif
            </div>
            
        </div>
        <div class="form-group ansexp{{$k}} {{$questionAnswer->is_correct==1?'':'is_correct_check'}}"  >
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
        <div class="form-group cloneans">
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
            <input type="checkbox" name="is_correct{{$i}}" class="form-control"  value="1"/> 
                
            </div>
            
        </div>
        <div class="form-group ansexp{{$i}}"  >
            <label class="control-label col-md-3">Answer explanation
                
            </label>
            <div class="col-md-6">
               
                <textarea name="correct_explanation{{$i}}" rows="8" class="form-control" >{{$questionAnswer->correct_explanation}}</textarea>
            </div>
            @if ($errors->has('correct_explanation'))
            <span class="help-block">
                <strong>{{ $errors->first('correct_explanation') }}</strong>
            </span>
            @endif
        </div>
        
    @endfor
@endforelse



