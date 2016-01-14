<meta charset="UTF-8">
<style>
    .methodDiv{ width: 15%;border: 1px grey solid;height: 650px;float: left;overflow-y: scroll;	}
    .methodDiv li{	list-style-type:none;margin-left:15px; margin-top:3px;	}
    .testDiv{	width: 84%;border: 1px grey solid;height: 650px;float: left;  }
    .testDiv .tdTitle{	text-align:right;		}
    .testDiv tr{	height:35px;	}
    .method{	 text-decoration:none;	}
    #testTable input{ width:500px;	}
</style>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/jquery.js");
?>
<script src="<?php echo Yii::app()->request->hostInfo.'/myii/js/jquery.js'?>"></script>
<script type="text/javascript">
    $(function(){
        $(".method").click(function(){
            var method=$(this).html();
            $.ajax({
                type: "POST",
                url:"doc",
                data:{	name:method	},
                dataType:"json",
                success:function(data){
                    $(".methodName").html(method);
                    $("#textForm").attr("action",method).attr("enctype","application/x-www-form-urlencoded");
                    $(".methodUrl").val(data.url);
                    $(".methodDoc").html(data.doc);
                    var html = new Array();
                    for(key in data.parameter){
                        var param=data.parameter[key].replace("$","");
                        //if(param!="msg"){
                        if(param!="msg"&&param!="doneVerify"&&param!='signature'){
                            if(param != "uploadImg"){
                                html.push('<tr><td class="tdTitle">'+param+':</td><td><input  type="text" name="'+param+'" /></td></tr>');
                            }else{
                                $("#textForm").attr("enctype","multipart/form-data");
                                html.push('<tr><td class="tdTitle">'+param+':</td><td><input  type="file" name="'+param+'[]" /></td></tr>');
                                //$("#textForm").attr("enctype","multipart/form-data");
                                html.push('<tr><td class="tdTitle">'+param+':</td><td><input  type="file" name="'+param+'[]" /></td></tr>');
                                html.push('<tr><td class="tdTitle">'+param+':</td><td><input  type="file" name="'+param+'[]" /></td></tr>');
                            }
                        }else{
                            $("#textForm").attr("enctype","multipart/form-data");
                            html.push('<tr><td class="tdTitle">'+param+':</td><td><input  type="file" name="'+param+'" /></td></tr>');
                        }
                    }
                    html.push('<tr><td></td><td><input type="submit"  value="提交"  /></td></tr>');
                    $("#testTable").html(html.join(' '));
                }
            });
        });

    });
</script>
<div >
    <div class="methodDiv">
        <lu>
            <?php foreach ($apiList as $key=>$item){?>
                <li><h4><?php echo $key;?></h4></li>
                <?php  foreach ($item as $val){?>
                    <li><a href="#" class="method"><?php echo $val;?></a></li>
                <?php }?>
            <?php }?>
        </lu>
    </div>
    <div class="testDiv">
        <table>
            <tr>
                <td class="tdTitle">方法名：</td>
                <td class="methodName">Login</td>
            </tr>
            <tr>
                <td class="tdTitle">调用地址：</td>
                <td>
                    <input type="text" class="methodUrl" style="width:720px;margin-left:2px;" value="<?php echo $defaultUrl; ?>" />
                    <!-- <input type="button" value="复制" class="btnCopy"/> -->
                </td>
            </tr>
            <tr>
                <td class="tdTitle">注释说明：</td>
                <td>
                    <textArea class="methodDoc" cols=100 rows=15  style="overflow:auto" readonly><?php echo $defaultDoc; ?></textArea>
                </td>
            </tr>
            <tr>
                <td class="tdTitle">模拟调用：</td>
                <td>
                    <div style="width:720px;margin-left:2px;border:1px solid #A9A9A9;">
                        <form action="login"  method="post"  target="_blank"  id="textForm">
                            <table id="testTable">
                                <tr><td class="tdTitle">username:</td><td><input  type="text" name="username" /></td></tr>
                                <tr><td class="tdTitle">password:</td><td><input  type="text" name="password" /></td></tr>
                                <tr><td></td><td><input type="submit"  value="提交"  /></td></tr>
                            </table>
                        </form>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
