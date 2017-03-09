# laravel-generate-html
laravel框架的生成静态页的扩展包

根据缓冲技术生成静态页

部署此类网站，需前后台分离，即两个域名/ip分别指向前台和后台

后台域名/ip指向laravel框架的public目录

前台域名/ip指向laravel框架的public目录下的指定目录【该目录名称可以在配置文件中设置】

在网站中使用该扩展，请按照如下步骤使用：

1. 使用`composer require caijw/laravel-generate-html`下载该扩展
2. 在config/app.php的providers数组中加入以下语句：`caijw\Generate\GenerateServiceProvider::class`注册服务提供者
3. 在项目根目录使用`php artisan vendor:publish --force`，将配置文件copy到config目录下
4. 修改config目录下的generate文件中的配置【具体配置要求详见generate.php中的注释】
5. 所有需要刷新的页面的对应控制器都不要继承controller，而是`use caijw\Generate\Controllers\GenerateController;`继承该控制器
6. 函数在返回视图时不要使用`return view()`，而是使用`return $this->view()`;用法和view一致
7. 在blade模板中，所有的静态资源文件，都使用`cga()`，用法与`asset()`一致
8. 在blade模板中，所有的站内链接，都使用`cgr()`，用法与`route()`一致
9. 进入对应页面【generate.php配置的refreshUrl】，点击开始刷新，即可生成静态页

> 在使用过程中如遇到问题或发现bug或有更好的建议，欢迎随时与我联系：18292054@qq.com