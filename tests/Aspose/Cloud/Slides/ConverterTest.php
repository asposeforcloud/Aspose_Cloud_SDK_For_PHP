<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Slides\Converter;

class ConverterTest extends PHPUnit_Framework_TestCase {
    
    protected $converter;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->converter = new Converter('Test.pptx');
    } 
    
    public function testConvertToImage()
    {  
        $slideNumber = 1;
        $imageFormat = 'jpg';
        $this->converter->convertToImage($slideNumber, $imageFormat);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.jpg');
    }
    
    public function testConvertToImagebySize()
    {  
        $slideNumber = 1;
        $imageFormat = 'png';
        $width = 200;
        $height = 200;
        $this->converter->convertToImagebySize($slideNumber, $imageFormat, $width, $height);
        $this->assertFileExists(getcwd(). '/Data/Output/output.png');
    }
    
    public function testConvert()
    {  
        $this->converter->saveFormat = 'pdf';
        $this->converter->convert();
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf');
    }
    
    public function testConvertWithAdditionalSettings()
    {  
        $this->converter->convertWithAdditionalSettings($saveFormat = 'pdf', $textCompression = 'Flat', 
                                                        $embedFullFonts = false, $compliance ='Pdf15', 
                                                        $jpegQuality = 50, $saveMetafilesAsPng = false, 
                                                        $pdfPassword = '123456', $embedTrueTypeFontsForASCII = false);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf');
    }
    
}