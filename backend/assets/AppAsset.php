<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
    public $sourcePath = "@backend/assets/src/";
    public $css = [
        'css/site.css',
        'css/paper-dashboard.css',

    ];
    public $js = [
        'js/popper.min.js',
        'js/bootstrap-notify.js',
        'js/popper.min.js',
        'js/perfect-scrollbar.jquery.min.js',
        'js/paper-dashboard.min.js',
        'js/chartjs.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'backend\assets\BootstrapAsset',
    ];
}
