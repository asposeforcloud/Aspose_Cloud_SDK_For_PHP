<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Pdf\TextEditor;

class TextEditorTest extends PHPUnit_Framework_TestCase {
    
    protected $texteditor;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->texteditor = new TextEditor('Test.pdf');
    } 
        
    public function testGetText()
    {  
        $result = $this->texteditor->getText();
        $this->assertInternalType('string', $result);
    }
    
    public function testGetTextItems()
    {  
        $result = $this->texteditor->getTextItems();
        $this->assertInternalType('array', $result);
    }
    
    public function testGetFragmentCount()
    {  
        $pageNumber = 1;
        $result = $this->texteditor->getFragmentCount($pageNumber);
        $this->assertInternalType('integer', $result);
    }
    
    public function testGetSegmentCount()
    {  
        $pageNumber = 1;
        $fragmentNumber = 1;
        $result = $this->texteditor->getSegmentCount($pageNumber, $fragmentNumber);
        $this->assertInternalType('integer', $result);
    }
    
    public function testGetTextFormat()
    {  
        $pageNumber = 1;
        $fragmentNumber = 1;
        $result = $this->texteditor->getTextFormat($pageNumber, $fragmentNumber);
        print_r($result);
        $this->assertInstanceOf('stdClass', $result);
    }
    
    public function testReplaceMultipleText()
    {  
        $oldText = 'demo';
        $newText = 'sample';
        $fieldsArray = array('OldValue' => $oldText, 'NewValue' => $newText);
        $result = $this->texteditor->replaceMultipleText($fieldsArray);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf');
    }
    
    public function testReplaceText()
    {  
        $oldText = 'sample';
        $newText = 'demo';
        $isRegularExpression = false;
        $result = $this->texteditor->replaceText($oldText, $newText, $isRegularExpression );
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf');
    }
    
}   