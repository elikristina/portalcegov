<?php

// just one change.

date_default_timezone_set('America/Sao_Paulo');
// change the following paths if necessary
$yii=dirname(__FILE__).'/../../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

//Yii::import("yiiext.components.zendAutoloader.EZendAutoloader", true);
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);



// you can load not only Zend classes but also other classes with the same naming
// convention
//EZendAutoloader::$prefixes = array('Zend', 'Custom');
 

//Yii::registerAutoloader(array("EZendAutoloader", "loadClass"), true);

Yii::createWebApplication($config)->run();
