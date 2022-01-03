<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>menu</title>
    <link rel="stylesheet" href="../lib/layui-v2.6.3/css/layui.css" media="all">
    <link rel="stylesheet" href="../css/public.css" media="all">
    <style>
        .layui-btn:not(.layui-btn-lg ):not(.layui-btn-sm):not(.layui-btn-xs) {
            height: 34px;
            line-height: 34px;
            padding: 0 8px;
        }
    </style>
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <div>
            <div class="layui-btn-group">
                <button class="layui-btn" id="btn-expand">全部展开</button>
                <button class="layui-btn layui-btn-normal" id="btn-fold">全部折叠</button>
            </div>
            <table id="munu-table" class="layui-table" lay-filter="munu-table"></table>
        </div>
    </div>
</div>
<!-- 操作列 -->
<script type="text/html" id="auth-state">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">修改</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

<script src="../lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
<script src="../js/lay-config.js?v=1.0.4" charset="utf-8"></script>
<script>
    layui.use(['table', 'treetable'], function () {
        var $ = layui.jquery;
        var table = layui.table;
        var treetable = layui.treetable;
        var datas = [];
        $.ajax({
            async:false, 
            url:'material_tree.php',
            type:'post',
            contentType:'application/x-www-form-urlencoded',
            dataType:'json',
            success:function(result){
                            datas = result;
                            console.log(datas);
                        },
                        error:function(msg){
                            //console.log(msg);
                            layer.msg('服务器错误');
                        }
        });
        // 渲染表格
        layer.load(2);
        treetable.render({
            treeColIndex: 1,
            treeSpid: -1,
            treeIdName: 'type_id',
            treePidName: 'parentId',
            elem: '#munu-table',
            data:datas,
            page: false,
            cols: [[
                {type: 'numbers'},
                {field: 'type', minWidth: 80,  align: 'center',title: '物资类型'},
                {field: 'name', minWidth: 80,  align: 'center',title: '物资名称'},
                {field: 'spec', minWidth: 80,  align: 'center',title: '物资规格'},
                {field: 'number', minWidth: 80,  align: 'center',title: '物资数量'},
                {field: 'price', minwidth: 80, align: 'center', title: '物资单价'},
                {field: 'producer', minWidth: 80,  align: 'center',title: '生产厂商'},
                {field: 'status', minWidth: 80,  align: 'center',title: '状态'}
            ]],
            done: function () {
                layer.closeAll('loading');
            }
        });

        $('#btn-expand').click(function () {
            treetable.expandAll('#munu-table');
        });

        $('#btn-fold').click(function () {
            treetable.foldAll('#munu-table');
        });

        //监听工具条
        table.on('tool(munu-table)', function (obj) {
            var data = obj.data;
            var layEvent = obj.event;

            if (layEvent === 'del') {
                layer.msg('删除' + data.id);
            } else if (layEvent === 'edit') {
                layer.msg('修改' + data.id);
            }
        });
    });
</script>
</body>
</html>