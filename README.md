# PHP-библиотека DiskSpace

**\* Только для Unix-based систем**

Проверка свободного места на диске

## Установка
```bash
composer require lemurro/lib-diskspace
```

## Использование
```php
$disk_space = new \Lemurro\Lib\DiskSpace\DiskSpace();

// Лимит свободного места, в бинарной системе основанной на 1024-байтах в килобайте
// Суффиксы: KiB, MiB, GiB, TiB, PiB, …
// По умолчанию: '1GiB'

$result = $disk_space->check('50GiB');
//Array
//(
//    [data] => Array
//        (
//            [limit_exceeded] => true
//            [free_space] => 43.2 GiB
//            [space_limit] => 50.0 GiB
//        )
//)

$result = $disk_space->check('30GiB');
//Array
//(
//    [data] => Array
//        (
//            [limit_exceeded] => false
//            [free_space] => 43.2 GiB
//            [space_limit] => 30.0 GiB
//        )
//)
```

## Ошибки
В случае возникновения ошибок будет возвращён массив содержащий элемент `errors`
```
Array
(
    [errors] => Array
        (
            [status] => '400 Bad Request'
            [code] => 'warning'
            [title] => 'Не удалось преобразовать указанный лимит в байты'
            [meta] => Array
            (
                [space_limit_string] => '50 abc'
            )
        )
)
```