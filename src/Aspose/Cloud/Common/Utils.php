<?php
namespace Aspose\Cloud\Common;

use Aspose\Cloud\Event\ProcessCommandEvent;
use Aspose\Cloud\Event\ValidateOutputEvent;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;
use Aspose\Cloud\Exception\AsposeCurlException;

if (!function_exists('curl_init')) {
    AsposeApp::getLogger()->emergency('Aspose needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
    AsposeApp::getLogger()->emergency('Aspose needs the JSON PHP extension.');
}

/**
 * Provides access to the Aspose Platform.
 *
 * @author Imran Anwar <imran.anwar@Aspose.com>
 * @author Assad Mahmood <assadvirgo@gmail.com>
 * @author Rvanlaak
 */
class Utils
{

    public static $http_codes = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Switch Proxy',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        449 => 'Retry With',
        450 => 'Blocked by Windows Parental Controls',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        509 => 'Bandwidth Limit Exceeded',
        510 => 'Not Extended'
    );

    /**
     * Performs Aspose Api Request.
     *
     * @param string $url Target Aspose API URL.
     * @param string $method Method to access the API such as GET, POST, PUT and DELETE
     * @param string $headerType XML or JSON
     * @param string $src Post data.
     * @param string $returnType
     * @return string
     * @throws Exception
     */
    public static function processCommand($url, $method = 'GET', $headerType = 'XML', $src = '', $returnType = 'xml')
    {
        $dispatcher = AsposeApp::getEventDispatcher();

        $method = strtoupper($method);
        $headerType = strtoupper($headerType);

        AsposeApp::getLogger()->info("Aspose Cloud SDK: processCommand called", array(
            'url' => $url,
            'method' => $method,
            'headerType' => $headerType,
            'src' => $src,
            'returnType' => $returnType,
        ));

        $session = curl_init();

        curl_setopt($session, CURLOPT_URL, $url);
        if ($method == 'GET') {
            curl_setopt($session, CURLOPT_HTTPGET, 1);
        } else {
            curl_setopt($session, CURLOPT_POST, 1);
            curl_setopt($session, CURLOPT_POSTFIELDS, $src);
            curl_setopt($session, CURLOPT_CUSTOMREQUEST, $method);
        }
        curl_setopt($session, CURLOPT_HEADER, false);
        if ($headerType == 'XML') {
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Accept: application/' . $returnType . '', 'Content-Type: application/xml', 'x-aspose-client: PHPSDK/v1.0'));
        } else {
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'x-aspose-client: PHPSDK/v1.0'));
        }
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        if (preg_match('/^(https)/i', $url))
            curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);

        // Allow users to register curl options before the call is executed
        $event = new ProcessCommandEvent($session);
        $dispatcher->dispatch(ProcessCommandEvent::PRE_CURL, $event);

        $result = curl_exec($session);
        $headers = curl_getinfo($session);

        if (substr($headers['http_code'], 0, 1) != '2') {

            if (curl_errno($session) !== 0) {
                throw new AsposeCurlException(curl_strerror(curl_errno($session)), $headers, curl_errno($session));
                AsposeApp::getLogger()->warning(curl_strerror(curl_errno($session)));
            } else {
                throw new Exception($result);
                AsposeApp::getLogger()->warning($result);
            }

        } else {
            if (preg_match('/You have processed/i', $result) || preg_match('/Your pricing plan allows only/i', $result)) {
                AsposeApp::getLogger()->alert($result);
                throw new Exception($result);
            }
        }

        // Allow users to alter the result
        $event = new ProcessCommandEvent($session, $result);

        /** @var ProcessCommandEvent $dispatchedEvent */
        $dispatchedEvent = $dispatcher->dispatch(ProcessCommandEvent::POST_CURL, $event);

        curl_close($session);

        // TODO test or the Event result needs to be returned in case an listener was triggered
        return $dispatchedEvent->getResult();
    }

    /**
     * Performs Aspose Api Request to Upload a file.
     *
     * @param string $url Target Aspose API URL.
     * @param string $localFile Local file
     * @param string $headerType XML or JSON
     * @param string $method
     * @return mixed
     */
    public static function uploadFileBinary($url, $localFile, $headerType = 'XML', $method = 'PUT')
    {
        $method = strtoupper($method);
        $headerType = strtoupper($headerType);

        AsposeApp::getLogger()->info("Aspose Cloud SDK: uploadFileBinary called", array(
            'url' => $url,
            'localFile' => $localFile,
            'headerType' => $headerType,
            'method' => $method,
        ));

        $fp = fopen($localFile, 'r');
        $session = curl_init();
        curl_setopt($session, CURLOPT_VERBOSE, 1);
        curl_setopt($session, CURLOPT_USERPWD, 'user:password');
        curl_setopt($session, CURLOPT_URL, $url);
        if ($method == 'PUT') {
            curl_setopt($session, CURLOPT_PUT, 1);
        } else {
            curl_setopt($session, CURLOPT_UPLOAD, true);
            curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'POST');
        }
        curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($session, CURLOPT_HEADER, false);
        if ($headerType == 'XML') {
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Accept: application/xml', 'Content-Type: application/xml', 'x-aspose-client: PHPSDK/v1.0'));
        } else {
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'x-aspose-client: PHPSDK/v1.0'));
        }
        curl_setopt($session, CURLOPT_INFILE, $fp);
        curl_setopt($session, CURLOPT_INFILESIZE, filesize($localFile));
        $result = curl_exec($session);
        curl_close($session);
        fclose($fp);
        return $result;
    }

    public static function sign($urlToSign)
    {
        // parse the url
        $urlToSign = rtrim($urlToSign, "/");
        $url = parse_url($urlToSign);

        $urlPartToSign = $url['scheme'] . '://' . $url['host'] . str_replace(array(' ', '+'), array('%20', '%2B'), $url['path']);

        if (isset($url['query']) && !empty($url['query'])) {
            $urlPartToSign .= "?" . str_replace(array(' ', '+'), array('%20', '%2B'), $url['query']) . '&appSID=' . AsposeApp::$appSID;
        } else {
            $urlPartToSign .= '?appSID=' . AsposeApp::$appSID;
        }

        // Create a signature using the private key and the URL-encoded
        // string using HMAC SHA1. This signature will be binary.
        $signature = hash_hmac('sha1', $urlPartToSign, AsposeApp::$appKey, true);

        $encodedSignature = self::encodeBase64UrlSafe($signature);
        $encodedSignature = str_replace(array('=', '-', '_'), array('', '%2b', '%2f'), $encodedSignature);

        preg_match_all("/%[0-9a-f]{2}/", $encodedSignature, $m);
        foreach ($m[0] as $code) {
            $encodedSignature = str_replace($code, strtoupper($code), $encodedSignature);
        }

        $returnUrl = $urlPartToSign . '&signature=' . $encodedSignature;
        AsposeApp::getLogger()->debug("Aspose Cloud SDK: url signed", array(
            'urlToSign' => $urlToSign,
            'returnUrl' => $returnUrl,
        ));

        return $returnUrl;
    }

    /**
     * Encode a string to URL-safe base64
     *
     * @param string $value value to encode
     * @return mixed
     */
    private static function encodeBase64UrlSafe($value)
    {
        return str_replace(array('+', '/'), array('-', '_'), base64_encode($value));
    }

    /**
     * Saves the files
     *
     * @param string $input input stream.
     * @param string $fileName fileName along with the full path.
     */
    public static function saveFile($input, $fileName)
    {
        $fh = fopen($fileName, 'w') or die('cant open file');
        fwrite($fh, $input);
        fclose($fh);
    }

    public static function getFileName($file)
    {
        $info = pathinfo($file);
        $file_name = basename($file, '.' . $info['extension']);
        return $file_name;
    }

    /**
     * Check or the result does not contain an error message. If $result is invalid it contains the error message
     * @param $result
     * @return string
     */
    public static function validateOutput($result, $saveFormat='')
    {
        $result = (string) $result;
        $validate = array(
            'Unknown file format.',
            'Unable to read beyond the end of the stream',
            'Index was out of range',
            'Cannot read that as a ZipFile',
            'Not a Microsoft PowerPoint 2007 presentation',
            'Index was outside the bounds of the array',
            'An attempt was made to move the position before the beginning of the stream',
            "Format '$saveFormat' is not supported."
        );
        $invalid = 0;
        foreach ($validate as $key => $value) {
            $pos = strpos($result, $value);
            if ($pos === 1 || $pos === 16) {
                $invalid = true;
            }
        }

        // Event can be used to perform extra validation on the result
        $dispatcher = AsposeApp::getEventDispatcher();
        $event = new ValidateOutputEvent($result, $invalid);

        /** @var ValidateOutputEvent $dispatchedEvent */
        $dispatchedEvent = $dispatcher->dispatch(ValidateOutputEvent::VALIDATE_OUTPUT, $event);

        // If the output is invalid it contains the error message
        if ($dispatchedEvent->isInvalid() === true) {
            return $result;
        } else {
            return ''; // FIXME returning an empty string here is really weird
        }
    }

    /**
     * Will get the value of a field in JSON Response
     *
     * @param string $jsonResponse JSON Response string.
     * @param string $fieldName Field to be found.
     *
     * @return getFieldValue($jsonResponse, $fieldName) - String Value of the given Field.
     */
    public function getFieldValue($jsonResponse, $fieldName)
    {
        return json_decode($jsonResponse)->{$fieldName};
    }

    /**
     * This method parses XML for a count of a particular field.
     *
     * @param string $jsonResponse JSON Response string.
     * @param string $fieldName Field to be found.
     *
     * @return getFieldCount($jsonResponse, $fieldName) - String Value of the given Field.
     */
    public function getFieldCount($jsonResponse, $fieldName)
    {
        $arr = json_decode($jsonResponse)->{$fieldName};
        return count($arr, COUNT_RECURSIVE);
    }

    /**
     * Copies the contents of input to output. Doesn't close either stream.
     *
     * @param string $input input stream.
     *
     * @return copyStream($input) - Outputs the converted input stream.
     */
    public function copyStream($input)
    {
        return stream_get_contents($input);
    }

}
