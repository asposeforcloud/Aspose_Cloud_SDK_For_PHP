<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Imaging\Converter;

class ConverterTest extends PHPUnit_Framework_TestCase {
    
    protected $image;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->image = new Image('Test.jpg');
    } 
        
    public function testConvertLocalFile()
    {  
        $inputPath = getcwd() . '/Data/Input/Test.png';
        $outputFormat = 'png';
        $this->image->convertLocalFile($inputPath, $outputFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.png');
    }
    
}    