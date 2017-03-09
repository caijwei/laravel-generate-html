<?php

return [
    "refreshUrl"=>"caijw_refresh",//刷新页面的网址，从根目录开始写
    "domain"=>"http://127.0.0.1:8888",//根目录网址，即所有要刷新的url的公共部分

    "home"=>"test",//生成的静态页存放目录，前后不要加/
    /*
     * 如果访问的url以数组中元素结尾，则不产生下级目录
     *  如：suffix中有.html元素存在则访问/abc/qwe.html：会在目录中形成如下文件：/abc/qwe.html
     *     如果不存在.html元素，则访问/abc/qwe.html：会在目录中形成如下文件：/abc/qwe.html/index.html
     * */
    "suffix"=>[".html",".xml"],

    "urls"=>[
        "1",
        "/2",
        "/3",
        "/4",
        "/5",
        "/6",
        "/7",
        "/8",
        "/9",
        "/10",
        "/11",

    ]

];