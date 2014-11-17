<?php
namespace DERHANSEN\AuthTest\Security\Authentication\Provider;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "DERHANSEN.AuthTest".    *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Security\Policy\Role;
use TYPO3\Flow\Security\Exception\UnsupportedAuthenticationTokenException;
use TYPO3\Flow\Security\Authentication\TokenInterface;
use TYPO3\Flow\Security\Authentication\Provider\AbstractProvider;

/**
 * First second authentication provider
 */
class Test2Provider extends AbstractProvider {

	/**
	 * @var \TYPO3\Flow\Security\Context
	 * @Flow\Inject
	 */
	protected $securityContext;

	/**
	 * Returns the class names of the tokens this provider can authenticate.
	 *
	 * @return array
	 */
	public function getTokenClassNames() {
		return array('DERHANSEN\AuthTest\Security\Authentication\Token\Test2Token');
	}

	/**
	 * Sets isAuthenticated to TRUE for all tokens.
	 *
	 * @param \TYPO3\Flow\Security\Authentication\TokenInterface $authenticationToken The token to be authenticated
	 * @return void
	 * @throws \TYPO3\Flow\Security\Exception\UnsupportedAuthenticationTokenException
	 */
	public function authenticate(TokenInterface $authenticationToken) {
		if (!($authenticationToken instanceof \DERHANSEN\AuthTest\Security\Authentication\Token\Test2Token)) {
			throw new UnsupportedAuthenticationTokenException('This provider cannot authenticate the given token.', 1217339840);
		}

		$credentials = $authenticationToken->getCredentials();
		if (is_array($credentials) && isset($credentials['password'])) {
			if ($credentials['password'] === $this->options['password']) {
				$authenticationToken->setAuthenticationStatus(\TYPO3\Flow\Security\Authentication\TokenInterface::AUTHENTICATION_SUCCESSFUL);
				$account = new \TYPO3\Flow\Security\Account();
				$roles = array();
				foreach ($this->options['authenticateRoles'] as $roleIdentifier) {
					$roles[] = new Role($roleIdentifier, Role::SOURCE_SYSTEM);
				}
				$account->setRoles($roles);
				$authenticationToken->setAccount($account);
			} else {
				$authenticationToken->setAuthenticationStatus(\TYPO3\Flow\Security\Authentication\TokenInterface::WRONG_CREDENTIALS);
			}
		} elseif ($authenticationToken->getAuthenticationStatus() !== \TYPO3\Flow\Security\Authentication\TokenInterface::AUTHENTICATION_SUCCESSFUL) {
			$authenticationToken->setAuthenticationStatus(\TYPO3\Flow\Security\Authentication\TokenInterface::NO_CREDENTIALS_GIVEN);
		}
	}

}
