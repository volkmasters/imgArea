<?php

require_once (dirname(dirname(__FILE__))) . '/index.class.php';

class imgAreaHomeManagerController extends imgAreaMainController {
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
		return $this->modx->lexicon('imgarea') .' :: '. $this->modx->lexicon('imgarea_home');
	}


	/**
	 * @return void
	 */
	public function loadCustomCssJs() {
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
	}


	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->imgArea->config['templatesPath'] . 'home.tpl';
	}
}