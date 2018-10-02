<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Tasks\Converter;

class ConverterTest extends PHPUnit_Framework_TestCase {
    
    protected $object;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->object = new Converter('MyProject.mpp');
    } 
    
    public function testConvert()
    {  
        $this->object->saveFormat = 'pdf';
        $this->object->convert();
        $this->assertFileExists(getcwd(). '/Data/output/MyProject.pdf');
    }
    
}