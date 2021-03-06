<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="../../lib/layui-v2.6.3/css/layui.css" media="all">
    <link rel="stylesheet" href="../../css/public.css" media="all">
    <style>
        body {
            background-color: #ffffff;
        }
    </style>
</head>
<body>
<div class="layui-form layuimini-form" lay-filter="editform">
    <div class="layui-form-item">
        <input type="hidden" name="id" value="" class="layui-input">
        <label class="layui-form-label required">用户名</label>
        <div class="layui-input-block">
            <input type="text" name="username" lay-verify="required" lay-reqtext="用户名不能为空" placeholder="请输入用户名" value="" class="layui-input">
            <tip>修改管理账号的名称。</tip>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label required">密码</label>
        <div class="layui-input-block">
        <input type="text" name="password" lay-verify="required" lay-reqtext="密码不能为空" placeholder="请输入密码" value="" class="layui-input">
            <tip>修改管理账号的密码。</tip>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label required">状态</label>
        <div class="layui-input-block">
        <select id="status" name="status">
            <option>正常</option>
            <option>禁用</option>
    </select>
            <tip>禁用管理账号。</tip>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认保存</button>
        </div>
    </div>
</div>
<script src="../../lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
<script>
    layui.use(['form'], function (data) {
        var form = layui.form,
            layer = layui.layer,
            $ = layui.$;
        var id = GetQueryString("id");
        //封装GetQueryString获取上个页面传来的参数
        function GetQueryString(name){
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if(r != null){
                return decodeURI(r[2]);
            }
            return null;
        }
        //从父页面接收数据
        var getParentValue = parent.toChildValue();
        //console.log(getParentValue);
        //写入form
        form.val('editform',{
            "id":getParentValue.id,
            "username":getParentValue.name,
            "password":getParentValue.pwd,
            "status":getParentValue.status
        });

            //ajax读取数据，应优化为缓存
            // $.ajax({
            //     async:false,
            //     url:'userservice.php',
            //     type:'post',
            //     contentType:'application/x-www-form-urlencoded',
            //     dataType:'json',
            //     data:{"id":`${id}`},
            //     success:function(result){
            //             data = result;
            //             //layer.msg('sic');
            //     },
            //                 error:function(msg){
            //                     //console.log(msg);
            //                     layer.msg('失败');
            //                 }
            //     });
            //     return data;
        //监听提交
        form.on('submit(saveBtn)', function (data) {
                //ajax提交数据
                data = data.field;
                console.log(data);
                $.ajax({
                url:'userservice_edit.php',
                type:'post',
                contentType:'application/x-www-form-urlencoded',
                dataType:'json',
                data:data,
                success:function(result){
                    if(result.status==1){
                        layer.msg('修改成功',function(){
                            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                            parent.layer.close(index);
                            parent.location.reload();
                        });
                    }else{
                        layer.msg('修改失败');
                    }
                }
                    ,
                            error:function(msg){
                                //console.log(msg);
                                layer.msg('服务器错误');
                            }
                });
            return false;
        });
    });
</script>
</body>
</html>