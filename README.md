Yii2-test-module
==========


Тестовый модуль для использования в качестве учебного материала


```
php composer require halumein/yii2-test-module "*"
```

миграция:

```
php yii migrate --migrationPath=vendor/halumein/yii2-test-module/migrations
```

В конфигурационный файл приложения добавить модуль test

```php
    'modules' => [
        'test' => [
            'class' => 'halumein\test\Module',
        ],
        //...
    ]
```




```


<?php /* Выведет кнопку */ ?>

<?= halumein\test\widgets\TestButton::widget([
    'label' => 'Мегакнопка'
]); ?>
```
