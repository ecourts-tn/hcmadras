<?php  
require('config/dbconfig.php');

$sql = "SELECT doc_pdf_file,doc_title FROM document_files inner join mhc_document on mhc_document.doc_id=document_files.document_id WHERE document_id in 
(SELECT doc_id
FROM mhc_document
WHERE doc_show_page = 'U' and display='Y'
ORDER BY create_modify DESC
LIMIT 1 )";
$quer = pg_query($bd22, $sql);

$reg = pg_fetch_object($quer);

  header('Content-type: application/pdf');
 header("Content-Disposition:inline;filename=".$reg -> doc_title.".PDF");
 header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: public'); 
print pg_unescape_bytea($reg -> doc_pdf_file);