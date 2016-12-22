<?php
namespace lo\widgets\daterange;

use yii\web\AssetBundle;

/**
 * Class DateRangeAsset
 * @package lo\widgets\daterange
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class DateRangeAsset extends AssetBundle
{
    /**
     * @var string locale for moment.js
     */
    public static $locale;
    public $sourcePath = '@bower/daterange-picker-ex/dist';

    public $css = [
        'daterangepicker.min.css'
    ];

    public $js = [
        'jquery.daterangepicker.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'lo\widgets\daterange\MomentAsset'
    ];
}