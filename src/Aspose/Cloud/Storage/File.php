<?php
/**
 *  Class that exposes methods to the File endpoints
 */
namespace Aspose\Cloud\Storage;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;

class File
{
    private $strURIFile;

    public function __construct()
    {
        $this->strURIFile = Product::$baseProductUri . '/storage/file/';
    }

    /**
     * Gets a file from Aspose storage.
     *
     * @param string $fileName The name of file.
     * @param string $storageName The name of storage.
     * @return array
     * @throws Exception
     */
    public function getFile($fileName, $storageName = '')
    {
        //check whether file is set or not
        if ($fileName == '') {
            AsposeApp::getLogger()->error(Exception::MSG_NO_FILENAME);
            throw new Exception(Exception::MSG_NO_FILENAME);
        }

        //build URI
        $strURI = $this->strURIFile . $fileName;
        if ($storageName != '') {
            $strURI .= '?storage=' . $storageName;
        }
        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $outputPath = AsposeApp::$outPutLocation . basename($fileName);
        Utils::saveFile($responseStream, $outputPath);

        return $outputPath;
    }

    /**
     * Copies a file in Aspose storage to a new destination
     *
     * @param string $fileName The name of file.
     * @param string $storageName The name of storage.
     * @return bool
     * @throws Exception
     */
    public function copyFile($fileName, $storageName = '', $newDest)
    {
        //check whether file is set or not
        if ($fileName == '' || $newDest == '') {
            AsposeApp::getLogger()->error(Exception::MSG_NO_FILENAME);
            throw new Exception(Exception::MSG_NO_FILENAME);
        }

        //build URI
        $strURI = $this->strURIFile . $fileName . '?newdest=' . $newDest;
        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'PUT', '', '');
        $json = json_decode($responseStream);

        if ($json->Code === 200) {
            return true;
        }

        return false;
    }
}