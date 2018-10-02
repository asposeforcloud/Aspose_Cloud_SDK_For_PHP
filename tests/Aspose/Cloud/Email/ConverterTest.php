<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Storage\Folder;
use Aspose\Cloud\Email\Converter;

class ConverterTest extends PHPUnit_Framework_TestCase {
    
    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';
    } 
    
    public function testConvert()
    {  
        $inputFile = getcwd() . '/Data/Input/test.eml';
        $folder = new Folder();
        $folder->uploadFile($inputFile, '');
        
        $converter = new Converter('test.eml');
        $converter->saveFormat = 'msg';
        $converter->convert();
        $this->assertFileExists(getcwd(). '/Data/output/test.msg');
    }
    
}