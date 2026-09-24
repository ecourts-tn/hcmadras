
<?php
 include"header.php";
 $qry1 = $DB_con->query("SELECT max(year) FROM mhc_holiday limit 1");
while($row1 = $qry1->fetch())
{
	$max_yr=$row1['max'];
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Calendar</title>
        <link rel="stylesheet" href="css/calendar_style.css" />
		<script src="js/jquery-3.6.0.min.js" type="text/javascript"></script>
		<style>
		th{
			font-weight:strong;
		}
		table, th, td {
  border: 1px solid;
}
th, td {
  padding: 3px;
  text-align: left;
  font-weight:500;
}
		</style>
    </head>
    <body>
        <div class="main">
		 <div class="right"></div>
            <div class="left">
                <div class="wrapper">
				<br>
                    <div class="top">
                        <p class="backward"></p>
                        <p class="year-num"></p>
                        <p class="forward"></p>
                    </div>
					<br>
                    <div class="bottom" style='display:none'></div>
                </div>
			   <div class="vacc_det" >
			   <div class="alx-tabs-container" width='90%'>
			   <br>
			<ul id="tab-recent-3" class="alx-tab calc_note">
			
			</ul>
	
		
			</div>
			<div  style='font-weight:900;float:right'>
			( By Order )<br>
			
			Registrar General
			</div>
			   </div>
            </div>
           
        </div>
        <!--<script src="script.js"></script>-->
		<script>
		
		$(document).ready(function() {
			
		});
		const rightSide = document.querySelector(".right");
const leftMonth = document.querySelector(".left .bottom");
const yearNum = document.querySelector(".year-num");
const backward = document.querySelector(".backward");
const forward = document.querySelector(".forward");
const themeSwitch = document.querySelector(".themeSwitch");
const body = document.querySelector("body");

let monthIndex = 0;
const Months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
];
const Day = ["S", "M", "T", "W", "T", "F", "S"];

