
<form id="form_sample_{{$count}}" action="{{route('saveResellerCommission')}}" class="clonerow form-horizontal" method="POST">
    @csrf
<div class="form-group " id="clonerow">
    <div class="control-label col-md-2">
    
    </div>
    
    <div class="col-md-2">
        <input type="number" name="lower_bound" class="form-control lower_bound"  value="{{($slab->upper_bound)+1}}" min=1 oninput="validity.valid||(value='');" readonly  required/> 

    @if ($errors->has('lower_bound'))
    <span class="help-block">
        <strong>{{ $errors->first('lower_bound') }}</strong>
    </span>
    @endif
    </div>
    <div class="col-md-2">
    <input type="number" name="upper_bound" class="form-control upper_bound"  value="" required min=1 oninput="validity.valid||(value='');"  /> 

    @if ($errors->has('upper_bound'))
    <span class="help-block">
        <strong>{{ $errors->first('upper_bound') }}</strong>
    </span>
    @endif
    </div>
    <div class="col-md-2">
        <input type="number" name="commission" class="form-control commission"  value="" required min=1 oninput="validity.valid||(value='');" /> 

    @if ($errors->has('commission'))
    <span class="help-block">
        <strong>{{ $errors->first('commission') }}</strong>
    </span>
    @endif
    </div>
    
    
    <label class="col-md-2 removeBtn">
        
        <button class="btn green save-btn"  type="submit"  ><i class="fa fa-floppy-o" aria-hidden="true"></i></button>

        <button class="btn red"  type="button" onclick="removeRow(this)"><i class="fa fa-trash" aria-hidden="true"></i></button>
    </label>
</div> 
</form>
                                    
                                       