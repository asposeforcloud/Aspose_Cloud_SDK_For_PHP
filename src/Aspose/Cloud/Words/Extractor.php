<?php
/**
 * Extract various types of information from the document.
 */
namespace Aspose\Cloud\Words;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;

class Extractor
{

    public $fileName = '';

    public function __construct($fileName='')
    {
        $this->fileName = $fileName;
    }

    /**
     * Gets Text items list from document.
     *
     * @return array
     * @throws Exception
     */
    public function getText()
    {


        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/textItems';

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        return $json->TextItems->List;
    }

    /**
     * Get the OLE drawing object from document.
     *
     * @param int $index The index of OLE object.
     * @param string $OLEFormat The format to save.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function getoleData($index, $OLEFormat)
    {


        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/drawingObjects/' . $index . '/oleData';

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '_' . $index . '.' . $OLEFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Get the Image drawing object from document.
     *
     * @param int $index The index of drawing object.
     * @param string $renderformat The render format.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function getimageData($index, $renderFormat)
    {


        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/drawingObjects/' . $index . '/ImageData';

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '_' . $index . '.' . $renderFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Convert drawing object to image.
     *
     * @param int $index The index of drawing object.
     * @param string $renderformat Returns object in the specified format.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function convertDrawingObject($index, $renderFormat)
    {


        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/drawingObjects/' . $index . '?format=' . $renderFormat;

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '_' . $index . '.' . $renderFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Get the List of drawing object from document.
     *
     * @return array|boolean
     * @throws Exception
     */
    public function getDrawingObjectList()
    {


        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/drawingObjects';

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->DrawingObjects->List;
        else
            return false;
    }

    /**
     * Get the List of drawing object from document.
     *
     * @param string $outputPath The output directory path.
     *
     * @return string|boolean
     * @throws Exception
     */
    public function getDrawingObjects($outputPath)
    {


        if ($outputPath == '')
            throw new Exception('Output path not specified');

        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/drawingObjects';

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            foreach ($json->DrawingObjects->List as $object) {
                $this->getDrawingObject(Product::$baseProductUri . '/words/' . $object->link->Href, $outputPath);
            }
        } else
            return false;
    }

    /**
     * Get the drawing object from document.
     *
     * @param string $objectURI The URI of object.
     * @param string $outputPath The output directory path.
     *
     * @return string|boolean
     * @throws Exception
     */
    public function getDrawingObject($objectURI, $outputPath)
    {


        if ($outputPath == '')
            throw new Exception('Output path not specified');

        if ($objectURI == '')
            throw new Exception('Object URI not specified');

        $url_arr = explode('/', $objectURI);
        $objectIndex = end($url_arr);

        $strURI = $objectURI;

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            if ($json->DrawingObject->ImageDataLink != '') {
                $strURI = $strURI . '/imageData';
                $outputPath = $outputPath . '\\DrawingObject_' . $objectIndex . '.jpeg';
            } else if ($json->DrawingObject->OleDataLink != '') {
                $strURI = $strURI . '/oleData';
                $outputPath = $outputPath . '\\DrawingObject_' . $objectIndex . '.xlsx';
            } else {
                $strURI = $strURI . '?format=jpeg';
                $outputPath = $outputPath . '\\DrawingObject_' . $objectIndex . '.jpeg';
            }

            $signedURI = Utils::sign($strURI);

            $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

            $v_output = Utils::validateOutput($responseStream);

            if ($v_output === '') {
                Utils::saveFile($responseStream, $outputPath);
                return $outputPath;
            } else
                return $v_output;
        } else {
            return false;
        }
    }
    
    /**
     * Get the Current Protection of the Word
     * 
     * @return string|boolean
     */
    public function getProtection()
    {
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/protection';

        $signedURI = Utils::sign($strURI);

        $response = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($response);

        if ($json->Code == 200)
            return $json->ProtectionData->ProtectionType;
        else
            return false;
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

}