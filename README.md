#TYPO3 Flow authentication provider test package

This package contains w authentication providers, that are equally. They just check, if the password
in the given token matches the password in the settings.yaml file.

You can use both authentication providers with the different authentication strategies in TYPO3 Flow.
If you set the authentication strategy to use both authenticationProviders (both passwords have to be 
correct), then you have to use the following settings.

```
TYPO3:
  Flow:
    security:
      authentication:
        authenticationStrategy: alltokens
```

**Please note, that this package is only for testing purposes and should not be used in production **




