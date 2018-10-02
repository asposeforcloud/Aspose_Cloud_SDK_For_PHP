<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Pdf\Converter;

class ConverterTest extends PHPUnit_Framework_TestCase {
    
    protected $converter;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->converter = new Converter('Test.pdf');
    } 
        
    public function testConvertToImagebySize()
    {  
        $pageNumber = 1;
        $imageFormat = 'png';
        $width = 200;
        $height = 200;
        $this->converter->convertToImagebySize($pageNumber, $imageFormat, $width, $height);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_1.png');
    }
    
    public function testConvertToImage()
    {  
        $pageNumber = 1;
        $imageFormat = 'png';
        $this->converter->convertToImage($pageNumber, $imageFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_1.png');
    }
    
    public function testConvertByUrl()
    {  
        $url = 'http://cdn.aspose.com/tmp/pdf-sample.pdf';
        $format = 'doc';
        $outputFilename = 'pdf-sample-out.doc';
        $this->converter->convertByUrl($url, $format, $outputFilename);
        $this->assertFileExists(getcwd(). '/Data/Output/' . $outputFilename);
    }
    
    public function testConvert()
    {  
        $this->converter->fileName = 'Test.pdf';
        $this->converter->saveFormat = 'doc';
        $this->converter->convert();
        $this->assertFileExists(getcwd(). '/Data/Output/Test.doc');
    }
    
    public function testConvertLocalFile()
    {  
        $inputFile = getcwd() . '/Data/Input/Test.pdf';
        $outputFilename = 'Test.tiff';
        $outputFormat = 'tiff';
        $this->converter->convertLocalFile($inputFile, $outputFilename, $outputFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.tiff');
    }
    
}