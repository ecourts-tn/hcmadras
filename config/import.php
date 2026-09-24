<?php
$bd22 = pg_pconnect("host=10.236.255.28 port=5432 dbname=hcmadras user=postgres password=K-preReCr5@");
$bd23 = pg_pconnect("host=10.236.255.28 port=5432 dbname=hcmadrasn user=postgres password=K-preReCr5@");
 $pg_con2=pg_query($bd22,"select * from visitor_logs order by sno asc");
while($pg_cone=pg_fetch_object($pg_con2))
{
	pg_query($bd23,"insert into visitor_logs(page_url,referrer_url,user_ip_address,user_agent,created,sno) values('$pg_cone->page_url','$pg_cone->referrer_url','$pg_cone->user_ip_address','$pg_cone->user_agent','$pg_cone->created','$pg_cone->sno')");
	echo "sno=>".$pg_cone->sno;
	echo "<br>";
} 
/* $pg_con=pg_query($bd22,"select * from mhc_document order by doc_id asc");
while($pg_cone=pg_fetch_object($pg_con))
{
	echo "insert into mhc_document(doc_id,doc_title,doc_size,doc_lan,doc_f_date,doc_to_date,doc_order,doc_bench,doc_new_icon,doc_show_page,display,create_modify,mhc_user,order_type,doc_icon) values('$pg_cone->doc_id','$pg_cone->doc_title','$pg_cone->doc_size','$pg_cone->doc_lan','$pg_cone->doc_f_date','$pg_cone->doc_to_date','$pg_cone->doc_order','$pg_cone->doc_bench','$pg_cone->doc_new_icon','$pg_cone->doc_show_page','$pg_cone->display','$pg_cone->create_modify','$pg_cone->mhc_user','$pg_cone->order_type','$pg_cone->doc_icon')";
	pg_query($bd23,"insert into mhc_document(doc_id,doc_title,doc_size,doc_lan,doc_f_date,doc_to_date,doc_order,doc_bench,doc_new_icon,doc_show_page,display,create_modify,mhc_user,order_type,doc_icon) values('$pg_cone->doc_id','$pg_cone->doc_title','$pg_cone->doc_size','$pg_cone->doc_lan','$pg_cone->doc_f_date','$pg_cone->doc_to_date','$pg_cone->doc_order','$pg_cone->doc_bench','$pg_cone->doc_new_icon','$pg_cone->doc_show_page','$pg_cone->display','$pg_cone->create_modify','$pg_cone->mhc_user','$pg_cone->order_type','$pg_cone->doc_icon')");
	echo "mhc_document=>".$pg_cone->doc_id;
	echo "<br>";
} 
$pg_con2=pg_query($bd22,"select * from document_files where document_id>1015 order by document_id asc");
while($pg_cone=pg_fetch_object($pg_con2))
{
	echo "insert into document_files(document_id,create_modify,doc_pdf_file,doc_files_id) values('$pg_cone->document_id','$pg_cone->create_modify','$pg_cone->doc_pdf_file','$pg_cone->doc_files_id')";
	pg_query($bd23,"insert into document_files(document_id,create_modify,doc_pdf_file,doc_files_id) values('$pg_cone->document_id','$pg_cone->create_modify','$pg_cone->doc_pdf_file','$pg_cone->doc_files_id')");
	echo "document_files=>".$pg_cone->document_id;
	echo "<br>";
}
*/
?>		tho$Ic8o