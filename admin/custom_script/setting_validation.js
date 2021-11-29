function add_product_type()
 {
  
	
	var p_type = $('#type').val();
		if (!isNull(p_type)) {
			$('#type').removeClass('black_border').addClass('red_border');
            
		} else {
			$('#type').removeClass('red_border').addClass('black_border');
            
		}
}


		
function product()
{ 
	//alert('ok');
 $('#add').attr('onchange', 'add_product_type()');
   	$('#add').attr('onkeyup', 'add_product_type()');
   	$('#add').attr('onclick', 'add_product_type()');
	
	var checking= add_product_type();

	if ($('#add .red_border').size() > 0)  {
		$('#add .red_border:first').focus();
		$('#add .alert-error').show();
		return false;
	} else {

		$("#add").submit();
	}
    
}
function product_edit()
{ 
	//alert('ok');
 $('#edit').attr('onchange', 'add_product_type()');
   	$('#edit').attr('onkeyup', 'add_product_type()');
   	$('#edit').attr('onclick', 'add_product_type()');
	
	var checking= add_product_type();

	if ($('#edit .red_border').size() > 0)  {
		$('#edit .red_border:first').focus();
		$('#edit .alert-error').show();
		return false;
	} else {

		$("#edit").submit();
	}
}

   function add_make()
 {
  
    
  var p_type = $('#p_type').val();
    if (!isNull(p_type)) {
      $('#p_type').removeClass('black_border').addClass('red_border');
            
    } else {
      $('#p_type').removeClass('red_border').addClass('black_border');
            
    }
  
  var make = $('#make').val();
    if (!isNull(make)) {
      $('#make').removeClass('black_border').addClass('red_border');
            
    } else {
      $('#make').removeClass('red_border').addClass('black_border');
            
    }

  
}

function manufacture()
{ 
  //alert('ok');
 $('#add_make').attr('onchange', 'add_make()');
    $('#add_make').attr('onkeyup', 'add_make()');
    $('#add_make').attr('onclick', 'add_make()');
  
  var checking= add_make();

  if ($('#add_make .red_border').size() > 0)  {
    $('#add_make .red_border:first').focus();
    $('#add_make .alert-error').show();
    return false;
  } else {

    $("#add_make").submit();
  }
}


function make_validation()
{ 
  //alert('ok');
 $('#edit_make').attr('onchange', 'add_make()');
    $('#edit_make').attr('onkeyup', 'add_make()');
    $('#edit_make').attr('onclick', 'add_make()');
  
  var checking= add_make();

  if ($('#edit_make .red_border').size() > 0)  {
    $('#edit_make .red_border:first').focus();
    $('#edit_make .alert-error').show();
    return false;
  } else {

    $("#edit_make").submit();
  }
}

function add_capacity()
 {
  
    
  var p_type = $('#p_type').val();
    if (!isNull(p_type)) {
      $('#p_type').removeClass('black_border').addClass('red_border');
            
    } else {
      $('#p_type').removeClass('red_border').addClass('black_border');
            
    }
  
  var capacity = $('#capacity').val();
    if (!isNull(capacity)) {
      $('#capacity').removeClass('black_border').addClass('red_border');
            
    } else {
      $('#capacity').removeClass('red_border').addClass('black_border');
            
    }

  
}

function capacity_validation()
{ 
  //alert('ok');
 $('#form').attr('onchange', 'add_capacity()');
    $('#form').attr('onkeyup', 'add_capacity()');
    $('#form').attr('onclick', 'add_capacity()');
  
  var checking= add_capacity();

  if ($('#form .red_border').size() > 0)  {
    $('#form .red_border:first').focus();
    $('#form .alert-error').show();
    return false;
  } else {

    $("#form").submit();
  }
}
function edit_capacity_validation()
{ 
  //alert('ok');
 $('#form').attr('onchange', 'add_capacity()');
    $('#form').attr('onkeyup', 'add_capacity()');
    $('#form').attr('onclick', 'add_capacity()');
  
  var checking= add_capacity();

  if ($('#form .red_border').size() > 0)  {
    $('#form .red_border:first').focus();
    $('#form .alert-error').show();
    return false;
  } else {

    $("#form").submit();
  }
}

