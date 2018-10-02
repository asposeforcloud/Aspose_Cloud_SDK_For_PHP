<?php
/**
 * This class contains features to work with email document.
 */

namespace Aspose\Cloud\Email;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;

class Document
{

    public $fileName = '';

    public function __construct($fileName='')
    {
        $this->fileName = $fileName;
    }

    /**
     * Get resource properties information like From, To, Subject.
     *
     * @param string $propertyName The name of property.
     *
     * @return string Returns value of the property.
     * @throws Exception
     */
    public function getProperty($propertyName)
    {
        if ($propertyName == '')
            throw new Exception('Property Name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/email/' . $this->getFileName() . '/properties/' . $propertyName;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->EmailProperty->Value;
        else
            return false;
    }

    /**
     * Set document property.
     *
     * @param string $propertyName The name of property.
     * @param string $propertyValue The value of property.
     *
     * @return string|boolean Return value if property is set or FALSE if it is not set.
     * @throws Exception
     */
    public function setProperty($propertyName, $propertyValue)
    {
        if ($propertyName == '')
            throw new Exception('Property Name not specified');

        if ($propertyValue == '')
            throw new Exception('Property Value not specified');

        //build URI 
        $strURI = Product::$baseProductUri . '/email/' . $this->getFileName() . '/properties/' . $propertyName;

        $put_data_arr['Value'] = $propertyValue;

        $put_data = json_encode($put_data_arr);

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'PUT', 'json', $put_data);

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->EmailProperty->Value;
        else
            return false;
    }

    /**
     * Get email attachment.
     *
     * @param string $attachmentName The name of attached file.
     *
     * @return string Return path of the attached file.
     * @throws Exception
     */
    public function getAttachment($attachmentName)
    {
        if ($attachmentName == '')
            throw new Exception('Attachment Name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/email/' . $this->getFileName() . '/attachments/' . $attachmentName;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $outputFilename = $attachmentName;
            Utils::saveFile($responseStream, AsposeApp::$outPutLocation . $outputFilename);
            return $outputFilename;
        } else {
            return $v_output;
        }
    }
    
    /**
     * Add email attachment.
     *
     * @param string $attachmentName The name of attached file.
     *
     * @return string Return path of the attached file.
     * @throws Exception
     */
    public function addAttachment($attachmentName)
    {
        if ($attachmentName == '')
            throw new Exception('Attachment Name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/email/' . $this->getFileName() . '/attachments/' . $attachmentName;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $strURI = Product::$baseProductUri . '/storage/file/' . $this->getFileName();
            $signedURI = Utils::Sign($strURI);
            $responseStream = Utils::processCommand($signedURI, "GET", "", "");

            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
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

}