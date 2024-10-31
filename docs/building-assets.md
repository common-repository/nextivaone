# Development Tasks

The local build system for NextivaOne utilizes `mix` to handle building styles, scripts and assets.

- `npm run dev`: runs the `development` task, which just runs `mix`
- `npm run watch`: runs a `mix watch` task, which watches for file changes and also spins up Browsersync.
- `npm run prod`: runs the `production` task, which builds assets for production. You mostly won't need this one as it's only used when we deploy the plugin.
- `npm run lint`: runs an `eslint` task to lint all javascript files located within `resources/src`.
- `npm run format`: runs a `prettier` task that will format all style & javascript files located within `resources/src`.
