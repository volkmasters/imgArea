<?php

/**
 * Class imgAreaMainController
 */
abstract class imgAreaMainController extends modExtraManagerController {
	/** @var imgArea $imgArea */
	public $imgArea;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('imgarea_core_path', null, $this->modx->getOption('core_path') . 'components/imgarea/');
		require_once $corePath . 'model/imgarea/imgarea.class.php';

		$this->imgArea = new imgArea($this->modx);
		//$this->addCss($this->imgArea->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->imgArea->config['jsUrl'] . 'mgr/imgarea.js');
		$this->addHtml('
		<script type="text/javascript">
			imgArea.config = ' . $this->modx->toJSON($this->imgArea->config) . ';
			imgArea.config.connector_url = "' . $this->imgArea->config['connectorUrl'] . '";
		</script>
		');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('imgarea:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends imgAreaMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}