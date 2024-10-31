# Local Setup

## Bitbucket

Nextiva's plugin repo is hosted on Bitbucket. This involves getting a developer access to Nextiva's SSO application so that the developer can log into Bitbucket in order to pull down the repo.

1. Clone (`git clone git@bitbucket.org:nextiva/wp-contact-plugin.git`) the [NextivaOne repo](https://bitbucket.org/nextiva/wp-contact-plugin/src/main/).

## Local Config

1. Run `composer install`.
1. Run `npm install`.
1. Duplicate `local-config-sample.json`, rename it to `local-config.json` and update the values as necessary.
1. Duplicate `.env.sample`, rename it to `.env` and update the values as necessary.
1. Run `npm run dev` or `npm run prod` to build assets.
1. Ensure that the `NextivaOne` plugin is activated in the WP Admin under "Plugins". You may activate any theme available to you.
