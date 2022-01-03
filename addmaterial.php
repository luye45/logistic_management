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
<div class="layui-form layuimini-form">
    <div class="layui-form-item">
        <label class="layui-form-label required">物资名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" lay-verify="required" lay-reqtext="物资名称不能为空" placeholder="请输入物资名称" value="" class="layui-input">
            <tip>填写物资名称。</tip>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label required">物资规格</label>
        <div class="layui-input-block">
        <input type="text" name="spec" lay-verify="required" lay-reqtext="物资规格不能为空" placeholder="请输入物资规格" value="" class="layui-input">
            <tip>填写物资规格。</tip>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label required">物资数量</label>
        <div class="layui-input-block">
        <input type="text" name="number" lay-verify="required" lay-reqtext="物资数量不能为空" placeholder="请输入物资数量" value="" class="layui-input">
            <tip>填写物资数量。</tip>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label required">物资单价</label>
        <div class="layui-input-block">
        <input type="text" name="price" lay-verify="required" lay-reqtext="物资单价不能为空" placeholder="请输入物资单价" value="" class="layui-input">
            <tip>填写物资单价。</tip>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label required">物资类别</label>
        <div class="layui-input-block">
        <select id="type" name="type">
            <option value="">请选择</option>
        </select>
        <tip>填写物资类别。</tip>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label required">生产厂商</label>
        <div class="layui-input-block">
        <input type="text" name="producer" lay-verify="required" lay-reqtext="生产厂商不能为空" placeholder="请输入生产厂商" value="" class="layui-input">
            <tip>填写生产厂商。</tip>
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
    layui.use(['form'], function () {
        var form = layui.form,
            layer = layui.layer,
            $ = layui.$;
        var materialinfo = [];
            $.ajax({
            url:'mtype_query.php',
            type:'post',
            contentType:'application/x-www-form-urlencoded',
            dataType:'json',
            success:function(result){
                        var typelist = result.list;
                        for(var i = 0;i < typelist.length;i++){
                            $("#type").append((new Option(typelist[i].toString())));
                            layui.form.render('select');
                            console.log();
                        }
                        },
                        error:function(msg){
                            //console.log(msg);
                            layer.msg('服务器错误');
                        }
        });
        //监听提交
        form.on('submit(saveBtn)', function (data) {
                //ajax提交数据
                data = data.field;
                $.ajax({
                url:'material_add.php',
                type:'post',
                contentType:'application/x-www-form-urlencoded',
                dataType:'json',
                data:data,
                success:function(result){
                    if(result.status==1){
                        layer.msg('新增成功',function(){
                            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                            parent.layer.close(index);
                            parent.location.reload();
                    });
                        }else if(result.status==0){
                            layer.msg('物资已存在');
                        }
                        else{
                            layer.msg('新增失败');
                        }
                            },
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