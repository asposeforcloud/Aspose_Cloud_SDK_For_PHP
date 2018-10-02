<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Email\Document;

class DocumentTest extends PHPUnit_Framework_TestCase {
    protected $object;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->object = new Document('test.eml');
    } 
    
    public function testGetProperty()
    {  
        $propertyName = 'Subject';
        $result = $this->object->getProperty($propertyName);
        $this->assertInternalType('string',$result);
    }
    
    public function testSetProperty()
    {  
        $propertyName = 'Subject';
        $propertyValue = 'New Subject Here';
        $result = $this->object->setProperty($propertyName, $propertyValue);
        $this->assertInternalType('string',$result);
    }
    
    public function testGetAttachment()
    {
        $attachmentName = 'readme.txt';
        $result = $this->object->getAttachment($attachmentName);
        $this->assertInternalType('string',$result);
    }    
    
    public function testAddAttachment()
    {
        $attachmentName = 'watermark.png';
        $result = $this->object->addAttachment($attachmentName);
        $this->assertFileExists(getcwd(). '/Data/Output/test.eml');
    }        
    
}    