<?php

/**
 * Remove an Items
 */
class visualfilterItemRemoveProcessor extends modObjectProcessor {
	public $objectType = 'visualfilterItem';
	public $classKey = 'visualfilterItem';
	public $languageTopics = array('visualfilter');
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
			return $this->failure($this->modx->lexicon('visualfilter_item_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var visualfilterItem $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('visualfilter_item_err_nf'));
			}

			$object->remove();
		}

		return $this->success();
	}

}

return 'visualfilterItemRemoveProcessor';