const date = new Date();
var c_yr='<?php echo $max_yr;?>';
calender();
function calender() {
    rightSide.innerHTML = "";
	
	 yearNum.innerHTML = date.getFullYear();
	 if(date.getFullYear()>2020)
    backward.innerHTML = date.getFullYear() - 1;
	else
	 backward.innerHTML ='';
if(date.getFullYear()<c_yr)
   forward.innerHTML = date.getFullYear() + 1;
else
	 forward.innerHTML = '';
			var yr=date.getFullYear();
			var date_arr;
			var vacc_arr;
			$.ajax({
			type: "POST",
			url: "get_holidays.php",
			async:false,
			data: { yr:btoa(yr),type:"year_holiday_list" }
		  }).done(function( data ) {
				 date_arr=JSON.parse(data);
		});
		$.ajax({
			type: "POST",
			url: "get_holidays.php",
			async:false,
			data: { year:btoa(yr),type:"year_vacation_list" }
		  }).done(function( data ) {
				 vacc_arr=JSON.parse(data);
		});
		$.ajax({
			type: "POST",
			url: "get_holidays.php",
			async:false,
			data: { year:btoa(yr),type:"year_holiday_note" }
		  }).done(function( data ) {
				vacc_arr1=JSON.parse(data);
				$("#tab-recent-3").html(vacc_arr1);
		});
		
    for (let i = 0; i < 12; i++) {
        let month = createMonth(i, date.getFullYear(),false,date_arr,vacc_arr);
        rightSide.appendChild(month);
		
    }
	if(document.getElementById("holiday"))
	{const element = document.getElementById("holiday");
	element.remove();
	}
   const holiday_list = document.createElement("div");
   holiday_list.id='holiday';
   holiday_list.innerHTML='';
	
   // holiday_list.classList.add("holiday");
   let table = '<table width="100%" >';  
	table += '<tr style="background:#D4F1F4"><th width="30%">DATE</th><th width="70%">HOLIDAYS</th></tr>';  
	Object.keys(date_arr).forEach(function(key, index) {
	table += '<tr><td width="30%">'+key+'</td><td width="70%">'+this[key][1]+'</td></tr>';  	
}, date_arr);
	 
	table += '</table>';  
	holiday_list.innerHTML=table;
	//holiday_list.appendChild(table);
	leftMonth.appendChild(holiday_list);
	leftMonth.style.display ='block';
   // setLeftCalender();
    //clickAdjust();
}
function createMonth(monthNumber, yearNumber,flag,date_arr,vacc_arr) {
	year = yearNumber;
    let i = monthNumber;
    const month = document.createElement("div");
    month.classList.add("months");
	if(flag){
    const monthNum = document.createElement("div");
    monthNum.classList.add("month-num");
    monthNum.innerHTML = pad(i + 1);
    month.appendChild(monthNum);
	}
    const monthName = document.createElement("div");
    monthName.classList.add("month-name");
    monthName.innerHTML = Months[i];
    month.appendChild(monthName);
    const daysDiv = document.createElement("div");
    daysDiv.classList.add("days");
    const barDiv = document.createElement("div");
    barDiv.classList.add("bar");
    for (let j = 0; j < 7; j++) {
        const p = document.createElement("p");
        if (j % 7 == 0) p.classList.add("sunday");
        else if (j % 7 == 6) p.classList.add("saturday");
        p.innerHTML = Day[j];
        barDiv.appendChild(p);
    }
    daysDiv.appendChild(barDiv);
    const line = document.createElement("div");
    line.classList.add("border");
    daysDiv.appendChild(line);
    const datesDiv = document.createElement("div");
    datesDiv.classList.add("dates");

    let firstDayIndex = new Date(year, i, 0).getDay() + 1;
    let lastDate = new Date(year, i + 1, 0).getDate();
    firstDayIndex = firstDayIndex == 7 ? 0 : firstDayIndex;
    let count = 0;
    for (j = 0; j < firstDayIndex; j++) {
        const blankDiv = document.createElement("div");
        datesDiv.appendChild(blankDiv);
        count++;
    }
	
    for (let j = 1; j <= lastDate; j++) {
        const dayDiv = document.createElement("div");
        dayDiv.classList.add("day");
        if (count % 7 == 0) dayDiv.classList.add("sunday");
        else if (count % 7 == 6) dayDiv.classList.add("saturday");
        dayDiv.innerHTML = j;
		 var yr_dt=((j.toString()).padStart(2, '0')+"-"+((i+1).toString()).padStart(2, '0')+"-"+year).toString();
		if(date_arr!='')
		if(yr_dt in date_arr)
			dayDiv.style.setProperty('color', 'red');
		 if(vacc_arr!=''){
		if( vacc_arr.includes(yr_dt))
		 {
			 
					  dayDiv.style.setProperty("background-color", "#A0DB9B");
					 //dayDiv.style.setProperty("color", "#ff0040");
				}
		 }
        datesDiv.appendChild(dayDiv);
		
		
        count++;
    }
    if (count < 37) {
        for (j = 0; j < 36 - count; j++) {
            const blankDiv = document.createElement("div");
            datesDiv.appendChild(blankDiv);
        }
    }
	
    daysDiv.appendChild(datesDiv);
    month.appendChild(daysDiv);
    return month;
}
function pad(number) {
    let a = number < 10 ? "0" + number : number + "";
    return a;
}

/*function initClick() {
    const allMonth = document.querySelectorAll(".months");
    allMonth.forEach((month, index) => {
        month.addEventListener("click", () => {
            monthIndex = index;
            setLeftCalender();
        });
    });
}
function setLeftCalender() {
    leftMonth.innerHTML = "";
    let month = createMonth(monthIndex, date.getFullYear(),true,'','');
    leftMonth.appendChild(month);
    const fix = document.querySelector(".left .bottom .months");
    let htmlString = fix.innerHTML;
    leftMonth.innerHTML = htmlString;
    leftMonth.classList.add("animation");
    setTimeout(() => {
        leftMonth.classList.remove("animation");
    }, 300);
}*/

backward.addEventListener("click", () => {
	if(date.getFullYear()>2020){
    date.setFullYear(date.getFullYear() - 1);
    calender();
	}
   // clickAdjust();
});
forward.addEventListener("click", () => {
	if(date.getFullYear()<c_yr){
    date.setFullYear(date.getFullYear() + 1);
    calender();}
    //clickAdjust();
});
/*themeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");
});*/
window.addEventListener("keydown", (e) => {
    if (e.key == "ArrowRight") {
        forward.click();
    } else if (e.key == "ArrowLeft") {
        backward.click();
    } /*else if (e.key == "ArrowDown") {
        if (monthIndex < 11) {
            monthIndex += 1;
           // setLeftCalender();
        }
    } else if (e.key == "ArrowUp") {
        if (monthIndex > 0) {
            monthIndex -= 1;
           // setLeftCalender();
        }
    }*/
});

/*function clickAdjust() {
    const width = window.innerWidth;
    if (width >= 1060) {
        initClick();
    }
}*/
</script>
    </body>
</html>
