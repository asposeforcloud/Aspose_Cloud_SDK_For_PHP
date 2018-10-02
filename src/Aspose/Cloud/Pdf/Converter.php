<?php
/**
 * Converts pages or document into different formats.
 */
namespace Aspose\Cloud\Pdf;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;

class Converter
{

    public $fileName = '';
    public $saveFormat = '';

    public function __construct($fileName='', $saveFormat = 'Pdf')
    {
        $this->fileName = $fileName;
        $this->saveFormat = $saveFormat;
    }

    /**
     * Convert a particular page to image with specified size.
     *
     * @param integer $pageNumber The document page number.
     * @param string $imageFormat Return the document in the specified format.
     * @param integer $width The width of image.
     * @param integer $height The height of image.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function convertToImagebySize($pageNumber, $imageFormat, $width, $height)
    {


        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/pages/' . $pageNumber . '?format=' . $imageFormat . '&width=' . $width . '&height=' . $height;

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '_' . $pageNumber . '.' . $imageFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Convert a particular page to image with default size.
     *
     * @param integer $pageNumber The document page number.
     * @param string $imageFormat Return the document in the specified format.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function convertToImage($pageNumber, $imageFormat)
    {


        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/pages/' . $pageNumber . '?format=' . $imageFormat;

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '_' . $pageNumber . '.' . $imageFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Convert a document by url to SaveFormat.
     *
     * @param string $url URL of the document.
     * @param string $outputFilename The name of output file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function convertByUrl($url = '', $format = '', $outputFilename = '')
    {
        //check whether file is set or not
        if ($url == '')
            throw new Exception('Url not specified');

        $strURI = Product::$baseProductUri . '/pdf/convert?url=' . $url . '&format=' . $format;

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'PUT', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            if ($this->saveFormat == 'html') {
                $saveFormat = 'zip';
            } else {
                $saveFormat = $this->saveFormat;
            }

            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($outputFilename) . '.' . $format;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else {
            return $v_output;
        }
    }

    /**
     * Convert a document to SaveFormat using Aspose cloud storage.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function convert()
    {


        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '?format=' . $this->saveFormat;

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            if ($this->saveFormat == 'html') {
                $saveFormat = 'zip';
            } else {
                $saveFormat = $this->saveFormat;
            }

            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '.' . $saveFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else {
            return $v_output;
        }
    }

    /**
     * Convert PDF to different file format without using Aspose cloud storage.
     *
     * $param string $inputFile The path of source file.
     * @param string $outputFilename The output file name.
     * @param string $outputFormat Returns document in the specified format.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function convertLocalFile($inputFile = '', $outputFilename = '', $outputFormat = '')
    {
        //check whether file is set or not
        if ($inputFile == '')
            throw new Exception('No file name specified');

        if ($outputFormat == '')
            throw new Exception('output format not specified');


        $strURI = Product::$baseProductUri . '/pdf/convert?format=' . $outputFormat;

        if (!file_exists($inputFile)) {
            throw new Exception('input file doesnt exist.');
        }


        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::uploadFileBinary($signedURI, $inputFile, 'xml');

        $v_output = Utils::validateOutput($responseStream, $outputFormat);

        if ($v_output === '') {
            if ($outputFormat == 'html') {
                $saveFormat = 'zip';
            } else {
                $saveFormat = $outputFormat;
            }

            if ($outputFilename == '') {
                $outputFilename = Utils::getFileName($inputFile) . '.' . $saveFormat;
            }
            $outputPath = AsposeApp::$outPutLocation . $outputFilename;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
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
