<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\OCR\Extractor;

class ExtractorTest extends PHPUnit_Framework_TestCase {
    
    protected $extractor;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->extractor = new Extractor();
    } 
        
    public function testExtractText()
    {  
        $result = $this->extractor->extractText('ocr.png');
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testExtractTextFromLocalFile()
    {  
        $localFile = getcwd(). '/Data/Input/ocr.png';
        $language = "English";
        $useDefaultDictionaries = true;
        $result = $this->extractor->extractTextFromLocalFile($localFile, $language, $useDefaultDictionaries);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testExtractTextFromUrl()
    {  
        $url = "http://www.example.com/test.png";
        $language = "English";
        $useDefaultDictionaries = true;
        $result = $this->extractor->extractTextFromUrl($url, $language, $useDefaultDictionaries);
        $this->assertInstanceOf('stdClass',$result);
    }
    
}    