<?php

$sp = &$scriptProperties;

if (!$imgArea = $modx->getService('imgarea', 'imgArea', $modx->getOption('imgarea_core_path', null, $modx->getOption('core_path') . 'components/imgarea/') . 'model/imgarea/', $sp)) {
    return 'Could not load imgArea class!';
}

$id = $modx->getOption('id', $sp, 0); // id картинки
$tpl = $modx->getOption('tpl', $sp, 'tpl.imgArea'); // шаблон вывода изображения
$tplScripts = $modx->getOption('tplScripts', $sp, 'tpl.imgArea.scripts'); // шаблон вывода скриптов

if ((int)$id <= 0) {
    return;
}

$hideInactive = (int)$modx->getOption('hideInactive', $sp, 1); // скрыть неактивные области
$hideActive = (int)$modx->getOption('hideActive', $sp, 0); // скрыть активные области

$easyTooltip = $modx->getOption('easyTooltip', $sp, 1); // вкл/выкл easyTooltip
$textBlock = $modx->getOption('textBlock', $sp, ''); // отображать alt в стороннем блоке. Укажите #id или .class блока
$textBlockShowHide = $modx->getOption('textBlockShowHide', $sp, 0); // показать/скрыть textBlock при наведении/отведении мыши на область

$bg = $modx->getOption('bg', $sp, 1); // фон - вкл/выкл
$bgColor = $modx->getOption('bgColor', $sp, 'ff0000'); // цвет фона (HEX). Короткая запись не сработает: fff, 000
$bgOpacity = (float)$modx->getOption('bgOpacity', $sp, '0.4'); // прозрачность фона (от 0.0 до 1.0)
$border = $modx->getOption('border', $sp, 1); // рамка - вкл/выкл
$borderWidth = (int)$modx->getOption('borderWidth', $sp, '2'); // толщина рамки (от 0 до 999)
$borderColor = $modx->getOption('borderColor', $sp, 'f88017'); // цвет рамки (HEX). Короткая запись не сработает: fff, 000
$borderOpacity = (float)$modx->getOption('borderOpacity', $sp, '0.4'); // прозрачность рамки (от 0.0 до 1.0)
$defaultSelect = $modx->getOption('defaultSelect', $sp, 0); // выделить по-умолчанию - вкл/выкл

$imgBackgroundSize = $modx->getOption('imgBackgroundSize', $sp, '');
$imgBackgroundPosition = $modx->getOption('imgBackgroundPosition', $sp, '');
if (!empty($imgBackgroundSize) && $imgBackgroundSize != 'cover') {
    $imgBackgroundSize = '';
    $imgBackgroundPosition = '';
}

$hideInactive = ($hideInactive == 'true') ? 1 : $hideInactive;
$hideInactive = ($hideInactive == '0' || $hideInactive == 'false' || empty($hideInactive)) ? 0 : 1;
$hideActive = ($hideActive == 'true') ? 1 : $hideActive;
$hideActive = ($hideActive == '0' || $hideActive == 'false' || empty($hideActive)) ? 0 : 1;

$bg = ($bg == 'true') ? 1 : $bg;
$bg = ($bg == '0' || $bg == 'false' || empty($bg)) ? 'false' : 'true';
$border = ($border == 'true') ? 1 : $border;
$border = ($border == '0' || $border == 'false' || empty($border)) ? 'false' : 'true';
$defaultSelect = ($defaultSelect == 'true') ? 1 : $defaultSelect;
$defaultSelect = ($defaultSelect == '0' || $defaultSelect == 'false' || empty($defaultSelect)) ? 'false' : 'true';

$bgColor = str_replace('#', '', $bgColor);
$borderColor = str_replace('#', '', $borderColor);

$params = array();

$item = $modx->getObject('imgAreaItem', $id);

