<?php

namespace Jlonom\tinymce;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class TinyMCEWidget extends InputWidget
{
    /**
     * @var string the language to use. Defaults to null (en).
     */
    public $language;

    /**
     * @var array<string, mixed> the options for the TinyMCE JS plugin.
     * Please refer to the TinyMCE JS plugin Web page for possible options.
     * @see http://www.tinymce.com/wiki.php/Configuration
     */
    public $clientOptions = [];

    /**
     * @inheritdoc
     */
    public function run(): void
    {
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }
        $this->registerClientScript();
    }

    /**
     * Registers Twitter TypeAhead Bootstrap plugin and the related events
     */
    protected function registerClientScript(): void
    {
        $view = $this->getView();

        TinyMCEAsset::register($view);

        $id = $this->options['id'];

        $this->clientOptions['selector'] = "#$id";
        if ($this->language !== null) {
            $this->clientOptions['language'] = $this->language;
        }

        $options = Json::encode($this->clientOptions);

        $view->registerJs("tinymce.init($options);");
    }
}
