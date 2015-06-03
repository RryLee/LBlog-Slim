# Project Init

#### 大体框架基本完成，有如下特点：
* 没有数据库支持，后面会考虑是否将旧文件自动导入mongo
* 安装简单，方便，没有传统csm，blog部署那么复杂
* 适合学习

目前依赖情况:
* PHP框架使用的是 _Slim_ ，很轻便
* 前端CSS框架使用 _foundation_ ，跟_bootstarp_ 差不多，只是没有那么火
* _markdown_ 语法解析，这个都懂得
* HTML使用_Twig_ 模版，感觉和_Django_ 里面的模版用法差不多，很容易上手，功能比_laravel_ 中使用的_blade_ 模版要强大一点
* 使用[Rss_write](https://github.com/suin/php-rss-writer)生成rss feed.

待解决:
* 读取编辑，目前只支持本地编辑上传
* 自定义配置选项，只能手动更改源码，移植性差

最终目标，想做一个本地开发文档库，需要很多的markdown文档，慢慢迭代.

_想要安装在自己本地的同学请参考[安装文档](http://)_

最后，欢迎Star. Fork. Pull Request，提出问题意见，额，麻雀虽小五脏俱全。