function add_model()
 {
 // alert();
  
  
  var p_type = $('#p_type').val();
    if (!isNull(p_type)) {
      $('#p_type').removeClass('black_border').addClass('red_border');
            
    } else {
      $('#p_type').removeClass('red_border').addClass('black_border');
            
    }

  
  var make = $('#make').val();
    if (!isNull(make)) {
      $('#make').removeClass('black_border').addClass('red_border');
            
    } else {
      $('#make').removeClass('red_border').addClass('black_border');
            
    }

    
  	var model = $('#model').val();
    if (!isNull(model)) {
      $('#model').removeClass('black_border').addClass('red_border');
            
    } else {
      $('#model').removeClass('red_border').addClass('black_border');
            
    }
  
}

function model_validation()
{ 
	//alert('ok');
    $('#form').attr('onchange', 'add_model()');
   	$('#form').attr('onkeyup', 'add_model()');
   	$('#form').attr('onclick', 'add_model()');
	
	add_model();

	if($('#form .red_border').size() > 0)  {
		 $('#form .red_border:first').focus();
		 $('#form .alert-error').show();

		return false;

	} else {

		$("#form").submit();
	}
    
}


function edit_model()
{ 
	//alert('ok');
 $('#form').attr('onchange', 'add_model()');
   	$('#form').attr('onkeyup', 'add_model()');
   	$('#form').attr('onclick', 'add_model()');
	
	var checking= add_model();

	if ($('#form .red_border').size() > 0)  {
		$('#form .red_border:first').focus();
		$('#form .alert-error').show();
		return false;
	} else {

		$("#form").submit();
	}
    
}
function brand()
 {
  
    
  var p_type = $('#p_type').val();
    if (!isNull(p_type)) {
      $('#p_type').removeClass('black_border').addClass('red_border');
            
    } else {
      $('#p_type').removeClass('red_border').addClass('black_border');
            
    }
  
 /* var manufacturer = $('#manufacturer').val();
    if (!isNull(manufacturer)) {
      $('#manufacturer').removeClass('black_border').addClass('red_border');
            
    } else {
      $('#manufacturer').removeClass('red_border').addClass('black_border');
            
    }
    
  	var model = $('#model').val();
    if (!isNull(model)) {
      $('#model').removeClass('black_border').addClass('red_border');
            
    } else {
      $('#model').removeClass('red_border').addClass('black_border');
           
    }*/

  	var brand = $('#brand').val();
    if (!isNull(brand)) {
      $('#brand').removeClass('black_border').addClass('red_border');
            
    } else {
      $('#brand').removeClass('red_border').addClass('black_border');
           
    }
  
}

function add_brand_validation()
{ 
	//alert('ok');
 $('#form').attr('onchange', 'brand()');
   	$('#form').attr('onkeyup', 'brand()');
   	$('#form').attr('onclick', 'brand()');
	
	var checking= brand();

	if ($('#form .red_border').size() > 0)  {
		$('#form .red_border:first').focus();
		$('#form .alert-error').show();
		return false;
	} else {

		$("#form").submit();
	}
    
}
function edit_brand_validation()
{ 
	//alert('ok');
 $('#form').attr('onchange', 'brand()');
   	$('#form').attr('onkeyup', 'brand()');
   	$('#form').attr('onclick', 'brand()');
	
	var checking= model();

	if ($('#form .red_border').size() > 0)  {
		$('#form .red_border:first').focus();
		$('#form .alert-error').show();
		return false;
	} else {

		$("#form").submit();
	}
    
}

