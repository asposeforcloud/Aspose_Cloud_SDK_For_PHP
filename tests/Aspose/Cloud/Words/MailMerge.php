<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Words\MailMerge;

class MailMergeTest extends PHPUnit_Framework_TestCase {
    
    protected $object;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';
        
        $this->object = new MailMerge();
    } 
    
    public function testExecuteTemplate()
    {  
        $fileName = 'MyFile.docx';
        $xml = simplexml_load_file(getcwd() . "/Data/Input/MyFile.xml");
        
        $this->object->executeTemplate($fileName, $xml->asXML());
        $this->assertFileExists(getcwd(). '/Data/Output/MyFile.docx');
    }
    
    public function testExecuteMailMerge()
    {  
        $fileName = 'MyFile.docx';
        $xml = simplexml_load_file(getcwd() . "/Data/Input/MyFile.xml");
        
        $this->object->executeMailMerge($fileName, $xml->asXML());
        $this->assertFileExists(getcwd(). '/Data/Output/MyFile.docx');
    }
    
    public function testExecuteMailMergewithRegions()
    {  
        $fileName = 'MyFile.docx';
        $xml = simplexml_load_file(getcwd() . "/Data/Input/MyFile.xml");
        
        $this->object->executeMailMergewithRegions($fileName, $xml->asXML());
        $this->assertFileExists(getcwd(). '/Data/Output/MyFile.docx');
    }
    
}    