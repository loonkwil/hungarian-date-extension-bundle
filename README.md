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
    "spe/hungarian-date-extension-bundle": "dev-master",
}
```

```bash
php composer.phar update
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
