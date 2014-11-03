function tick() {
var years,months,days,hours, minutes, seconds;
var intYears,intMonths,intDays,intHours, intMinutes, intSeconds;
var today;
today = new Date(); //系统当前时间
intYears = today.getFullYear(); //得到年份,getFullYear()比getYear()更普适
intMonths = today.getMonth() + 1; //得到月份，要加1
intDays = today.getDate(); //得到日期
intHours = today.getHours(); //得到小时
intMinutes = today.getMinutes(); //得到分钟
intSeconds = today.getSeconds(); //得到秒钟
years = intYears + "-";
if(intMonths < 10 ){
months = "0" + intMonths +"-";
} else {
months = intMonths +"-";
}
if(intDays < 10 ){
days = "0" + intDays +" ";
} else {
days = intDays + " ";
}
if (intHours == 0) {
hours = "00:";
} else if (intHours < 10) {
hours = "0" + intHours+":";
} else {
hours = intHours + ":";
}
if (intMinutes < 10) {
minutes = "0"+intMinutes+":";
} else {
minutes = intMinutes+":";
}
if (intSeconds < 10) {
seconds = "0"+intSeconds+" ";
} else {
seconds = intSeconds+" ";
}
timeString = years+months+days+hours+minutes+seconds;
Clock.innerHTML = timeString;
window.setTimeout("tick();", 1000);
}
window.onload = tick;
