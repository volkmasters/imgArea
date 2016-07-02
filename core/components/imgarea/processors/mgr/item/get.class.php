<?php

/**
 * Get an Item
 */
class imgAreaItemGetProcessor extends modObjectGetProcessor
{
	public $objectType = 'imgAreaItem';
	public $classKey = 'imgAreaItem';
	public $languageTopics = array('imgarea:default');
	//public $permission = 'view';


	/**
	 * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return mixed
	 */
	public function process()
	{
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		return parent::process();
	}
	
	
	public function cleanup()
	{
		$img_array = $this->object->toArray();
		$html_areas = '';
		
		$a_areas = $this->modx->getCollection('imgAreaItemArea', array('img_id' => $img_array['id']));
		
		foreach( $a_areas as $obj )
		{
			$props = $this->modx->fromJSON($obj->properties);
			
			$html_areas .= '<area ';
			$html_areas .= 'shape="'. $obj->shape .'" ';
			$html_areas .= 'coords="'. $obj->coords .'" ';
			$html_areas .= 'alt="'. $obj->alt .'" ';
			$html_areas .= 'title="'. $obj->title .'" ';
			$html_areas .= 'data-target="'. $obj->target .'" ';
			$html_areas .= 'href="'. $obj->href .'" ';
			$html_areas .= !empty($obj->active) ? 'data-active="'. $obj->active .'" ' : '';
			
			
			if( !empty($props['view']) )
			{
				$_props[2] = !empty($props['view']['render_select']) ? $props['view']['render_select'] : array();
				$_props[3] = !empty($props['view']['render_highlight']) ? $props['view']['render_highlight'] : array();
				
				unset($props['view']['render_select'], $props['view']['render_highlight']);
				
				$_props[1] = $props['view'];
			}
			
			foreach( $_props as $num => $array )
			{
				if( !empty($array) )
				{
					foreach( $array as $name => $value )
					{
						if( $name == 'staticState' )
						{
							$html_areas .= !empty($value) ? 'data-'. $name . $num .'="'. $value .'" ' : '';
						}
						else {
							$html_areas .= 'data-'. $name . $num .'="'. $value .'" ';
						}
					}
				}
			}
			
			
			$html_areas .= '/>';
			$html_areas .= "\r\n";
		}
		
		$return = array_merge(
			$this->object->toArray(),
			array('areas' => $html_areas)
		);
		
		
		return $this->success('', $return);
	}

}

return 'imgAreaItemGetProcessor';