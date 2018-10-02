<?php
/**
 * Converts pages or document into different formats.
 */
namespace Aspose\Cloud\Cells;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;

class Extractor
{

    public $fileName = '';

    public function __construct($fileName='')
    {
        //set default values
        $this->fileName = $fileName;
    }

    /**
     * Saves a specific picture from a specific sheet as image.
     *
     * @param string $worksheetName Name of the sheet.
     * @param integer $pictureIndex Index of the picture.
     * @param string $imageFormat Returns image in the specified format.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function getPicture($worksheetName, $pictureIndex, $imageFormat)
    {
        //Build URI
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $worksheetName . '/pictures/' . $pictureIndex . '?format=' . $imageFormat;
        //Sign URI
        $signedURI = Utils::sign($strURI);
        //Send request and receive response stream
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        //Validate output
        $v_output = Utils::validateOutput($responseStream);
        if ($v_output === '') {
            //Save ouput file
            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '_' . $worksheetName . '.' . $imageFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Saves a specific OleObject from a specific sheet as image.
     *
     * @param string $worksheetName Name of the sheet.
     * @param integer $objectIndex Index of the object.
     * @param string $imageFormat Returns image in the specified format.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function getOleObject($worksheetName, $objectIndex, $imageFormat)
    {
        //Build URI
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $worksheetName . '/oleobjects/' . $objectIndex . '?format=' . $imageFormat;
        //Sign URI
        $signedURI = Utils::sign($strURI);
        //Send request and receive response stream
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        //Validate output
        $v_output = Utils::validateOutput($responseStream);
        if ($v_output === '') {
            //Save ouput file
            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '_' . $worksheetName . '.' . $imageFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Saves a specific chart from a specific sheet as image.
     *
     * @param string $worksheetName Name of the sheet.
     * @param integer $chartIndex Index of the chart.
     * @param string $imageFormat Returns image in the specified format.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function getChart($worksheetName, $chartIndex, $imageFormat)
    {
        //Build URI
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $worksheetName . '/charts/' . $chartIndex . '?format=' . $imageFormat;
        //Sign URI
        $signedURI = Utils::sign($strURI);
        //Send request and receive response stream
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        //Validate output
        $v_output = Utils::validateOutput($responseStream);
        if ($v_output === '') {
            //Save ouput file
            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '_' . $worksheetName . '.' . $imageFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Saves a specific auto-shape from a specific sheet as image.
     *
     * @param string $worksheetName Name of the sheet.
     * @param integer $shapeIndex Index of the shape.
     * @param string $imageFormat Returns image in the specified format.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function getAutoShape($worksheetName, $shapeIndex, $imageFormat)
    {
        //Build URI
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $worksheetName . '/autoshapes/' . $shapeIndex . '?format=' . $imageFormat;

        //Sign URI
        $signedURI = Utils::sign($strURI);

        //Send request and receive response stream
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        //Validate output
        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            //Save ouput file
            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '_' . $worksheetName . '.' . $imageFormat;
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
            throw new Exception('No File Name Specified');
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

}
