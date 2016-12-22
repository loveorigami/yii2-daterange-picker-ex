<?php
namespace lo\widgets\daterange;
use yii\helpers\Html;

/**
 * Class DateRangePicker
 * @package lo\widgets\daterange
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class DateRangeInline extends DateRangePicker
{
    public $fromAttr = 'date_from';
    public $toAttr = 'date_to';

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerAsset();
        echo Html::tag('div', '', ['id'=>$this->getWid()]);
    }
}