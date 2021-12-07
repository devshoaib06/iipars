@extends('admin.layouts.app')

@section('page_title')
	Reseller Commission
@endsection

@section('page_level_plugins_css')
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_css')
@endsection



@section('content')	
    <!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper">
			
			<div class="page-sidebar navbar-collapse collapse">
				
				@include('admin.partials.sidebarMenu')
				
			</div>
			<!-- END SIDEBAR -->
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<!-- BEGIN CONTENT BODY -->
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<!-- BEGIN THEME PANEL -->
				@include('admin.partials.theme')
				<!-- END THEME PANEL -->
				<!-- BEGIN PAGE BAR -->
				<div class="page-bar">
				
				<div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet light portlet-fit portlet-form bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-user "></i>
                                    <span class="caption-subject  sbold ">	Reseller Commission

                                    </span>
                                </div>
                                
                            </div>
                            
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                               

                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>


                                        @if(Session::has('message'))                         
                                        <div class="{{ Session::get('messageClass') }}">
                                            <button class="close" data-close="alert"></button>
                                            <span>{{ Session::get('message') }} </span>
                                        </div>
                                        @endif  
                                        <div class="alert alert-success showmsg" style="display: none">
                                            <button class="close" data-close="alert"></button>
                                            <span class="msg"></span>
                                        </div>
                                        <!--profile pic-->
                                        
                                        
                                        

                                        <form id="form_sample_0" class="form-horizontal" >
                                            {!! csrf_field() !!}
                                        <div class="form-group">
                                            <div class="control-label col-md-2">
                                               
                                            </div>
                                            <div class="col-md-2">Lower Bound</div>
                                            <div class="col-md-2">Upper Bound</div>
                                            <div class="col-md-2">Commission (%)</div>
                                            
                                        </div>
                                        </form>
                                        @php
                                            $j=1;
                                            $total_row=count($slabs);
                                        @endphp

                                        @forelse ($slabs as $slab)
                                        <form id="form_sample_{{$j}}" action="{{route('updateResellerCommission')}}" method="POST" class="form-horizontal clonerow" >
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="id" value="{{$slab->id}}">
                                            <div class="form-group " id="clonerow{{$j}}">
                                                <div class="control-label col-md-2">
                                                
                                                </div>
                                                
                                                <div class="col-md-2">
                                                    <input type="number" name="lower_bound" class="form-control lower_bound" readonly  value="{{$slab->lower_bound}}" min=1 oninput="validity.valid||(value='');" /> 

                                                @if ($errors->has('lower_bound'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('lower_bound') }}</strong>
                                                </span>
                                                @endif
                                                
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" name="upper_bound" class="form-control upper_bound" {{$j>=$total_row?'':'readonly'}} value="{{$slab->upper_bound}}" min=1 oninput="validity.valid||(value='');" /> 

                                                @if ($errors->has('upper_bound'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('upper_bound') }}</strong>
                                                </span>
                                                @endif
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" name="commission" class="form-control commission"   value="{{$slab->commission}}" required min=1 oninput="validity.valid||(value='');" /> 

                                                @if ($errors->has('commission'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('commission') }}</strong>
                                                </span>
                                                @endif
                                                </div>
                                                
                                                
                                                @if ($j>=$total_row)
                                                    
                                                <label class="col-md-2 removeBtn">
                                                    <button class="btn green update-btn"   type="submit" data-val="{{$slab->id}}" ><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                                    <button class="btn red delete-btn"  type="button " data-val="{{$slab->id}}" ><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    
                                                </label>
                                                @else
                                                <label class="col-md-1 removeBtn">

                                                    <button class="btn green update-btn"  type="submit" data-val="{{$slab->id}}" ><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                                </label>
                                                
                                                @endif

                                            </div>
                                            @php
                                                $j++;
                                            @endphp 
                                            </form>  
                                        @empty
                                        <div class="form-group clonerow" >
                                            <div class="control-label col-md-2">
                                            
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <input type="text" name="lower_bound" class="form-control lower_bound"  value=""/> 

                                            @if ($errors->has('lower_bound'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('lower_bound') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="upper_bound " class="form-control upper_bound"  value=""/> 

                                            @if ($errors->has('upper_bound'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('upper_bound') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="commission" class="form-control commission"  value=""/> 

                                            @if ($errors->has('commission'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('commission') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                            
                                            
                                            <label class="col-md-2 removeBtn">
                                                {{-- <button class="btn red"  type="button" onclick="removeRow(this)"><i class="fa fa-trash" aria-hidden="true"></i></button> --}}
                                                <button class="btn green save-btn"  type="button" ><i class="fa fa-floppy-o" aria-hidden="true"></i></button>

                                            </label>
                                           
                                        </div> 
                                        @endforelse
                                        <div id="divitems">
                                        </div>
                                        <div class="form-group">
                                            <div class="control-label col-md-8 text-right">
                                                <input type="button" value="Add More" class="btn green addnewrow" data-val="1" />
                                            </div>

                                        
                                        </div> 
                                       
                                       
                                        {{-- <div class="form-group">
                                            <label class="control-label col-md-2">Status <span class="required"> * </span></label>
                                            <div class="col-md-8">

                                                <div class="radio-list">
                                                    <label class="radio-inline" for="status-inline-radio3">
                                                        <input id="status-inline-radio3" type="radio" value="1" name="status"  > Active</label>
                                                    <label class="radio-inline" for="status-inline-radio4">
                                                        <input id="status-inline-radio4" type="radio" value="0" name="status" {{$banner->status==0?'checked':''}}> Inactive</label>
                                                </div>
                                            </div> 

                                        </div>  --}}
                                       
                                       

                                        
                                        
                                    </div>
                                    {{-- <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-2 col-md-9">
                                                <button type="submit" class="btn green">Submit</button>
                                                
                                            </div>
                                        </div>
                                    </div> --}}
                                {{-- </form> --}}
                                <!-- END FORM-->
                            </div>
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>
			</div>
			<!-- END CONTENT BODY -->
		</div>
		<!-- END CONTENT -->
		<!-- BEGIN QUICK SIDEBAR -->            
		@include('admin.partials.quickSidebar')
		<!-- END QUICK SIDEBAR -->
	</div>    
    <!-- END CONTAINER -->
@endsection


@section('page_level_plugins')
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script src="{{config('path.assets_path')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript" ></script>
<script src="public/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>

@endsection

@section('page_level_scripts')
@for ($count=1;$count<count($slabs);$count++)
<script>
    $(document).ready(function(){
        $('#form_sample_'+{{$count}}).validate();
        
    })
</script>
@endfor
<script type="text/javascript">

var $i=$k=1;

$('body').on('click','.addnewrow',function(){
    
    let url="{{route('nextSlabRow')}}";
    var noofrows=$('.clonerow').length;
    let data={
        noofrows:noofrows,
        _token:"{{ csrf_token() }}"
    };
    $.post(url,data,function(res){
        $('#divitems').append(res.html);
        $('#form_sample_'+(noofrows+1)).validate();

    })

});

$('body').on('click','.save-btn',function(event){
    // debugger;
    event.preventDefault();
    let parent_row=$(this).parents(".clonerow");
    let form_id=parent_row.attr('id');

    let lower_bound=parent_row.find('.lower_bound').val();
    let upper_bound=parent_row.find('.upper_bound').val();
    let commission=parent_row.find('.commission').val();
    if(upper_bound<=lower_bound){
        alert('Please enter value greater than lower bound. ');
        return ;
    }
    $("#"+form_id).valid();
    
    let data={
        lower_bound:lower_bound,
        upper_bound:upper_bound,
        commission:commission,
        _token:"{{ csrf_token() }}"

    }
    let url="{{route('saveResellerCommission')}}";
    // $.post(url,data,function(res){
    //     if(res.success){
    //         $('.showmsg').show();
    //         $('.msg').text(res.msg);
    //     }

    // });

});
$('body').on('click','.update-btn',function(event){
    debugger;
    // event.preventDefault();

    let parent_row=$(this).parents(".clonerow");
    let form_id=parent_row.attr('id');
    let id=$(this).data('val');
    let lower_bound=parent_row.find('.lower_bound').val();
    let upper_bound=parent_row.find('.upper_bound').val();
    let commission=parent_row.find('.commission').val();
    if(upper_bound<=lower_bound){
        alert('Please enter value greater than lower bound. ');
        return false ;
    }
    $("#"+form_id).valid();
    if($("#"+form_id).valid()){

        

        return;
    }

});

$('body').on('click','.delete-btn',function(event){
    
    event.preventDefault();
    let parent_row=$(this).parents(".clonerow");
    let form_id=parent_row.attr('id');

    let id=$(this).data('val');
    
    let data={
        id:id,
        _token:"{{ csrf_token() }}"

    }
    let url="{{route('deleteSlab')}}";
    $.post(url,data,function(res){
        if(res.success){
            $('.showmsg').show();
            $('.msg').text(res.msg);
            parent_row.remove();
            location.reload();
        }

    });

});
function removeItem($j){
   

	$("#divdynamicitems"+$j).remove();
}
function removeRow(_this){
       
       $(_this).parents("#clonerow").remove();
   }    
</script>
@endsection