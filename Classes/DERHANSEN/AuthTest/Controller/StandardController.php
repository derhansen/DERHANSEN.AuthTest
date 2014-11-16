<?php
namespace DERHANSEN\AuthTest\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "DERHANSEN.AuthTest".    *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

class StandardController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('message', 'Welcome to the standard controller');
	}

}