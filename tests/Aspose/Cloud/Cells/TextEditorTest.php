<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Cells\TextEditor;

class TextEditorTest extends PHPUnit_Framework_TestCase {
    
    protected $texteditor;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->texteditor = new TextEditor('Test.xlsx');
    } 
        
    public function testFindText()
    {  
        $result = $this->texteditor->findText('Aspose');
        $this->assertInternalType('array', $result);
    }
    
    public function testGetTextItems()
    {  
        $result = $this->texteditor->getTextItems();
        $this->assertInternalType('array', $result);
    }
    
    public function testReplaceText()
    {  
        $oldValue = 'Aspose';
        $newValue = 'Aspose Products';
        $result = $this->texteditor->replaceText($oldValue, $newValue);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.xlsx');
    }
    
}    