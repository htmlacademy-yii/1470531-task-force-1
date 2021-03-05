## Создание фикстур

php yii fixture/generate category notification response review specialization task userSpecialization --language=ru_RU  
php yii fixture/generate city --count=100 --language=ru_RU  
php yii fixture/generate profile user --count=10  
--language=ru_RU

## Загрузка фикстур

php yii fixture/load "*"
