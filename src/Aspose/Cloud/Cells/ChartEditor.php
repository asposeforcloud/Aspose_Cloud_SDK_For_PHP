<?php
/**
 * This class contains features to work with charts.
 */
namespace Aspose\Cloud\Cells;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;
use Aspose\Cloud\Storage\Folder;

class ChartEditor
{

    public $fileName = '';
    public $worksheetName = '';

    public function __construct($fileName='', $worksheetName='')
    {
        $this->fileName = $fileName;
        $this->worksheetName = $worksheetName;
    }

    /**
     * Adds a new chart.
     *
     * @param string $chartType Type of the chart.
     * @param integer $upperLeftRow Number of the upper left row.
     * @param integer $upperLeftColumn Number of the upper left column.
     * @param integer $lowerRightRow Number of the lower right row.
     * @param integer $lowerRightColumn Number of the lower right column.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function addChart($chartType, $upperLeftRow, $upperLeftColumn, $lowerRightRow, $lowerRightColumn)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/charts?chartType=' . $chartType . '&upperLeftRow=' . $upperLeftRow . '&upperLeftColumn=' . $upperLeftColumn . '&lowerRightRow=' . $lowerRightRow . '&lowerRightColumn=' . $lowerRightColumn;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'PUT', '', '');
        $v_output = Utils::validateOutput($responseStream);
        if ($v_output === '') {
            //Save doc on server
            $folder = new Folder();
            $outputStream = $folder->GetFile($this->getFileName());
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }
    
    /**
     * Deletes all charts.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function deleteCharts()
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/charts/';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');
        $v_output = Utils::validateOutput($responseStream);
        if ($v_output === '') {
            //Save doc on server
            $folder = new Folder();
            $outputStream = $folder->GetFile($this->getFileName());
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Deletes a chart.
     *
     * @param integer $chartIndex Index of the chart.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function deleteChart($chartIndex)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/charts/' . $chartIndex;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');
        $v_output = Utils::validateOutput($responseStream);
        if ($v_output === '') {
            //Save doc on server
            $folder = new Folder();
            $outputStream = $folder->GetFile($this->getFileName());
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Show legend of the chart.
     *
     * @param integer $chartIndex Index of the chart.
     *
     * @return string Return the file path.
     * @throws Exception
     */
    public function showChartLegend($chartIndex)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/charts/' . $chartIndex . '/legend';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'PUT', '', '');
        $v_output = Utils::validateOutput($responseStream);
        if ($v_output === '') {
            //Save doc on server
            $folder = new Folder();
            $outputStream = $folder->GetFile($this->getFileName());
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Hide legend of the chart.
     *
     * @param string $chartIndex Index of the chart.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function hideChartLegend($chartIndex)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/charts/' . $chartIndex . '/legend';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');
        $v_output = Utils::validateOutput($responseStream);
        if ($v_output === '') {
            //Save doc on server
            $folder = new Folder();
            $outputStream = $folder->GetFile($this->getFileName());
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Update chart legend.
     *
     * @param integer $chartIndex Index of the chart.
     * @param array $properties Properties of the chart legend.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function updateChartLegend($chartIndex, $properties = '')
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/charts/' . $chartIndex . '/legend';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', 'json', $properties);
        $v_output = Utils::validateOutput($responseStream);
        if ($v_output === '') {
            //Save doc on server
            $folder = new Folder();
            $outputStream = $folder->GetFile($this->getFileName());
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Get chart legend.
     *
     * @param integer $chartIndex Index of the chart.
     *
     * @return object
     * @throws Exception
     */
    public function readChartLegend($chartIndex)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/charts/' . $chartIndex . '/legend';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', 'json', '');
        $json = json_decode($responseStream);
        return $json->Legend;
    }

    /**
     * Gets ChartArea of a chart.
     *
     * @param integer $chartIndex Index of the chart.
     *
     * @return object
     * @throws Exception
     */
    public function getChartArea($chartIndex)
    {
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/charts/' . $chartIndex . '/chartArea';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->ChartArea;
    }

    /**
     * Gets fill format of the ChartArea of a chart.
     *
     * @param integer $chartIndex Index of the chart.
     *
     * @return object
     * @throws Exception
     */
    public function getFillFormat($chartIndex)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/charts/' . $chartIndex . '/chartArea/fillFormat';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->FillFormat;
    }

    /**
     * Gets border of the ChartArea of a chart.
     *
     * @param integer $chartIndex Index of the chart.
     *
     * @return object
     * @throws Exception
     */
    public function getBorder($chartIndex)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/charts/' . $chartIndex . '/chartArea/border';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Line;
    }
    
    /**
     * Set Chart Title in Excel Worksheet
     *
     * @param integer $chartIndex Index of the chart.
     * @param xml $xml Data in xml format.
     *
     * @return boolean
     * @throws Exception
     */
    public function setChartTitle($chartIndex, $strXML)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        
        if (!isset($chartIndex))
            throw new Exception('Chart Index not specified');
        
        if ($strXML == '')
            throw new Exception('XML data not specified');
        
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/charts/' . $chartIndex . '/title';
        
        $signedURI = Utils::sign($strURI);
        
        $response = Utils::processCommand($signedURI, 'PUT', 'xml', $strXML);
        
        $xml = simplexml_load_string($response);
        
        if ($xml->Status == 'OK')
            return true;
        else
            return false;
    }
	
    /**
     * Update Chart Title in Excel Worksheet
     *
     * @param integer $chartIndex Index of the chart.
     * @param xml $xml Data in xml format.
     *
     * @return boolean
     * @throws Exception
     */
    public function updateChartTitle($chartIndex, $strXML)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        
        if (!isset($chartIndex))
            throw new Exception('Chart Index not specified');
        
        if ($strXML == '')
            throw new Exception('XML data not specified');
        
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/charts/' . $chartIndex . '/title';
        
        $signedURI = Utils::sign($strURI);
        
        $response = Utils::processCommand($signedURI, 'POST', 'xml', $strXML);
        
        $xml = simplexml_load_string($response);
        
        if ($xml->Status == 'OK')
            return true;
        else
            return false;
    }
	
    /**
     * Delete Chart Title in Excel Worksheet
     *
     * @param integer $chartIndex Index of the chart.
     *
     * @return boolean
     * @throws Exception
     */
    public function deleteChartTitle($chartIndex)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        
        if (!isset($chartIndex))
            throw new Exception('Chart Index not specified');
        
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/charts/' . $chartIndex . '/title';
        
        $signedURI = Utils::sign($strURI);
        
        $response = Utils::processCommand($signedURI, 'DELETE', '', '');
        
        $json = json_decode($response);
        
        if ($json->Code == 200)
            return true;
        else
            return false;
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

    /**
     * @return string
     */
    public function getWorksheetName()
    {
        return $this->worksheetName;
    }

    /**
     * @param string $worksheetName
     */
    public function setWorksheetName($worksheetName)
    {
        $this->worksheetName = $worksheetName;
        return $this;
    }

}
