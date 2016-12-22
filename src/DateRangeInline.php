<?php
namespace lo\widgets\daterange;

use yii\helpers\Html;
use yii\web\JsExpression;
use yii\web\View;

/**
 * Class DateRangePicker
 * @package lo\widgets\daterange
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class DateRangeInline extends DateRangePicker
{
    /**
     * @var string
     */
    public $fromAttr = 'date_from';

    /**
     * @var string
     */
    public $toAttr = 'date_to';

    /**
     * init widget
     */
    public function init()
    {
        parent::init();
        $this->pluginOptions['container'] = '#' . $this->getWid();
        $this->pluginOptions['inline'] = true;
        $this->pluginOptions['alwaysOpen'] = true;

        $id_from = $this->getInputFrom();
        $id_to = $this->getInputTo();

        if ($id_from && $id_to) {
            $this->pluginOptions['setValue'] = new JsExpression("
                function (s, s1, s2){
                    $('#$id_from').val(s1).trigger('change');
                    $('#$id_to').val(s2).trigger('change');
                }
            ");
            $this->pluginOptions['getValue'] = new JsExpression("
                function (){
                    var dateFrom = $('#$id_from').val();
                    var dateTo = $('#$id_to').val();
                    var dateInit =  localStorage.getItem('date_to');
                    
                    if(!dateFrom){
                        dateFrom = dateInit;
                        dateTo = dateInit;
                    }
                    
                    if (dateFrom && dateTo){
                        return dateFrom + ' ~ ' + dateTo;
                    } else {
                        return '';
                    }
                }
            ");
        }

        $view = $this->getView();
        $view->registerJs("
            $('#$id_to').on('change', function(e){
                 var nextDay = moment($(this).val()).add(1, 'days').format(moment.format);
                 localStorage.setItem('date_to', nextDay);
            });
        ", View::POS_END);

    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerAsset();
        echo Html::tag('div', '', ['id' => $this->getWid()]);
    }

    /**
     * @return null|string
     */
    protected function getInputFrom()
    {
        if ($this->hasModel()) {
            return Html::getInputId($this->model, $this->fromAttr);
        }
        return null;
    }

    /**
     * @return null|string
     */
    protected function getInputTo()
    {
        if ($this->hasModel()) {
            return Html::getInputId($this->model, $this->toAttr);
        }
        return null;
    }
}