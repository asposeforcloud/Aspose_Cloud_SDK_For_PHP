<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Cells\Converter;

class ConverterTest extends PHPUnit_Framework_TestCase {
    
    protected $converter;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->converter = new Converter();
    } 
        
    public function testConvert()
    {  
        $this->converter->fileName = 'Test.xlsx';
        $this->converter->saveFormat = 'pdf';
        $this->converter->convert();
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf');
    }
    
    public function testConvertToImage()
    {  
        $this->converter->fileName = 'Test.xlsx';
        $imageFormat = 'png';
        $worksheetName = 'Sheet1';
        $this->converter->convertToImage($imageFormat, $worksheetName);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_Sheet1.png');
    }
    
    public function testSave()
    {  
        $this->converter->fileName = 'Test.xlsx';
        $outputFormat = 'tiff';
        $this->converter->save($outputFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.tiff');
    }
    
    public function testWorksheetToImage()
    {  
        $this->converter->fileName = 'Test.xlsx';
        $this->converter->worksheetName = 'Sheet1';
        $imageFormat = 'gif';
        $this->converter->worksheetToImage($imageFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_Sheet1.gif');
    }
    
    public function testPictureToImage()
    {  
        $this->converter->fileName = 'Test.xlsx';
        $this->converter->worksheetName = 'Sheet2';
        $pictureIndex = 0;
        $imageFormat = 'gif';
        $this->converter->pictureToImage($pictureIndex, $imageFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_Sheet2.gif');
    }
    
    public function testOleObjectToImage()
    {  
        $this->converter->fileName = 'Test.xlsx';
        $this->converter->worksheetName = 'Sheet2';
        $objectIndex = 0;
        $imageFormat = 'png';
        $this->converter->oleObjectToImage($objectIndex, $imageFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_Sheet2.png');
    }
    
    public function testChartToImage()
    {  
        $this->converter->fileName = 'Test.xlsx';
        $this->converter->worksheetName = 'Sheet3';
        $chartIndex = 0;
        $imageFormat = 'png';
        $this->converter->chartToImage($chartIndex, $imageFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_Sheet3.png');
    }
    
    public function testAutoShapeToImage()
    {  
        $this->converter->fileName = 'Test.xlsx';
        $this->converter->worksheetName = 'Sheet1';
        $shapeIndex = 0;
        $imageFormat = 'png';
        $this->converter->autoShapeToImage($shapeIndex, $imageFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_Sheet1.png');
    }
    
    public function testConvertLocalFile()
    {  
        $inputPath = getcwd() . '/Data/Input/Test.xlsx';
        $outputPath = 'Test.pdf';
        $outputFormat = 'pdf';
        $this->converter->convertLocalFile($inputPath, $outputPath, $outputFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf');
    }
    
}