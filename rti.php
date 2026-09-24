<?php  
include "header.php";


require('config/dbconfig.php');
$qry = $DB_con->query("select * from mhc_document where display='Y' and doc_show_page='I' order by doc_id desc");
if($row = $qry->fetch())
{
	$file_id=$row['doc_id'];
	$file_name=$row['doc_title'];
	$size=$row['doc_size'];
	$lan=$row['doc_lan'];
	$as_on=date_format(date_create($row['doc_f_date']),"d-m-Y");
}
?>
<style type="text/css">
.table2 {
	width:auto;
    border:1px solid #f2f2f2;

    border-spacing:5px;
	
	
}
.Row {
	display:table-row;
    width:auto;
}

.Cell1 {
    float:left;
    display:table-column;
    width:170px;
 	text-align:left;
	background-color:#f1f1f1;
	font-size: 0.9em;
	padding: 10px;
}
.Cell2 {
    float:right;
    display:table-column;
    width:350px;
	text-align:justify;
	padding: 10px;
 
}
@media only screen and (max-width: 1025px){
	
	
	.table2 {
	width:auto;
    border:1px solid #f2f2f2;

    border-spacing:5px;
	
	
}
.Row {
	display:table-row;
    width:auto;
}

.Cell1 {
    float:left;
    display:table-column;
    width:150px;
 	text-align:left;
	background-color:#f1f1f1;
	font-size: 0.9em;
	padding: 10px;
}
.Cell2 {
    float:right;
    display:table-column;
    width:300px;
	text-align:left;
	padding: 10px;
 
}
	
	
}
@media only screen and (max-width: 719px){
	
	
	.table2 {
	width:auto;
    border:1px solid #f2f2f2;

    border-spacing:5px;
	
	
}
.Row {
	display:table-row;
    width:auto;
}

.Cell1 {
    float:left;
    display:table-column;
    width:120px;
 	text-align:left;
	background-color:#f1f1f1;
	font-size: 0.9em;
	padding: 10px;
}
.Cell2 {
    float:left;
    display:table-column;
    width:200px;
	text-align:justify;
	font-size: 0.9em;
	padding: 10px;
 
}
	
	
}

@media only screen and (max-width: 768px)
{
	 .Cell1{width:93%;}
	 .Cell2{width:93%;}
}
</style>
<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">
<div class="pad group">

		<h2 class="post-title" align="center">Right to Information</h2>
		<h1 align="center">(Dissemination of information under Section 4 of the RTI Act, 2005)</h1><br>
	
	
				

