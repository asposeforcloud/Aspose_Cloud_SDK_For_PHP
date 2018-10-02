<?php
/*
* this class represents product information
*/

/**
 * @author Imran Anwar <imran.anwar@Aspose.com>
 * @author Assad Mahmood <assadvirgo@gmail.com>
 * @author Rvanlaak
 */

namespace Aspose\Cloud\Common;

class Product
{
    /*
    *this property represents the base product uri i.e. http://api.saaspose.com/v1.0
    *you can set this property according to the current version you're using
    */

    public static $baseProductUri = 'http://api.aspose.com/v1.1';

    /**
     * @return string
     */
    public static function getBaseProductUri()
    {
        return self::$baseProductUri;
    }

    /**
     * @param string $baseProductUri
     * @return self
     */
    public static function setBaseProductUri($baseProductUri)
    {
        self::$baseProductUri = $baseProductUri;
    }

}