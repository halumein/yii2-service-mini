Yii2-test-module
==========


Тестовый модуль для использования в качестве учебного материала


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
