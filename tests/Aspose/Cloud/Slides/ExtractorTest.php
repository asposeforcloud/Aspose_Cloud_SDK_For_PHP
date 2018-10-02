<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Slides\Extractor;

class ExtractorTest extends PHPUnit_Framework_TestCase {
    
    protected $extractor;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->extractor = new Extractor('Test.pptx');
    } 
    
    public function testGetComments()
    {  
        $slideNumber = 1;
        $result = $this->extractor->getComments($slideNumber, $storageName = '', $folder = '');
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testGetImageCount()
    {  
        $result = $this->extractor->getImageCount();
        $this->assertInternalType('integer',$result);
    }
    
    public function testGetSlideImageCount()
    {  
        $result = $this->extractor->getSlideImageCount($slideNumber = 1, $storageName = '', $folder = '');
        $this->assertInternalType('integer',$result);
    }
    
    public function testGetColorScheme()
    {  
        $slideNumber = 2;
        $result = $this->extractor->getColorScheme($slideNumber);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testGetFontScheme()
    {  
        $slideNumber = 2;
        $result = $this->extractor->getFontScheme($slideNumber);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testGetFormatScheme()
    {  
        $slideNumber = 2;
        $result = $this->extractor->getFormatScheme($slideNumber);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testGetPlaceholderCount()
    {  
        $slideNumber = 1;
        $result = $this->extractor->getPlaceholderCount($slideNumber);
        $this->assertInternalType('integer',$result);
    }
    
    public function testGetPlaceholder()
    {  
        $slideNumber = 1;
        $result = $this->extractor->getPlaceholder(1, 1);
        $this->assertInstanceOf('stdClass',$result);
    }
    
}