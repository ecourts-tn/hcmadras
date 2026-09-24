<?php
$prev_dt=date('Ymd',strtotime("-1 days"));
if(file_exists("cis_files/$prev_dt")){
array_map('unlink', glob("cis_files/$prev_dt/*.*"));
rmdir("cis_files/$prev_dt");
}
?>