function battery()
 {
  
   
  var p_type = $('#p_type').val();
    if (!isNull(p_type)) {
      $('#p_type').removeClass('black_border').addClass('red_border');
            
    } else {
      $('#p_type').removeClass('red_border').addClass('black_border');
          
    }

  var manufacturer = $('#manufacturer').val();
    if (!isNull(manufacturer)) {
      $('#manufacturer').removeClass('black_border').addClass('red_border');
           
    } else {
      $('#manufacturer').removeClass('red_border').addClass('black_border');
            
    }
  
    var model = $('#model').val();
    if (!isNull(model)) {
      $('#model').removeClass('black_border').addClass('red_border');
           
    } else {
      $('#model').removeClass('red_border').addClass('black_border');
          
    }

    var brand = $('#brand').val();
    if (!isNull(brand)) {
      $('#brand').removeClass('black_border').addClass('red_border');
          
    } else {
      $('#brand').removeClass('red_border').addClass('black_border');
          
    }


    var title = $('#title').val();
    if (!isNull(title)) {
      $('#title').removeClass('black_border').addClass('red_border');
           
    } else {
      $('#title').removeClass('red_border').addClass('black_border');
          
    }

  
    var price = $('#price').val();
    if (!isNull(price)) {
      $('#price').removeClass('black_border').addClass('red_border');
          
    } else {
      $('#price').removeClass('red_border').addClass('black_border');
         
    }
  
}

function battery_validation()
{ 
  //alert('ok');
 $('#form').attr('onchange', 'battery()');
    $('#form').attr('onkeyup', 'battery()');
    $('#form').attr('onclick', 'battery()');
  
  var checking= battery();

  if ($('#form .red_border').size() > 0)  {
    $('#form .red_border:first').focus();
    $('#form .alert-error').show();
    return false;
  } else {

    $("#form").submit();
  }
    
}

function battery_edit_validation()
{ 
  //alert('ok');
 $('#form').attr('onchange', 'battery()');
    $('#form').attr('onkeyup', 'battery()');
    $('#form').attr('onclick', 'battery()');
  
  var checking= battery();

  if ($('#form .red_border').size() > 0)  
  {
    $('#form .red_border:first').focus();
    $('#form .alert-error').show();
    return false;
  } else 
  {

    $("#form").submit();
  }
    
}

function specification()
 {

  var capacity = $('#capacity').val();
    if (!isNull(capacity)) {
      $('#capacity').removeClass('black_border').addClass('red_border');
       
    } else {
      $('#capacity').removeClass('red_border').addClass('black_border');
        
    }

  var Warranty = $('#Warranty').val();
    if (!isNull(Warranty)) {
      $('#Warranty').removeClass('black_border').addClass('red_border');
          
    } else {
      $('#Warranty').removeClass('red_border').addClass('black_border');
            
    }
 
    var dimension = $('#dimension').val();
    if (!isNull(dimension)) {
      $('#dimension').removeClass('black_border').addClass('red_border');
           
    } else {
      $('#dimension').removeClass('red_border').addClass('black_border');
          
    }
 
    var layout = $('#layout').val();
    if (!isNull(layout)) {
      $('#layout').removeClass('black_border').addClass('red_border');
         
    } else {
      $('#layout').removeClass('red_border').addClass('black_border');
            
    }

   
  
}

function specification_validation()
{ 
  //alert('ok');
 $('#form').attr('onchange', 'specification()');
    $('#form').attr('onkeyup', 'specification()');
    $('#form').attr('onclick', 'specification()');
  
  var checking= specification();

  if ($('#form .red_border').size() > 0)  
  {
    $('#form .red_border:first').focus();
    $('#form .alert-error').show();
    return false;
  } else 
  {

    $("#form").submit();
  }
    
}

function tyre_brand()
 {
  

  var type = $('#type').val();
    if (!isNull(type)) {
      $('#type').removeClass('black_border').addClass('red_border');
           
    } else {
      $('#type').removeClass('red_border').addClass('black_border');
            
    }

  var brand = $('#brand').val();
    if (!isNull(brand)) {
      $('#brand').removeClass('black_border').addClass('red_border');
           
    } else {
      $('#brand').removeClass('red_border').addClass('black_border');
         
    }
}

function tyre_brand_validation()
{ 
  //alert('ok');
 $('#form').attr('onchange', 'tyre_brand()');
    $('#form').attr('onkeyup', 'tyre_brand()');
    $('#form').attr('onclick', 'tyre_brand()');
  
  var checking= tyre_brand();

  if ($('#form .red_border').size() > 0)  
  {
    $('#form .red_border:first').focus();
    $('#form .alert-error').show();
    return false;
  } else 
  {

    $("#form").submit();
  }
    
}

