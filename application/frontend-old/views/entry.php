<html>
	<head>
	<style>
	
	
	table.resech_p_cus tbody {
    border: 0;
}
table.category_ppp_ccc tr td {
    color: red;
    font-size: 14px;
}

table.category_ppp_ccc {
    box-shadow: none;
    border: oldlace;
    background: #fff;
    padding: 10px;
    border-radius: 5px;
}
th.reasear_acti_hehe {
    color: #202c45;
    font-size: 18px;
    padding-bottom: 8px;
    padding-top: 20px;
}
.out_side_all_page_sec_pp h3 {
    margin: 15px 0px 0px;
    text-align: left;
    color: #202c45;
    border-bottom: 1px solid;
    padding-bottom: 10px;
}
table {
    color: white;
    border-bottom-color: transparent !important;
}
select {
    height: 40px;
    width: 100%;
    border: 0px;
    border-radius: 5px;
}

table.resech_p_cus {
    box-shadow: none;
    border: 0px !important;
}
table {
    color: white;
    background: #2c82c8;
    border: 0;
    box-shadow: 0 10px 15px -3px rgb(255 255 255 / 42%), 0 0px 5px -5px rgb(255 255 255 / 32%);
    padding: 25px 25px 25px 25px;
    margin-bottom: 30px;
    border: 1px solid #ffffff4d;
    border-radius: 25px;
}	
button {
    background: #202c45;
    border: 0;
    width: 170px;
    height: 45px;
    color: #fff;
    font-size: 18px;
    border-radius: 5px;
}
	.outside_logo img {
    width: 100%;
}
.out_side_all_page_sec_pp h2 {
   margin: 0px;
    padding: 10px 0px;
    background: #57a92a;
    font-size: 20px;
    border-radius: 5px;
}
table tr td {
    border: 0;
        font-family: sans-serif;
}
table tr th {
    border: 0;
        font-family: sans-serif;
}
.out_side_all_page_sec_pp input {
    height: 35px;
    border: 0px;
    border-radius: 5px;
}
.out_side_all_page_sec_pp h1 {
    color: #000;
    padding: 20px 0px;
}
.outside_logo {
    width: 100%;
    float: left;
    text-align:center;
    padding:15px 0px;
}
.outside_logo img {
    width: 280px;
}
.out_side_all_page_sec_pp {
    background: #e9faff;
    width:100%;
    float:left;
}
body {
    margin: 0px;
}

	 /*body{background-image:url(<?php echo base_url(); ?>assets/images/bg.jpg);background-repeat:no-repeat;background-size:100% 100%;}*/
	 table {
  color: white;
  border-bottom-color:black;
}
input[type='text'] { font-size: 24px; }
	</style>
		<title>General Degree College</title>
		<script>
			var nm,ins,des,ph,wa,em;
			var mp,hs,ug,pg,spa;
			var sa,sr,ac,rea,total,def;
			var r1,r2,r3,r4,r5,rtotal;
			var net,mphil,phd,ra,intr,exp,w,yno,zone;
			function addnumbers()
			{
				
				mp=Number(document.getElementById("INPUT1").value);
				hs=Number(document.getElementById("INPUT2").value);
				ug=Number(document.getElementById("INPUT3").value);
				pg=Number(document.getElementById("INPUT4").value);
				spa=Number(document.getElementById("INPUT5").value);
				sa=((mp/100)*5)+((hs/100)*10)+((ug/100)*20)+((pg/100)*20)+spa;
				document.getElementById("answer1").value=sa;
				
				var sID = document.getElementById("INPUT6");
				var selVal = sID.options[sID.selectedIndex].value;
				if(selVal==3)
				{
						w=1;net=4;
						yno="JRF";
				}
				else if(selVal==2)
				{
						w=0;net=4;
						yno="NET";
				}
				else
				{
						w=0;net=0;
						yno="NIL";
				}
				mphil=Number(document.getElementById("INPUT7").value);
				phd=Number(document.getElementById("INPUT8").value);
				r1=Number(document.getElementById("cat1").value);
				r2=Number(document.getElementById("cat2").value);
				r3=Number(document.getElementById("cat3").value);
				r4=Number(document.getElementById("cat4").value);
				r5=Number(document.getElementById("cat5").value);
				rtotal=r5+r4+r3+r2+r1;
				var g=(r1+r2+r3)*.5;
				if((rtotal+g)>=6)
				{
					ra=6;
				}
				else
				{
					ra=rtotal+g;
				}
				document.getElementById("INPUT9").value=ra;
				exp=Number(document.getElementById("INPUT10").value);
				if(phd>0)
				{
					document.getElementById("INPUT7").value=0;
					mphil=0;
					yno=yno+",PhD";
				}
				else if(phd<0 && mphil>0){
					mphil=Number(document.getElementById("INPUT7").value);
					yno=yno+",MPhil";
				}
				else{
					yno=yno;
					}
				sr=net+phd+ra+exp+mphil;
				document.getElementById("answer2").value=sr;
				if(sa>35)
				{
					ac=6;
				}
				else
				{
					ac=5;
				}
				if(sr<10)
				{
					rea=5;
				}
				else if(sr>=10 && sr<=19)
				{
					rea=9;
				}
				else if(sr>19&&sr<25)
				{
					rea=15;
				}
				else
				{
					rea=16;
				}
				intr=ac+rea+w;
				document.getElementById("answer3").value=ac+rea+w;
				total=sa+sr+ac+rea+w;
				document.getElementById("answer4").value=total;
				def=total-65;
			    document.getElementById("answer5").value=def;
				if(def>-25 && def<0)
				{
					document.getElementById("cc").value="You are in Yellow zone?";
					document.getElementById("r").style.background="yellow";
					zone="Yellow";
				}
				else if(def>0)
				{
					document.getElementById("cc").value="You are in safe zone";
					document.getElementById("r").style.background="green";
					zone="Green";
				}
				else
				{
					document.getElementById("cc").value="You are in Danger zone!!!";
					document.getElementById("r").style.background="red";
					zone="Red";
				}
			}
		function submit()
		{
		   nm=document.getElementById("name").value;
		   ins=document.getElementById("inst").value;
		   des=document.getElementById("desig").value;
		   ph=document.getElementById("ph").value;
		   wa=document.getElementById("wa").value;
		   em=document.getElementById("email").value;
		   window.alert(nm);
		}
		</script>
		
		<script type="text/javascript">
