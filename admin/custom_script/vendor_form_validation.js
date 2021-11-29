function add_make_submit()
 {
    //alert('hello');
  var veh_type=$('#veh_type').val();
  if (!isNull(veh_type))
  {
    $('#veh_type').removeClass('black_border').addClass('red_border');
  } 
  else 
  {
    $('#veh_type').removeClass('red_border').addClass('black_border');
  }
  
  var veh_make=$('#veh_make').val();
  if (!isNull(veh_make)) 
  {
    $('#veh_make').removeClass('black_border').addClass('red_border');
  } 
  else 
  {
    $('#veh_make').removeClass('red_border').addClass('black_border');
  } 
  
  
 /*var make_logo = $("#make_logo").get(0).files.length;
 var old_logo= $("#old_logo").val();
  if (make_logo=='' && old_logo=='') 
  {
    $('#make_logo').removeClass('black_border').addClass('red_border');
  } 
  else 
  {
    $('#make_logo').removeClass('red_border').addClass('black_border');
  }*/
  

}

function exequete_make_form_validation() 
{
  //alert('ok');
  $('#make_form').attr('onchange', 'add_make_submit()');
  $('#make_form').attr('onkeyup', 'add_make_submit()');
  
  add_make_submit()

  if ($('#make_form .red_border').size() > 0) 
  {
    $('#make_form .red_border:first').focus();
    $('#make_form .alert-error').show();
    return false;
    
  } else {

    $("#make_form").submit();
  }
}






		
	

