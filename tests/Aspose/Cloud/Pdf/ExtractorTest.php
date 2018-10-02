<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Pdf\Extractor;

class ExtractorTest extends PHPUnit_Framework_TestCase {
    
    protected $extractor;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->extractor = new Extractor('Test.pdf');
    } 
        
    public function testGetImageCount()
    {  
        $pageNumber = 1;
        $result = $this->extractor->getImageCount($pageNumber);
        $this->assertInternalType('integer', $result);
    }
    
    public function testGetImageDefaultSize()
    {  
        $pageNumber = 1;
        $imageIndex = 1;
        $imageFormat = 'png';
        $result = $this->extractor->getImageDefaultSize($pageNumber, $imageIndex, $imageFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_1.png');
    }
    
    public function testGetImageCustomSize()
    {  
        $pageNumber = 1;
        $imageIndex = 1;
        $imageFormat = 'png';
        $imageWidth = 200;
        $imageHeight = 200;
        $result = $this->extractor->getImageCustomSize($pageNumber, $imageIndex, $imageFormat, $imageWidth, $imageHeight);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_1.png');
    }
    
}