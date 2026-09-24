<?php
/*error_reporting(0);
session_start();
if ($_SESSION["uid"] != 'yes' || ($_SESSION['uniq'] != 'TnportalA1@3' && $_SESSION['ptoken'] != $_POST['ptoken']))
 {
    
	header("location:entrylogin.php");
	 exit;
 }
 */
include("conn.php");

//--- begin   chandru sirs code

$pio = $_POST['pio'];
$pio1 = $_POST['pio1'];
$pio2 = $_POST['pio2'];
$pio3= $_POST['pio3'];
$pio4 = $_POST['pio4'];
$pio5 = $_POST['pio5'];
$nopio1 =$_POST['nopio'];	  
$t1 = $_POST['t11'];
$t2 = $_POST['t12'];
$cmsnr1 = $_POST['cmsnr1'];
$cmsnr2 = $_POST['cmsnr2'];
$cmsnr3 = $_POST['cmsnr3'];
$directions1 = $_POST['directions1'];

$category1 = $_POST['category1'];
$catno11 = $_POST['catno1'];
$oldcategory1 = $_POST['oldcategory1'];
$oldcatno11 = $_POST['oldcatno11'];
$oldcatyy11 = $_POST['oldcatyy11'];

//echo "category";
//echo $category1;
//echo "cat no";
//echo $catno11;
//echo "old cat";
//echo $oldcategory1;
//echo "old cat no";
//echo $oldcatno11;
//echo "old cat yr";
//echo $oldcatyy11;

 // $directions1 = "m";
  if ($directions1 == "m")
  {
	   $mchk1 = "checked";
  } //if ($directions1 == "m")
    if ($directions1 == "m")
  {	  
	  $ochk1 = "checked";
  } //if ($directions1 == "m")
  //
  $chk1 = "";
    $chk2 = "";  $chk3 = "";  $chk4 = "";  $chk5 = "";  $chk6 = "";  $chk7 = "";  $chk8 = "";  $chk9 = "";  $chk10 = "";  $chk11 = "";  $chk12 = "";  $chk13 = "";
  if (($cmsnr1 == "SIC-KSS") || ($cmsnr2 == "SIC-KSS") || ($cmsnr3 == "SIC-KSS") )
  {
  	$chk1 = "checked=\"checked\"";
  } //if ($cmnsr1 == "SIC-KSS")
  else //else of if ($cmnsr1 == "SIC-KSS")
  {
  	$chk1= "";
  } //end of else if ($cmnsr1 == "SIC-KSS")
  
  if (($cmsnr1 == "SIC-RP") ||($cmsnr2 == "SIC-RP") || ($cmsnr3 == "SIC-RP"))
  {
  	$chk6 = "checked=\"checked\"";
  } //if ($cmnsr6 == "SIC-RP")
  if (($cmsnr1 == "SIC-TS") || ($cmsnr2 == "SIC-TS")  || ($cmsnr3 == "SIC-TS"))
  {
  
  	$chk7 = "checked=\"checked\"";
  } //if ($cmnsr7 == "SIC-TS")



  if (($cmsnr1 == "SIC-VS") || ($cmsnr2 == "SIC-VS") || ($cmsnr3 == "SIC-VS"))
  {
  	echo ("hai is it ok?");
  	$chk9 = "checked=\"checked\"";
  } //if ($cmnsr9 == "SIC-VS")
  if (($cmsnr1 == "SIC-CN") || ($cmsnr2 == "SIC-CN") || ($cmsnr3 == "SIC-CN"))
  {
  	$chk10 = "checked=\"checked\"";
  } //if ($cmnsr10 == "SIC-CN")
  if (($cmsnr1 == "SIC-PT") ||($cmsnr2 == "SIC-PT") || ($cmsnr3 == "SIC-PT"))
  {
  	$chk11 = "checked=\"checked\"";
  } //if ($cmnsr11 == "SIC-PT")
  if (($cmsnr1 == "SIC-BN") || ($cmsnr2 == "SIC-BN") || ($cmsnr3 == "SIC-BN"))
  {
  	$chk12 = "checked=\"checked\"";
  } //if ($cmnsr12 == "SIC-BN")
  if (($cmsnr1 == "SIC-SFA") || ($cmsnr2 == "SIC-SFA") || ($cmsnr3 == "SIC-SFA"))
  {
  	$chk13 = "checked=\"checked\"";
  } //if ($cmnsr13 == "SIC-SFA")

