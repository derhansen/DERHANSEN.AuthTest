<?php
namespace DERHANSEN\AuthTest\Security\Authentication\Token;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "DERHANSEN.AuthTest".    *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Test2 authentication token
 */
class Test2Token extends \TYPO3\Flow\Security\Authentication\Token\AbstractToken {

	/**
	 * The username/password credentials
	 * @var array
	 * @Flow\Transient
	 */
	protected $credentials = array('password' => '');

	/**
	 * Updates the password credentials from the POST vars, if the POST parameters are available.
	 * Sets the authentication status to REAUTHENTICATION_NEEDED, if credentials have been sent.
	 *
	 * Note: You need to send the username and password in this POST parameters:
	 *       __authentication[DERHANSEN][AuthTest][Security][Authentication][Token][Test2Token][password]
	 *
	 * @param \TYPO3\Flow\Mvc\ActionRequest $actionRequest The current action request
	 * @return void
	 */
	public function updateCredentials(\TYPO3\Flow\Mvc\ActionRequest $actionRequest) {
		$httpRequest = $actionRequest->getHttpRequest();
		if ($httpRequest->getMethod() !== 'POST') {
			return;
		}

		$arguments = $actionRequest->getInternalArguments();
		$password = \TYPO3\Flow\Reflection\ObjectAccess::getPropertyPath($arguments, '__authentication.DERHANSEN.AuthTest.Security.Authentication.Token.Test2Token.password');
		if (!empty($password)) {
			$this->credentials['password'] = $password;
			$this->setAuthenticationStatus(self::AUTHENTICATION_NEEDED);
		}
	}

	/**
	 * Returns a string representation of the token for logging purposes.
	 *
	 * @return string The username credential
	 */
	public function  __toString() {
		return 'Password: "' . $this->credentials['password'] . '"';
	}

}