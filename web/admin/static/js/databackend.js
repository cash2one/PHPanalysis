
//分页page
function changePage(page){
        $("#page").val(page);
        $("#myform").submit();
}
//tag 标签栏
function selectTag(showContent,selfObj){
	// 操作标签
	var tag = document.getElementById("tags").getElementsByTagName("li");
	var taglength = tag.length;
	for(i=0; i<taglength; i++){
		tag[i].className = "";
	}
	selfObj.parentNode.className = "selectTag";
	// 操作内容
	for(i=0; j=document.getElementById("tagContent"+i); i++){
		j.style.display = "none";
	}
	document.getElementById(showContent).style.display = "block";
}
//时间段按钮提交
function timeSelect(obj){

        var timestamp = (Date.parse(new Date()))/1000; 
        if(obj.id==='oneweek'){
           var passTimestamp = ((Date.parse(new Date()))/1000)-604800; //一周
        }else if(obj.id==='onemonth'){
          var  passTimestamp = ((Date.parse(new Date()))/1000)-2592000; //一个月
        }else if(obj.id==='threemonth'){
          var  passTimestamp = ((Date.parse(new Date()))/1000)-7776000; //三个月
        }else if(obj.id==='sixmonth'){
          var  passTimestamp = ((Date.parse(new Date()))/1000)-15552000; //六个月
        }
        //document.write(obj.id);
        document.getElementById("begin_time").value = passTimestamp;
        document.getElementById("end_time").value = timestamp;
        document.getElementById("myform").submit();
}

$(function()
{
    $('#begin_time').dateRangePicker(
    {
            autoClose: true,
            singleDate : true,
            showShortcuts: false 
    });
    $('#end_time').dateRangePicker(
    {
            autoClose: true,
            singleDate : true,
            showShortcuts: false 
    });
});


//留存用户统计的时间快捷键
function thedays(days){
            var begin_time=document.getElementById("begin_time").value;
            begin_time = begin_time.replace(/-/g,"/"); //为了兼容IE
            var begin_time = new Date(begin_time);
            days=Number(days);//获取过来的days为字符串，需转换成数字
            var timestamp=((Date.parse(begin_time))/1000)+days;
            var str=new Date(parseInt(timestamp) * 1000).toLocaleString().replace(/年|月/g, "/").replace(/日|上午/g, " ").substr(0,10);   
            document.getElementById("end_time").value=str;
            document.getElementById("myform").submit();
}
