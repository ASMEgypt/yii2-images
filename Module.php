<?php
/**
 */

namespace execut\images;


use execut\dependencies\PluginBehavior;
use execut\files\models\FileBase;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\console\Application;
use yii\db\ActiveRecord;

class Module extends \yii\base\Module implements Plugin
{
    public $dataAttribute = 'data';
    public $extensionAttribute = 'extension';
    public $filesModuleId = 'files';

    public function behaviors()
    {
        return [
            [
                'class' => PluginBehavior::class,
                'pluginInterface' => Plugin::class,
            ],
        ];
    }

    public function init()
    {
        if (\yii::$app instanceof Application) {
            $this->controllerNamespace = 'execut\images\console';
        }

        parent::init(); // TODO: Change the autogenerated stub
    }

    public function getSizes(FileBase $file = null) {
        return $this->getPluginsResults(__FUNCTION__, false, func_get_args());
    }

    public static function getFormatAttribute($thumbnailAttributeName, $format) {
        return $thumbnailAttributeName . '_' . $format;
    }

    public function getFilesModule() {
        return \yii::$app->getModule($this->filesModuleId);
    }
    public function getImageTargetUrl(FileBase $image) {
        return $this->getPluginsResults(__FUNCTION__, true, func_get_args());
    }
}