<?php

/**
 * Remove an Items
 */
class imgAreaItemRemoveProcessor extends modObjectProcessor {
	public $objectType = 'imgAreaItem';
	public $classKey = 'imgAreaItem';
	public $languageTopics = array('imgarea');
	//public $permission = 'remove';


	/**
	 * @return array|string
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		$ids = $this->modx->fromJSON($this->getProperty('ids'));
		if (empty($ids)) {
			return $this->failure($this->modx->lexicon('imgarea_item_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var imgAreaItem $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('imgarea_item_err_nf'));
			}

			$object->remove();
		}

		return $this->success();
	}

}

return 'imgAreaItemRemoveProcessor';