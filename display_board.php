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
            padding:10px;
            margin-top:10px;
            min-height:300px;
        }
    </style>
<style>
/* FontAwesome for working BootSnippet :> */


#team {
    background: #eee !important;
}

.btn-primary:hover,
.btn-primary:focus {
    background-color: #ea061b;
    border-color: #71010b;
    box-shadow: none;
    outline: none;
}

.btn-primary {
    color: #fff;
    background-color: #ea061b;
    border-color: #71010b;
	font-size: 20px;
	font-weight: bold;
}

section {
    padding: 60px 0;
}

section .section-title {
    text-align: center;
    color: #007b5e;
    margin-bottom: 50px;
    text-transform: uppercase;
}

#team .card {
    border: none;
    background: #ffffff;
}

.image-flip:hover .backside,
.image-flip.hover .backside {
    -webkit-transform: rotateY(0deg);
    -moz-transform: rotateY(0deg);
    -o-transform: rotateY(0deg);
    -ms-transform: rotateY(0deg);
    transform: rotateY(0deg);
    border-radius: .25rem;
}

.image-flip:hover .frontside,
.image-flip.hover .frontside {
    -webkit-transform: rotateY(180deg);
    -moz-transform: rotateY(180deg);
    -o-transform: rotateY(180deg);
    transform: rotateY(180deg);
}

.mainflip {
    -webkit-transition: 1s;
    -webkit-transform-style: preserve-3d;
    -ms-transition: 1s;
    -moz-transition: 1s;
    -moz-transform: perspective(1000px);
    -moz-transform-style: preserve-3d;
    -ms-transform-style: preserve-3d;
    transition: 1s;
    transform-style: preserve-3d;
    position: relative;
}

.frontside {
    position: relative;
    -webkit-transform: rotateY(0deg);
    -ms-transform: rotateY(0deg);
    z-index: 2;
    margin-bottom: 30px;
}

.backside {
    position: absolute;
    top: 0;
    left: 0;
    background: white;
    -webkit-transform: rotateY(-180deg);
    -moz-transform: rotateY(-180deg);
    -o-transform: rotateY(-180deg);
    -ms-transform: rotateY(-180deg);
    transform: rotateY(-180deg);
    -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
    -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
    box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
}

.frontside,
.backside {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: 1s;
    -webkit-transform-style: preserve-3d;
    -moz-transition: 1s;
    -moz-transform-style: preserve-3d;
    -o-transition: 1s;
    -o-transform-style: preserve-3d;
    -ms-transition: 1s;
    -ms-transform-style: preserve-3d;
    transition: 1s;
    transform-style: preserve-3d;
}

.frontside .card,
.backside .card {
    min-height: 312px;
}

.backside .card a {
    font-size: 18px;
    color: #007b5e !important;
}

.frontside .card .card-title,
.backside .card .card-title {
    color: #007b5e !important;
}
.card-title{ height:70px;}
.card-title1{ color: #007b5e !important;margin-bottom: 25px;
font-size: 25px;
}

.frontside .card .card-body img {
    width: 120px;
   /*  height: 120px */;
    border-radius: 50%;
	margin-bottom: 10px;
}
.card-body{height:400px;}


</style>


<div class="pad group">

<div>
    <span class="tab active" id="tab1">Principal Seat</span>
    <span class="tab" id="tab2">Madurai Bench</span>
	   
</div>

<div id="content1"></div>
	</div>





<script>

$(document).ready(function(){

    // Load page1 by default
    $("#content1").load("display_board_mhc1.php");

    $("#tab1").click(function(){

        $(".tab").removeClass("active");
        $(this).addClass("active");

        $("#content1").load("display_board_mhc1.php");

    });

    $("#tab2").click(function(){

        $(".tab").removeClass("active");
        $(this).addClass("active");

        $("#content1").load("display_board_mdu1.php");

    });

});
function mhc_refresh(){

        $("#content1").load("display_board_mhc1.php");
}
function mdu_refresh(){

        $("#content1").load("display_board_mdu1.php");
}

</script>





				
<?php include "footer.php"; ?>

