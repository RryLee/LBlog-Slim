#slim-blog

_安装简单快捷，本地使用查看markdown文档，也可做个人博客_

####特点
* PHP框架使用的是 _Slim_ ，很轻便
* 前端CSS框架使用 _foundation_ ，跟_bootstarp_ 差不多，只是没有那么火
* _markdown_ 语法解析，这个都懂得
* HTML使用_Twig_ 模版，感觉和_Django_ 里面的模版用法差不多，很容易上手，功能比_laravel_ 中使用的_blade_ 模版要强大一点
* 使用[Rss_write](https://github.com/suin/php-rss-writer)生成rss feed.
* 没有使用数据库，直接读取.md文件生成post

####安装

    composer install
    
在posts文件架下面创建post, 文件名格式为 2015-06-01_name.md

####注意:
* 文章url根据文件名来生成
* 文章标题使用 # (也就是h1) 来书写, 详细参考demo

欢迎提示问题. 贡献markdown格式文档
