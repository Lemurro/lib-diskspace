<?php
/**
 * Конвертирование байтов
 *
 * @version 01.07.2018
 * @author  Дмитрий Щербаков <atomcms@ya.ru>
 */

namespace Lemurro\Lib\DiskSpace;

use ByteUnits\Binary;

/**
 * Class ByteConvert
 *
 * @package Lemurro\Lib\DiskSpace
 */
class ByteConvert
{
    /**
     * Преобраузем строку в количество байтов
     *
     * @param string $string Строка в бинарной системе основанной на 1024-байтах в килобайте (12GiB, 35MiB и т.д.)
     *
     * @return integer
     *
     * @version 01.07.2018
     * @author  Дмитрий Щербаков <atomcms@ya.ru>
     */
    public function toBytes($string)
    {
        try {
            return \ByteUnits\parse($string)->numberOfBytes();
        } catch (\Exception $e) {
            return -1;
        }
    }

    /**
     * Преобраузем байты в строку
     *
     * @param integer $bytes Число байт
     *
     * @return string
     *
     * @version 01.07.2018
     * @author  Дмитрий Щербаков <atomcms@ya.ru>
     */
    public function toString($bytes)
    {
        try {
            return Binary::bytes($bytes)->format(1, ' ');
        } catch (\Exception $e) {
            return -1;
        }
    }
}