function edit_tyre_brand_validation()
{ 
  //alert('ok');
 $('#form').attr('onchange', 'tyre_brand()');
    $('#form').attr('onkeyup', 'tyre_brand()');
    $('#form').attr('onclick', 'tyre_brand()');
  
  var checking= tyre_brand();

  if ($('#form .red_border').size() > 0)  
  {
    $('#form .red_border:first').focus();
    $('#form .alert-error').show();
    return false;
  } else 
  {

    $("#form").submit();
  }
    
}

function tyre_model()
 {
  
 
  var type = $('#type').val();
    if (!isNull(type)) {
      $('#type').removeClass('black_border').addClass('red_border');
           
    } else {
      $('#type').removeClass('red_border').addClass('black_border');
         
    }

  var make = $('#make').val();
    if (!isNull(make)) {
      $('#make').removeClass('black_border').addClass('red_border');
          
    } else {
      $('#make').removeClass('red_border').addClass('black_border');
    }

  
  var model = $('#model').val();
    if (!isNull(model)) {
      $('#model').removeClass('black_border').addClass('red_border');
            
    } else {
      $('#model').removeClass('red_border').addClass('black_border');
          
    }
}

function add_tyre_model_validation()
{ 
  //alert('ok');
 $('#form').attr('onchange', 'tyre_model()');
    $('#form').attr('onkeyup', 'tyre_model()');
    $('#form').attr('onclick', 'tyre_model()');
  
  var checking= tyre_model();

  if ($('#form .red_border').size() > 0)  
  {
    $('#form .red_border:first').focus();
    $('#form .alert-error').show();
    return false;
  } else 
  {

    $("#form").submit();
  }
    
}

function edit_tyre_model_validation()
{ 
  //alert('ok');
 $('#form').attr('onchange', 'tyre_model()');
    $('#form').attr('onkeyup', 'tyre_model()');
    $('#form').attr('onclick', 'tyre_model()');
  
  var checking= tyre_model();

  if ($('#form .red_border').size() > 0)  
  {
    $('#form .red_border:first').focus();
    $('#form .alert-error').show();
    return false;
  } else 
  {

    $("#form").submit();
  }
    
}


function tyre_pattern()
 {
  
 
  var type = $('#type').val();
    if (!isNull(type)) {
      $('#type').removeClass('black_border').addClass('red_border');
           
    } else {
      $('#type').removeClass('red_border').addClass('black_border');
         
    }

 
  
  var pattern = $('#pattern').val();
    if (!isNull(pattern)) {
      $('#pattern').removeClass('black_border').addClass('red_border');
            
    } else {
      $('#pattern').removeClass('red_border').addClass('black_border');
          
    }
}

function tyre_pattern_add()
{ 
  //alert('ok');
 $('#pattern_add').attr('onchange', 'tyre_pattern()');
    $('#pattern_add').attr('onkeyup', 'tyre_pattern()');
    $('#pattern_add').attr('onclick', 'tyre_pattern()');
  
  var checking= tyre_pattern();

  if ($('#pattern_add .red_border').size() > 0)  
  {
    $('#pattern_add .red_border:first').focus();
    $('#pattern_add .alert-error').show();
    return false;
  } else 
  {

    $("#pattern_add").submit();
  }
    
}

function tyre_pattern_edit()
{ 
  //alert('ok');
 $('#pattern_edit').attr('onchange', 'tyre_pattern()');
    $('#pattern_edit').attr('onkeyup', 'tyre_pattern()');
    $('#pattern_edit').attr('onclick', 'tyre_pattern()');
  
  var checking= tyre_pattern();

  if ($('#pattern_edit .red_border').size() > 0)  
  {
    $('#pattern_edit .red_border:first').focus();
    $('#pattern_edit .alert-error').show();
    return false;
  } else 
  {

    $("#pattern_edit").submit();
  }
    
}





		
	

