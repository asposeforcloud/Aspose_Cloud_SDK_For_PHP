<?php

/**
 * This file is part of the Aspose for Cloud SDK.
 *
 * @author Imran Anwar <imran.anwar@Aspose.com>
 * @author Assad Mahmood <assadvirgo@gmail.com>
 * @author Rvanlaak <rvanlaak@gmail.com>
 */

namespace Aspose\Cloud\Exception;

class AsposeCurlException extends AsposeCloudException
{
    public $curlHeaders;

    public function __construct($message, $curlHeaders, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->curlHeaders = $curlHeaders;
    }

}
