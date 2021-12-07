<?php 
    $myLibrary=new \App\library\myFunctions;
?>
        @forelse ($orders as $order)
        <?php 
            $payment_info=$myLibrary->getPaymentInfo($order->order_id);
            $pay_date="-";
            $pay_type="-";
            $pay_str="Due";
            $cheque_no_neft="-";
            $pay_status=0;
                if($payment_info){
                $pay_status=$payment_info['pay_status'];
                if($pay_status==1){
                        $pay_str="Requested";
                }
                else if($pay_status==2){
                    $pay_date=$payment_info['pay_date'];
                    $cheque_no_neft=$payment_info['cheque_no_neft'];
                    $pay_str="Paid";
                }

                if($payment_info->pay_type==1){
                    $pay_type="Cheque";
                }
                elseif($payment_info->pay_type==2){
                    $pay_type="NEFT";

                }

            }
        ?>
        <tr class="append-data">
            <td class="order-td">
                <input type="checkbox" name="checkdorders[]" class="order-check" {{$pay_status!=0?'disabled':''}} value={{$order->order_id}} >
                <input type="hidden" class="amount-check" name="orderamount[]" value={{$order->total}} disabled="disabled" >
            </td>
            <td>{{$order->reciept_id}}</td>
            <td>{{$order->name}}</td>
            <td>{{\Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}</td>
            <td>{{$order->revised_price!=""?$order->revised_price:$order->price}}</td>
            <td>{{$order->total}}</td>
            <td>
                @if($pay_date!="-")
                {{\Carbon\Carbon::parse($pay_date)->format('d/m/Y')}}
                @else
                {{$pay_date}}
                @endif
            </td>
            <td>
                {{$pay_type}}
                
            </td>
            <td>{{$cheque_no_neft}}</td>
            <td class="text-center">
                @if($pay_str=="Requested")
                    <a href="#" class="text text-info"><strong>{{$pay_str}}</strong></a>
                @endif
                @if($pay_str=="Due")
                    <a href="#" class="text text-danger"><strong>{{$pay_str}}</strong></a>
                @endif
                @if($pay_str=="Paid")
                    <a href="#" class="text text-success"><strong>{{$pay_str}}</strong></a>
                @endif
                
           
            </td>
            {{-- <td>
            <button type="button" class="btn btn-default" {{$pay_status!=0?'disabled':''}}>{{$pay_str}}</button>
            </td> --}}
        </tr>
        @empty
        <tr><td colspan="10">No order yet.</td></tr>
        @endforelse
        
        
    

                               