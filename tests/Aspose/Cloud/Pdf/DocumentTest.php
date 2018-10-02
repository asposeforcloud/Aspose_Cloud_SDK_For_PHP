<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Pdf\Document;

class DocumentTest extends PHPUnit_Framework_TestCase {
    
    protected $document;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->document = new Document('Test.pdf');
    } 
        
    public function testGetPageCount()
    {  
        $result = $this->document->getPageCount();
        $this->assertInternalType('integer', $result);
    }
    
    public function testAppendDocument()
    {  
        $basePdf = 'Test.pdf';
        $newPdf = 'MyFile.pdf';
        $this->document->appendDocument($basePdf, $newPdf, $startPage = 0, $endPage = 0, $sourceFolder = '');
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf');
    }
    
    public function testMergeDocuments()
    {  
        $basePdf = 'Test.pdf';
        $newPdf = 'MyFile.pdf';
        $sourceFiles = array($basePdf, $newPdf);
        $result = $this->document->mergeDocuments($sourceFiles);
        $this->assertEquals(true,$result);
    }
    
    public function testCreateFromHtml()
    {  
        $pdfFileName = 'index.pdf';
        $htmlFileName = 'index.html';
        $this->document->createFromHtml($pdfFileName, $htmlFileName);
        $this->assertFileExists(getcwd(). '/Data/Output/index.pdf');
    }
    
    public function testGetFormFieldCount()
    {  
        $result = $this->document->getFormFieldCount();
        $this->assertInternalType('integer', $result);
    }
    
    public function testGetFormFields()
    {  
        $result = $this->document->getFormFields();
        $this->assertInternalType('array', $result);
    }
    
    public function testGetFormField()
    {
        $fieldName = 'field name';
        $result = $this->document->getFormField($fieldName);
        $this->assertInstanceOf('stdClass', $result);
    }
    
    public function testCreateEmptyPdf()
    {  
        $pdfFileName = 'Testing.pdf';
        $this->document->createEmptyPdf($pdfFileName);
        $this->assertFileExists(getcwd(). '/Data/Output/Testing.pdf');
    }
    
    public function testAddNewPage()
    {  
        $this->document->addNewPage();
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf');
    }
    
    public function testMovePage()
    {  
        $this->document->movePage($pageNumber=2, $newLocation=1);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf');
    }
    
    public function testDeletePage()
    {  
        $pageNumber = 1;
        $this->document->deletePage($pageNumber);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf');
    }
    
    public function testReplaceImageUsingFile()
    {  
        $pageNumber = 1;
        $imageIndex = 1;
        $imageFile = 'watermark.png';
        $this->document->replaceImageUsingFile($pageNumber, $imageIndex, $imageFile);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf');
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
        $this->assertInstanceOf('stdClass', $result);
    }
    
    public function testSetDocumentProperty()
    {  
        $propertyName = 'property name';
        $propertyValue = 'property value';
        $result = $this->document->setDocumentProperty($propertyName, $propertyValue);
        $this->assertInstanceOf('stdClass', $result);
    }
    
    public function testRemoveAllProperties()
    {  
        $result = $this->document->removeAllProperties();
        $this->assertEquals(true, $result);
    }
    
    public function testSplitAllPages()
    {  
        $result = $this->document->splitAllPages();
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf_1.pdf');
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf_2.pdf');
    }
    
    public function testSplitPages()
    {  
        $from = 1;
        $to = 2;
        $result = $this->document->splitPages($from, $to);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf_1.pdf');
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf_2.pdf');
    }
    
    public function testSplitPagesToAnyFormat()
    {  
        $from = 1;
        $to = 2;
        $format = 'png';
        $result = $this->document->splitPagesToAnyFormat($from, $to, $format);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf_1.png');
        $this->assertFileExists(getcwd(). '/Data/Output/Test.pdf_2.png');
    }
    
}   