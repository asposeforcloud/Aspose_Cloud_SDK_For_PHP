<?php
/**
 * converts pages or document into different formats
 */
namespace Aspose\Cloud\Words;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;

class Converter {

    public $fileName = '';
    public $saveFormat = '';

    public function __construct($fileName, $saveFormat='Doc')
    {
        //set default values
        $this->fileName = $fileName;
        $this->saveFormat = $saveFormat;
    }

    /**
     * Convert a document to SaveFormat using Aspose storage.
     * 
     * @return string Returns the file path.
     * @throws Exception
     */
    public function convert($folder = null)
    {
        //build URI
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '?format=' . $this->saveFormat;
        if ($folder) {
            $strURI = $strURI . "&folder=" . urlencode($folder);
        }

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
     * Convert a document to SaveFormat without using Aspose storage.
     * 
     * @param string $inputPath The path of source file.
     * @param string $outputPath Path where you want to file after conversion.
     * @param string $outputFormat New file format.
     * 
     * @return string Returns the file path.  
     */
    public function convertLocalFile($inputPath, $outputPath, $outputFormat)
    {
        $str_uri = Product::$baseProductUri . '/words/convert?format=' . $outputFormat;
        $signed_uri = Utils::sign($str_uri);
        $responseStream = Utils::uploadFileBinary($signed_uri, $inputPath, 'xml');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            if ($outputFormat == 'html') {
                $saveFormat = 'zip';
            } else {
                $saveFormat = $outputFormat;
            }

            if ($outputPath == '') {
                $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($inputPath) . '.' . $saveFormat;
            }

            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        }
        else
            return $v_output;
    }
    
    /**
     * Convert web pages to Word Documents
     * 
     * @param XML $strXML Provide XML data.
     * 
     * @return string
     * @throws Exception
     */
    public function convertWebPages($strXML)        
    {
        if ($strXML == '')
            throw new Exception('XML not specified');
        
        //build URI
        $strURI = Product::$baseProductUri . '/words/loadWebDocument';
        
        //sign URI
        $signedURI = Utils::sign($strURI);
           
        $responseStream = Utils::processCommand($signedURI, 'POST', 'XML', $strXML);
        
        $xml = simplexml_load_string($responseStream);
        
        if ($xml->Status == 'OK') {
            $fileName = $xml->SaveResult->Dest['href'];
            $strURI = Product::$baseProductUri . '/storage/file/' . $fileName;            
            $signedURI = Utils::Sign($strURI);
            $responseStream = Utils::processCommand($signedURI, "GET", "", "");

            $outputPath = AsposeApp::$outPutLocation . $fileName;
            Utils::saveFile($responseStream, $outputPath);
            
            return $outputPath;
        } else {
            return false;
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
