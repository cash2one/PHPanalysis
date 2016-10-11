<?php /* Smarty version 2.6.25, created on 2016-05-21 11:23:53
         compiled from module/center/online_half_hour_pic.html */ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
        <link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css"></link>
        <link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css"></link>
        <script type="text/javascript" src="/web/admin/static/js/jquery.min.js"></script>
        <script type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"></script>
        <script type="text/javascript" src="/web/admin/static/js/FusionCharts.js"></script>


        <!--  添加回到顶部      start        -->
        <script>

            function goTopEx(){
                var obj=document.getElementById("goTopBtn");
                function getScrollTop(){
                    return document.documentElement.scrollTop;
                }
                function setScrollTop(value){
                    document.documentElement.scrollTop=value;
                }
                window.onscroll=function(){getScrollTop()>0?obj.style.display="":obj.style.display="none";
                }
                obj.onclick=function(){
                    var goTop=setInterval(scrollMove,10);
                    function scrollMove(){
                        setScrollTop(getScrollTop()/1.1);
                        if(getScrollTop()<1)clearInterval(goTop);
                    }
                }
            }


            


        </script>
        <!--  添加回到顶部   end        -->
        <style type="text/css">
            #all {text-align:left;margin-left:4px; line-height:1;}
            #nodes {width:100%;float:left;border:1px #ccc solid;}
            #result {width: 100%; height:100%; clear:both;border:1px #ccc solid;}
            .table_all_head { color:#232323; background-color:#99CC66;font-weight:bold; }

            BODY { position: relative;}
            #goTopBtn { z-index:333; position:fixed; TEXT-ALIGN:right; LINE-HEIGHT: 30px; WIDTH: 30px; BOTTOM: 35px; HEIGHT: 33px; FONT-SIZE: 12px; CURSOR: pointer; RIGHT: 0px; _position:absolute;
                        _top:       expression(eval(document.compatMode &&
                                document.compatMode=='CSS1Compat') ?
                            documentElement.scrollTop+550 :
                            document.body.scrollTop +
                            (document.body.clientHeight
                            -this.clientHeight));
            }
            <!--  添加回到顶部      end        -->


        </style>
        <title><?php echo $this->_tpl_vars['_lang']['new']['online_hour_statistics']; ?>
</title>
    </head>
    <body>
        <div id="all">
            <div id="position"><?php echo $this->_tpl_vars['_lang']['new']['online_hour_statistics']; ?>
</div>
            <div id="main">

                <form name="form" method="GET">
                    <table width="100%" border="0" cellspacing="1" cellpadding="2" align="center" bgcolor="#D7E4F5">
                        <tr><td>&nbsp;<?php echo $this->_tpl_vars['_lang']['left']['select_agents']; ?>
：</td></tr>
                        <tr>
                            <td>
                                <input type="radio" name="radio_agent" id="radio_agent" onclick="GetPlatServer(this.value)" value="0" <?php if ($this->_tpl_vars['agent_id'] == 0): ?> checked <?php endif; ?>  /><?php echo $this->_tpl_vars['_lang']['conmon']['any']; ?>

                                       <?php $_from = $this->_tpl_vars['allAgentName']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                       <input type="radio" name="radio_agent" id="radio_agent" onclick="GetPlatServer(this.value)" value="<?php echo $this->_tpl_vars['key']; ?>
"  <?php if ($this->_tpl_vars['agent_id'] == $this->_tpl_vars['key']): ?> checked <?php endif; ?> /><?php echo $this->_tpl_vars['item']; ?>

                                       <?php endforeach; endif; unset($_from); ?>
                                       </td>
                                        </tr>
                                        <tr id="sServerName_TD1" style="display:none"><td>&nbsp;<?php echo $this->_tpl_vars['_lang']['left']['select_agents']; ?>
：</td></tr>
                                        <tr id="sServerName_TD2" style="display:none"><td id="sServer"></td></tr>
                                        <tr><td  bgcolor="#D7Eff5">
                                                &nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['start_day_time']; ?>