if (is_object($item)) {
    $params['jsUrl'] = $imgArea->config['jsUrl'];
    $chunk_params = $item->toArray();

    $area_where = '';

    if (!$hideInactive) {
        $area_where[0] .= '( imgAreaItemArea.active = "0" ';
    } else {
        $area_where[0] .= '( imgAreaItemArea.active != "0" ';
    }

    if (!$hideActive) {
        $area_where[0] .= 'OR imgAreaItemArea.active = "1" )';
    } else {
        $area_where[0] .= 'OR imgAreaItemArea.active != "1" )';
    }

    $q = $modx->newQuery('imgAreaItemArea');
    $q->select(array(
        'imgAreaItemArea.*',
    ));
    $q->where(array_merge(array(
        'imgAreaItemArea.img_id = ' . $chunk_params['id'],
    ), $area_where));
    $s = $q->prepare(); //print_r($q->toSQL()); die;
    $s->execute();
    $rows = $s->fetchAll(PDO::FETCH_ASSOC);
    unset($q, $s);

    $areas_html = '';
    $areas_opts = '';

    if (!empty($rows)) {
        $i = 0;
        foreach ($rows as $row) {
            $props = $modx->fromJSON($row['properties']);

            $opt_area = array();
            $opt_area['main'][] = 'key: "area' . $row['id'] . '"';

            $areas_html .= '<area ';
            $areas_html .= 'data-key="area' . $row['id'] . '" ';
            $areas_html .= 'shape="' . $row['shape'] . '" ';
            $areas_html .= 'coords="' . $row['coords'] . '" ';
            $areas_html .= 'alt="' . $row['alt'] . '" ';
            $areas_html .= 'title="' . $row['title'] . '" ';
            $areas_html .= 'data-target="' . $row['target'] . '" ';
            $areas_html .= 'data-href="' . $row['href'] . '" ';
            $areas_html .= 'href="#" ';
            $areas_html .= !empty($row['active']) ? 'data-active="' . $row['active'] . '" ' : '';
            $areas_html .= '/>';
            $areas_html .= "\r\n";

            if (!empty($props['view'])) {
                $opts = $props['view'];

                $_props['select'] = !empty($opts['render_select']) ? $opts['render_select'] : array();
                $_props['highlight'] = !empty($opts['render_highlight']) ? $opts['render_highlight'] : array();

                unset($opts['render_select'], $opts['render_highlight']);

                $_props['main'] = $opts;

                foreach ($_props as $cat => $array) {
                    if (!empty($array)) {
                        if (!empty($array['fillColor']) || !empty($array['fillOpacity'])) {
                            $opt_area[$cat][] = 'fill: true';
                        } elseif (isset($array['fillOpacity']) && $array['fillOpacity'] == '0') {
                            $opt_area[$cat][] = 'fill: false';
                        }

                        if (!empty($array['strokeWidth']) || !empty($array['strokeOpacity'])) {
                            $opt_area[$cat][] = 'stroke: true';
                        } elseif ((isset($array['strokeWidth']) && $array['strokeWidth'] == '0') || (isset($array['strokeOpacity']) && $array['strokeOpacity'] == '0')) {
                            $opt_area[$cat][] = 'stroke: false';
                        }

                        foreach ($array as $name => $value) {
                            if (mb_strlen($value, 'UTF-8')) {
                                if ($name == 'staticState') {
                                    $opt_area[$cat][] = $name . ': ' . (!empty($value) ? 'true' : 'false') . '';
                                } else {
                                    $opt_area[$cat][] = $name . ': "' . $value . '"';
                                }
                            }
                        }
                    }
                }

                $area_opts[$i] = '';

                if (!empty($opt_area['main'])) {
                    $area_opts[$i] .= "{\r\n\t";

                    if (!empty($opt_area['select'])) {
                        $area_opts[$i] .= "render_select: {\r\n\t\t";
                        $area_opts[$i] .= '' . implode(",\r\n\t\t", $opt_area['select']);
                        $area_opts[$i] .= "\r\n\t},\r\n\t";
                    }

                    if (!empty($opt_area['highlight'])) {
                        $area_opts[$i] .= "render_highlight: {\r\n\t\t";
                        $area_opts[$i] .= '' . implode(",\r\n\t\t", $opt_area['highlight']);
                        $area_opts[$i] .= "\r\n\t},";
                    }

                    $area_opts[$i] .= "\r\n\t" . implode(",\r\n\t", $opt_area['main']);
                    $area_opts[$i] .= "\r\n}";
                }
            }

            ++$i;
        }
    }

    $areas_opts .= '[';

    if (!empty($area_opts)) {
        $areas_opts .= implode(',', $area_opts);
    }

    $areas_opts .= ']';

    $chunk_params['areas_html'] = $areas_html;
    $chunk_params['areas_opts'] = $areas_opts;

    $chunk_params['easyTooltip'] = $easyTooltip;
    $chunk_params['textBlock'] = $textBlock;
    $chunk_params['textBlockShowHide'] = $textBlockShowHide;

    $chunk_params['bg'] = $bg;
    $chunk_params['bgColor'] = $bgColor;
    $chunk_params['bgOpacity'] = $bgOpacity;
    $chunk_params['border'] = $border;
    $chunk_params['borderWidth'] = $borderWidth;
    $chunk_params['borderColor'] = $borderColor;
    $chunk_params['borderOpacity'] = $borderOpacity;
    $chunk_params['defaultSelect'] = $defaultSelect;

    $chunk_params['imgBackgroundSize'] = $imgBackgroundSize;
    $chunk_params['imgBackgroundPosition'] = $imgBackgroundPosition;

    $scripts = $modx->getChunk($tplScripts, array_merge($params, $chunk_params));
    $modx->regClientScript($scripts, true);

    return $modx->getChunk($tpl, array_merge($params, $chunk_params));
} else {
    return;
}
