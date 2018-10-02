<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Storage\Folder;

class FolderTest extends PHPUnit_Framework_TestCase {
    protected $object;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/output/';

        $this->object = new Folder();
    } 
    
    public function testGetFilesList()
    {  
        $result = $this->object->getFilesList('');
        $this->assertInternalType('array',$result);
    }
    
    public function testGetFile()
    {
        $result = $this->object->getFile('MyProject.pdf','');
        $this->assertFileExists(getcwd(). '/output/MyProject.pdf');
    }
    
    public function testCreateFolder()
    {
        $result = $this->object->createFolder('UnitTest','');
        $this->assertEquals(true,$result);
    }
    
    public function testDeleteFolder()
    {
        $result = $this->object->deleteFolder('UnitTest');
        $this->assertEquals(true,$result);
    } 
    
    public function testGetDiskUsage()
    {
        $result = $this->object->getDiscUsage();
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testFileExists()
    {
        $result = $this->object->fileExists('watermark.png');
        $this->assertEquals(true,$result);
    }
    
    public function testUploadFile()
    {
        $strFile = getcwd(). '/Data/Input/TestStorage.txt';
        $result = $this->object->uploadFile($strFile);
        $this->assertInternalType('string',$result);
    }
    
    public function testDeleteFile()
    {
        $result = $this->object->deleteFile('TestStorage.txt');
        $this->assertEquals(true,$result);
    } 
    
}