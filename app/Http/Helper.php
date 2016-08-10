<?php
/**
 * Created by PhpStorm.
 * User: simonemacri
 * Date: 08.08.16
 * Time: 14:35
 */

namespace app\Http;


class Helper
{
    public static function issetOrNull(&$is, $txt = null, $txtFail = null){
        $txt = is_null($txt) ? $is : $txt;
        return isset($is) ? $txt : $txtFail;
    }

}