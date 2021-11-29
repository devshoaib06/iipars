<!doctype html>
<html lang="en">


<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Naturecampretreat</title>

<style>
body{font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;}
ul{ margin:0 0 0 20px; padding: 0 ;width: 100%;
    float: left;}
ul li{ list-style-type:disc;     width: 100%;
    float: left; }
</style>

</head>

<body style="margin: 0; padding: 0">
<div style="width: 100%; float: left;  margin: 0; padding: 0;">
<div style="max-width: 700px; width: 100%; margin: 0 auto;">
<center>
<table style="width: 100%; float: left; box-sizing: border-box;" cellpadding="0" cellspacing="0">
        <tr>
                <td style=" background: #0095da; padding: 12px 0; font-size: 20px; font-weight: 700; text-transform: uppercase; text-align: center; color: #fff;">New Home Stay Booking!
            </td>
            </tr>
        </table>    
<table style="width: 100%; float: left;  border-left: 1px solid #ddd;    border-right: 1px solid #ddd; border-bottom: 14px solid #d4539e; color:#333; padding:15px 25px 15px; box-sizing: border-box;" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <table style="width: 100%; float: left;">
            <tr>
                <td style="text-align: left;"><a href="javascript:void(0)"><img src="https://naturecampretreat.com/assets/images/nature-camp-logo.png" alt="logo" style="width: 250px"></a>
            </td>
                
            </tr>   
                
            </table>

            
            <table style="width: 100%; float: left; padding: 10px 0 0;">
                <tr>
                <td style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;"><p style="padding: 0; margin: 0;">Dear Naturecampretreat Admin,
 </p></td>
</tr>
<tr>
                <td  style="  font-size: 14px; line-height: 22px; text-align:justify;"><p style="padding: 0; margin: 0;"> <p>Congratulations! <br/>
                New Home Stay booking  has been done by <strong><?php echo @$mail_data['clientname']; ?></strong>. Please check the details that are given below:<br/><br/>

                <strong>Client Deatails:</strong>




</p></td>
            </tr>
        </table>

        <table style="width: 100%; float: left; ">
                <tr>
                    <td>
                        <ul>
                            <li>
                                <strong style=" font-size: 14px; vertical-align: top; line-height: 22px; color: #0095da; width: 250px; text-align:left; float:left;">Client Name</strong> 
                                <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;"><?php echo @$mail_data['clientname']; ?></span>
                            </li>
                            <li><strong style=" font-size: 14px; vertical-align: top; line-height: 22px;    color: #0095da; width: 250px; text-align:left; float:left;">Client Phone No</strong> 
                            <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;"><?php echo @$mail_data['uphone']; ?></span></li>
                            <li><strong style=" font-size: 14px; vertical-align: top; line-height: 22px;    color: #0095da; width: 250px; text-align:left; float:left;">Client Email</strong> 
                                <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;">
                <a href="#" style="color: #0095da; text-decoration: none;"><?php echo @$mail_data['uemail']; ?></a></span></li>

                        </ul>

                    </td>
                

</tr>
        </table>
        <table style="width: 100%; float: left; padding: 10px 0 0;">
<tr>
                <td  style="  font-size: 14px; line-height: 22px; text-align:justify;"><p style="padding: 0; margin: 0;"> <p>
<strong>Booking Details:
</strong>
</p></td>
            </tr>
        </table>


            <table style="width: 100%; float: left; ">
                <tr>
                    <td>
                        <ul>
                            <!-- <li>
                                <strong style=" font-size: 14px; vertical-align: top; line-height: 22px; color: #0095da; width: 250px; text-align:left; float:left;">Arrival Date</strong> 
                                <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;"><?php echo @$mail_data['arrival_date']; ?>
</span>
                            </li> -->
                            <!-- <li><strong style=" font-size: 14px; vertical-align: top; line-height: 22px;    color: #0095da; width: 250px; text-align:left; float:left;">Approx Time</strong> 
                            <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;"><?php echo @$mail_data['arrival_time']; ?>
