<?php  
include "header.php";
/*  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting( E_ALL);  */
?>

<style>
#judge_thumb{border-radius: 50%!important; vertical-align: middle;}
 
 td {
           
            word-wrap: break-word;
			
			
        }


        .tab{
            padding:10px 20px;
            cursor:pointer;
            border:1px solid #ccc;
            display:inline-block;
            background:#f5f5f5;
			font-weight:bold;
        }

        .active{
            background:#007bff;
            color:#fff;
        }

        #content1{
            border:1px solid #ccc;
            padding:20px;
            margin-top:10px;
            min-height:300px;
        }
    </style>

<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">

<div class="pad group">

<div>
    <span class="tab active" id="tab1">Principal Seat</span>
    <span class="tab" id="tab2">Madurai Bench</span>
</div>

<div id="content1"></div>
	</div>

</div><!--/.pad-->



<script>

$(document).ready(function(){

    // Load page1 by default
    $("#content1").load("registrars_mhc1.php");

    $("#tab1").click(function(){

        $(".tab").removeClass("active");
        $(this).addClass("active");

        $("#content1").load("registrars_mhc1.php");

    });

    $("#tab2").click(function(){

        $(".tab").removeClass("active");
        $(this).addClass("active");

        $("#content1").load("registrars_mdu1.php");

    });

});

</script>





	<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<?php include "footer.php"; ?>

