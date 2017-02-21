Yii2-service-mini
==========

Про тарифные сетки

```
composer require halumein/yii2-service "*"
```

Миграции:

```
php yii migrate --migrationPath=vendor/halumein/yii2-service-mini/migrations
```


В конфигурационный файл приложения добавить модуль test

```php
    'modules' => [
        'service-mini' => [
            'class' => 'halumein\servicemini\Module',
        ],
    ]
```
