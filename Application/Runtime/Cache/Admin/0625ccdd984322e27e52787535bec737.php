<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/Css/style.css" />
    <script type="text/javascript" src="/Public/Admin/Js/jquery2.js"></script>
    <script type="text/javascript" src="/Public/Admin/Js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public/Admin/Js/ckform.js"></script>
    <script type="text/javascript" src="/Public/Admin/Js/common.js"></script>
    <script type="text/javascript" src="/Public/Admin/Js/jquerypicture.js"></script>
    
    <style type="text/css">
        body {font-size: 20px;
            padding-bottom: 40px;
            background-color:#e9e7ef;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }
        ul,li{
            list-style: none;
            margin: 0px;
            padding: 0px;
        }
        
    </style>
</head>
<body>
<form action="" method="post" class="definewidth m20" enctype="multipart/form-data">
<table class="table table-bordered table-hover m10" style="margin-left:10px;margin-top:3px;">
    <tr>
        <td width="10%" class="tableleft">类别</td>
        <td>
            <select name="goods_cateid">
                <option value="0">请选择分类</option>
                <option value="1"/>&nbsp;移动电话</option>
                <option value="2"/>&nbsp;平板电脑</option>        
                <option value="3"/>&nbsp;笔记本电脑</option>        
                <option value="4"/>&nbsp;电脑主机</option>        
                <option value="5"/>&nbsp;数码配件</option>        
            </select>
            <br>
            <select name="goods_brandid" id='brand'>
                <option value="0">请选择品牌</option>
                
            </select>
        </td>
    </tr>
    
   
    <tr>
        <td class="tableleft">商品名称</td>
        <td><input type="text" name="goods_name"/></td>
    </tr>
    <tr>
        <td class="tableleft">商品关键字</td>
        <td><input type="text" name="goods_keyword"/></td>
    </tr>
    <tr>
        <td class="tableleft">商品价格</td>
        <td><input type="text" name="goods_price"/></td>
    </tr>
    <tr>
        <td class="tableleft">商品数量</td>
        <td><input type="text" name="goods_num"/></td>
    </tr>
    <tr>
        <td class="tableleft">商品属性</td>
        <td>
        <ul id='attr_td'>
            <li>请选择属性</li>
        </ul>
        </td>
    </tr>
    <tr>
        <td class="tableleft">图片上传</td>
        <td><input type="file" name="goods_pic"  multiple="multiple" /></td>
    </tr>
    
	 <tr>
        <td class="tableleft">视频上传</td>
        <td><input type="file" name="goods_video" multiple="multiple" /></td>
    </tr>
     <tr>
        <td class="tableleft">商品状态</td>
        <td>
            <input type="radio" name='goods_status' value='上架' checked>上架
            <input type="radio" name='goods_status' value='下架'>下架
        </td>
    </tr>
    <tr>
        <td class="tableleft">商品简介</td>
        <td><textarea name='goods_introduce' rows="10" style="width: 600px;"></textarea></td>
    </tr>
   
    <tr>
        <td class="tableleft"></td>
        <td>
            <button style="margin-left:5px;"type="submit" class="btn btn-primary" type="button"  >保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>
</table>
</form>

</body>
</html>
<script type="text/javascript">
    $('select:first').change(function(){
        var pid=$(this).val();
        var data={"pid":pid};
        $.post("<?php echo U('getBrand');?>",data,function(msg){
            msg='<option value="0">请选择品牌</option>'+msg;
            $('#brand').html(msg);
        },'text');
    })
    $('#brand').change(function(){
        var pid=$('select:first').val();
        var td=$('#attr_td');
         $.ajax({
        'url':"<?php echo U('Attr/getAttr');?>",
        'data':{'pid':pid},
        'type':'get',
        'cache':false,
        //定义返回值类型, 先用text能够看清楚返回数据的结构
        'dataType':'json',
        'success':function(msg){
             td.children('li').not('li:first').remove();
            $.each(msg,function(index,el){
                if(el.attr_type=='手填'){
                    str="<li><label>"+el.attr_name+"<a href='javascript:void(0)' class='add'>[+]</a></label></label><input class='dfinput' name='vals["+el.attr_id+"][]'placeholder='请输入"+el.attr_name+"'/></li>";
                }else{
                    var option='';
                    var arr=el.attr_value.split(',');
                    for(var i=0;i<arr.length;i++){
                        option+="<option value="+arr[i]+">"+arr[i]+"</option>";
                    }
                    str="<li><label>"+el.attr_name+"<a href='javascript:void(0)' class='add'>[+]</a></label><select name='vals["+el.attr_id+"][]' class='dfinput'><option value='0'>请选择</option>"+option+"</select><i></i></li>";
                }
                td.find('li:first').after(str);
            });           
        }
    })
   })
    $('.add').live('click',function(){
        var li=$(this).parent().parent();
        var minus=(li.html()).replace('add','minus').replace('+','-');
        minus="<li>"+minus+"</li>";
        $(this).parent().parent().after(minus);
   })
   $('.minus').live('click',function(){
        var li=$(this).parent().parent();
        li.remove();
   })
</script>