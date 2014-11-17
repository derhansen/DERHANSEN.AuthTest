<?php
namespace DERHANSEN\AuthTest\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "DERHANSEN.AuthTest".    *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Error\Message;
use TYPO3\Flow\Mvc\ActionRequest;
use TYPO3\Flow\Security\Authentication\Controller\AbstractAuthenticationController;
use TYPO3\Flow\Security\Exception\AuthenticationRequiredException;

class LoginController extends AbstractAuthenticationController {

	/**
	 * Default action, displays the login screen and redirect to index-action in standard-controller, if
	 * authenticated
	 *
	 * @return void
	 */
	public function indexAction() {
		if ($this->authenticationManager->isAuthenticated()) {
			$this->redirect('index', 'Standard');
		}
	}

	/**
	 * Is called if authentication failed.
	 *
	 * @param AuthenticationRequiredException $exception The exception thrown while the authentication process
	 * @return void
	 */
	protected function onAuthenticationFailure(AuthenticationRequiredException $exception = NULL) {
		$this->addFlashMessage('The entered password is wrong', 'Wrong credentials', Message::SEVERITY_ERROR, array(), ($exception === NULL ? 1347016771 : $exception->getCode()));
		$this->redirect('index', 'Login');
	}

	/**
	 * Is called if authentication was successful.
	 *
	 * @param ActionRequest $originalRequest The request that was intercepted by the security framework, NULL if there was none
	 * @return void
	 */
	public function onAuthenticationSuccess(ActionRequest $originalRequest = NULL) {
		$this->redirect('index', 'Standard');
	}
}