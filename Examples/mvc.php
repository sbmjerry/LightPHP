<?php

require_once("../lp-load.php");

//lpMVC是一个灰常简单的MVC路由器，用于把请求分发到对应的处理器(handler)

//将页面A绑定到一个处理器上
lpMVC::bind("^/A", new AHandler);

//也可以绑定到一个匿名函数上,函数可以返回一个处理器
lpMVC::bind("^/B/(\d+)", function()
{
    return new BHandler;
});

//还可以让匿名函数直接返回文本
lpMVC::bind("^/C", function()
{
    return "页面C";
});

//设置默认处理器
lpMVC::onDefault(function()
{
    return "您请求的页面未找到";
});

//处理器就是一个继承自lpPage类，他们接收一个参数(可选)，是一个数组，其中是被正则表达式匹配的文本
class AHandler extends lpPage
{
    public function get()
    {
        print "页面A";
        return true;
    }
}

class BHandler extends lpPage
{
    public function get($args)
    {
        //读取参数
        print "页面B {$args[0]}";
        return true;
    }
}

?>