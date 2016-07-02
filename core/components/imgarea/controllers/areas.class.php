<?php

require_once (dirname(dirname(__FILE__))) . '/index.class.php';

class imgAreaAreasManagerController extends imgAreaMainController {
	/* @var imgArea $imgArea */
	public $imgArea;


	/**
	 * @param array $scriptProperties
	 */
	public function process(array $scriptProperties = array()) {
	}


	/**
	 * @return null|string
	 */
	public function getPageTitle() {
		return $this->modx->lexicon('imgarea') .' :: '. $this->modx->lexicon('imgarea_areas');
	}


	/**
	 * @return void
	 */
	public function loadCustomCssJs()
	{
		$this->addCss($this->imgArea->config['cssUrl'] . 'mgr/imc.css');
		$this->addJavascript($this->imgArea->config['jsUrl'] . 'mgr/lib/imc.js');
		
		$this->addJavascript($this->imgArea->config['jsUrl'] . 'jquery-2.1.1.min.js');
		
		/*
		$this->addJavascript($this->imgArea->config['jsUrl'] . 'mgr/lib/colorpicker/colorpicker.js');
		$this->addCss($this->imgArea->config['jsUrl'] . 'mgr/lib/colorpicker/css/colorpicker.css');
		*/
		
		/*
		$this->addJavascript($this->imgArea->config['jsUrl'] . 'mgr/lib/color_picker/js/ifx.js');
		$this->addJavascript($this->imgArea->config['jsUrl'] . 'mgr/lib/color_picker/js/idrop.js');
		$this->addJavascript($this->imgArea->config['jsUrl'] . 'mgr/lib/color_picker/js/idrag.js');
		$this->addJavascript($this->imgArea->config['jsUrl'] . 'mgr/lib/color_picker/js/iutil.js');
		$this->addJavascript($this->imgArea->config['jsUrl'] . 'mgr/lib/color_picker/js/islider.js');
		$this->addJavascript($this->imgArea->config['jsUrl'] . 'mgr/lib/color_picker/js/color_picker/color_picker.js');
		$this->addCss($this->imgArea->config['cssUrl'] . 'mgr/lib/color_picker/js/color_picker/color_picker.css');
		*/
		
		/*
		$this->addCss($this->imgArea->config['cssUrl'] . 'mgr/main.css');
		$this->addCss($this->imgArea->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
		$this->addJavascript($this->imgArea->config['jsUrl'] . 'mgr/misc/utils.js');
		$this->addJavascript($this->imgArea->config['jsUrl'] . 'mgr/widgets/items.grid.js');
		$this->addJavascript($this->imgArea->config['jsUrl'] . 'mgr/widgets/items.windows.js');
		$this->addJavascript($this->imgArea->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->imgArea->config['jsUrl'] . 'mgr/sections/home.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "imgarea-page-home"});
		});
		</script>');
		*/
	}


	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->imgArea->config['templatesPath'] . 'areas.tpl';
	}
}