<?php
/**
 * Deals with project document level aspects.
 */
namespace Aspose\Cloud\Tasks;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;
use Aspose\Cloud\Storage\Folder;

class Document
{

    public $fileName = '';

    public function __construct($fileName='')
    {
        $this->fileName = $fileName;
    }

    /**
     * Get document properties of a project file.
     *
     * @return array Returns the document properties.
     * @throws Exception
     */
    public function getProperties()
    {

        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/documentProperties';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->Properties->List;
        else
            return false;
    }

    /**
     * Get project task items. Each task item has a link to get full task representation in the project.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function getTasks()
    {

        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/tasks';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->Tasks->TaskItem;
        else
            return false;
    }

    /**
     * Get task information.
     *
     * @param integer $taskId The id of the task.
     *
     * @return array Returns the task.
     * @throws Exception
     */
    public function getTask($taskId)
    {


        if ($taskId == '')
            throw new Exception('Task ID not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/tasks/' . $taskId;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->Task;
        else
            return false;
    }

    /**
     * Add a new task to a project.
     *
     * @param string $taskName The name of the new task.
     * @param integer $beforeTaskId The id of the task to insert the new task before.
     * @param string $changedFileName The name of the project document to save changes to. If this parameter is omitted then the changes will be saved to the source project document.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function addTask($taskName, $beforeTaskId, $changedFileName)
    {
        if ($taskName == '')
            throw new Exception('Task Name not specified');

        if ($beforeTaskId == '')
            throw new Exception('Before Task ID not specified');

        //build URI 
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/tasks?taskName=' . $taskName . '&beforeTaskId=' . $beforeTaskId;
        if ($changedFileName != '') {
            $strURI .= '&fileName=' . $changedFileName;
            $this->setFileName($changedFileName);
        }

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $folder = new Folder();
            $outputStream = $folder->GetFile($this->getFileName());
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Delete a project task with all references to it and rebuilds tasks tree.
     *
     * @param integer $taskId The id of the task.
     * @param string $changedFileName The name of the project document to save changes to. If this parameter is omitted then the changes will be saved to the source project document.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function deleteTask($taskId, $changedFileName)
    {

        if ($taskId == '')
            throw new Exception('Task ID not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/tasks/' . $taskId;
        if ($changedFileName != '') {
            $strURI .= '?fileName=' . $changedFileName;
            $this->setFileName($changedFileName);
        }

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $folder = new Folder();
            $outputStream = $folder->GetFile($this->getFileName());
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Get project task links.
     *
     * @return array Returns the task links.
     * @throws Exception
     */
    public function getLinks()
    {

        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/taskLinks';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->TaskLinks;
        else
            return false;
    }
    
    /**
     * Add a Task Link to Project
     * 
     * @param string $link URL of the link.
     * @param integer $index
     * @param integer $predecessorUid Predecessor UID.
     * @param integer $successorUid Successor UID.
     * @param string $linkType Type of the link.
     * @param integer $lag
     * @param string $lagFormat
     * 
     * @return boolean
     * @throws Exception
     */
    public function addLink($link, $index, $predecessorUid, $successorUid, $linkType, $lag, $lagFormat)
    {
        if ($link == '')
            throw new Exception('Link not specified');
        
        if ($index == '')
            throw new Exception('Index not specified');
        
        if ($predecessorUid == '')
            throw new Exception('Predecessor UID not specified');
        
        if ($successorUid == '')
            throw new Exception('Successor UID not specified');
        
        if ($linkType == '')
            throw new Exception('Link Type not specified');
        
        if (!isset($lag))
            throw new Exception('Lag not specified');
        
        if ($lagFormat == '')
            throw new Exception('Lag Format not specified');
        
        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/taskLinks';

        //sign URI
        $signedURI = Utils::sign($strURI);
        
        $data = array('Link' => $link, 'Index' => $index, 'PredecessorUid' => $predecessorUid, 
                      'SuccessorUid' => $successorUid, 'LinkType' => $linkType, 'Lag' => $lag, 
                      'LagFormat' => $lagFormat);
        $jsonData = json_encode($data);
        
        $response = Utils::processCommand($signedURI, 'POST', 'json', $jsonData);

        $json = json_decode($response);

        if ($json->Code == 200)
            return true;
        else
            return false;
    }

    /**
     * Delete a task link.
     *
     * @param integer $index The index of the task link.
     * @param string $changedFileName The name of the project document to save changes to. If this parameter is omitted then the changes will be saved to the source project document.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function deleteLink($index, $changedFileName)
    {

        if ($index == '')
            throw new Exception('Index not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/taskLinks/' . $index;
        if ($changedFileName != '') {
            $strURI .= '?fileName=' . $changedFileName;
            $this->setFileName($changedFileName);
        }

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $folder = new Folder();
            $outputStream = $folder->GetFile($this->getFileName());
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Get project outline code items. Each outline code item has a link to get full outline code
     * definition representation in the project.
     *
     * @return array Returns the outline codes.
     * @throws Exception
     */
    public function getOutlineCodes()
    {

        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/outlineCodes';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->OutlineCodes;
        else
            return false;
    }

    /**
     * Get Outline Code
     *
     * @param integer $outlineCodeId The id of the outline code.
     *
     * @return array Returns the outline code.
     * @throws Exception
     */
    public function getOutlineCode($outlineCodeId)
    {

        if ($outlineCodeId == '')
            throw new Exception('Outline Code ID not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/outlineCodes/' . $outlineCodeId;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->OutlineCode;
        else
            return false;
    }

    /**
     * Delete a project outline code.
     *
     * @param integer $outlineCodeId The id of the outline code.
     * @param string $changedFileName The name of the project document to save changes to. If this parameter is omitted then the changes will be saved to the source project document.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function deleteOutlineCode($outlineCodeId, $changedFileName)
    {
        if ($outlineCodeId == '')
            throw new Exception('Outline Code ID not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/outlineCodes/' . $outlineCodeId;
        if ($changedFileName != '') {
            $strURI .= '?fileName=' . $changedFileName;
            $this->setFileName($changedFileName);
        }

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $folder = new Folder();
            $outputStream = $folder->GetFile($this->getFileName());
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Get project extended attribute items. Each extended attribute item has a link to get full
     * extended attribute representation in the project.
     *
     * @return array Returns the file path.
     * @throws Exception
     */
    public function getExtendedAttributes()
    {
        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/extendedAttributes';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->ExtendedAttributes;
        else
            return false;
    }

    /**
     * Get project extended attribute definition.
     *
     * @param integer $extendedAttributeId
     *
     * @return array Returns the extended attribute.
     * @throws Exception
     */
    public function getExtendedAttribute($extendedAttributeId)
    {

        if ($extendedAttributeId == '')
            throw new Exception('Extended Attribute ID not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/extendedAttributes/' . $extendedAttributeId;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->ExtendedAttribute;
        else
            return false;
    }

    /**
     * Delete a project extended attribute.
     *
     * @param integer $extendedAttributeId The id of the extended attribute.
     * @param string $changedFileName The name of the project document to save changes to. If this parameter is omitted then the changes will be saved to the source project document.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function deleteExtendedAttribute($extendedAttributeId, $changedFileName)
    {

        if ($extendedAttributeId == '')
            throw new Exception('Extended Attribute ID not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/extendedAttributes/' . $extendedAttributeId;
        if ($changedFileName != '') {
            $strURI .= '?fileName=' . $changedFileName;
            $this->setFileName($changedFileName);
        }

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $folder = new Folder();
            $outputStream = $folder->GetFile($this->getFileName());
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($outputStream, $outputPath);
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

}