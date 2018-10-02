<?php
/**
 * @author Imran Anwar <imran.anwar@Aspose.com>
 * @author Assad Mahmood <assadvirgo@gmail.com>
 * @author Rvanlaak
 */
namespace Aspose\Cloud\Common;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class AsposeApp
{

    /**
     * Represents AppSID for the app.
     */
    public static $appSID = '';

    /**
     * Represents AppKey for the app.
     */
    public static $appKey = '';

    /**
     * Location where files get stored
     */
    public static $outPutLocation = 'E:\\';

    /**
     * @var bool
     */
    public static $debug = false;

    /**
     * @var EventDispatcherInterface
     */
    private static $eventDispatcher;

    /**
     * @var LoggerInterface
     */
    private static $logger;


    /**
     * @return string
     */
    public static function getAppKey()
    {
        return self::$appKey;
    }

    /**
     * @param string $appKey
     * @return self
     */
    public static function setAppKey($appKey)
    {
        self::$appKey = $appKey;
    }

    /**
     * @return string
     */
    public static function getAppSID()
    {
        return self::$appSID;
    }

    /**
     * @param string $appSID
     * @return self
     */
    public static function setAppSID($appSID)
    {
        self::$appSID = $appSID;
    }

    /**
     * @return string
     */
    public static function getOutPutLocation()
    {
        return self::$outPutLocation;
    }

    /**
     * @param string $outPutLocation
     * @return self
     */
    public static function setOutPutLocation($outPutLocation)
    {
        self::$outPutLocation = $outPutLocation;
    }

    /**
     * @return boolean
     */
    public static function isDebug()
    {
        return self::$debug;
    }

    /**
     * @param boolean $debug
     */
    public static function setDebug($debug)
    {
        self::$debug = $debug;
    }

    /**
     * @return EventDispatcherInterface
     */
    public static function getEventDispatcher()
    {
        if (null === self::$eventDispatcher) {
            self::$eventDispatcher = new EventDispatcher();
        }
        return self::$eventDispatcher;
    }

    /**
     * @param EventDispatcherInterface $eventDispatcher
     */
    public static function setEventDispatcher($eventDispatcher)
    {
        self::$eventDispatcher = $eventDispatcher;
    }

    /**
     * @return bool
     */
    public static function hasEventDispatcher()
    {
        return (null !== self::$eventDispatcher);
    }

    /**
     * @return LoggerInterface
     */
    public static function getLogger()
    {
        if (null === self::$logger) {
            self::$logger = Logger::newInstance();
        }
        return self::$logger;
    }

    /**
     * @param LoggerInterface $logger
     */
    public static function setLogger($logger)
    {
        self::$logger = $logger;
    }

}