<?php /* Smarty version 2.6.25, created on 2015-12-03 21:08:03
         compiled from module/pay/pay_recharge.html */ ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
    <link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
    <title>充值测试</title>
</head>
<script>
    var xmlHttp = false; //全局变量，用于记录XMLHttpRequest对象
    function createXMLHttpRequest() {
        if(window.ActiveXObject) { //Internet Explorer时，创建XMLHttpRequest对象的方法
            try {
                xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
            } catch(e) {
                try {
                    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                } catch(e) {
                    window.alert("创建XMLHttpRequest对象错误"+e);
                }
            }
        } else if(window.XMLHttpRequest) {
            xmlHttp = new XMLHttpRequest();
        }
        if(!(xmlHttp)) {
            window.alert("创建XMLHttpRequest对象异常！");
        }
    }

    //选框失去焦点时
    function proChange(objVal) {
        if(objVal.length != 0){
            createXMLHttpRequest();
            xmlHttp.onreadystatechange = cityList;
            var url = "pay_recharge.php?type=ajax&count_name=" + objVal;
            xmlHttp.open("GET",url,true);
            xmlHttp.send(null);
        }

    }
    //回调函数
    function cityList() {
        if(xmlHttp.readyState==4) {
            if(xmlHttp.status==200) {
                parseText(xmlHttp.responseText);
            }
        }
    }
    //输出函数
    function parseText(parseText){
        var str = "";
        var obj = eval(parseText);
        var num = obj.length;
        for(var i=0;i<num;i++){
            str += "<option value='"+ obj[i].role_id +"'>"+obj[i].role_name+"</option>";
        }
        var roleName = document.getElementById('role_name');
        roleName.innerHTML = str;
    }
</script>
<body>
   <div>
       <h1>模拟充值</h1>
       <div style="margin-top:20px">
           <form action="<?php echo $this->_tpl_vars['URL_SELF']; ?>
?type=action" method="post" name="form1" style="text-align:center">
               <input name="count_name" type="text" value="" id="countName" onBlur="proChange(this.value)">
               <select name="role_id" id="role_name" style="width:100;"><option>请入账号名</option></select><br><br>
               <div>
                   充值人民币：<input name="pay_money" type="text" value=""><br><br>
               </div>
               <input name="" type="submit" value="提交" >
           </form>
       </div>
   </div>
</body>
</html>