<?php
/**
 * Инициализация
 *
 * @version 01.07.2018
 * @author  Дмитрий Щербаков <atomcms@ya.ru>
 */

namespace Lemurro\Lib\DiskSpace;

/**
 * Class DiskSpace
 *
 * @package Lemurro\Lib\DiskSpace
 */
class DiskSpace
{
    /**
     * Выполним проверку свободного места
     *
     * @param string $space_limit_string Лимит свободного места, в бинарной системе основанной на 1024-байтах в килобайте
     *
     * @return array
     *
     * @version 01.07.2018
     * @author  Дмитрий Щербаков <atomcms@ya.ru>
     */
    public function check($space_limit_string = '1GiB')
    {
        $space_limit_bytes = (new ByteConvert())->toBytes($space_limit_string);

        if ($space_limit_bytes !== -1) {
            return (new Check())->run($space_limit_bytes);
        } else {
            return [
                'errors' => [
                    [
                        'status' => '400 Bad Request',
                        'code'   => 'warning',
                        'title'  => 'Не удалось преобразовать указанный лимит в байты',
                        'meta'   => [
                            'space_limit_string' => $space_limit_string,
                        ],
                    ],
                ],
            ];
        }
    }
}
