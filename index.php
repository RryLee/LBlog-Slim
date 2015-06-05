<?php
require './vendor/autoload.php';
require './lib/myFunc.php';

# 实例化应用
$app = new \Slim\Slim([
    'mode' => 'development',                       // 开发模式
    'debug' => true,                               // 开启调试
    'templates.path' => './resource/templates',    // 静态资源地址
    'view' => new \Slim\Views\Twig(),              // 使用twig模版
    ]);
# 配置项
$app->setName('Fblog');                            // 设置app名
$view = $app->view();                              // 实例化视图对象
$view->parserOptions = array(                      // 配置视图项
    'debug' => true,
    'cache' => dirname(__FILE__) . '/cache'
);
# 404                                              // 404配置模版
$app->notFound(function() use($app){
   $app->render('404.html');
});

#####################################################
# 路由
#####################################################
$app->get('/test', function() use($app){
    $Parsedown = new Parsedown();
    echo $Parsedown->parse('');
})->name('test');

#主页
$app->get('/', function() use ($app) {
    $app->render('welcome.html');
});
$app->get('/home(/:page)', function($page = 1) use($app) {
    $posts = get_posts($page);

    if (empty($posts) || $page < 1) {
        $app->notFound();
    }

    $app->render('index.html', [
        'page' => $page,
        'posts' => $posts,
        'has_pagination' => has_pagination($page)
    ]);

})->conditions(array('page' => '[0-9]*'));

# Posts页
$app->get('/:year/:month/:name', function($year, $month, $name) use ($app) {
    $post = find_post($year, $month, $name);

    if (! $post) {
        $app->notFound();
    }

    $app->render('post.html', ['post' => $post]);
});

# 生成rss
$app->get('/rss', function() use($app) {
    $app->response->headers->set('Content-Type', 'application/rss+xml');
    echo generate_rss(get_posts(1, 30));
});

# 非法页面
$app->get('.*', function() use($app) {
    $app->notFound();
});

$app->run();
