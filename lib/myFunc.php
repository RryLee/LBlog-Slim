<?php
use \Suin\RSSWriter\Feed;
use \Suin\RSSWriter\Channel;
use \Suin\RSSWriter\Item;

/**
 * get all post name
 * @return  cache [array]
 */
function get_post_names()
{
    static $_cache = [];

    if (empty($_cache)) {
        $_cache = array_reverse(glob('posts/*.md'));
    }

    return $_cache;
}

/**
 * 获取全部文章资源
 * @param  integer $page
 * @param  integer $perpage
 * @return
 */
function get_posts($page = 1, $perpage = 0)
{
    if ($perpage == 0) {
        $perpage = 5;
    }

    $posts = get_post_names();

    // 当前页面posts
    $posts = array_slice($posts, ($page-1) * $perpage, $perpage);

    $tmp = [];

    $Parsedown = new Parsedown();

    foreach ($posts as $v) {
        $post = new stdClass;

        $arr = explode('_', $v);
        // 从文件名获取时间戳
        $post->date = strtotime(str_replace('posts/', '', $arr[0]));
        // 获取url
        $post->url = './' . date('Y/m', $post->date) . '/' . str_replace('.md', '', $arr[1]);
        // 得到post内容
        $content = $Parsedown->text(file_get_contents($v));
        $arr = explode('</h1>', $content);
        $post->title = str_replace('<h1>','',$arr[0]);
        $post->body = $arr[1];
        $tmp[] = $post;
    }

    return $tmp;
}

/**
 * 判断是否有pagination参数
 * @param  integer $page [description]
 * @return boolean       [description]
 */
function has_pagination($page = 1)
{
    $total = count(get_post_names());

    return [
        'prev'  =>  $page > 1,
        'next'  =>  $total > $page * 5
    ];
}

/**
 * 获取目标post
 * @param  [type] $year
 * @param  [type] $month
 * @param  [type] $name
 */
function find_post($year, $month, $name) {

    foreach (get_post_names() as $key => $value) {
        if (strpos($value, "$year-$month") !== false && strpos($value, $name . '.md') !== false) {
            $arr = get_posts($key+1, 1);
            return $arr[0];
        }
    }

    return false;
}

function generate_rss($posts)
{
    $feed = new Feed();
    $channel = new Channel();

    $channel->title('LBlog')
            ->description('A very light weight blog.')
            ->url('http://localhost:8000')
            ->appendTo($feed);

    $item = new Item();

    foreach($posts as $post) {
        $item->title($post->title)
             ->description($post->body)
             ->url($post->url)
             ->appendTo($channel);
    }

    echo $feed;

}