<?php
/**
 * This class contains features to work with workbooks.
 */
namespace Aspose\Cloud\Cells;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;

class Workbook
{

    public $fileName = '';

    public function __construct($fileName='')
    {
        $this->fileName = $fileName;
    }

    /**
     * Get Document's properties.
     *
     * @return array|boolean
     * @throws Exception
     */
    public function getProperties()
    {
        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/documentProperties';
        //sign URI
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return $json->DocumentProperties->DocumentPropertyList;
        else
            return false;
    }

    /**
     * Get Resource Properties information like document source format,
     * IsEncrypted, IsSigned and document properties
     *
     * @param string $propertyName Name of the property.
     *
     * @return object
     * @throws Exception
     */
    public function getProperty($propertyName)
    {
        if ($propertyName == '')
            throw new Exception('Property Name not specified');
        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/documentProperties/' . $propertyName;
        //sign URI
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return $json->DocumentProperty;
        else
            return false;

    }

    /**
     * Set document property.
     *
     * @param string $propertyName Name of the property.
     * @param string $propertyValue Value of the property.
     *
     * @return object
     * @throws Exception
     */
    public function setProperty($propertyName, $propertyValue)
    {
        if ($propertyName == '')
            throw new Exception('Property Name not specified');
        if ($propertyValue == '')
            throw new Exception('Property Value not specified');

        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/documentProperties/' . $propertyName;
        $put_data_arr['Value'] = $propertyValue;
        $put_data = json_encode($put_data_arr);
        //sign URI
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'PUT', 'json', $put_data);
        $json = json_decode($responseStream);
        if ($json->Code == 201) {
            return $json->DocumentProperty;
        } else {
            return false;
        }

    }

    /**
     * Remove All Document's properties.
     *
     * @return boolean
     * @throws Exception
     */
    public function removeAllProperties()
    {
        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/documentProperties';
        //sign URI
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'DELETE');
        $json = json_decode($responseStream);
        if (is_object($json)) {
            if ($json->Code == 200)
                return true;
            else
                return false;
        }
        return true;

    }

    /**
     * Delete a document property.
     *
     * @param string $propertyName Name of the property.
     *
     * @return boolean
     * @throws Exception
     */
    public function removeProperty($propertyName)
    {
        if ($propertyName == '')
            throw new Exception('Property Name not specified');
        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/documentProperties/' . $propertyName;
        //sign URI
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Create Empty Workbook.
     *
     * @return null
     */
    public function createEmptyWorkbook()
    {

        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName();
        //sign URI
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'PUT');
        $json = json_decode($responseStream);
        return $json;

    }

    /**
     * Create Empty Workbook.
     *
     * @param string $templateFileName Name of the template file.
     *
     * @return null
     * @throws Exception
     */
    public function createWorkbookFromTemplate($templateFileName)
    {

        if ($templateFileName == '')
            throw new Exception('Template file not specified');
        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '?templatefile=' . $templateFileName;
        //sign URI
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'PUT');
        $json = json_decode($responseStream);
        return $json;

    }

    /**
     * Create Empty Workbook.
     *
     * @param string $templateFileName Name of the template file.
     * @param string $dataFile Data file.
     *
     * @return null
     * @throws Exception
     */
    public function createWorkbookFromSmartMarkerTemplate($templateFileName, $dataFile)
    {

        if ($templateFileName == '')
            throw new Exception('Template file not specified');
        if ($dataFile == '')
            throw new Exception('Data file not specified');
        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '?templatefile=' . $templateFileName . '&dataFile=' . $dataFile;
        //sign URI
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'PUT');
        $json = json_decode($responseStream);
        return $json;

    }

    /**
     * Process Smartmaker Datafile.
     *
     * @param string $dataFile
     *
     * @return object
     * @throws Exception
     */
    public function processSmartMarker($dataFile)
    {

        if ($dataFile == '')
            throw new Exception('Data file not specified');
        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/smartmarker?xmlFile=' . $dataFile;
        //sign URI
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST');
        $json = json_decode($responseStream);
        return $json;

    }

    /**
     * Get Worksheets Count in Workbook.
     *
     * @return integer
     * @throws Exception
     */
    public function getWorksheetsCount()
    {
        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets';
        //sign URI
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return count($json->Worksheets->WorksheetList);

    }

    /**
     * Get Names Count in Workbook.
     *
     * @return integer
     * @throws Exception
     */
    public function getNamesCount()
    {
        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/names';
        //sign URI
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Names->Count;

    }

    /**
     * Get Default Style.
     *
     * @return object
     * @throws Exception
     */
    public function getDefaultStyle()
    {
        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/defaultStyle';
        //sign URI
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '');
        $json = json_decode($responseStream);
        return $json->Style;

    }

    /**
     * Encrypt workbook.
     *
     * @param string $encryptionType Type of the encryption.
     * @param string $password Document encryption password.
     * @param integer $keyLength The key length. This parameter is only for Excel97~2003 format
     *
     * @return boolean
     * @throws Exception
     */
    public function encryptWorkbook($encryptionType = 'XOR', $password = '', $keyLength = '')
    {
        //Build JSON to post
        $fieldsArray['EncriptionType'] = $encryptionType;
        $fieldsArray['KeyLength'] = $keyLength;
        $fieldsArray['Password'] = $password;
        $json = json_encode($fieldsArray);
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/encryption';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', 'json', $json);
        $json_response = json_decode($responseStream);
        if ($json_response->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Protect workbook.
     *
     * @param string $password Document protection password.
     * @param string $protectionType Document protection type.
     *
     * @return boolean
     * @throws Exception
     */
    public function protectWorkbook($password, $protectionType = 'all')
    {
        //Build JSON to post
        $fieldsArray['ProtectionType'] = $protectionType;
        $fieldsArray['Password'] = $password;
        $json = json_encode($fieldsArray);
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/protection';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', 'json', $json);
        $json_response = json_decode($responseStream);
        if ($json_response->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Unprotect workbook.
     *
     * @param string $password Protection password.
     *
     * @return boolean
     * @throws Exception
     */
    public function unprotectWorkbook($password)
    {
        //Build JSON to post
        $fieldsArray['Password'] = $password;
        $json = json_encode($fieldsArray);
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/protection';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'DELETE', 'json', $json);
        $json_response = json_decode($responseStream);
        if ($json_response->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Change password.
     *
     * @param string $password Modify document password.
     *
     * @return boolean
     * @throws Exception
     */
    public function setModifyPassword($password)
    {
        //Build JSON to post
        $fieldsArray['Password'] = $password;
        $json = json_encode($fieldsArray);
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/writeProtection';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'PUT', 'json', $json);
        $json_response = json_decode($responseStream);
        if ($json_response->Status == 'OK')
            return true;
        else
            return false;

    }

    /**
     * Clear modify password.
     *
     * @param string $password Modify document password.
     *
     * @return boolean
     * @throws Exception
     */
    public function clearModifyPassword($password)
    {
        //Build JSON to post
        $fieldsArray['Password'] = $password;
        $json = json_encode($fieldsArray);
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/writeProtection';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'DELETE', 'json', $json);
        $json_response = json_decode($responseStream);
        if ($json_response->Status == 'OK')
            return true;
        else
            return false;

    }

    /**
     * Decrypt workbook.
     *
     * @param string $password Document decryption password.
     *
     * @return boolean
     * @throws Exception
     */
    public function decryptWorkbook($password)
    {
        //Build JSON to post
        $fieldsArray['Password'] = $password;
        $json = json_encode($fieldsArray);
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/encryption';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'DELETE', 'json', $json);
        $json_response = json_decode($responseStream);
        if ($json_response->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Add worksheet.
     *
     * @param string $worksheetName Name of the sheet.
     *
     * @return boolean
     * @throws Exception
     */
    public function addWorksheet($worksheetName)
    {
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $worksheetName;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'PUT', '', '');
        $json_response = json_decode($responseStream);
        if ($json_response->Code == 201)
            return true;
        else
            return false;

    }

    /**
     * Remove worksheet from workbook.
     *
     * @param string $worksheetName Name of the worksheet.
     *
     * @return boolean
     * @throws Exception
     */
    public function removeWorksheet($worksheetName)
    {
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $worksheetName;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');
        $json_response = json_decode($responseStream);
        if ($json_response->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Merge workbook.
     *
     * @param string $mergeFileName Name of merge file.
     *
     * @return boolean
     * @throws Exception
     */
    public function mergeWorkbook($mergeFileName)
    {
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/merge?mergeWith=' . $mergeFileName;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        $json_response = json_decode($responseStream);
        if ($json_response->Code == 200)
            return true;
        else
            return false;

    }          
    
    /**
     * Auto Fit Rows in Excel Workbooks
     * 
     * @param string $saveFormat Format for the output file.
     *
     * @return string Returns file path.
     */
    public function autofitRows($saveFormat = "")
    {
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '?isAutoFit=true';
        if ($saveFormat != '')
            $strURI .= '&format=' . $saveFormat;
        
        $signedURI = Utils::sign($strURI);
        
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        
        $v_output = Utils::validateOutput($responseStream);
        
        if ($v_output === '') {
            if ($saveFormat == '') {
                $strURI = Product::$baseProductUri . '/storage/file/' . $this->getFileName();
                $signedURI = Utils::Sign($strURI);
                $responseStream = Utils::processCommand($signedURI, "GET", "", "");
                
                $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
                Utils::saveFile($responseStream, $outputFile);
            } else {
                $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '.' . $saveFormat;
                Utils::saveFile($responseStream, $outputPath);
            }
            return $outputPath;
        } else {
            return $v_output;
        }
    }
    
    /**
     * Convert Excel Workbook with Additional Settings
     * 
     * @param xml $strXML Data in XML format.
     * @param string $outputFile The name of output file.
     * 
     * @return string Returns the file path.
     * @throws Exception
     */
    public function saveAs($strXML, $outputFile)
    {
        if ($strXML == '')
            throw new Exception('XML Data not specified');
        
        if ($outputFile == '')
            throw new Exception('Output Filename along extension not specified');
        
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/saveAs?newfilename=' . $outputFile;
        $signedURI = Utils::Sign($strURI);
        $responseStream = Utils::processCommand($signedURI, "POST", "XML", $strXML);
        
        $v_output = Utils::validateOutput($responseStream);
        
        if ($v_output === '') {
            $strURI = Product::$baseProductUri . '/storage/file/' . $outputFile;
            $signedURI = Utils::Sign($strURI);
            $responseStream = Utils::processCommand($signedURI, "GET", "", "");

            $outputPath = AsposeApp::$outPutLocation . $outputFile;
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