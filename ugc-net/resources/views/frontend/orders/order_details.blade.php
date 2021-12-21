<div class="modal-body">
    <h2>Order Details:</h2>
    <div class="table-responsive">
        <table style="width:100%" class="table table-hover table-bordered table-striped">
            <tr>
                <th style="width: 30%">Order #:</th>
                <td class="order_no">{{ $order_info->order_id }}</td>
            </tr>
            <tr>
                <th>Order Date & Time:</th>
                <td class="order_date">{{ $order_date  }}</td>
            </tr>
            <tr>
                <th>Order Status:</th>
                <td class="order_status">
                    {{ $order_info->payment_status=='created'?'Pending':ucfirst($order_info->payment_status) }}</td>
            </tr>
            <tr>
                <th>Grand Total:</th>
                <td class="grand_total">{{  $order_info->grand_total}}</td>
            </tr>
        </table>
    </div>

    <h2>Customer Information:</h2>
    <div class="table-responsive">
        <table style="width:100%" class="table table-hover table-bordered table-striped">
            <tr>
                <th style="width: 30%">Customer Name:</th>
                <td class="cust_name">{{ $billing_info->first_name }} {{ $billing_info->last_name }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td class="email">{{ $billing_info->email }}</td>
            </tr>
            <tr>
                <th>Phone Number:</th>
                <td class="phone_number">{{ $billing_info->phone }}</td>
            </tr>
        </table>
    </div>

    <h2>Shipping Address:</h2>
    <div class="table-responsive">
        <table style="width:100%" class="table table-hover table-bordered table-striped">
            <tr>
                <th style="width: 30%">Biller Name:</th>
                <td class="cust_name">{{ $billing_info->first_name }} {{ $billing_info->last_name }}</td>
            </tr>
            <tr>
                <th>Street Address:</th>
                <td class="address">{{ $billing_info->street_address_1 }} {{  $billing_info->street_address_2}}</td>
            </tr>
            <tr>
                <th>City & Zip:</th>
                <td class="city_zip">{{ $billing_info->city }} {{ $billing_info->zip }}</td>
            </tr>
            <tr>
                <th>State:</th>
                <td class="state">{{ isset($billing_info->states)?$billing_info->states->state_name:''  }}</td>
            </tr>
            <tr>
                <th>Country:</th>
                <td class="country">{{ isset($billing_info->countries)?$billing_info->countries->country_name:'' }}</td>
            </tr>
        </table>
    </div>
    <div class="card_info">
        <h2>Payment Details:</h2>
        <div class="table-responsive">
            <table style="width:100%" class="table payment-detail-table table-hover table-bordered table-striped">
                <tr>
                    <th style="width: 30%">Payment Type:</th>
                    <td class="last4digit">{{ ucfirst($payment_details->payment_method) }}</td>
                </tr>
                @if ($payment_details->payment_method=='upi')
                <tr>
                    <th style="width: 30%">UPI ID:</th>
                    <td class="last4digit">{{ $payment_details->vpa }}</td>
                </tr>
                @endif
                @if ($payment_details->payment_method=='card')
                <tr>
                    <th style="width: 30%">Last 4 digit:</th>
                    <td class="last4digit">{{ ucfirst($card_info->last4digit) }}</td>
                </tr>
                <tr>
                    <th style="width: 30%">Card Network:</th>
                    <td class="last4digit">{{ $card_info->card_network }}</td>
                </tr>
                <tr>
                    <th style="width: 30%">Card Type:</th>
                    <td class="last4digit">{{ ucfirst($card_info->card_type) }}</td>
                </tr>
                @endif
                @if ($payment_details->payment_method=='netbanking')
                <tr>
                    <th style="width: 30%">Bank:</th>
                    <td class="last4digit">{{ $payment_details->bank }}</td>
                </tr>

                @endif
                @if ($payment_details->payment_method=='wallet')
                <tr>
                    <th style="width: 30%">Wallet:</th>
                    <td class="last4digit">{{ $payment_details->wallet }}</td>
                </tr>

                @endif
            </table>
        </div>

    </div>

    <h2>Course Information:</h2>
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th> Course </th>
                    <th> Original Price </th>
                    <th> Revised Price </th>
                    {{-- 
                <th> Cashback </th> --}}
                    <th> Discount Amount <br />({{ $order_info->revised_percent?$order_info->revised_percent:0 }}%) </th>
                    @if ($order_info->extra_discount)
                        <th> Extra Discount</th>
                    @endif
                    <th> Total </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="product_name">
                        {{ $order_info->product_name }}
                    </td>
                    <td class="org_price"> {{ $order_info->price }} </td>
                    <td class="revised_price"> ₹ {{ $order_info->revised_price?$order_info->revised_price:0.00 }} </td>
                   
                    <td class="discount_amount"> ₹ {{ $order_info->discount_amount?$order_info->discount_amount:0.00 }}
                    </td>
                    @if ($order_info->extra_discount)
                        <td class="discount_amount"> ₹ {{ $order_info->extra_discount?$order_info->extra_discount:0.00 }}
                        </td>
                    @endif
                    <td class="grand_total"> ₹ {{ $order_info->grand_total }} </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    @if ($payment_details->payment_method!='Free')
        <button type="button " class="btn btn-default invoice_url_btn">
            <a href="{{ $invoice_url }}" target="_blank" class="invoice_url">Invoice</a>
        </button>
    @endif
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
