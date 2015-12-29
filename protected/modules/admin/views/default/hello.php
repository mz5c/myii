<?php

$this->pageTitle=Yii::app()->name.' - Hello';
$this->breadcrumbs=array(
    'Hello'=>array('index'),
);?>
    <h1>Hello</h1>
    input what you want to say:<input type="text" id="words"><br>
    <input type="button" onclick="callAjax()" value="click"><br>

    <script>
        function hello(){
            //alert('hello');
            var a = prompt('input');
            alert(a);
            var b = confirm('del');
            alert(b);
        }

        function callAjax(){
            $.ajax({
                url:"callajax",
                cache:false,
                type:'post',
                timeout:1000,
                data:{words:$('#words').val()},
                success: function (o) {
                    if(o.errcode == 'success'){
                        alert('success');
                        $('#words').val(o.res);
                    }else{
                        alert(o.errmsg);
                    }
                },
                error: function () {
                    alert('call failed');
                },
                dataType:'json'
            });
        }
    </script>
<?php echo 'what you want to say : '.$words.'<br>';
?>