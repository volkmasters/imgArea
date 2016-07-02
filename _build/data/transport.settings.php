<?php

$settings = array();

$tmp = array(
	
	'media_source' => array(
		'xtype' => 'modx-combo-source',
		'value' => '',
		'area' => 'imgarea_main',
	),
	
);

foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => 'imgarea_' . $k,
			'namespace' => PKG_NAME_LOWER,
		), $v
	), '', true, true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