function showDiv(select){
   if(select.value==1){
    document.getElementById('hidden_div1').style.visibility = "visible";
    document.getElementById('hidden_div2').style.visibility = "visible";
    document.getElementById('hidden_div3').style.visibility = "visible";
    document.getElementById('hidden_div4').style.visibility = "visible";
     document.getElementById('hidden_div5').style.visibility = "hidden";
    document.getElementById('hidden_div6').style.visibility = "hidden";
   
   } 
   else if(select.value==3){
     document.getElementById('hidden_div5').style.visibility = "visible";
     document.getElementById('hidden_div6').style.visibility = "visible";
        document.getElementById('hidden_div1').style.visibility = "hidden";
    document.getElementById('hidden_div2').style.visibility = "hidden";
    document.getElementById('hidden_div3').style.visibility = "hidden";
    document.getElementById('hidden_div4').style.visibility = "hidden";
   }
   
   else{
    document.getElementById('hidden_div1').style.visibility = "hidden";
    document.getElementById('hidden_div2').style.visibility = "hidden";
    document.getElementById('hidden_div3').style.visibility = "hidden";
    document.getElementById('hidden_div4').style.visibility = "hidden";
    document.getElementById('hidden_div5').style.visibility = "hidden";
    document.getElementById('hidden_div6').style.visibility = "hidden";
    
   
   }
} 
</script>




		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
		//var join=JSON.parse(sessionStorage.getItem("joindate"));
        $("#btnPrint").live("click", function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=1200,width=1600');
			var pesonal='<table style="font-size:30px;width:100%"><TR><TD align="left">Name:'+nm+
													'<TR><TD>Institute:'+ins+
													'<TR><TD>Email:'+em+
													'</table>';
			var content='<table style="font-size:30px;width:100%" border="4"cellspacing="2" frame="hsides" rules="groups">'+
			'<TBODY>'+
			'<TBODY>'+
			'<TR><TD colspan="3" align = "center">Your Marks'+
			'<TBODY>'+
			'<TR><TD>1<TD>Percentage in 10 Standard<TD>'+mp+
			'<TR><TD>2<TD>Percentage in 12 Standard<TD>'+hs+
			'<TR><TD>3<TD>Percentage in BA/BSc/BCom<TD>'+ug+
			'<TR><TD>4<TD>Percentage in MA/MSc/MCom<TD>'+pg+
			'<TR><TD>5<TD>Special Awards<TD>'+spa+
			'<TBODY>'+
			'<TR><TD>*<TD>Having NET,PhD,MPhil<TD>'+yno+
			'<TBODY>'+
			'<TR><TD colspan="3" align = "center">You Obtained'+
			'<TBODY>'+
			'<TR><TD>1<TD>Academic Score<TD>'+sa+
			'<TR><TD>2<TD>Exam Score<TD>'+net+
			'<TR><TD>3<TD>Research Activities Score<TD>'+ra+
			'<TR><TD>4<TD>Interview Score<TD>'+intr+
			'<TBODY>'+
			'<TBODY>'+
			'<TR><TD colspan="2">TOTAL<TD>'+total+
			'<TBODY>'+
			'<TR><TD colspan="2">Deficit/Surplus<TD>'+def+
			'<TBODY>'+
			'</table>';
			var iipars='<table style="width:100%" align="center"><TR><TD>International Institute for Academic & Research Support'+
													'<TR><TD>Phone No:6297566041'+
													'<TR><TD>WhatsApp No:9609066503'+
													'<TR><TD><Input type="image" src="<?php echo base_url(); ?>assets/images/iipars.jpg">'+
													'</table>';
            printWindow.document.write('<html><head><title>Your Report Card</title>');
            printWindow.document.write('</head><body >');
			printWindow.document.write('<h1 style="font-size:100px"align="center">IIPARS</h1><p style="font-size:30px" align="center">');
			printWindow.document.write('=========================================================================================================================<br>');
            //printWindow.document.write('Name:'+nm +'<br>');
			//printWindow.document.write('Institution:'+ins +'<br>');
			//printWindow.document.write('Email:'+em);
			printWindow.document.write(pesonal);
			printWindow.document.write(content);
			printWindow.document.write('<BR><BR>***Your Are in '+zone+' Zone***<BR>');
			printWindow.document.write('=========================================================================================================================<br>');
			printWindow.document.write(iipars);
            printWindow.document.write('</p></body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>
	</head>
	<body>
	    
	    <div class="outside_logo_sec_all">
	        <div class="outside_logo">
	            <img src="<?php echo base_url();?>assets/images/new-aeducation-logo.png">
	        </div>
	        <!--<div class="outside_header">ENTRY LEVEL CALCULATION</div>-->
	    </div>
	    
	    
	    <div class="out_side_all_page_sec_pp">
		<h1 align="center"> ENTRY LEVEL CALCULATION</h1>
		<p align="center">
		<table id="t1" border="2" height="200" cellpadding="5" cellspacing="3" class="ippas_api_section_class">
		<tr><th colspan="4"><h2>PERSONAL DETAILS</h2></th></tr>
		<tr></tr>
			<td >Name:</td>
			<td ><input id="name" value="<?php echo @$user_details[0]->first_name; ?>" size="70"/></td>
		<tr></tr>
			<td >Institution:</td>
			<td ><input id="inst"size="70"/></td>
		<tr></tr>
			<td >Designation:</td>
			<td ><input id="desig"size="70"/></td>
		<tr></tr>
			<td >Phone No:</td>
			<td ><input id="ph" value="<?php echo @$user_details[0]->mobile; ?>" size="70"/></td>
		<tr></tr>
			<td >WhatsApp:</td>
			<td ><input id="wa"size="70"/></td>
		<tr></tr>
			<td>Email:</td>
			<td><input id="email" value="<?php echo @$user_details[0]->login_email; ?>" size="70"/></td>
		<tr></tr>
			<td colspan="3"align="center"><button onclick="submit()">Submit</button></td>
		</table>
		<table id="t1" border="2" height="200" cellpadding="5" cellspacing="3">
		   
		<tr><th colspan="4"><h2>FOR DEGREE COLLEGE/UNIVERSITY</h2></th></tr>
		 <tr>
		        <td>Select College/ University</td>
		        <td colspan="4">
		            <select onchange="showDiv(this)">
		                <option>For General College/ Others</option>
		                <option>For Science</option>
		                <option value="3">For B.Ed College</option>
		                <option value="1">For Librarian</option>
		                
		            </select>
		        </td>
		    </tr>
		<tr><th colspan="2"><h3>ACADEMIC QUALIFICATIONS</h3></th><th colspan="2"><h3>EXAM & RESEARCH</h3></th></tr>
		<tr></tr>
			<td >Percentage in<BR>10 Standard</td>
			<td ><input id="INPUT1"/></td>
			<td>NET/JRF<BR>(4 marks)</td>
			<td ><select id="INPUT6"><option value="1">Select</option>
							<option value="2">NET</option>
							<option value="3">JRF</option></td></select>
		<tr></tr>
			<td >Percentage in<BR>12 Standard</td>
			<td ><input id="INPUT2"/></td>
			<td>M.Phil.<BR>(3 marks)</td>
			<td ><input id="INPUT7"/></td>
		<tr></tr>
			<td >Percentage in<BR>B.A./B.Sc./B.Com.</td>
			<td ><input id="INPUT3"/></td>
			<td>PhD<BR>(6 marks)</td>
			<td ><input id="INPUT8"/></td>
		<tr></tr>
		
		<tr>
		    	<td id="hidden_div1" style="visibility:hidden;">B.Lis</td>
		    	<td id="hidden_div2" style="visibility:hidden;"><input id=""/></td>
		    	
		    	<td id="hidden_div3" style="visibility:hidden;">M.Lis</td>
		    	<td id="hidden_div4" style="visibility:hidden;"><input id=""/></td>
		</tr>
		
		<tr>
		    	<td id="hidden_div5" style="visibility:hidden;">B.Ed/ M.Ed</td>
		    	<td id="hidden_div6" style="visibility:hidden;" ><input id=""/></td>
	
		    
		</tr>
			<td >Percentage in<BR>M.A./M.Sc./M.Com</td>
			<td ><input id="INPUT4"/></td>
			<td>
			    <table frame="hsides" rules="groups" class="resech_p_cus">
			<tr><th colspan="2" align ="center" class="reasear_acti_hehe">Research Activities*</th>
			<TR><TD>Category<td>NO
			<TR><TD>Category I<TD><input size="5" id="cat1"/>
			<TR><TD>Category II<TD><input size="5" id="cat2"/>
			<TR><TD>Category III<TD><input size="5" id="cat3"/>
			<TR><TD>Category IV<TD><input size="5" id="cat4"/>
			<TR><TD>Category V<TD><input size="5" id="cat5"/>
			</table></td>
			<td >Your Score<br><input id="INPUT9"/></td>
		<tr></tr>
			<td >Spl. Awards<BR>(Max. 6)</td>
			<td ><input id="INPUT5"/></td>
			<td>Experiences<BR>(Max. 6)</td>
			<td ><input id="INPUT10"/></td>
		<tr></tr>
			<td colspan="4"align="center"><button onclick="addnumbers()">CALCULATE</button></td>
		<tr></tr>
			<td>ACADEMIC</td>
			<td><input id="answer1"/></td>
			<td>RESEARCH</td>
			<td><input id="answer2"/></td>
		<tr>
			<td>INTERVIEW</td>
			<td><input id="answer3"/></td>
			<td>TOTAL</td>
			<td><input id="answer4"/></td>
		</tr>
		<tr>
		<td colspan="2",rowspan="2"><TABLE style="font-size:11px" class="category_ppp_ccc"><TR><TD>*Category I: UGC care listed Journal. 
		<TR><TD>Category II: Scopus journals.
		<TR><TD>Category III: SCIE/SCI/SSCI Journals.
		<TR><TD>Category IV: UGC approved Journal <br>(before 14 june 2019).
		<TR><TD>Category V: Reffered Jorunal with ISSN.
		</TABLE>
			<td>DEFICIT/SURPLUS</td>
			<td><input id="answer5"/></td>
		</tr>
		<tr>
		<td id="r" colspan="4"align="center"><input type="text" id="cc" align="center"></td>
		<tr></tr>
			<td colspan="4"align="center"><button class="btn print" id="btnPrint">Print</button></td>
		</table>
		</p>
		</div>
		</div>
		
	</body>
</html>