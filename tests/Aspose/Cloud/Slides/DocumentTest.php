<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Slides\Document;

class DocumentTest extends PHPUnit_Framework_TestCase {
    
    protected $document;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->document = new Document('Test.pptx');
    } 
    
    public function testChangeSlidePosition()
    {  
        $old_position = 2;
        $new_position= 1;
        $result = $this->document->changeSlidePosition($old_position, $new_position, $storageName = '', $folder = '');
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testCloneSlide()
    {  
        $slideNumber = 2;
        $position= 3;
        $result = $this->document->cloneSlide($slideNumber, $position, $storageName = '', $folder = '');
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testAddSlide()
    {  
        $result = $this->document->addSlide($position='4', $storageName = '', $folder = '');
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testSplitPresentation()
    {  
        $from = 2;
        $to = 3;
        $destination = '';
        $format = 'png';
        $storageName = '';
        $folder = '';
        $this->document->splitPresentation($from, $to, $destination, $format, $storageName, $folder);
        $this->assertFileExists(getcwd(). '/Data/Output/Test_'.$from.'.png');
        $this->assertFileExists(getcwd(). '/Data/Output/Test_'.$to.'.png');
    }
    
    public function testCreateEmptyPresentation()
    {
        $doc = new Document('MyFile.pptx');
        $doc->createEmptyPresentation($storageName = '', $folder = '');
        $this->assertFileExists(getcwd(). '/Data/Output/MyFile.pptx');
    }
    
    public function testGetSlideCount()
    {
        $result = $this->document->getSlideCount();
        $this->assertInternalType('integer', $result);
    }
    
    public function testReplaceText()
    {
        $old = "Old Text";
        $new = "New Text";
        $this->document->replaceText($old, $new);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pptx');
    }
    
    public function testGetAllTextItems()
    {
        $result = $this->document->getAllTextItems();
        $this->assertInternalType('array', $result);
    }
    
    public function testDeleteAllSlides()
    {
        $this->document->deleteAllSlides();
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pptx');
    }
    
    public function testGetDocumentProperties()
    {
        $result = $this->document->getDocumentProperties();
        $this->assertInternalType('array', $result);
    }
    
    public function testGetDocumentProperty()
    {
        $propertyName = 'Author';
        $result = $this->document->getDocumentProperty($propertyName);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testSetProperty()
    {
        $propertyName = 'Test';
        $propertyValue = 'abc...';
        $result = $this->document->setProperty($propertyName, $propertyValue);
        print_r($result);
        $this->assertInternalType('array',$result);
    }
    
    public function testDeleteDocumentProperty()
    {
        $propertyName = 'Test';
        $result = $this->document->deleteDocumentProperty($propertyName);
        $this->assertEquals(true,$result);
    }
    
    public function testRemoveAllProperties()
    {
        $result = $this->document->removeAllProperties();
        $this->assertEquals(true,$result);
    }
    
    public function testSaveAs()
    {
        $outputPath = getcwd(). '/Data/Output/';
        $saveFormat = 'tiff';
        $this->document->saveAs($outputPath, $saveFormat, $jpegQuality='', $storageName = '', $folder = ''); 
        $this->assertFileExists(getcwd(). '/Data/Output/Test.tiff');
    }
    
    public function testSaveSlideAs()
    {
        $slideNumber = 1;
        $outputPath = getcwd(). '/Data/Output/';
        $saveFormat = 'png';
        $this->document->saveSlideAs($slideNumber, $outputPath, $saveFormat); 
        $this->assertFileExists(getcwd(). '/Data/Output/Test_1.png');
    }
    
    public function testAspectRatio()
    {
        $result = $this->document->aspectRatio($slideNumber=1); 
        $this->assertInternalType('float',$result);
    }
    
}