<?php

namespace Jlonom\tinymce;

use yii\web\AssetBundle;

class TinyMCEAsset extends AssetBundle
{
    public $sourcePath = '@vendor/tinymce/tinymce';
    public $js = ['tinymce.min.js'];
}
