<?php

$properties = array();

$tmp = array(

    'id' => array(
        'type' => 'numberfield',
        'value' => 0,
    ),
    'tpl' => array(
        'type' => 'textfield',
        'value' => 'tpl.imgArea',
    ),
    'tplScripts' => array(
        'type' => 'textfield',
        'value' => 'tpl.imgArea.scripts',
    ),

    'hideInactive' => array(
        'type' => 'combo-boolean',
        'value' => 1,
    ),
    'hideActive' => array(
        'type' => 'combo-boolean',
        'value' => 0,
    ),

    'easyTooltip' => array(
        'type' => 'combo-boolean',
        'value' => 1,
    ),
    'textBlock' => array(
        'type' => 'textfield',
        'value' => '',
    ),
    'textBlockShowHide' => array(
        'type' => 'combo-boolean',
        'value' => 0,
    ),

    'bg' => array(
        'type' => 'combo-boolean',
        'value' => 1,
    ),
    'bgColor' => array(
        'type' => 'textfield',
        'value' => 'ff0000',
    ),
    'bgOpacity' => array(
        'type' => 'textfield',
        'value' => '0.4',
    ),

    'border' => array(
        'type' => 'combo-boolean',
        'value' => 1,
    ),
    'borderWidth' => array(
        'type' => 'numberfield',
        'value' => 2,
    ),
    'borderColor' => array(
        'type' => 'textfield',
        'value' => 'f88017',
    ),
    'borderOpacity' => array(
        'type' => 'textfield',
        'value' => '0.4',
    ),

    'defaultSelect' => array(
        'type' => 'combo-boolean',
        'value' => 0,
    ),

    'imgBackgroundSize' => array(
        'type' => 'textfield',
        'value' => '',
    ),
    'imgBackgroundPosition' => array(
        'type' => 'textfield',
        'value' => '',
    ),

);

foreach ($tmp as $k => $v) {
    $properties[] = array_merge(array(
        'name' => $k,
        'desc' => PKG_NAME_LOWER . '_prop_' . $k,
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ), $v);
}

return $properties;
