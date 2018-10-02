<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Cells\Extractor;

class ExtractorTest extends PHPUnit_Framework_TestCase {
    
    protected $extractor;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->extractor = new Extractor('Test.xlsx');
    } 
        
    public function testGetPicture()
    {  
        $worksheetName = 'Sheet3';
        $pictureIndex = 0;
        $imageFormat = 'png';
        $this->extractor->getPicture($worksheetName, $pictureIndex, $imageFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_Sheet3.png');
    }
    
    public function testGetOleObject()
    {  
        $worksheetName = 'Sheet3';
        $objectIndex = 0;
        $imageFormat = 'png';
        $this->extractor->getOleObject($worksheetName, $objectIndex, $imageFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_Sheet3.png');
    }
    
    public function testGetChart()
    {  
        $worksheetName = 'Sheet3';
        $chartIndex = 0;
        $imageFormat = 'png';
        $this->extractor->getChart($worksheetName, $chartIndex, $imageFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_Sheet3.png');
    }
    
    public function testGetAutoShape()
    {  
        $worksheetName = 'Sheet1';
        $shapeIndex = 0;
        $imageFormat = 'png';
        $this->extractor->getAutoShape($worksheetName, $shapeIndex, $imageFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_Sheet1.png');
    }
      
}