<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Words\DocumentBuilder;

class DocumentBuilderTest extends PHPUnit_Framework_TestCase {
    
    protected $object;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';
        
        $this->object = new DocumentBuilder();
    } 
    
    public function testReplaceText()
    {  
        $fileName = 'Test.docx';
        $oldValue = "oldTextHere";
        $newValue = "newTextHere";
        $isMatchCase = False;
        $isMatchWholeWord = True;
        
        $result = $this->object->replaceText($fileName, $oldValue, $newValue, $isMatchCase, $isMatchWholeWord);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.docx');
    }
    
    public function testInsertWatermarkText()
    {
        $fileName = "Test.docx";
        $text = "Watermark text here";
        $rotationAngle = "45.0";
        $this->object->insertWatermarkText($fileName, $text, $rotationAngle);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.docx');
    }
    
    public function testRemoveWatermark()
    {
        $fileName = "Test.docx";
        $this->object->removeWatermark($fileName);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.docx');
    }
    
    public function testInsertWatermarkImage()
    {
        $fileName = "MyFile.docx";
        $imageFile = "watermark.png";
        $rotationAngle = "45.0";
        $this->object->insertWatermarkImage($fileName, $imageFile, $rotationAngle);
        $this->assertFileExists(getcwd(). '/Data/Output/MyFile.docx');
    }
    
}    