<?php
namespace caijw\Generate\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;


class PrivateController extends Controller{
    function refresh(){
        $urls = Config::get("generate.urls");
        $domain = Config::get("generate.domain");
        $callback = "/".Config::get("generate.refreshUrl")."/callback";
        file_put_contents(dirname(__DIR__).DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."toHTML.conf","1");
        return view('generate::refresh',["urls"=>$urls,"domain"=>$domain,"callback"=>$callback]);
    }
    function callback(){
        $urls = Config::get("generate.urls");
        if(empty($_POST['num']) || $_POST['num']!=count($urls)){
            return json_encode(["status"=>-1,"message"=>"更新信息失败"],JSON_UNESCAPED_UNICODE);
        }
        file_put_contents(dirname(__DIR__).DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."toHTML.conf","0");
        return json_encode(["status"=>0,"message"=>"更新信息成功"],JSON_UNESCAPED_UNICODE);
    }

}