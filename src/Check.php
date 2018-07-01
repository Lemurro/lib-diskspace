<?php
/**
 * Проверка свободного места
 *
 * @version 01.07.2018
 * @author  Дмитрий Щербаков <atomcms@ya.ru>
 */

namespace Lemurro\Lib\DiskSpace;

/**
 * Class Check
 *
 * @package Lemurro\Lib\DiskSpace
 */
class Check
{
    /**
     * Выполним проверку свободного места
     *
     * @param integer $space_limit_bytes Лимит свободного места, в бинарной системе основанной на 1024-байтах в килобайте
     *
     * @return array
     *
     * @version 01.07.2018
     * @author  Дмитрий Щербаков <atomcms@ya.ru>
     */
    public function run($space_limit_bytes)
    {
        $free_space_in_kb = shell_exec("df -k " . __DIR__ . " | awk '{print $4}' | grep -o '[0-9]*'");

        if ($free_space_in_kb !== '') {
            $free_space_in_bytes = $free_space_in_kb * 1024;

            if ($space_limit_bytes >= $free_space_in_bytes) {
                $limit_exceeded = true;
            } else {
                $limit_exceeded = false;
            }

            $byte_convert = new ByteConvert();

            return [
                'data' => [
                    'limit_exceeded' => $limit_exceeded,
                    'free_space'     => $byte_convert->toString($free_space_in_bytes),
                    'space_limit'    => $byte_convert->toString($space_limit_bytes),
                ],
            ];
        } else {
            return [
                'errors' => [
                    [
                        'status' => '500 Internal Server Error',
                        'code'   => 'danger',
                        'title'  => 'Запрос свободного места вернул: "' . $free_space_in_kb . '"',
                    ],
                ],
            ];
        }
    }
}
