<?php
use Illuminate\Support\Facades\Config;
function caijw_generate_mk_dirs($dir){
    if(!is_dir($dir)){
        if(!caijw_generate_mk_dirs(dirname($dir))){
            return false;
        }
        if(!mkdir($dir,0777)){
            return false;
        }
    }
    return true;
}
function caijw_generate_url_suffix($url){
    $f = true;//假定生成下级目录
    $suffix = Config::get("generate.suffix");
    foreach($suffix as $value){
        if(strrchr($url,$value)==$value){//以给定后缀结束
            $f = false;//不再产生下级目录
            break;
        }
    }
    if($f){
        return $url."/index.html";
    }
    return $url;
}
function caijw_generate_route($routeName,$routeParameter=[]){/*对route功能进行生成静态页完善*/
    $url = route($routeName, $routeParameter);
    $domain = Config::get("generate.domain");
    $falg = file_get_contents(__DIR__.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."toHTML.conf");
    if($falg!=="0" && (strpos($url, $domain) !== false)){
        if($domain==$url){
            return "/";
        }
        $url = caijw_generate_url_suffix($url);
        return str_replace($domain,"",$url);
    }
    return $url;
}
function caijw_generate_asset($parameter){/*对asset功能进行生成静态页完善*/
    $url = asset($parameter);
    //return str_replace(生成静态页的服务器,线上服务器,$url);如果线上服务器和生成静态页服务器不一致，可以修改此处
    return $url;
}

if (! function_exists('cgr')) {
    function cgr($routeName,$routeParameter=[]){
        return caijw_generate_route($routeName,$routeParameter);
    }
}
if (! function_exists('cga')) {
    function cga($parameter){
        return caijw_generate_asset($parameter);
    }
}