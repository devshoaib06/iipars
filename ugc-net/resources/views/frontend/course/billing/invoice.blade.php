<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">
    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">

    <title>Invoice</title>

    <style>
        .headstyle {
            font-size: 12px;
            font-weight: normal;
            padding: 0px;
        }
        
        .normalstyle {
            font-size: 9px;
            font-weight: normal;
            padding: 0px;
        }
        
        .style1 {
            color: #000000;
            font-weight: bold;
        }
    </style>

</head>

<body style="font-size:10px;">

    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">

        <tr>

            <td width="66%" valign="top">

                <p><img src="{{ asset('public/frontend/images/logo-iipars.png') }}"></p>
                {{-- <p><img src="{{ config('path.iipars_base_url') }}assets/images/new-aeducation-logo.png"></p> --}}

            </td>

            {{--
            <td width="34%" align="left" valign="bottom"><img src="http://billing.karmickinfosystem.com/invoice-logo.jpg" width="113" height="25" alt="" /></td> --}}

        </tr>

        <tr>

            <td align="left"><span class="headstyle" style="padding-left:15px; font-size:12px;"></span>
                <br /> {{-- <span class="normalstyle" style="padding:0px;">{{COMPANYDETAILS}}</span> --}}

                <br />

                <br />

                <span class="headstyle" style=" font-size:12px;">TO<br />

                <strong>{{$order_info->fullname}}</strong></span>
                <br />
                @if($billing_info->street_address_1)    
                <span class="normalstyle" style="padding:0px;">{{$billing_info->street_address_1}}, {{$billing_info->street_address_2}}<br>
                @endif    
                {{-- {{$billing_info->city}} {{$billing_info->zip}} <br>
                {{$state->state_name}}<br> --}}
                {{$country->country_name}}<br>
                {{$billing_info->phone}}<br>
                {{$billing_info->email}}<br></span></td>

            <td valign="top">

                <strong style="padding-left:0px;">INVOICE NO: {{$order_info->order_id}}</strong>
                <br />

                <strong style="padding:0px;">DATE:</strong> {{\Carbon\Carbon::parse($order_info->created_at)->format('F j, Y')}}

            </td>

        </tr>

    </table>
    <table width="100%" border="0" align="center">

        <tr>

            <td align="center"><strong>Attn. Mr/Mrs {{$order_info->fullname}}</strong></td>

        </tr>

    </table>
    <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
              <th width="191" align="center" bgcolor="#e1e1e1"><font size="1" face="Georgia, Arial" color="black"><strong>COURSE</strong></font></th>
              <th width="97" align="center" bgcolor="#e1e1e1"><font size="1" face="Georgia, Arial" color="black"><strong>RATE </strong></font></th>
              <th width="128" align="center" bgcolor="#e1e1e1" ><font size="1" face="Georgia, Arial" color="black"><strong>AMOUNT</strong></font></th>
        </tr>
        <tr>
            <td align="center" valign="top" class="normalstyle">{{$order_info->product_name}}</td>

            <td align="center" valign="top" class="normalstyle">{{$order_info->currency}} {{$order_info->revised_price!=""?$order_info->revised_price:$order_info->price}}</td>
            <td align="center" valign="top" class="normalstyle">{{$order_info->currency}} {{$order_info->revised_price!=""?$order_info->revised_price:$order_info->price}}</td>

        </tr>
        {{-- <tr>
            <td align="center" valign="top" class="normalstyle">CGST @9% </td>
            <td align="center" valign="top" class="normalstyle">CGST @9% </td>

            <td align="center" valign="top">{{$order_info->currency}} 0.00</td>

        </tr>
        <tr>
            <td align="center" valign="top" class="normalstyle">SGST @9% </td>
            <td align="center" valign="top" class="normalstyle">SGST @9% </td>

            <td align="center" valign="top">{{$order_info->currency}} 0.00</td>

        </tr> --}}
        @if ($order_info->student_cb_amount!="")
            
        <tr>
            
            <td colspan="2" align="center" valign="top"><font size="1" face="Arial, Georgia" color="black"><strong>Cashback</strong></font></td>
            
            <td align="center" valign="top">{{$order_info->currency}} {{$order_info->student_cb_amount}}</td>
            
        </tr>
        @endif
        <tr>
            <td colspan="2" align="center" valign="top"><font size="1" face="Arial, Georgia" color="black"><strong>Discount </strong></font></td>

            <td align="center" valign="top">{{$order_info->currency}} {{$order_info->discount_amount!=""?$order_info->discount_amount:'0.00'}}</td>

        </tr>
        <tr>

            <td colspan="2" align="center" valign="top"><font size="1" face="Arial, Georgia" color="black"><strong>SUBTOTAL</strong></font></td>

            <td align="center" valign="top">{{$order_info->currency}} {{$order_info->subtotal}}</td>

        </tr>


        {{-- <tr>

            <td colspan="2" align="center" valign="top">&nbsp;</td>

            <td align="center" valign="top">&nbsp;</td>

        </tr> --}}

        <tr>

            <td colspan="2" align="center" valign="top"><font size="3" face="Georgia, Arial" color="black"><strong>Total</strong></font></td>

            <td align="center" valign="top"><font size="1" face="Arial, Georgia" color="black"><strong>{{$order_info->currency}} {{$order_info->grand_total}}</strong></font></td>

        </tr>

    </table>
    <table width="100%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#000000">

        <tr>

            <td align="center" valign="top"><font size="1" face="Georgia, Arial" color="black"><strong >Rupees {{ucwords($amount_in_words)}}</strong></font></td>

        </tr>

    </table>
    <table width="100%" border="0">
        <tr>
            <td width="50%" rowspan="3" align="left" valign="top"><font size="1" face="Arial, Georgia" color="black"></font>
                <br /> {{-- {{BANKDETAILS}} --}}
            </td>
            <td><font size="1" face="Georgia, Arial" color="black"><strong></strong></font></td>
        </tr>
        <tr>
            <td>
                {{-- {{SIGNATURE}} --}}
            </td>
        </tr>
        <tr>
            <td>
                <font size="2" face="Arial, Georgia">
      <strong>
        {{-- {{AUTHORIZED}} --}}
      </strong>
      </font>
            </td>
        </tr>
    </table>
    <br/>
    <br/>
    <br/>
    <br/>
    <table>

    </table>

</body>

</html>