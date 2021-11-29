<html>
	<head>
	<style>
	table tr td {
    color: #000;
    font-family: sans-serif;
}

table.ippas_api_section_class h1 {
    font-size: 24px;
    color: #56a82b;
}

table.ippas_api_section_class {
    border: 0px;
    border-color: transparent !important;
}
table.ippas_api_section_class input {
    height: 40px;
    margin-bottom: 7px;
    padding-left: 15px;
    border-radius: 5px;
    border: 1px solid #333;
    box-shadow: none;
}

table.api_p_cus_ppp_table {
    border: 0;
    border-color: transparent;
}
.all_section_p_cus_all_table_p_cus button {
    background: #202c45;
    color: #fff;
    border: 0;
    padding: 12px 35px;
    margin-top: 10px;
}
table.api_p_cus_ppp_table input {
    height: 40px;
    margin-top: 5px;
}
table.api_p_cus_ppp_table select {
    height: 40px;
    margin-top: 5px;
}


.all_section_p_cus_all_table_p_cus input[type="button"] {
    background: #56a82b;
    border: 0;
    box-shadow: none;
    color: #fff;
    padding: 5px 10px;
}
input#in11, input#in12, input#in13, input#in14, input#in15, input#in16, input#in17, input#in18, input#in19, input#in20, input#in5,input#in6, input#in21, input#in22, input#in23, input#in24, input#in25, input#in26, input#in27, input#in28, input#in29, input#in30 {
    width: 100%;
    height: 40px;
}
table tr th {
    color: #000;
    font-family: sans-serif;
}
.outside_logo_sec_all {
    width: 100%;
    float: left;
    text-align: center;
    padding: 15px;
}
.outside_logo img {
    width: 350px;
}
.all_section_p_cus_all_table_p_cus {
    background: #e9faff;
    width: 100%;
    float: left;
    padding: 30px 0px;
}

	 body{margin:0;}
	 table {
  color: white;
  border-bottom-color:black;
}
	.alert {
  padding: 20px;
  background-color: #f44336; /* Red */
  color: white;
  margin-bottom: 15px;
}
	/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}
