# Hungarian Date Extension

[![Build Status](https://travis-ci.org/loonkwil/hungarian-date-extension-bundle.png)](https://travis-ci.org/loonkwil/hungarian-date-extension-bundle)

Twig filterek a dátumok magyar nyelven történő megjelenítésére.

## Installálás

composer.json fájlba:
```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/loonkwil/hungarian-date-extension-bundle.git"
    },
],
"require": {
    "spe/hungarian-date-extension-bundle": "~1.0.0",
}
```

```bash
php composer.phar update
```

### Symfony 2.x, 3.x

app/AppKernel.php fájlba:
```php
$bundles = array(
    // ...
    new SPE\HungarianDateExtensionBundle\SPEHungarianDateExtensionBundle(),
    // ...
);
```

### Silex

```php
use SPE\HungarianDateExtensionBundle\Twig\HungarianDateExtension;

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    $twig->addExtension(new HungarianDateExtension());

    return $twig;
}));
```

## Használata

```twig
{{ user.createdAt|hungarian_date }}
```

## Elérhető filterek

 * hungarian_date (pl.: `2012. december 2.`)
 * hungarian_date_tag (pl.: `<time title="2012. december 2. vasárnap 6:32">2012. december 2.</time>`)
 * hungarian_datetime (pl.: `2012. december 2. vasárnap 15:16`)
 * hungarian_datetime_tag (pl.: `<time title="2012. december 2. vasárnap 15:16">2012. december 2. vasárnap 15:16</time>`)
