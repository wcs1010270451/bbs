<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/15 0015
 * Time: 19:57
 */

namespace App\Observers;

use App\Models\Link;
use Cache;

class LinkObserver
{
    // 在保存时清空 cache_key 对应的缓存
    public function saved(Link $link)
    {
        Cache::forget($link->cache_key);
    }

    public function deleted(Link $link)
    {
        $this->saved($link);
    }
}