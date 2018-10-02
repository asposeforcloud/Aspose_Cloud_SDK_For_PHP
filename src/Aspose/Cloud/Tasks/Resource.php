<?php
/**
 * Deals with project resource level aspects.
 */
namespace Aspose\Cloud\Tasks;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;
use Aspose\Cloud\Storage\Folder;

class Resource
{

    public $fileName = '';

    public function __construct($fileName='')
    {
        $this->fileName = $fileName;
    }

    /**
     * Get project resource items. Each resource item has a link to get full
     * resource representation in the project.
     *
     * @return array Returns the resources.
     * @throws Exception
     */
    public function getResources()
    {


        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/resources/';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->Resources->ResourceItem;
        else
            return false;
    }

    /**
     * Get resource information.
     *
     * @param integer $resourceId The id of the project resource.
     *
     * @return string Returns project resource.
     * @throws Exception
     */
    public function getResource($resourceId)
    {


        if ($resourceId == '')
            throw new Exception('Resource ID not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/resources/' . $resourceId;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->Resource;
        else
            return false;
    }

    /**
     * Add new resource to project.
     *
     * @param string $resourceName The Name of the new resource.
     * @param integer $afterResourceId The id of the resource to insert the new resource after.
     * @param string $changedFileName The name of the project document to save changes to. If this parameter is omitted then the changes will be saved to the source project document.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function addResource($resourceName, $afterResourceId, $changedFileName)
    {


        if ($resourceName == '')
            throw new Exception('Resource Name not specified');

        if ($afterResourceId == '')
            throw new Exception('Resource ID not specified');

        //build URI 
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/resources?resourceName=' . $resourceName . '&afterResourceId=' . $afterResourceId;
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
     * Delete a project resource with all references to it.
     *
     * @param integer $resourceId The id of the project resource.
     * @param string $changedFileName The name of the project document to save changes to. If this parameter is omitted then the changes will be saved to the source project document.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function deleteResource($resourceId, $changedFileName)
    {

        if ($resourceId == '')
            throw new Exception('Resource ID not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/tasks/' . $this->getFileName() . '/resources/' . $resourceId;
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