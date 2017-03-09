<?php
namespace caijw\Generate\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

abstract class GenerateController extends Controller{
    private $request=null;
    function __construct(Request $request){
        $this->request=$request;
    }
    private function generate($viewUrl,$data){
        ob_end_clean();
        ob_start();
        echo base64_encode(view($viewUrl,$data));
        $content = ob_get_contents();
        ob_end_clean();

        $domain = Config::get("generate.domain");
        $url = $this->request->url();
        $url = str_replace($domain,"",$url);
        if(!(strpos($url, "/") === 0)){
            $url="/".$url;
        }
        /*在url前面加上用户指定的文件夹*/
        $url=Config::get("generate.home").$url;
        /*判断是否产生下级目录*/
        $url = caijw_generate_url_suffix($url);
        $url = str_replace("/",DIRECTORY_SEPARATOR,$url);
        $url = public_path($url);
        /*此时的url已经是完整的了*/
        caijw_generate_mk_dirs(dirname($url));//递归创建目录
        file_put_contents($url,base64_decode($content));
        return view("generate::202");//抛出页面刷新完成的信息
    }
    protected function view($viewUrl,$data=array()){
        $falg = file_get_contents(dirname(__DIR__).DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."toHTML.conf");
        if($falg!=="0"){
            return $this->generate($viewUrl,$data);
        }else{
            return view($viewUrl,$data);
        }
    }

}