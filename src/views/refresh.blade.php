<html>
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>刷新页面</title>
    <style type="text/css">
        *{margin: 0;padding: 0;}
        .bg{width: 100%;min-width: 1000px;height: 50px;position: fixed;background: #438eb9;}
        .zhanw{height: 80px;}
        .bg > div{width: 1000px;margin: 0 auto;}

        table{border-collapse: collapse;width: 1000px;margin: 0 auto;}
        table td{border: 1px solid #ccc;}
        table td:first-child{width: 15px;padding:5px 10px;}
        table input{width: 15px;height: 15px;}
        table td.url{padding-left: 20px;}
        table td.url a{color: #a71d5d;text-decoration: underline;}
    </style>
</head>
<body>
<div class="bg">
    <div>
        <input type="button" value="开始刷新">
    </div>
</div>
<div class="zhanw"></div>
<table domain="{{$domain}}" callback="{{$callback}}">
    @foreach($urls as $val)
        <tr>
            <td><input type="checkbox" name="urls" value="{{$val}}" checked="checked" /></td>
            <td class="url"><a href="javascript:void(0)">{{$val}}</a></td>
        </tr>
    @endforeach
</table>

</body>
<script type="text/javascript" src="http://lib.sinaapp.com/js/jquery/1.12.4/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    winName=[];
    $(function(){
        $("input[type=button]").click(function(){

            urls = [];
            domain = $("table").attr("domain");
            var num = domain.lastIndexOf("/");
            if(num!=domain.length-1){
                domain=domain+"/";
            }
            $.each($('input:checkbox:checked'),function(){
                var url = $(this).val();
                var num = url.indexOf("/");
                if(num == 0) {
                    url = url.substring(1);
                }
                urls[urls.length] = domain+url;
            });
            generate(urls,0);
        })
    })


    function generate(urls,i){
        winName[i]=window.open(urls[i]);
        winName[i].addEventListener("load",function(){
            /*处理打开页面后的情况，查看是否刷新成功，如成功，则关闭页面，不成功，则记录不成功的数据*/
            if(Boolean(winName[i].document.getElementsByTagName('meta')['error'])){
                winName[i].close()
            }else{

            }
            /*处理是否进行下一个页面的访问，如果还有下一个页面，就刷新下一页面，否则回执成功记录，更新tohtml_time*/
            if(++i<urls.length){
                generate(urls,i);
            }else{
                $.ajax({
                    url: $("table").attr("callback"),
                    data: {num:i},
                    dataType: "json",
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    success: function(){

                    },
                    error: function(xhr, type,dsd){
                        console.log(dsd);
                    }
                });
            }
        });
    }
</script>

</html>
