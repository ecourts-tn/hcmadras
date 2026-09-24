<?php          
include 'config/dbconfig.php';

$page= $_GET['page'];

	$cod= $_GET['pdf_id'];

$sql = "SELECT meeting_file FROM mhc_metting_files WHERE files_id = '$cod'";
$quer = pg_query($bd22, $sql);

$reg = pg_fetch_object($quer);

 $id_proof_img = pg_unescape_bytea($reg -> meeting_file);
								$extension ='pdf';
								$fileId ='meeting_file';
								$filename1 = $fileId . '.' .$extension;
								$fileHandle = fopen($filename1, 'w');
								fwrite($fileHandle, $id_proof_img);
								fclose($fileHandle);
							
			//$file='test.pdf';							
  
          header('Content-Description: File Transfer');
              header('Content-Type: application/force-download');
            header('Content-Disposition: attachment; filename="'.basename($filename1).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename1));
            flush(); // Flush system output buffer
            readfile($filename1);
			 die();     

?>