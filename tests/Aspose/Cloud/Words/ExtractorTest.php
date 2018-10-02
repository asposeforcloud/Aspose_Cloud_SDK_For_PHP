<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Words\Extractor;

class ExtractorTest extends PHPUnit_Framework_TestCase {
    
    protected $object;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';
        
        $this->object = new Extractor('Test.docx');
    } 
    
    public function testGetText()
    {  
        $result = $this->object->getText();
        $this->assertInternalType('array',$result);
    }
    
    public function testConvertDrawingObject()
    {  
        $index = 0;
        $renderFormat = "png";
        $result = $this->object->convertDrawingObject($index, $renderFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_'.$index.'.'.$renderFormat);
    }
    
    public function testGetoleData()
    {  
        $index = 0;
        $renderFormat = "png";
        $result = $this->object->getoleData($index, $renderFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/DrawingObject_'.$index.'.'.$renderFormat);
    }
    
    public function testGetProtection()
    {
        $result = $this->object->getProtection();
        $this->assertInternalType('string',$result);
    }        
    
}    