<div class="table2"> 
					   <div class="Row">
					    <div class="Cell1">Name of the Organization </div>
						<div class="Cell2">The High Court of Madras </div>
					   </div>
					   <div class="Row">
					    <div class="Cell1">Functions and duties</div>
						<div class="Cell2">Administration of Justice; Administering subordinate judiciary; and connected functions</div>
					   </div>
					   <div class="Row">
					    <div class="Cell1">Duties and responsibilities of the officers and staff members</div>
						<!--<div class="Cell2"><img src="admin/images/pdf.png" alt="PDF file that opens in new window"  width="30" height="30"><a href="doc/duties-responsibility.pdf" title="PDF file that opens in a new window"target="_blank"><span style="TEXT-DECORATION: none; ">Details are available in Annexure-1</span>(4.3 MB)(English) as on 12-10-2020</a></div>-->
						<div class="Cell2" ><form method="POST" action="admin/view_pdf.php" target="_blank">
	  <input type="hidden" name="pdf_id" id="pdf_id" value="<?php echo base64_encode($file_id); ?> "/>
	  <input type="hidden" name="page" id="page" value='<?php echo base64_encode("I"); ?>'  />
	   <button type="submit" name="submit" id="submit"  style="cursor: pointer;background-color: white;border: white;text-align:left"><img src="admin/images/pdf.png" alt="PDF file that opens in new window"  width="30" height="30"><span style="font-size: 15px;text-align: left; text-decoration: underline;"><?php echo $file_name." (".$size.") (".$lan.") as on ".$as_on; ?></span></button>
	  </form> </div>
					   </div>
					   <div class="Row">
					    <div class="Cell1">Procedure followed in the decision making process, including channels of supervision and accountability</div>
						<div class="Cell2">On receipt of a proposal, the entry level staff will open up a file or process the proposal in the existing file. <br><br>
		The Section Officer will scrutinize the proposal and place it before the Assistant Registrar/Deputy Registrar.<br><br>
		The Assistant Registrar/the Deputy Registrar will review the proposal with reference to the relevant Rules and submit the same to the Registrars. <br><br>
		The Registrars will decide the course of action to be taken thereon under the powers delegated to them by the Hon`ble Chief Justice and, if necessary, will submit the file to the Hon`ble Judges or the Hon`ble Chief Justice for final orders.  <br><br>
		The respective superior officers have supervisory control over their subordinates.</div>
					   </div>
					   <div class="Row">
					    <div class="Cell1">Norms set by the Madras High Court for the discharge of its functions</div>
						<div class="Cell2">Issues are dealt with on priority basis</div>
					   </div>
					   <div class="Row">
					    <div class="Cell1">Rules, regulations, instructions, manuals and records used by the Madras High Court for discharging it`s functions</div>
						<div class="Cell2">&nbsp;
		1.	The Madras High Court Appellate Side Rules, 1965<br><br>
	    &nbsp; 2.	The Madras High Court Original Side Rules <br><br>
	   &nbsp; 3.	<img src="admin/images/pdf.png" alt="PDF file that opens in new window" alt="PDF file that opens in new window" width="30" height="30"> <a href="doc/high-court-standing-orders.pdf" title="PDF file that opens in a new window" target="_blank">
		<span style="TEXT-DECORATION: none; text-underline: none">
                                  <b>Standing Orders of the High Court</b></span>&nbsp;(34 MB) (English)
			    </a><br><br>
	    &nbsp; 4.	Madras High Court Service Rules <br><br>
	    &nbsp; 5.	The Criminal Rules of Practice<br><br>
	    &nbsp; 6.	The Civil Rules of Practice <br><br>
		 &nbsp;7.	The Code of Civil Procedure <br><br>
		 &nbsp;8.	The Code of Criminal Procedure  <br><br>
		 &nbsp;9.	The Constitution of India  <br><br>
			and other connected Acts and Rules</div>
					   </div>
					   <div class="Row">
					    <div class="Cell1">Documents held by the Madras High Court or under its control</div>
						<div class="Cell2">Case records and Registers connected thereto.<br><br>
		Service Records of staff members and officers; and all administrative records connected thereto</div>
					   </div>
					   <div class="Row">
					    <div class="Cell1">Existing arrangement for consultation with or representation by the members of the public, in relation to the formulation of its policy or implementation thereof</div>
						<div class="Cell2">&nbsp;1)	A computerized Information Center is functioning in the High Court premises, which provides information on the history of cases, filed/pending in the Madras High Court. <br><br>
		&nbsp;2)	Other information can be obtained from the Public Information Officer nominated under the RTI Act</div>
					   </div>
					   <div class="Row">
					    <div class="Cell1">Boards, councils, committees and other bodies consisting of two or more persons constituted as its part or for the purpose of its advice and as to whether meetings of those boards, councils, committees and other bodies are open to the public, or the minutes of such meetings are accessible for public</div>
						<div class="Cell2">Various Committees of Hon`ble Judges have been formed for assisting the Hon`ble Chief Justice in the administration.  The minutes of the meetings of such committees are not open to access by public</div>
					   </div>
					   <div class="Row">
					    <div class="Cell1">Directory of the officers and employees</div>
						<div class="Cell2"><img src="admin/images/pdf.png" alt="PDF file that opens in new window" width="30" height="30"><a href="doc/Intercomm.pdf"  title="PDF file that opens in a new window" target="_blank"><span style="TEXT-DECORATION: none; ">Available in Annexure-2</span>&nbsp;&nbsp;(61 KB)&nbsp;(English)</a>&nbsp; </div>
					   </div>
						<div class="Row">
					    <div class="Cell1">Monthly remuneration received by each of its officers and employees, including the system of compensation as provided in its regulations</div>
						<div class="Cell2"><img src="admin/images/pdf.png" alt="PDF file that opens in new window"  width="30" height="30"><a href="doc/Hcpay03072018.pdf"  title="PDF file that opens in a new window"  target="_blank"><span style="TEXT-DECORATION: none; ">Available in Annexure-3</span>&nbsp;&nbsp;(4.06 MB)&nbsp;(English)</a></div>
					   </div>
					   <div class="Row">
					    <div class="Cell1">Budget allocated to each of its agency, indicating the particulars of all plans, proposed expenditures and reports on disbursements made</div>
						<div class="Cell2"><img src="admin/images/pdf.png" alt="PDF file that opens in new window"  width="30" height="30"><a href="doc/Budget_Allocation-2020-2021.pdf"  title="PDF file that opens in a new window" target="_blank"><span style="TEXT-DECORATION: none; ">Available in Annexure-4</span>&nbsp;&nbsp;(10 KB)&nbsp;(English)</a></div>
					   </div>
					   
					   <div class="Row">
					    <div class="Cell1">Manner of execution of subsidy programmes, including the amounts allocated and the details of beneficiaries of such programmes</div>
						<div class="Cell2">NIL</div>
					   </div>
					   
					   <div class="Row">
					    <div class="Cell1">Particulars of recipients of concessions, permits or authorizations granted by it</div>
						<div class="Cell2">NIL</div>
					   </div>
					   
					   <div class="Row">
					    <div class="Cell1">Details of information available with or held by the Madras High Court, reduced in electronic form</div>
						<div class="Cell2">&nbsp;1.	History of cases from the date of filing till disposal are digitized and hard copy of information is furnished at the Information Center.<br><br>
		&nbsp;2.	Judicial records are photo-copied and furnished to the litigants/third parties.<br><br>
		&nbsp;3.	Certified Copies of judgments/Judicial orders are processed through computers and furnished to the litigants/third parties. <br><br>
		&nbsp;4.	Important Judgements/Judicial Orders are published on the internet for public use.<br><br>
		&nbsp;5.	All Judgments/Judicial Orders, from the year 2002, are available in digital form</div>
					   </div>
					   
					   <div class="Row">
					    <div class="Cell1">Facilities available to citizens for obtaining information, including the working hours of a library or reading room, if maintained for public use</div>
						<div class="Cell2">&nbsp;1. The computerized Information Center, functioning in the High Court premises, furnishes information on the history of cases filed/pending in the Madras High Court. <br><br>
		&nbsp;2. Information on other matters can be obtained from the Public Information Officer, nominated under the RTI Act.<br><br>
		&nbsp;3. The High Court Library is meant for Hon`ble Judges only. No library is run for public use</div>
					   </div>
						<div class="Row">
					    <div class="Cell1">Particulars of the Public Information Officers</div>
						<div class="Cell2">The Registrar General, High Court Madras, Appellate Authority
						<br><br>
						The Registrar (Administration), Public Information Officer<br><br>
		The Joint Registrar (RTI), Assistant Public Information Officer
						</div>
					   </div>
			</div>
			   <br>
			<h3>Right to Information Rules, 2007</h3> <br>
			<b>(Regulation of Fee and Cost)</b>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[R.O.C.No.2636-A/06/F1-SRO C-3/2008].--- In exercise of the powers conferred by Section 28 of the Right to Information Act, 2005 (Central Act 22 of 2005), the Chief Justice of the High court of Madras hereby makes the following Rules:-
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.Short title and commencement.----(i) These  rules may be called `Madras High Court Right to Information (Regulation of Fee and Cost) Rules, 2007`.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ii) They shall come into force on the date of their publication in the Official Gazette.<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Definitions.--- In these Rules, Unless the context otherwise requires,-----<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(a) `Act` means the Right to information Act, 2005 (Central Act 22 of 2005).<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b)`section` means Section of the Act;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(c) all other words and expressions used in these Rules but not defined in the Act , shall have the same meaning assigned to them in the Act.<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. Fees.--- Every application for obtaining information under sub-section (1) of Section 6 of the Act shall be accompanied by an application fee of Rupees Ten.<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. Charges.---For providing the information under Sections 7(1) and (5) of the Act, the following charges are payable:-<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(a) the application requiring copy of order, judgement/statements/reports shall accompany, in addition to the application fee, a sum of Rupees 100 towards cost.  If, the actual cost of charges for information exceeds Rs.100 then the same would be intimated to the applicant and the copy of information would be furnished on payment of excess amount; and <br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b) for information to be provided in a diskette or a floppy a sum of Rs.50.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Fees/Charges payable under Rules 3 & 4 shall be paid either in Cash or court Fee Stamp or Demand Draft/Postal Order drawn in favour of PIO, High Court, Madras/ Treasury Challan.<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.(A) Appellate Authority under Section 19(1) of the Right to Information Act, at the Principal Seat of the Madras High Court and Madurai Bench of Madras High Court, Madurai and for the State  Judiciary in the State of Tamil Nadu and Union Territory of Puducherry:<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Registrar General, High Court, Madras.<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(B) Public Information Officers at the Principal Seat of the Madras High Court and Madurai Bench of the Madras High Court:<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.	                   Registrar (Admn.), High Court, Madras.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.	                   Registrar (Admn.),Madurai Bench of Madras High Court, Madurai.<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(C) Assistant Public Information Officers at the Prinicpal Seat of the Madras High Court and Madurai Bench of the Madras High Court:<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.	                  Deputy Registrar (RTI Act), High Court, Madras.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.	                  Deputy  Registrar (Admn.),Madurai Bench of Madras High Court, Madurai.<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>(D) Public Information Officers for Subordinate Courts:</b><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.	                 Principal Judge, City Civil Court, Chennai.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.	                 Chief Judge, Court of Small Causes, Chennai.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.	                 Principal Judge, Family Court, Chennai.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.	                 Chief Metropolitan Magistrate, Egmore, Chennai<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.	                 AG and OT, Administrator General and Official Trustee of Tamil Nadu, Chennai 600104<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.	                 The Presiding Officer, All Labour Courts.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7.	                 The Presiding Officer/Special Judge, Special Courts constituted under Various Acts.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8.	                 The Presiding Officer, Industrial Tribunal.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9.	                 The Chairman, State Transport Appellate Tribunal<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10.	                 The Chairman, Sales Tax Appellate Tribunal<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;11.	                 Principal District Judges of every District, Chief Judge, Puducherry.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;12.	                 Chief Judicial Magistrate of every District.<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>(E)  Assistant  Public Information Officer for Subordinate Courts:</b><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.	              Personal  Assistant to the Principal Judge, City Civil Court, Chennai.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.	              Registrar, Court of Small Causes, Chennai.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.	              Sheristadar, Family court, chennai<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.	              Sheristadar, Chief Metropolitan Magistrate, Egmore, Chennai.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.	              Personal Assistant to the Principal District Judges of every District.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.	              Sheristadar of Chief Judicial Magistrate of every District.<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Appellate Authority, Public Information Officers and Assistant Public Information Officers will discharge the functions prescribed in the Right to Information Act, 2005 subject to the internal procedures laid down by the Honourable The chief Justice of Madras High Court.
			<br><br>
			<h3>Amendment Notification</h3><br>
			<b>Notification (ROC.No.3689/2013/RTI)</b><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In exercise of the powers conferred by Section 28 of the Right to Information  Act, 2005 (Central Act 22 of 2005), the Hon`ble the Acting Chief Justice of High Court, Madras, is pleased to make the following amendments to the Madras High Court Right to Information (Regulation of Fee and cost) Rules,2007.
			<b>AMENDMENT</b><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The existing `Rule 4. Charges`, shall be substituted with the following:<br><br>
		    4. Charges:<br>
	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;For providing the information under Sections 7(1) and (5)  of the Act, the following charges are payable:-<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(a)	The application requiring copy of records (except order/decree/judgement/documents on the judicial side) shall accompany, in addition to the application fee, a sum of Rupees 100 towards cost.  If the actual cost of charges for information exceeds Rs.100, then the same would be intimated to the applicant and the copy of information would be furnished on payment of excess amount; and<br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b)	For information to be provided in a diskette or a foppy, a sum of Rs.50/-.<br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The fees/charges payable under Rules 3 & 4 shall be paid either by Cash or Court Fee Stamp or Treasury Challan or Demand Draft/Postal Order drawn in favour of Public information Officer, High Court, Madras / Public information Officer, Madurai Bench of Madras High Court, Madruai, as the case may be, in respect of information/records to be obtained (except order/decree/judgement/documents on the judicial side).<br><br>
	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Provided that, if the information sought by the applicant is in respect of copies of order/decree/judgement/documents on the judicial side under the control of the High Court/Subordinate Courts, he shall obtain such copies as per the procedure prescribed for obtaining certified copies in the Madras High Court Appellate Side Rules/ Madras High Court Original Side Rules/Civil Rules of Practice/Criminal Rules of Practice, as the case may be, or any other Rule for the time being in force in that behalf.  Copies of order/decree/judgement/documents on the judicial side will not be issued under the Right to Information Act.`<br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Amendments hereby made shall come into force w.e.f. 04.04.2014.<br><br>
           <b> Sd/- P.Kalaiyarasan<br>REGISTRAR GENERAL,<br> HIGH COURT, MADRAS <br>DATED: 04.04.2014</b>
			<br><br><br><br>
			
			<h3>Public Information Officers and Appellate Authorities of Madras High Court</h3>
			<h4>Principal Bench</h4>
			
			<div class="table2"> 
					   <div class="Row">
					    <div class="Cell1"><b>Designation under the Act</b></div>
						<div class="Cell2"><b>Designation, Office Address, Phone No. & E-mail-ID</b></div>
					   </div>
					   <div class="Row">
					    <div class="Cell1">Appellate Authority</div>
						<div class="Cell2">Registrar General,<br>High Court, Madras,<br> 044-25301101</div>
					   </div>
					    <div class="Row">
					    <div class="Cell1">Public Information Officer</div>
						<div class="Cell2">Registrar (Administration)<br>High Court, Madras,<br> 044-25301103</div>
					   </div>
					   <div class="Row">
					    <div class="Cell1">Assistant Public Information Officer</div>
						<div class="Cell2">Joint Registrar (RTI Act)<br>High Court, Madras,<br>044-25301133</div>
					   </div>
				</div>
			    <h4>Madurai Bench</h4>
			    <div class="table2"> 
				
					   <div class="Row">
					    <div class="Cell1"><b>Designation under the Act</b></div>
						<div class="Cell2"><b>Designation, Office Address, Phone No. & E-mail-ID</b></div>
					   </div>
					   <div class="Row">
					    <div class="Cell1">Appellate Authority</div>
						<div class="Cell2">Registrar General<br>High Court, Madras,<br> 044-25301101</div>
					   </div>
					   <div class="Row">
					    <div class="Cell1">Public Information Officer</div>
						<div class="Cell2">Registrar (Administration)<br>Madurai Bench of Madras High Court, <br>0452-2433036</div>
					   </div>
					   <div class="Row">
					    <div class="Cell1">Assistant Public Information Officer</div>
						<div class="Cell2">Deputy Registrar (Admn)<br>Madurai Bench of Madras High Court,<br> 0452-2433051</div>
					   </div>
				</div>
			
			
			
			

	<a href="doc/rtiamendment.pdf" target="_blank"><h5><img src="admin/images/pdf.png" alt="PDF file that opens in new window"  width="30" height="30"><u>RTI Amendment Notification</u><h5></a>
       		
	<a href="doc/rtinotification.pdf" target="_blank"><h5><img src="admin/images/pdf.png" alt="PDF file that opens in new window"  width="30" height="30"><u>RTI Notification by Head of Department</u><h5></a>
        
		<a href="doc/PIO LIST (TN).pdf" target="_blank"><h5><img src="admin/images/pdf.png" alt="PDF file that opens in new window"  width="30" height="30"><u>List of Public Information Officers</u><h5></a>
	
	
			
			
			
					
			
				
<!--/.main-inner-->

	</div>
	</div>
		<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>		
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
</div>

	<?php include "footer.php"; ?>

