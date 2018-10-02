<?php
/**
 * This class contains features to work with email conversion.
 */

namespace Aspose\Cloud\Email;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;

class Converter
{

    public $fileName = '';
    public $saveFormat = '';

    public function __construct($fileName='')
    {
        //set default values
        $this->fileName = $fileName;

        $this->saveFormat = 'msg';
    }

    /**
     * Convert a document to SaveFormat using Aspose storage.
     *
     * @param string $saveFormat Returns document in the specified format.
     *
     * @return string Return the file path.
     * @throws Exception
     */
    public function convert()
    {
        //build URI
        $strURI = Product::$baseProductUri . '/email/' . $this->getFileName() . '?format=' . $this->saveFormat;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            if ($this->saveFormat == 'html') {
                $save_format = 'zip';
            } else {
                $save_format = $this->saveFormat;
            }

            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '.' . $save_format;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else {
            return $v_output;
        }
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        if ($this->fileName == '') {
            AsposeApp::getLogger()->error(Exception::MSG_NO_FILENAME);
            throw new Exception(Exception::MSG_NO_FILENAME);
        }
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @return string
     */
    public function getSaveFormat()
    {
        return $this->saveFormat;
    }

    /**
     * @param string $saveFormat
     */
    public function setSaveFormat($saveFormat)
    {
        $this->saveFormat = $saveFormat;
        return $this;
    }

}