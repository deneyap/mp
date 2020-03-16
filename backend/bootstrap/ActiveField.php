<?php
namespace backend\bootstrap;

class ActiveField extends \yii\bootstrap4\ActiveField {

    protected function createLayoutConfig($instanceConfig) {
        $config = [
            'hintOptions' => [
                'tag' => 'small',
                'class' => ['form-text', 'text-muted'],
            ],
            'errorOptions' => [
                'tag' => 'div',
                'class' => 'invalid-feedback',
            ],
            'inputOptions' => [
                'class' => 'form-control form-control-lg'
            ]
        ];

        $layout = $instanceConfig['form']->layout;

        if ($layout === 'horizontal') {
            $config['template'] = "{label}\n{beginWrapper}\n{input}\n{error}\n{hint}\n{endWrapper}";
            $config['wrapperOptions'] = [];
            $config['labelOptions'] = [];
            $config['options'] = [];
            $cssClasses = [
                'offset' => '',
                'label' => 'col-md-2 col-form-label',
                'wrapper' => 'col-md-10',
                'error' => '',
                'hint' => '',
                'field' => 'form-group row'
            ];
            if (isset($instanceConfig['horizontalCssClasses'])) {
                $cssClasses = ArrayHelper::merge($cssClasses, $instanceConfig['horizontalCssClasses']);
            }
            $config['horizontalCssClasses'] = $cssClasses;

            Html::addCssClass($config['wrapperOptions'], $cssClasses['wrapper']);
            Html::addCssClass($config['labelOptions'], $cssClasses['label']);
            Html::addCssClass($config['errorOptions'], $cssClasses['error']);
            Html::addCssClass($config['hintOptions'], $cssClasses['hint']);
            Html::addCssClass($config['options'], $cssClasses['field']);
        } elseif ($layout === 'inline') {
            Html::addCssClass($config['labelOptions'], 'sr-only');
            $config['enableError'] = false;
        }

        return $config;
    }

}
