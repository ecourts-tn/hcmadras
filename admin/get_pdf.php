<?php
include 'config/dbconfig.php';
include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();
if(isset($_POST['view_id']))
	{
		$view_id =$_POST['view_id'];
		if(empty($view_id))
   {
      echo 2;
   
   }
 else if(!empty($view_id) && $validator->chkbadchar($view_id) == false)
 {
 echo 2;
 
 }
  else if(!empty($view_id) && $validator->test_datatype($view_id,"[^0-9]") == false)
 {
  echo 2;
 }
 else
 {
		$stmt1 =$DB_con->prepare("SELECT an_pdf FROM announcement WHERE an_id=:view_id");
        $stmt1->execute(array(':view_id'=>$view_id));
		if($stmt1->rowCount() > 0) {
         $row1=$stmt1->fetch(PDO::FETCH_ASSOC);
		
		   print(trim($row1['an_pdf']));
 
		}
		else
		{
			echo 2;
		}
 }
		die();	
	}
?>