if (($cmsnr1 == "SIC-KR") || ($cmsnr2 == "SIC-KR") || ($cmsnr3 == "SIC-KR"))
  {
  	$chk14 = "checked=\"checked\"";
  } //if ($cmnsr13 == "SIC-SFA")
if (($cmsnr1 == "SIC-GM") || ($cmsnr2 == "SIC-GM") || ($cmsnr3 == "SIC-GM"))
  {
  	$chk15 = "checked=\"checked\"";
  } //if ($cmnsr13 == "SIC-SFA")
if (($cmsnr1 == "SIC-RD") || ($cmsnr2 == "SIC-RD") || ($cmsnr3 == "SIC-RD"))
  {
  	$chk16 = "checked=\"checked\"";
  } //if ($cmnsr13 == "SIC-SFA")


  //
  $nocmsnr1 = 1;
  $scmsnr2 = strlen($cmsnr2);
  if ($scmsnr2 > 1)
  {
   $nocmsnr1 = $nocmsnr1 +1;
  } //if ($scmsnr2 > 1)
  
  $scmsnr3 = strlen($cmsnr3);
  if ($scmsnr3 > 1)
  {
   $nocmsnr1 = $nocmsnr1 +1;
  } //if ($scmsnr2 > 1)

$peti = $_POST['peti'];
// --- end of chandru sirs code

	  
?>
<link rel="stylesheet" href="jquery-ui.css" />

<script language="Javascript" src="jquery.js"></script>
<script language="Javascript" src="jquery-ui.js"></script>
<script>
$(function(){
$("#txtDate1").datepicker({dateFormat: "dd-mm-yy"});
$("#txtDate2").datepicker({dateFormat: "dd-mm-yy"});
$('.tab-section').hide();
$('#tabs a').bind('click', function(e){
$('#tabs a.current').removeClass('current');
$('.tab-section:visible').hide();
$(this.hash).show();
$(this).addClass('current');
e.preventDefault();
}).filter(':first').click();  
});
</script>

