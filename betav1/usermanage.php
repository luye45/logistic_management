<?php
if($_COOKIE['login_session'] != "islogin"){
    setcookie("login_session","islogout", time()+3600*24);
    header("Location: loginreq.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="../lib/layui-v2.6.3/css/layui.css" media="all">
    <link rel="stylesheet" href="../css/public.css" media="all">
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <script type="text/html" id="toolbarDemo">
            <div class="layui-btn-container">
                <button class="layui-btn layui-btn-normal layui-btn-sm data-add-btn" lay-event="add"> 添加 </button>
                <button class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn" lay-event="delete"> 删除 </button>
            </div>
        </script>

        <table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>

        <script type="text/html" id="currentTableBar">
            <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">删除</a>
        </script>

    </div>
</div>
<script src="../lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
<script>
    var parentData='';
    layui.use(['form', 'table'], function () {
        var $ = layui.jquery,
            form = layui.form,
            table = layui.table;
        var userinfo = [];
            $.ajax({
            async:false, 
            url:'userservice.php',
            type:'post',
            contentType:'application/x-www-form-urlencoded',
            dataType:'json',
            success:function(result){
                            userinfo = result;
                            console.log(userinfo);
                        },
                        error:function(msg){
                            //console.log(msg);
                            layer.msg('查询失败');
                        }
        });
        console.log(userinfo);
        table.render({
            elem: '#currentTableId',
            data:userinfo,
            //url: '../api/table.json',
            toolbar: '#toolbarDemo',
            defaultToolbar: ['filter', 'exports', 'print', {
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            cols: [[
                {type: "checkbox", width: 30},
                {field: 'id', width: 60, title: 'ID', sort: true},
                {field: 'name', width: 80, title: '用户名'},
                {field: 'pwd', width: 80, title: '密码'},
                {field: 'create_time', width: 170, title: '创建时间'},
                {field: 'update_time', width: 170, title: '更新时间'},
                {field: 'create_user_name', width: 120, title: '创建用户名'},
                {field: 'login_count', width: 90, title: '登录次数'},
                {field: 'last_login_time', width: 170, title: '上次登录时间'},
                {field: 'status', width: 60, title: '状态'},
                {title: '操作', minWidth: 150, toolbar: '#currentTableBar', align: "center"}
            ]],
            limits: [10, 15, 20, 25, 50, 100],
            limit: 15,
            page: true,
            skin: 'line'
        });

        /**
         * toolbar监听事件
         */
        table.on('toolbar(currentTableFilter)', function (obj) {
            if (obj.event === 'add') {  // 监听添加操作
                var index = layer.open({
                    title: '添加用户',
                    type: 2,
                    shade: 0.2,
                    maxmin:true,
                    shadeClose: true,
                    area: ['100%', '100%'],
                    content: 'adduser.php',
                });
                $(window).on("resize", function () {
                    layer.full(index);
                });
            } else if (obj.event === 'delete') {  // 监听删除操作
                var checkStatus = table.checkStatus('currentTableId')
                    , data = checkStatus.data;
                    var ids ='';
                    //获取每一个对应值
                    ids = data.map((item) => {return item.id;}).join(',').split(',');
                    console.log(ids);
                    $.ajax({
                    url:'userservice_delete.php',
                    type:'post',
                    contentType:'application/x-www-form-urlencoded',
                    dataType:'json',
                    data:{'ids':ids},
                    success:function(result){
                        if(result.status==1){
                            layer.msg('删除成功',function(){
                                window.location.reload();
                            });
                        }else{
                            layer.msg('删除失败');
                        }
                                },
                                error:function(msg){
                                    //console.log(msg);
                                    layer.msg('服务器错误');
                                }
        });
            }
        });

        //监听表格复选框选择
        table.on('checkbox(currentTableFilter)', function (obj) {
            console.log(obj)
        });

        table.on('tool(currentTableFilter)', function (obj) {
            var data = obj.data;
            parentData = data;
            let ids = [data.id]
            if (obj.event === 'edit') {

                var index = layer.open({
                    title: '编辑用户',
                    type: 2,
                    shade: 0.2,
                    maxmin:true,
                    shadeClose: true,
                    area: ['100%', '100%'],
                    content: `edituser.php`
                });
                $(window).on("resize", function () {
                    layer.full(index);
                });
                return false;
            } else if (obj.event === 'delete') {
                layer.confirm('确定删除？', function (index) {
                $.ajax({
                    url:'userservice_delete.php',
                    type:'post',
                    contentType:'application/x-www-form-urlencoded',
                    dataType:'json',
                    data:{"ids":ids},
                    success:function(result){
                        if(result.status==1){
                            layer.msg('删除成功',function(){
                                window.location.reload();
                            });
                        }else{
                            layer.msg('删除失败');
                        }
                                },
                                error:function(msg){
                                    //console.log(msg);
                                    layer.msg('服务器错误');
                                }
        });
                });
            }
        });

    });
    function toChildValue(){
            return parentData;
        }
</script>

</body>
</html>