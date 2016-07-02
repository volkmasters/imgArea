<?php

/**
 * Areasave an Item.
 */
class imgAreaItemAreasaveProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'imgAreaItem';
    public $classKey = 'imgAreaItem';
    public $languageTopics = array('imgarea');
    //public $permission = 'save';

    /**
     * We doing special check of permission
     * because of our objects is not an instances of modAccessibleObject.
     *
     * @return bool|string
     */
    public function beforeSave()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }

    /**
     * @return bool
     */
    public function beforeSet()
    {
        $id = (int) $this->getProperty('id');
        $html = trim($this->getProperty('html'));
        $areas = '';
        $new_areas = array();

        if (empty($id)) {
            return $this->modx->lexicon('imgarea_item_err_ns');
        }

        if (!empty($html)) {
            $areas = $html;

            $areas = preg_replace('/^<img[^>]*>/Ui', '', $areas);

            $areas = str_replace(
                array(
                    '<map name="map">    ',
                    '</map>',
                    '/>    <area',
                ),
                array(
                    '',
                    '',
                    '/>||||separator||||<area',
                ),
                $areas
            );

            $areas_list = explode('||||separator||||', $areas);

            foreach ($areas_list as $area) {
                // $this->modx->log(1, print_r($area, 1));
                preg_match('/shape=[\'"]+(.*?)[\'"]+/i', $area, $shape);
                preg_match('/coords=[\'"]+(.*?)[\'"]+/i', $area, $coords);
                preg_match('/href=["]+(.*?)["]+/i', $area, $href);
                preg_match('/alt=[\'"]+(.*?)[\'"]+/i', $area, $alt);
                preg_match('/title=[\'"]+(.*?)[\'"]+/i', $area, $title);
                preg_match('/data-target=[\'"]+(.*?)[\'"]+/i', $area, $target);
                preg_match('/data-active=[\'"]+(.*?)[\'"]+/i', $area, $active);

                preg_match('/data-fillColor1=[\'"]+(.*?)[\'"]+/i', $area, $fillColor1);
                preg_match('/data-fillColor2=[\'"]+(.*?)[\'"]+/i', $area, $fillColor2);
                preg_match('/data-fillColor3=[\'"]+(.*?)[\'"]+/i', $area, $fillColor3);

                preg_match('/data-fillOpacity1=[\'"]+(.*?)[\'"]+/i', $area, $fillOpacity1);
                preg_match('/data-fillOpacity2=[\'"]+(.*?)[\'"]+/i', $area, $fillOpacity2);
                preg_match('/data-fillOpacity3=[\'"]+(.*?)[\'"]+/i', $area, $fillOpacity3);

                preg_match('/data-strokeWidth1=[\'"]+(.*?)[\'"]+/i', $area, $strokeWidth1);
                preg_match('/data-strokeWidth2=[\'"]+(.*?)[\'"]+/i', $area, $strokeWidth2);
                preg_match('/data-strokeWidth3=[\'"]+(.*?)[\'"]+/i', $area, $strokeWidth3);

                preg_match('/data-strokeColor1=[\'"]+(.*?)[\'"]+/i', $area, $strokeColor1);
                preg_match('/data-strokeColor2=[\'"]+(.*?)[\'"]+/i', $area, $strokeColor2);
                preg_match('/data-strokeColor3=[\'"]+(.*?)[\'"]+/i', $area, $strokeColor3);

                preg_match('/data-strokeOpacity1=[\'"]+(.*?)[\'"]+/i', $area, $strokeOpacity1);
                preg_match('/data-strokeOpacity2=[\'"]+(.*?)[\'"]+/i', $area, $strokeOpacity2);
                preg_match('/data-strokeOpacity3=[\'"]+(.*?)[\'"]+/i', $area, $strokeOpacity3);

                preg_match('/data-staticState1=[\'"]+(.*?)[\'"]+/i', $area, $staticState1);
                preg_match('/data-staticState2=[\'"]+(.*?)[\'"]+/i', $area, $staticState2);
                preg_match('/data-staticState3=[\'"]+(.*?)[\'"]+/i', $area, $staticState3);

                $_shape = $shape[1];
                $_coords = $coords[1];
                $_href = !empty($href) ? $href[1] : '#';
                $_alt = !empty($alt) ? htmlspecialchars($alt[1]) : '';
                $_title = !empty($title) ? htmlspecialchars($title[1]) : '';
                $_target = !empty($target) ? '_blank' : '_self';
                $_active = !empty($active) ? 1 : '';

                $_prop['view'] = array();

                $_prop['view']['fillColor'] = !empty($fillColor1) ? str_replace('#', '', $fillColor1[1]) : '';
                $_prop['view']['render_select']['fillColor'] = !empty($fillColor2) ? str_replace('#', '', $fillColor2[1]) : '';
                $_prop['view']['render_highlight']['fillColor'] = !empty($fillColor3) ? str_replace('#', '', $fillColor3[1]) : '';

                $_prop['view']['fillOpacity'] = !empty($fillOpacity1) ? (float) $fillOpacity1[1] : '';
                $_prop['view']['render_select']['fillOpacity'] = !empty($fillOpacity2) ? (float) $fillOpacity2[1] : '';
                $_prop['view']['render_highlight']['fillOpacity'] = !empty($fillOpacity3) ? (float) $fillOpacity3[1] : '';

                $_prop['view']['strokeWidth'] = !empty($strokeWidth1) ? (int) $strokeWidth1[1] : '';
                $_prop['view']['render_select']['strokeWidth'] = !empty($strokeWidth2) ? (int) $strokeWidth2[1] : '';
                $_prop['view']['render_highlight']['strokeWidth'] = !empty($strokeWidth3) ? (int) $strokeWidth3[1] : '';

                $_prop['view']['strokeColor'] = !empty($strokeColor1) ? str_replace('#', '', $strokeColor1[1]) : '';
                $_prop['view']['render_select']['strokeColor'] = !empty($strokeColor2) ? str_replace('#', '', $strokeColor2[1]) : '';
                $_prop['view']['render_highlight']['strokeColor'] = !empty($strokeColor3) ? str_replace('#', '', $strokeColor3[1]) : '';

                $_prop['view']['strokeOpacity'] = !empty($strokeOpacity1) ? (float) $strokeOpacity1[1] : '';
                $_prop['view']['render_select']['strokeOpacity'] = !empty($strokeOpacity2) ? (float) $strokeOpacity2[1] : '';
                $_prop['view']['render_highlight']['strokeOpacity'] = !empty($strokeOpacity3) ? (float) $strokeOpacity3[1] : '';

                $_prop['view']['staticState'] = !empty($staticState1) ? 1 : '';
                $_prop['view']['render_select']['staticState'] = !empty($staticState2) ? 1 : '';
                $_prop['view']['render_highlight']['staticState'] = !empty($staticState3) ? 1 : '';

                $new_areas[] = array(
                    'shape' => $_shape,
                    'coords' => $_coords,
                    'href' => $_href,
                    'target' => $_target,
                    'alt' => $_alt,
                    'title' => $_title,
                    'active' => $_active,
                    'properties' => $this->modx->toJSON($_prop),
                );
            }
        }

        $this->setProperty('html', '');
        $this->setProperty('areas', '');

        $this->modx->removeCollection('imgAreaItemArea', array('img_id' => $id)); // удаляем все области изображения

        foreach ($new_areas as $key => $area) {
            $area_obj[ $key ] = $this->modx->newObject('imgAreaItemArea', array('img_id' => $id));

            if (is_object($area_obj[ $key ])) {
                $area_obj[ $key ]->fromArray($area);
                $area_obj[ $key ]->save();
            }
        }

        return parent::beforeSet();
    }
}

return 'imgAreaItemAreasaveProcessor';
