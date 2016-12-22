<?php
namespace lo\widgets\daterange;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * Class DateRangePicker
 * @package lo\widgets\daterange
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class DateRangePicker extends InputWidget
{
    /**
     * widget prefix
     */
    const PREF_ID = 'dre';

    /**
     * @var string|null locale for moment.js. Used for display localized month and week names.
     * @link http://momentjs.com/docs/#/i18n/
     */
    public $locale;

    /**
     * @var array Date range plugin settings
     * @link http://www.daterangepicker.com/#options
     */
    public $pluginOptions;
    /**
     * @var array The HTML attributes for the input tag.
     */
    public $options = ['class' => 'form-control'];

    /**
     * @var string the template to render. The special tag `{input}` will be replaced with the form input.
     */
    public $template = '{input}';

    /**
     * @inheritdoc
     */
    public function run()
    {
        parent::run();
        $this->registerAsset();

        $input = $this->hasModel()
            ? Html::activeTextInput($this->model, $this->attribute, $this->options)
            : Html::textInput($this->name, $this->value, $this->options);

        echo strtr($this->template, ['{input}' => $input]);
    }

    /**
     * widget id
     */
    protected function getWid(){
        return self::PREF_ID.$this->options['id'];
    }

    /**
     * register assets
     */
    protected function registerAsset(){
        $view = $this->getView();

        MomentAsset::$locale = $this->locale;
        MomentAsset::register($view);
        DateRangeAsset::register($view);
        $options = Json::encode($this->pluginOptions);

        //$callback = (isset($this->callback)) ? ", {$this->callback}" : '';

        $script[] = "moment.locale('{$this->locale}');";
        $script[] = "$('#{$this->getWid()}').dateRangePicker({$options});";

        $js = implode("\r\n", $script);

        $view->registerJs($js);
        $view->registerCss(".dr-picker{z-index:9999;");
    }
}