<style type="text/css">
<!--
a:link {
	color: #000000;
}
a:visited {
	color: #000000;
}
a:hover {
	color: #000000;
}
a:active {
	color: #000000;
}
.style34 {color: #FF0000}
.style35 {color: #000000}
.style26 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<html>

<head>
<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tamil Nadu State Information Commission</title>
<link href="innerpage.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
-->
.submitLink {
background-color: transparent;
text-decoration: none;
border: none;
cursor: pointer;
cursor: hand;
}

.style25 {font-family: "Courier New", Courier, monospace}
.style27 {
	color: #0066FF;
	font-weight: bold;
}
.style28 {color: #0066FF}
.style30 {font-size: 9pt}
</style>
<script type="text/javascript" src="../include/validate.js"></script>
<script language="JavaScript">
function Validator(theform)
{
if(theform.caseno.value=="" )
   {
    alert("Enter Case No.");
	 theform.caseno.focus(); 
    return false;
  }
   if(chkbadchar(theform.caseno.value)==false )
   {
    alert("Enter a valid Case No.");
		 theform.caseno.focus(); 
    return false;
  }
   if(isNumber(theform.caseno.value)==false )
   {
    alert("Enter a valid Case No.");
		 theform.caseno.focus(); 
    return false;
  }
  if(!(theform.addl_caseno.value==""))
  {
  if(chkbadchar(theform.addl_caseno.value)==false )
   {
    alert("Enter a valid Additional Case No.");
		 theform.addl_caseno.focus(); 
    return false;
   }
    if(isNumber(theform.addl_caseno.value)==false )
   {
    alert("Enter a valid Additional Case No.");
		 theform.addl_caseno.focus(); 
    return false;
  }
  }
	if(theform.case_year.value=="" )
    {
    	alert("Enter Year");
	 	theform.case_year.focus(); 
    	return false;
    }
   if(chkbadchar(theform.case_year.value)==false )
    {
    	alert("Enter a valid Year.");
		theform.case_year.focus(); 
    	return false;
  	}
  if(isNumber(theform.case_year.value)==false )
   {
    alert("Enter a valid year.");
		 theform.case_year.focus(); 
    return false;
  }
/*  if(theform.txtDate1.value =="")
    {
    	alert("Enter Hearing Date");
	 	theform.txtDate1.focus(); 
    	return false;
    }*/
	
var yr=document.test.case_year.value;
var d = new Date();
var curr_day = d.getDate();
var curr_month = d.getMonth();
var curr_year = d.getFullYear();
var dt1 = new Date(curr_year, curr_month, curr_day);
if(yr>curr_year) 
{
	alert('Please Enter Year Less Than ' +curr_year);
	return false; 
}

var date2 = test.txtDate1.value; /* Date entered in the form */
var diff = dt1 - date2;
today=new Date()
//Get 1 day in milliseconds
var one_day=1000*60*60*24
var edt = date2.split("-"); 
var seldt=new Date(edt[2],edt[1]-1,edt[0]);

//Calculate difference btw the two dates, and convert to days
if((Math.ceil((dt1.getTime()-seldt.getTime())/(one_day))) < 0)
{
	alert('Hearing Date Cannot Be Greater Than Current Date');
    return false; 
}

	if(theform.petitioner.value=="" )
    {
    	alert("Enter Petitioner");
	 	theform.petitioner.focus(); 
    	return false;
    }
   if(chkbadchar(theform.petitioner.value)==false )
    {
    	alert("Enter  valid Petitioner");
		theform.petitioner.focus(); 
    	return false;
  	}
	
	if(theform.pio1.value=="" )
    {
    	alert("Atleast on Public Information Officer detail should be entered");
	 	theform.pio1.focus(); 
    	return false;
    }
   if(chkbadchar(theform.pio1.value)==false )
    {
    	alert("Enter valid Public Information Officer 1");
		theform.pio1.focus(); 
    	return false;
  	}
	if (!(theform.pio2.value == ""))
	{
	if(chkbadchar(theform.pio2.value)==false )
    {
    	alert("Enter valid Public Information Officer 2");
		theform.pio2.focus(); 
    	return false;
  	}
	}
	if (!(theform.pio3.value == ""))
	{
	if(chkbadchar(theform.pio3.value)==false )
    {
    	alert("Enter valid Public Information Officer 3");
		theform.pio3.focus(); 
    	return false;
  	}
	}
	if (!(theform.pio4.value == ""))
	{
	if(chkbadchar(theform.pio4.value)==false )
    {
    	alert("Enter valid Public Information Officer 4");
		theform.pio4.focus(); 
    	return false;
  	}
	}
	if (!(theform.pio5.value == ""))
	{
	if(chkbadchar(theform.pio5.value)==false )
    {
    	alert("Enter valid Public Information Officer 5");
		theform.pio5.focus(); 
    	return false;
  	}
	}
	var fullPath = document.getElementById('pdfname').value;
if (fullPath) {
	var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
	var filename = fullPath.substring(startIndex);
	if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
		filename = filename.substring(1);
	}
	//alert(filename);
	if(chkbadchar(filename)==false )
    {
    	alert("Invalid file name. Rename and upload the file.");
		theform.pdfname.focus(); 
    	return false;
  	}
	var parts = filename.split('.');
	if (!(parts[1] == "pdf"))
	  { alert("Invalid file type. Upload valid file");
	    theform.pdfname.focus(); 
	     return false;
	   }
}
	/*if (theform.pdfname.value == "")
	{
	 if(chkbadchar_f(theform.pdfname.value)==false)
	{
	alert("invalid file name");
	return false;
	}   
	  */
	 // alert(theform.pdfname.value);
	return true;
}
</script>
<script language="JavaScript">  

    function toggle(id) {  

         var state = document.getElementById(id).style.display;  

            if (state == 'block') {  
                document.getElementById(id).style.display = 'none';  
             } else {  
                document.getElementById(id).style.display = 'block';  
             }  
 }  
 </script> 
 
</head>
<body> 
<table align="center" width="80%" border="1" bgcolor="#999999">
<tr><td><IMG src="../../images/default_01.gif" border=0 width="995" height="104"></td></tr>
<tr><td><font face="arial" class="pagnired" align="left" >Welcome Web Administrator !</font> </td>
</tr>
<tr>
  <td bgcolor="#999999">
  <?php if ($_SESSION['user'] == "user")
  { ?>
  <span class="style26"><a href="entrycauselist.php">New Judgement Entry</a>&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp; <a href="judgementlist.php">List Judgements</a> &nbsp;&nbsp;&nbsp; |&nbsp;&nbsp; <a href="logout.php">Logout</a></span>
   <?php } 
   else if ($_SESSION['user'] == "super")
   { ?>
   <span class="style26"><a href="entrycauselist.php">New Judgement Entry</a>&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp; <a href="judgementlist.php">List Judgements</a> &nbsp;&nbsp;&nbsp; |&nbsp;&nbsp; <a href="editcauselist.php">Edit Judgements</a>&nbsp;&nbsp; |&nbsp; <a href="deletecauselist.php">Delete Judgements</a>&nbsp; |&nbsp;<a href="comm_report.php">Report - Commissioner Wise</a>&nbsp;&nbsp; |&nbsp; <a href="logout.php">Logout</a></span>
   <?php } ?>
  </td>
</tr>

</table>

 <?php
if(!empty($_COOKIE['error_msg'] )){
print_r( $_COOKIE['error_msg']);
setcookie("error_msg", '', time()+3600, '/');
}
?>
</center></b>
</div>
<div id="fail" style="color:green" class="black"><b><center>
  <p>
    <?php
if(!empty($_COOKIE['succ_msg'] )){
print_r( $_COOKIE['succ_msg']);
setcookie("succ_msg", '', time()+3600, '/');
}
?>
  </p>
</center></b>
</div>
<form name='test' method="POST" action="savecauselistnew.php"  onSubmit="return Validator(this)" ENCTYPE="multipart/form-data" accept-charset='UTF-8' >
         
	    <p align="center" class="sub style25"><strong> New Judgement Entry
        </strong>
  <table width="80%" border="1" align="center" cellpadding="4" cellspacing="3" bordercolorlight="#800000" bordercolordark="#FFFFFF">
            <tr>
              <td width="30%" class="ErrMsgBlCentAlign"><div align="left"><span class="style27"><font face="Arial" size="2">Case No.</font></span></div></td>
              <td width="21%" class="ErrMsgBlCentAlign">
                  <div align="left">
                    <input type="hidden" name="ptoken" value="<?php echo $ptoken;?>" />	
                  </div>
                  <p align="left"><input type="text" name="caseno" size="20" value="<?php echo $t1;?>">
              </td>
			 
              <td width="16%" class="ErrMsgBlCentAlign"><span class="style28"><b><font face="Arial" size="2">Category : <?php echo $category1; ?><input type="hidden" name="category" value="<?php echo $category1; ?>">
			  
			  </font></b></span></td>
              <td class="ErrMsgBlCentAlign"><div align="left"><span class="style28">
			   
                <input type="text" name="cat_no" size="20" value="<?php echo $catno11;?>">
				</span></div></td>
            </tr>
                      
            <tr>
              <td width="30%" class="ErrMsgBlCentAlign"><div align="left"><span class="style28"><b><font face="Arial" size="2">Year</font></b></span> <span class="style34">*</span></div></td>
              <td class="ErrMsgBlCentAlign"><div align="left">
                <input name="case_year" type="text" size="16"  value="<?php echo $t2;?>">              
              </div></td>
              <td class="style28"><b><font face="Arial" size="2">Hearing Date</font></b><br>
              <span class="style30">(Click on box for calender)</span></td>
              <td class="ErrMsgBlCentAlign"><div align="left">
                <input name="txtDate1" type="text" id="txtDate1" size="12" readonly="true" > 
              </div></td>
            </tr>
            
            <tr>
              <td width="30%" class="ErrMsgBlCentAlign"><div align="left"><span class="style28"><b><font face="Arial" size="2">Judges</font></b></span> <span class="style34">*</span></div></td>
              <td colspan="2" class="ErrMsgBlCentAlign"><div align="left" class="style35">
			   <input name="judge14" type="checkbox" id="judge14" value="1" <?php echo $chk14;?>>
              Thiru K. Ramanujam, I.P.S., (Retd.)- SCIC</font><br>
              
			  <input name="judge15" type="checkbox" id="judge15" value="1" <?php echo $chk15;?>>
              Thiru G. Murugan, B.Sc., B.L<br>
			  
<input name="judge16" type="checkbox" id="judge16" value="1" <?php echo $chk16;?>>
Thiru R. Dakshinamurthy, B.Sc.,B.L<br>

                <input name="judge8" type="checkbox" id="judge8" value="1" <?php echo $chk8;?>>
              Thiru. K.S Sripathi IAS (Retd)</font>				<br>
               
                <!--<input name="judge6" type="checkbox" id="judge6" value="1">			    
                Thiru. T Srinivasan M.Sc<br>
                <input name="judge9" type="checkbox" id="judge9" value="1">
                Dr.V. Saroja M.B.B.S.,M.D.,DGO<br>-->
                <input name="judge10" type="checkbox" id="judge10" value="1" <?php echo $chk10;?>>
                Thiru.Chirstopher Nelson I.P.S (Retd)</font></span><font size="2" face="Arial, Helvetica, sans-serif"><br>
                <br>
                </font></div></td>
              <td width="33%" class="ErrMsgBlCentAlign"><div align="left" class="style35">
                <input name="judge11" type="checkbox" id="judge11" value="1" <?php echo $chk11;?>>
Thiru.P. Thamilselvan M.A. B.L <br>
<input name="judge12" type="checkbox" id="judge12" value="1" <?php echo $chk12;?>>
              Tmt.B Neelambikai M.A., B.L<br>
  <input name="judge13" type="checkbox" id="judge13" value="1" <?php echo $chk13;?>>
              Thiru.S.F.Akbar B.Sc., B.L</font></div></td>
            </tr>
            <tr>
              <td width="30%" class="ErrMsgBlCentAlign"><div align="left"><span class="style28"><b><font face="Arial" size="2">Petitioner</font></b></span> <span class="style34">*</span></div></td>
              <td colspan="3" class="ErrMsgBlCentAlign"><div align="left"><span class="style28">
                <textarea rows="2" name="petitioner" cols="35"><?php echo $peti;?></textarea></font>
              </span></div></td>
            </tr>
            <tr>
              <td width="30%" class="ErrMsgBlCentAlign"><div align="left"><span class="style28"><b><font face="Arial" size="2">Public Information Officer
              1.&nbsp;</font></b></span> <span class="style34">*</span></div></td>
              <td colspan="3" class="ErrMsgBlCentAlign"><div align="left"><span class="style28">
                <textarea rows="2" name="pio1" cols="35"><?php echo $pio;?></textarea>
              </span></div></td>
            </tr>
            <tr>
              <td width="30%" class="ErrMsgBlCentAlign"><div align="left"><span class="style28"><b><font face="Arial" size="2">Public Information Officer
              2.&nbsp;</font></b></span></div></td>
              <td colspan="3" class="ErrMsgBlCentAlign"><div align="left"><span class="style28">
                <textarea rows="2" name="pio2" cols="35"><?php echo $pio1;?></textarea>
              </span> </div>
			   <a href="#" onClick="toggle('hidden');"><font face="Arial, Helvetica, sans-serif" color="Blue"><B><U>Add more PIOs</U></B></font></a>  

 </div> 
 <div id="hidden" style="display:none">&nbsp;&nbsp;
PIO - 3 :  <textarea rows="2" name="pio3" cols="35"><?php echo $pio2;?></textarea><br>
PIO - 4 :  <textarea rows="2" name="pio4" cols="35"><?php echo $pio3;?></textarea><br>
PIO - 5 :  <textarea rows="2" name="pio5" cols="35"><?php echo $pio4;?></textarea>
 </div>			  </td>
            </tr>
            <tr>
              <td width="30%" class="ErrMsgBlCentAlign"><div align="left"><span class="style28"><b><font face="Arial" size="2">Upload
              hearing Details</font></b></span> <span class="style34">*</span></div></td>
              <td colspan="3" class="ErrMsgBlCentAlign"><div align="left">
              <input type="file" name="pdfname" size="20" id="pdfname">
                 <br>
              <span class="pagnired">(filename format : 'caseno_2014.pdf'. No special characters are allowed)</span></td>
            </tr>
            <tr>
              <td colspan="4" align="center" class="ErrMsgBlCentAlign"> 
                <div align="center">
  <input type="submit" value="submit" name="submit">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
            </tr>
  </table>

</form>
            </td>
        </tr>
        <tr> 
          <td height="9">&nbsp;</td>
        </tr>
      </table>
      
      
     </td>
  </tr>
  <tr valign="bottom"> 
    <td height="19" align="right">&nbsp;</td>
  </tr>
</table>

</body>
<?php odbc_close($conn2); ?>
</html>
