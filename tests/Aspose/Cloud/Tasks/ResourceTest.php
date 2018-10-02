<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Tasks\Resource;

class ResourceTest extends PHPUnit_Framework_TestCase {
    protected $object;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        // Create resource object
        $this->object = new Resource('MyProject.mpp');
    } 
    
    public function testGetResources()
    {  
        $result = $this->object->getResources();
        $this->assertInternalType('array',$result);
    }
    
    public function testGetResource()
    {  
        $resourceId = 1;
        $result = $this->object->getResource($resourceId);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testAddResource()
    {
        $resourceName = 'NAME HERE';
        $afterResourceId = 2;
        $changedFileName = 'changed.mpp';
        $this->object->addResource($resourceName, $afterResourceId, $changedFileName);
        $this->assertFileExists(getcwd(). '/Data/Output/changed.mpp');
    }
    
    public function testDeleteResource()
    {
        $resourceId = 2;
        $changedFileName = 'changed.mpp';
        $this->object->deleteResource($resourceId, $changedFileName);
        $this->assertFileExists(getcwd(). '/Data/Output/'. $changedFileName);
    }

}    