：
                                                <input value="<?php echo $this->_tpl_vars['dStartTime']; ?>
" class="Wdate" id="dStartDate" readonly="readonly" name="dStartDate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" type="text" size="14" />&nbsp;
                                                <?php echo $this->_tpl_vars['_lang']['conmon']['end_day_time']; ?>
：
                                                <input value="<?php echo $this->_tpl_vars['dEndTime']; ?>
" class="Wdate" id="dEndDate" readonly="readonly" name="dEndDate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" type="text" size="14" />&nbsp;
                                                <input value="<?php echo $this->_tpl_vars['_lang']['conmon']['view']; ?>
" type="submit" id="btnsubmit"/>
                                                <font color="#FF0000"><?php echo $this->_tpl_vars['_lang']['new']['data_interval']; ?>
：20 min</font>
                                            </td>
                                        </tr>

                                        </table>
                                        </form>
                                        <?php if ($this->_tpl_vars['message'] != ''): ?>
                                        <p align="center"><b>&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['message']; ?>
</b></p>
                                        <?php endif; ?>
                                        <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <p align="left"><b>&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['item']['message']; ?>
</b></p>
                                        <div id="name[<?php echo $this->_tpl_vars['key']; ?>
]">
                                        </div>
                                        <script language="javascript">
                                            var name = 'char'+"<?php echo $this->_tpl_vars['key']; ?>
";
                                            var xml = "<?php echo $this->_tpl_vars['item']['xml']; ?>
";
                                            var chart1 = new FusionCharts("/web/admin/static/FusionCharts/FCF_Line.swf", name, "1200", "220", "0", "1");
                                            chart1.setDataXML(xml);
                                            chart1.render("name[<?php echo $this->_tpl_vars['key']; ?>
]");
                                        </script>
                                        <?php endforeach; endif; unset($_from); ?>
                                        </div>
                                        </div>

                                        <!--  添加回到顶部      start        -->
                                        <div style="DISPLAY: none" id=goTopBtn><img border=0 src="/web/admin/static/images/lanren_top.jpg" />
                                        </div>
                                        <script  type="text/javascript">goTopEx();</script>
                                        <!--  添加回到顶部      end      -->
                                        </body>
                                        <script type="text/javascript">
                                            var server_id ="<?php echo $this->_tpl_vars['server_id']; ?>
",agent_id = "<?php echo $this->_tpl_vars['agent_id']; ?>
";

                                            function GetPlatServer(value) {                                           
                                                if (value == "0") {// hide servers if select all
                                                    $("#sServerName_TD1").css("display", "none");
                                                    $("#sServerName_TD2").css("display", "none");
                                                } else {
                                                    $("#sServerName_TD1").css("display", "block");
                                                    $("#sServerName_TD2").css("display", "block");
                                                }

                                                    getServerRadios(agent_id,0);
                                                    search();                                         
                                            }


                                            $(function(){                                               
                                                if(agent_id > 0){
                                                    $("#sServerName_TD1").css("display", "block");
                                                    $("#sServerName_TD2").css("display", "block");
                                                    getServerRadios(agent_id,server_id);
                                                }
                                            })

                                            function getServerRadios(agent_id,server_id){
                                                var servers=<?php echo $this->_tpl_vars['servers']; ?>
;
                                                var server = servers[agent_id];
                                                var radios = "<input name='radio_server'  value='0' onclick='search();' "
                                                    +(server_id == 0? "checked='checked'":' ')
                                                    +"type='radio'/><?php echo $this->_tpl_vars['_lang']['conmon']['any']; ?>
 ";
                                                for(var i in server){
                                                    radios += "<input name='radio_server'  value='" + i + "' onclick='search();' "
                                                        +(server_id == i? "checked='checked'":' ')
                                                        +"type='radio'/>" + server[i];
                                                }
                                                $("#sServer").html(radios);
                                            }


                                            function search(){
                                                $('#btnsubmit').click()
                                            }

                                            
                                        </script>

                                        </html> 