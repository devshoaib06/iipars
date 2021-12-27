<table cellpadding="0" cellspacing="0" border="0" style="margin-top: 20px; font-family:Arial, Helvetica, sans-serif; font-style: normal; font-weight: normal; width: 100%; background-color: #fff; border:1px solid #ccc;">
    <tr>
       
		<td  align="left" style="padding-left: 70px; padding-right: 20px;padding-top: 20px;">
            <a href="{{ url('/') }}"><img src="{!! asset('public/frontend/images/logo-iipars.png') !!}" style="width:100%; max-width:200px; border-radius: 5px" alt=""></a>        
        </td>
		
    </tr>
    <tr>
        <td colspan="3" style=" vertical-align: top; padding: 20px; height: 400px">
            <table align="center" style="width: 90%; background-color: #FFF; ">                
                <tr>
                    <td style="padding:10px;">
				    @yield('content')                    
                    </td>
                </tr>
            </table>        
        </td>
    </tr>
	
    </table>
