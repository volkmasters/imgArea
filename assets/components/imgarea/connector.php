<?php
/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var imgArea $imgArea */
$imgArea = $modx->getService('imgarea', 'imgArea', $modx->getOption('imgarea_core_path', null, $modx->getOption('core_path') . 'components/imgarea/') . 'model/imgarea/');
$modx->lexicon->load('imgarea:default');

// handle request
$corePath = $modx->getOption('imgarea_core_path', null, $modx->getOption('core_path') . 'components/imgarea/');
$path = $modx->getOption('processorsPath', $imgArea->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));