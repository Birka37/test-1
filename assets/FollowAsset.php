<?php

namespace app\assets;

use yii\web\AssetBundle;

class FollowAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/follow.css',
    ];
    public $js = [
        'script/plugin/jquery.follow.js',
        'script/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