input#in1 {
    height: 40px;
}
input#in2 {
    height: 40px;
}
select#sel {
    height: 40px;
}
input#in3 {
    height: 40px;
}
input#out10 {
    height: 40px;
}
input#TOTAL {
    height: 40px;
}
input#out9 {
    height: 40px;
}
input#in4 {
    height: 40px;
}
button.submit_p_cus_sec {
    background: #56a82b;
    border: 0;
    width: 110px;
    height: 36px;
    color: #fff;
    border-radius: 5px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 1500px;
  padding: 10px;
  background-color: darkred;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
div.c{
font-size:large;
}
	</style>
		<title> API General Degree College</title>
		<script>
			var c0,dt1,cat1,cat2,cat3,cat22,cat23,ay,st=0,ed,it;
			var cnt=2,joindate,dt=0;
			var rpr,book,bookch,rp,cp,rg,ilp,fel,elr;
			var d1,d2,d3,d4;
			var v=[];
			var count=0,c0,v9,v10;
			var nm,ins,des,ph,wa,em;
			var selVal,selVal2;
			var Category1=["Direct Teaching (in Hrs.)", 
							"Answer Script Evaluation#",
							"Paper Setting#",
							"Moderation#",
							"Innovative Teaching(in Hrs.)",
							"Student Related Cocurricular Activities(in Hrs.)",
							"Corporate Management(in Hrs.)",
							"Professional Developement Activities(in Hrs.)"
							];
			function msg1()
			{
			    if(dt==0)
				{
					window.alert(n);
					window.alert("Input Date of Joining");
					location.reload(true);
				}
			}
			function msg()
			{
			     var m1=document.getElementById("op").value
				 var m2=document.getElementById("rc").value;
				 if(m1==0 && m2==0)
				 {
					window.alert("You cantnot make blank Refresher Course and Orientation Program");
					location.reload(true);
				}
				else if(selVal>2 && m2==0)
				{
					window.alert("You cannot make blank Refresher Course");
					location.reload(true);
				}
				 else
				 {
					c0=20;
				 }
			}
			function calculate()
			{
				
				//window.alert(v.length);
				v9=Number(document.getElementById("out9").value);
				v10=Number(document.getElementById("out10").value);
				rpr=(v9+v10);
				book=(v[0]+v[1]);
				bookch=(v[2]+v[3]+v[4]);
				rp=(v[5]+v[6]+v[7]);
				cp=v[8];
				rg=(v[9]+v[10]+v[11]);
				ilp=((v[12]+v[13]+v[14]+v[15]+v[16]+v[17])*(20/100));
				fel=(v[18]+v[19]+v[20]);
				elr=v[21];
				cat1=(cat1)/ay;
				cat22=(cat2+ed+it)/ay;
				//window.alert(cat2);
				cat3=(rpr+book+bookch+rp+cp+rg+ilp+fel+elr);
				cat23=c0+cat22+cat3;
				total=cat1+cat22+cat3;
				document.getElementById("TOTAL").value=total;
				//var text="Your Category I is "+cat1+"should be >=80\n Your Category II is "+cat2+"should be >=50\nYour Category III is "+cat3+"Should be >=20";
				//window.alert(text);
			}
			function age()
			{
				var curdt=new Date();
				dt=document.getElementById("join").value;
				var d=new Date(dt);
				joindate=d;
				var ndate=new Date(dt);
				ndate.setDate(d.getDate()+365);
				dt1=(Math.round((curdt - d)/ (31557600000)));
				msg1();
				if(ay==0)
				{
					ay=6;
				}
				if(dt1<ay)
				{
					window.alert("You are not eligible for any promotion");
					location.reload(true);
				}
				var sID = document.getElementById("sel");
				selVal = sID.options[sID.selectedIndex].value;
				var seltxt = sID.options[sID.selectedIndex].text;
				if(selVal==2)
				{
					chek();
					//alert("Selected Item  " +  seltxt + " So your Academic year will be "+ay);
				}
				else if(selVal==3)
				{
					ay=5;
					//alert(" So your Academic year will be "+ 5 +" after Stage I Promotion");
				}
				else if(selVal==4)
				{
					ay=3;
					//alert(" So your Academic year will be "+ 3 +" after Stage II Promotion");
				}
				else
				{
				     ay=6;
				}
				//var text="You have "+dt1+" Years of Experiences \n But you have to enter "+ay+" years as academic year in Stage 1";
			}
			function chek()
			{
				var sID2 =document.getElementById("sel2");
				selVal2=sID2.options[sID2.selectedIndex].value;
				var seltxt2=sID2.options[sID2.selectedIndex].text;
				if(selVal2==2)
				{
					ay=4;
				}
				else if(selVal2==3)
				{
					ay=5;
				}
				else
				{
					ay=6;
				}
			}
			function score()
			{
				document.getElementById("cat1").value=cat1;
				document.getElementById("cat2").value=cat22;
				document.getElementById("cat3").value=cat3;
				document.getElementById("cat23").value=cat23;
				document.getElementById("acat1").value=">80";
				document.getElementById("acat2").value=">50";
				document.getElementById("acat3").value=">20";
				document.getElementById("acat23").value=">90";
				d1=cat1-80;d2=cat22-50;d3=cat3-20;d4=cat23-90;
				document.getElementById("dcat1").value=cat1-80;
				document.getElementById("dcat2").value=cat22-50;
				document.getElementById("dcat3").value=cat3-20;
				document.getElementById("dcat23").value=cat23-90;
				if(d1<0 || d2<0 || d3<0 || d4<0){
					document.getElementById("answer").value="you are not eligible";
				}
				else{
				    document.getElementById("answer").value="Elligible";
				}
			}
			function openForm() {
					document.getElementById("myForm").style.display = "block";
			}

			function closeForm() {
					document.getElementById("myForm").style.display = "none";
			}
			function ontab25(e,inn,r,cl)
			{
				var c;
				var tbl3=document.getElementById("table3");
				if(e.keyCode==9)
				{
					c=Number(document.getElementById(inn).value)*25;
					tbl3.rows[r].cells[cl].innerHTML=c;
					v[count]=c;
					count++;
				}
				
			}
			function ontab30(e,inn,r,cl)
			{
				var c;
				var tbl3=document.getElementById("table3");
				if(e.keyCode==9)
				{
					c=Number(document.getElementById(inn).value)*30;
					tbl3.rows[r].cells[cl].innerHTML=c;
					v[count]=c;
					count++;
				}
				
			}
			function ontab10(e,inn,r,cl)
			{
				var c;
				var tbl3=document.getElementById("table3");
				if(e.keyCode==9)
				{
					c=Number(document.getElementById(inn).value)*10;
					tbl3.rows[r].cells[cl].innerHTML=c;
					v[count]=c;
					count++;
				}
				
			}
			function ontab15(e,inn,r,cl)
			{
				var c;
				var tbl3=document.getElementById("table3");
				if(e.keyCode==9)
				{
					//window.alert("look");
					c=Number(document.getElementById(inn).value)*15;
					tbl3.rows[r].cells[cl].innerHTML=c;
					v[count]=c;
					count++;
				}
				
			}
			function ontab5(e,inn,r,cl)
			{
				var c;
				var tbl3=document.getElementById("table3");
				if(e.keyCode==9)
				{
					//window.alert("look");
					c=Number(document.getElementById(inn).value)*5;
					tbl3.rows[r].cells[cl].innerHTML=c;
					v[count]=c;
					count++;
				}
				
			}
			function ontab20(e,inn,r,cl)
			{
				var c;
				var tbl3=document.getElementById("table3");
				if(e.keyCode==9)
				{
					c=Number(document.getElementById(inn).value)*20;
					tbl3.rows[r].cells[cl].innerHTML=c;
					v[count]=c;
					count++;
				}
				
			}
			function ontab7(e,inn,r,cl)
			{
				var c;
				var tbl3=document.getElementById("table3");
				if(e.keyCode==9)
				{
					//window.alert("look");
					c=Number(document.getElementById(inn).value)*7;
					tbl3.rows[r].cells[cl].innerHTML=c;
					v[count]=c;
					count++;
				}
				
			}
			function ontab3(e,inn,r,cl)
			{
				var c;
				var tbl3=document.getElementById("table3");
				if(e.keyCode==9)
				{
					//window.alert("look");
					c=Number(document.getElementById(inn).value)*3;
					tbl3.rows[r].cells[cl].innerHTML=c;
					v[count]=c;
					count++;
				}
				
			}
			function ontab2(e,inn,r,cl)
			{
			    var c;
				var tbl3=document.getElementById("table3");
				if(e.keyCode==9)
				{
					//window.alert("look");
					c=Number(document.getElementById(inn).value)*2;
					tbl3.rows[r].cells[cl].innerHTML=c;
					v[count]=c;
					count++;
				}
				
			}
			function addRow1(tableID) 
			{

				var table = document.getElementById(tableID);
				//var rowCount = table.rows.length;
				var r=table.insertRow(0);
				var p1=r.insertCell(0);
				r.appendChild(p1);
				p1.innerHTML="CATEGORY";
				var p2=r.insertCell(1);
				r.appendChild(p2);
				p2.innerHTML="ACTIVITIES";
				for (var p=2;p<2+ay;p++)
				{
					var p3=r.insertCell(p);
					r.appendChild(p3);
					var ndate=new Date(dt);
					ndate.setDate(joindate.getDate()+365*(p-1));
					var dat=ndate.getDate();
					var mon=ndate.getMonth();
					var y=ndate.getFullYear()
					p3.innerHTML=" YEAR "+(p-1)+"\n"+"("+dat+"/"+mon+"/"+y+")";
				}
				var p4=r.insertCell(p);
				r.appendChild(p4);
				p4.innerHTML=" RESULTED SCORE";
				var i,j;
				rowCount=8;
				for(i=1;i<=rowCount;i++)
				{
					var row = table.insertRow(i);
					var cel1=row.insertCell(0);
					//row.appendChild(cel1);
					if(i<=5){
						cel1.innerHTML="Category I";
					}
					else{
					     cel1.innerHTML="Category II";
					 }
					var cel2=row.insertCell(1);
					cel2.innerHTML=Category1[i-1];
					for(j=2;j<2+ay;j++)
					{
						var cell4 = row.insertCell(j);
						var element1 = document.createElement("input");
						element1.type = "text";
						element1.name="textbox[]";
						element1.id="i"+i;
						element1.size="5";
						cell4.appendChild(element1);
						cnt++;
					}
				var cell3 = row.insertCell(j);
				//var element2 = document.createElement("input");
				//element2.type = "text";
				//element2.name = "txtbox[]";
				//cell3.appendChild(element2);
			}
			
		}
		function getval(tableID)
			{
				var s=0,v=0;
				var tbl = document.getElementById(tableID);
				var rocnt=tbl.rows.length;
				for (var i=1;i<2;i++)
				{
					for (var j=2;j<2+ay;j++)
					{
						v=v+Number(tbl.rows[i].cells[j].childNodes[0].value);
					}
					if(ay==3)
					{
						tbl.rows[i].cells[j].innerHTML=v/7.75;
						s=s+(v/7.75);
						v=0;
					}
					else
					{
						tbl.rows[i].cells[j].innerHTML=v/7.5;
						s=s+(v/7.5);
						v=0;
					}
				}
				cat1=s;
				//var v=tbl.rows[1].cells[7].childNodes[0].value;
				//window.alert(cat1);
			}
		function getval1(tableID)
			{
				var s1=0,v=0,s3=0;
				var tbl = document.getElementById(tableID);
				var rocnt=tbl.rows.length;
				//window.alert(rocnt);
				for (var i=2;i<5;i++)
				{
					for (var j=2;j<2+ay;j++)
					{
						v=v+Number(tbl.rows[i].cells[j].childNodes[0].value);
					}
					tbl.rows[i].cells[j].innerHTML=v/10;
					s1=s1+(v/10);
					v=0;
				}
				ed=s1;
				for (var j=2;j<2+ay;j++)
					{
						v=v+Number(tbl.rows[5].cells[j].childNodes[0].value);
					}
					tbl.rows[5].cells[j].innerHTML=v/10;
				it=v/10;
				v=0;
				for (var i=6;i<rocnt-1;i++)
				{
					for (var j=2;j<2+ay;j++)
					{
						v=v+Number(tbl.rows[i].cells[j].childNodes[0].value);
					}
					tbl.rows[i].cells[j].innerHTML=v/10;
					s3=s3+(v/10);
					v=0;
				}
				cat2=s3;
				//window.alert(cat2);
			}
			function addRow(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "checkbox";
			element1.name="chkbox[]";
			cell1.appendChild(element1);

			var cell2 = row.insertCell(1);
			cell2.innerHTML = rowCount + 1;

			var cell3 = row.insertCell(2);
			var element2 = document.createElement("input");
			element2.type = "text";
			element2.name = "txtbox[]";
			element2.size=5;
			cell3.appendChild(element2);
			
			var cell4 = row.insertCell(3);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.name = "txtbox[]";
			element3.size=5;
			cell4.appendChild(element3);
			
			var cell5 = row.insertCell(4);
			var element4 = document.createElement("select");
			var opn1=document.createElement("option");
			opn1.text="Role";
			opn1.value=1;
			var opn2=document.createElement("option");
			opn2.text="First Author";
			opn2.value=2;
			var opn3=document.createElement("option");
			opn3.text="Other Author";
			opn3.value=3;
			cell5.appendChild(element4);
			element4.appendChild(opn1);
			element4.appendChild(opn2);
			element4.appendChild(opn3);

		}

		function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}
		function calculate2(tableID,in1,in2,out)
		{
			var impf,no,role,sum=0;
			var table = document.getElementById(tableID);
			var in1=Number(document.getElementById(in1).value);
			var in2=Number(document.getElementById(in2).value);
			var rowCount = table.rows.length;
			var r=impfactor(in1,in2,Number(table.rows[0].cells[4].childNodes[0].value));
			sum=sum+r;
			//window.alert(in1+"/"+in2+"/"+Number(table.rows[0].cells[4].childNodes[0].value));
			for(var i=1; i<rowCount; i++) 
			{
				var row = table.rows[i];
				impf=Number(row.cells[2].childNodes[0].value);
				no=Number(row.cells[3].childNodes[0].value);
				role=Number(row.cells[4].childNodes[0].value);
				//window.alert(impf+"/"+no+"/"+role);
				var p=impfactor(impf,no,role);
				sum=sum+p;
			}
			document.getElementById(out).value=sum;
		}
		function impfactor(impf,no,role)
		{
		     var X=25/10,augm,totalaugm;
			 if(impf>10)
			 {
				augm=25;
			}
			else if(impf>5 && impf<10)
			{
				augm=20;
			}
			 else if(impf>2 && impf<5)
			{
				augm=15;
			}
			else if(impf>1 && impf<2)
			{
				augm=10;
			}
			else 
			{
				augm=5;
			}
			totalaugm=(augm*no)+(X*no);
			if(role==2)
			{
				return totalaugm*(70/100);
			}
			else if(role==3)
			{
				return totalaugm*(30/100);
			}
			else
			{
				window.alert("Select Role");
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
	 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
		//var join=JSON.parse(sessionStorage.getItem("joindate"));
        $("#btnPrint").live("click", function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=1200,width=1600');
			var pesonal='<table style="font-size:30px;width:100%" align="center"><TR><TD>Name:'+nm+
													'<TR><TD>Institute:'+ins+
													'<TR><TD>Email:'+em+
													'</table>';
			var content='<table style="font-size:30px;width:100%" cellspacing="2" frame="hsides" rules="groups">'+
			'<TBODY>'+
			'<TBODY>'+
			'<TR><TD colspan="3" align = "center">CATEGORY I'+
			'<TBODY>'+
			'<TR><TD>1<TD>Direct Teaching<TD>'+cat1+
			'<TR><TD>2<TD>Examination Duties<TD>'+ed+
			'<TR><TD>3<TD>Innovative Teaching<TD>'+it+
			'<TBODY>'+
			'<TR><TD colspan="3" align = "center">CATEGORY II '+
			'<TBODY>'+
			'<TR><TD>4<TD>Student Related Activities<TD>'+cat2+
			'<TBODY>'+
			'<TR><TD colspan="3" align = "center">CATEGORY III'+
			'<TBODY>'+
			'<TR><TD>5<TD>Research Publication<TD>'+rpr+
			'<TR><TD>6<TD>Books Published<TD>'+book+
			'<TR><TD>7<TD>Chapters in Books<TD>'+bookch+
			'<TR><TD>8<TD>Research Projects<TD>'+rp+
			'<TR><TD>9<TD>Consultancy Projects<TD>'+cp+
			'<TR><TD>10<TD>Research Guidance<TD>'+rg+
			'<TR><TD>11<TD>Invited Lectures/Papers<TD>'+ilp+
			'<TR><TD>12<TD>Fellowship<TD>'+fel+
			'<TR><TD>13<TD>Elearning<TD>'+elr+
			'<TBODY>'+
			'<TBODY>'+
			'<TR><TD colspan="2">TOTAL<TD>'+total+
			'<TBODY>'+
			'<TR><TD colspan="2">Deficit/Surplus in Category I<TD>'+d1+
			'<TBODY>'+
			'<TR><TD colspan="2">Deficit/Surplus in Category II<TD>'+d2+
			'<TBODY>'+
			'<TR><TD colspan="2">Deficit/Surplus in Category III<TD>'+d3+
			'<TBODY>'+
			'<TR><TD colspan="2">Deficit/Surplus in Category II-III<TD>'+d4+
			'<TBODY>'+
			'</table>';
			var iipars='<table style="width:100%" align="center"><TR><TD>International Institute for Academic & Research Support'+
													'<TR><TD>Phone No:6297566041'+
													'<TR><TD>WhatsApp No:9609066503'+
													'<TR><TD><Input type="image" src="<?php echo base_url() ?>assets/images/iipars.jpg">'+
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
	    
	
		
		<div class="all_section_p_cus_all_table_p_cus">
		    	<h1 align="center">API Score for Assistant Professor</h1>
		<h2 align="center">General Degree Colleges/Universities</h2>
		<h2 align ="center">For an Academic Year</h2>
		
		<p align="center">
		<table id="t1" border="0" height="200" frame="hsides" rules="groups" class="ippas_api_section_class">
		<tr><th colspan="4"><h1>PERSONAL DETAILS</h1></th></tr>
		<tr></tr>
			<td ><input id="name" value="<?php echo @$user_details[0]->first_name; ?>" size="70" placeholder="NAME"/></td>
		<tr></tr>
			<td ><input id="inst" size="70" placeholder="INSTITUTION"/></td>
		<tr></tr>
			<td ><input id="desig" size="70" placeholder="DESIGNATION"/></td>
		<tr></tr>
			<td ><input id="ph" value="<?php echo @$user_details[0]->mobile; ?>" size="70" placeholder="PHONE NO"/></td>
		<tr></tr>
			<td ><input id="wa" size="70"placeholder="WHATSAPP NO"/></td>
		<tr></tr>
			<td><input id="email" value="<?php echo @$user_details[0]->login_email; ?>" size="70"placeholder="EMAIL"/></td>
		<tr></tr>
			<td colspan="3"align="center"><button onclick="submit()">Submit</button></td>
		</table>
		</p>
		<!--<h3 align="Center"><TABLE align="center"frame="hsides" rules="groups"><TR><TD>Date of Joining<br><input type="date" id="join">-->
		<!--<TD>Select Stage <br><select id="sel"><option value="1">Select Stage</option>-->
		<!--					<option value="2">Stage I-II</option>-->
		<!--					<option value="3">Stage II-III</option>-->
		<!--					<option value="4">Stage III-IV</option>-->
		<!--					</select>-->
		<!--<TD>Phd/Mphil<br><select id="sel2"><option value="1">Select Option</option>-->
		<!--					<option value="2">Joining with PhD</option>-->
		<!--					<option value="3">Joining with MPhil/ Equiv.</option>-->
		<!--					<option value="4">Joining without PhD/MPhil</option>-->
		<!--					</select>-->
		<!--<TD> No of Refresher course<br><input id="rc">-->
		<!--<TD>No of Orientation Program<br><input id="op">-->
		<!--<TR><TD colspan="6" align ="center"><button onclick="chek();age();addRow1('datatable')">SUBMIT</button></TABLE></h3>-->
		<div>
		<p align="center">
		    
		    	<h3 align="Center"><TABLE align="center"frame="hsides" rules="groups" class="api_p_cus_ppp_table"><TR><TD>Date of Joining<br><input type="date" id="join">
		<TD>Select Stage <br><select id="sel"><option value="1">Select Stage</option>
							<option value="2">Stage I-II</option>
							<option value="3">Stage II-III</option>
							<option value="4">Stage III-IV</option>
							</select>
		<TD>Phd/Mphil<br><select id="sel2"><option value="1">Select Option</option>
							<option value="2">Joining with PhD</option>
							<option value="3">Joining with MPhil/ Equiv.</option>
							<option value="4">Joining without PhD/MPhil</option>
							</select>
		<TD> No of Refresher course<br><input id="rc">
		<TD>No of Orientation Program<br><input id="op">
		<TR><TD colspan="6" align ="center"><button onclick="chek();age();addRow1('datatable')">SUBMIT</button></TABLE></h3>
		
		<TABLE id="datatable" border="2" cellpadding="5" cellspacing="3" color:white onclick="msg()" style="text-align: center; width: 100%">
		<COLGROUP align="center">
		<COLGROUP align="left">
		<COLGROUP align="center" span="2">
		<COLGROUP align="center" span="3">
		<THEAD valign="top">
		<TR><TD colspan="9" align="center"><button onclick="getval('datatable');getval1('datatable')">Data Submit</button>
		</TABLE>
		
		
		
		
		
		
		
		<TABLE border-collapse: collapse; id="table3" border="2" cellpadding="5" cellspacing="3" color:white onclick="msg()" style="width: 100%;" >
		<COLGROUP align="center">
		<COLGROUP align="left">
		<COLGROUP align="center" span="2">
		<COLGROUP align="center" span="3">
		<THEAD valign="top">
		<TR>
		<TH>CATEGORY
		<TH>Activities
		<TH>Sub<BR>Activities
		<TH>Inputs
		<TH>Resulted<BR>Score
		<TBODY>
		<TR><TD rowspan="24">Category III<TD rowspan="2">Research Publication<TD>No of Refereed Journals <BR>as notified by the UGC 
				<TD><INPUT type="button" value="Add Row" onclick="addRow('dataTable1')" />
					<INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable1')" />
					<INPUT align="rignt"type="button" value="Calculate"onclick="calculate2('dataTable1','in1','in2','out9')"/>
					<TABLE id="dataTable1" width="350px" border="1">
					<TR>
							<TD><INPUT type="checkbox" name="chk"/></TD>
							<TD> 1 </TD>
						<TD> <INPUT id="in1" placeholder="IF" size="5" /> </TD>
						<TD> <INPUT id="in2" placeholder="NO"size="5" /> </TD>
						<TD><select id="sel"><option value="1">Role</option>
							<option value="2">First Author</option>
							<option value="3">Other Author</option>
							</select></TD>
					</TR>
					</TABLE>
			<TD><input id="out9"/>
		<TR><TD>No of Other Reputed Journals <BR>as notified by the UGC
					<TD><INPUT type="button" value="Add Row" onclick="addRow('dataTable2')" />
					<INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable2')" />
					<INPUT align="rignt"type="button" value="Calculate"onclick="calculate2('dataTable2','in3','in4','out10')"/>
					
					<TABLE id="dataTable2" width="350px" border="1">
					<TR>
							<TD><INPUT type="checkbox" name="chk"/></TD>
							<TD> 1 </TD>
						<TD> <INPUT id="in3" placeholder="IF"size="5" /> </TD>
						<TD> <INPUT id="in4" placeholder="NO"size="5" /> </TD>
						<TD><select id="sel"><option value="1">Role</option>
							<option value="2">First Author</option>
							<option value="3">Other Author</option>
							</select></TD>
					</TR>
					</TABLE>
					<TD><input id="out10"/>
		<TR><TD rowspan="3"> No of Publications other than journal <BR>articles(Books) <TD>Internationl Level with ISBN/ISSN 
				<TD><input id="in11" onkeydown="ontab30(event,this.id,3,3)"/><TD>
		<TR><TD>Nationl Level with ISBN/ISSN<TD><input id="in12" onkeydown="ontab20(event,this.id,4,2)"/><TD>
		<TR><TD>Local Level with ISBN/ISSN<TD><input id="in13" onkeydown="ontab15(event,this.id,5,2)"/><TD>
		<TR><TD rowspan="2"> No of Publications other than journal <BR>Books Chapter <TD>Internationl Level 
				<TD><input id="in5" onkeydown="ontab10(event,this.id,6,3)"/><TD>
		<TR><TD>Nationl Level<TD><input id="in6" onkeydown="ontab5(event,this.id,7,2)"/><TD>
		<TR><TD rowspan="3"> NO of Research Projects<BR>(Sponsored Projects)<TD>Science Major >30 Lakh<BR>Arts Major >5 Lakh
				<TD><input id="in14" onkeydown="ontab20(event,this.id,8,3)"/><TD>
		<TR><TD>Science Major 5- 30 Lakh<BR>Arts Major 3 - 5 Lakh<TD><input id="in15" onkeydown="ontab15(event,this.id,9,2)"/><TD>
		<TR><TD>Science Minor<5 Lakh<br> Arts Minor<3 Lakh<TD><input id="in16" onkeydown="ontab10(event,this.id,10,2)"/><TD>
		<TR><TD>Consultancy Projects<TD>No of Projects(>2 Lakh)<TD><input id="in17" onkeydown="ontab10(event,this.id,11,3)"/><TD>
		<TR><TD rowspan="3">No of Research Guidance<TD> PHD Thesis Awarded<TD><input id="in18" onkeydown="ontab15(event,this.id,12,3)"/><TD>
		<TR><TD> PHD Thesis Submitted<TD><input id="in19" onkeydown="ontab10(event,this.id,13,2)"/><TD>
		<TR><TD>MPHIL Awarded<TD><input id="in20" onkeydown="ontab5(event,this.id,14,2)"/><TD>
		<TR><TD rowspan="3"> No of Invited Lectures<TD>Internationl <TD><input id="in21" onkeydown="ontab7(event,this.id,15,3)"/><TD>
		<TR><TD>National <TD><input id="in22" onkeydown="ontab5(event,this.id,16,2)"/><TD>
		<TR><TD>State/University Level <TD><input id="in27" onkeydown="ontab3(event,this.id,17,2)"/><TD>
		<TR><TD rowspan="3">Invited Papers<TD>Internationl <TD><input id="in28" onkeydown="ontab5(event,this.id,18,3)"/><TD>
		<TR><TD>National <TD><input id="in29" onkeydown="ontab3(event,this.id,19,2)"/><TD>
		<TR><TD>State/University Level <TD><input id="in30" onkeydown="ontab2(event,this.id,20,2)"/><TD>
		<TR><TD rowspan="3"> No of Fellowship<TD>Internationl Level<TD><input id="in23" onkeydown="ontab15(event,this.id,21,3)"/><TD>
		<TR><TD>National Level<TD><input id="in24" onkeydown="ontab10(event,this.id,22,2)"/><TD>
		<TR><TD>State/University Level<TD><input id="in25" onkeydown="ontab5(event,this.id,23,2)"/><TD>
		<TR><TD>Developement of Elearning Materials<TD> In No<TD><input id="in26" onkeydown="ontab10(event,this.id,24,3)"/><TD>
		<TBODY>
		<TR><TD><TD><TD><table frame="hsides" rules="groups">
			<TR><TD>#<td>UG<50<TD>UG>50<TD>PG<50<TD>PG>50
			<TBODY>
			<TR><TD>Evaluation<TD>0.3/<BR>Manuscript<TD>0.5/<BR>Manuscript<TD>0.5<TD>0.75
			<TR><TD>Question Paper<br>Settings<TD>5<TD>8<TD>4<TD>6
			<TR><TD>Moderation<TD>3<td>4<td>3<td>4
			</table>
			<TD align="center"><button onclick="calculate()" class="submit_p_cus_sec">SUBMIT</button><TD align="center">TOTAL<BR><input id="TOTAL"/>
	</TABLE>
		</p>
		</div>
		<button class="open-button" onclick="openForm();score()">Your Score Card</button>

		<div class="form-popup" id="myForm">
		<form class="form-container">
		<h1 align="center">Summery Of API</h1>
		<table border-collapse: collapse; frame="hsides" rules="groups">
		<tr><td>Criteria<td>Total API Score in<br>an assesment Year<td>Actual Scrore Should <td>Your Surplus/Deficit
		<tr><td>Category I<td><input id="cat1"><td><input id="acat1"><td><input id="dcat1">
		<tr><td>Category II<td><input id="cat2"><td><input id="acat2"><td><input id="dcat2">
		<tr><td>Category III<td><input id="cat3"><td><input id="acat3"><td><input id="dcat3">
		<tr><td>Category II+III<td><input id="cat23"><td><input id="acat23"><td><input id="dcat23">
		<tbody>
		<tr><td colspan="4" align="right"><input id="answer" align="center">
		<button class="btn cancel" onclick="closeForm()">Close</button>
		<tr><td colspan="4" align="right">
			<form id="form1">
				<div id="dvContainer">
				    This content needs to be printed.
				</div>
				<button class="btn print" id="btnPrint">Print</button>
			</form>
		</form>
		</div>
		</div>
	</body>
</html>