</span></li> -->
                            <li><strong style=" font-size: 14px; vertical-align: top; line-height: 22px;    color: #0095da; width: 250px; text-align:left; float:left;">Home Stay Name</strong> 
                                <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;">
                <?php echo @$mail_data['hotel_name']; ?></span></li>

                            <li><strong style=" font-size: 14px; vertical-align: top; line-height: 22px;    color: #0095da; width: 250px; text-align:left; float:left;">Home Stay Type</strong> 
                                <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;">
                <?php echo @$mail_data['hotel_type']; ?></span></li>
               
                <li><strong style=" font-size: 14px; vertical-align: top; line-height: 22px;    color: #0095da; width: 250px; text-align:left; float:left;">Room Price </strong> 
                                <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;">
                <?php echo @$mail_data['room_price']; ?>
</span></li>

<li><strong style=" font-size: 14px; vertical-align: top; line-height: 22px;    color: #0095da; width: 250px; text-align:left; float:left;">Room Type </strong> 
                                <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;">
                <?php echo @$mail_data['room_name']; ?>
</span></li>

  <li><strong style=" font-size: 14px; vertical-align: top; line-height: 22px;    color: #0095da; width: 250px; text-align:left; float:left;">Booking Date </strong> 
                                <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;">
                <?php echo @$mail_data['booking_date']; ?>
</span></li>



 <li><strong style=" font-size: 14px; vertical-align: top; line-height: 22px;    color: #0095da; width: 250px; text-align:left; float:left;">Booking Start Date </strong> 
                                <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;">
                <?php echo @$mail_data['booking_start_date']; ?>
</span></li>

 <li><strong style=" font-size: 14px; vertical-align: top; line-height: 22px;    color: #0095da; width: 250px; text-align:left; float:left;">Booking End Date </strong> 
                                <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;">
                <?php echo @$mail_data['booking_end_date']; ?>
</span></li>
 <li><strong style=" font-size: 14px; vertical-align: top; line-height: 22px;    color: #0095da; width: 250px; text-align:left; float:left;">Adult Number </strong> 
                                <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;">
                <?php echo @$mail_data['hotel_adult_numbere']; ?>
</span></li>

<li><strong style=" font-size: 14px; vertical-align: top; line-height: 22px;    color: #0095da; width: 250px; text-align:left; float:left;"> Child Number </strong> 
                                <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;">
                <?php echo @$mail_data['hotel_child_numberr']; ?>

</span></li>




<!-- <li><strong style=" font-size: 14px; vertical-align: top; line-height: 22px;    color: #0095da; width: 250px; text-align:left; float:left;"> Infants Number </strong> 
                                <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;">
                <?php echo @$mail_data['hotel_infants_numberrr']; ?>

</span></li> -->
<li><strong style=" font-size: 14px; vertical-align: top; line-height: 22px;    color: #0095da; width: 250px; text-align:left; float:left;"> No of days </strong> 
                                <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;">
                <?php echo @$mail_data['no_of_days']; ?>

</span></li>
<li><strong style=" font-size: 14px; vertical-align: top; line-height: 22px;    color: #0095da; width: 250px; text-align:left; float:left;"> Total Price </strong> 
                                <span style=" font-size: 14px; vertical-align: top; line-height: 22px; text-align:left; float:left;">
                <?php echo @$mail_data['total_cost']; ?>

</span></li>







                        </ul>

                    </td>
                

</tr>
        </table>
            
            

           <table style="width: 100%; float: left; padding: 20px 0 0;">
                <tr>
                    
                    <td style="float: left; text-align: left;"><div style="max-width: 400px; display: inline-block; text-align: left; font-size: 14px; font-weight: 600;"><p style="margin-top: 0;">Thank and Regards,
</p> <p style="margin-bottom: 0;">Naturecampretreat Admin Team<br/>
 <a href="https://naturecampretreat.com"  style="color: #0095da; text-decoration: none;"> https://naturecampretreat.com</a></p></div></td>
                </tr>
                
            </table>    


        </td>

    </tr>
</table>
</center>
</div>


</body>
</html>


