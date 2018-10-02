<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Words\Document;

class DocumentTest extends PHPUnit_Framework_TestCase {
    
    protected $object;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';
        
        $this->object = new Document('Test.docx');
    } 
    
    public function testGetStats()
    {  
        $result = $this->object->getStats();
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testGetProperties()
    {  
        $result = $this->object->getProperties();
        $this->assertInternalType('array',$result);
    }
    
    public function testGetProperty()
    {
        $propertyName = 'Author';
        $result = $this->object->getProperty($propertyName);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testSetProperty()
    {
        $propertyName = 'Test';
        $propertyValue = 'Test Value';
        $result = $this->object->setProperty($propertyName, $propertyValue);
        $this->assertInstanceOf('stdClass',$result);
    } 
    
    public function testDeleteProperty()
    {
        $propertyName = 'Test';
        $result = $this->object->deleteProperty($propertyName);
        $this->assertEquals(true,$result);
    }
    
    public function testProtectDocument()
    {
        $password = "123456";
        $protectionType = "AllowOnlyComments";
        $this->object->protectDocument($password, $protectionType);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.docx');
    }
    
    public function testUpdateProtection()
    {
        $oldPassword = "123456";
        $newPassword = "123456789";
        $protectionType = "AllowOnlyFormFields";

        $this->object->updateProtection($oldPassword, $newPassword, $protectionType);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.docx');
    }
    
    public function testUnprotectDocument()
    {
        $password = "123456789";
        $protectionType = "NoProtection";
        $this->object->unprotectDocument($password, $protectionType);
        $this->assertFileExists(getcwd(). '/Data/Output/Test.docx');
    }
    
    public function testAcceptTrackingChanges()
    {
        $this->object->acceptTrackingChanges();
        $this->assertFileExists(getcwd(). '/Data/Output/Test.docx');
    }
    
    public function testRejectTrackingChanges()
    {
        $this->object->rejectTrackingChanges();
        $this->assertFileExists(getcwd(). '/Data/Output/Test.docx');
    }
    
    public function testAppendDocument()
    {
        $mainDocumentFile = "MainDocument.docx";
        $appendDocument1 = "AppendDocument1.docx";
        $appendDocument2 = "AppendDocument2.docx";

        $mainDocument = basename($mainDocumentFile);
        $appendDocs = array(basename($appendDocument1), basename($appendDocument2));
        $importFormatsModes = array("KeepSourceFormatting", "UseDestinationStyles");

        $doc = new Document($mainDocument);
        $doc->appendDocument($appendDocs, $importFormatsModes, "");
        $this->assertFileExists(getcwd(). '/Data/Output/MainDocument.docx');
    }
    
    public function testSplitDocument()
    {
        $document = new Document('MainDocument.docx');
        $format = "pdf";
        $document->splitDocument('', '', $format);
        $this->assertFileExists(getcwd(). '/Data/Output/MainDocument_page1.pdf');
    }

    public function testSaveAs()
    {
        $document = new Document('MainDocument.docx');
        $xml_string = "
             <PdfSaveOptions>
	            <SaveFormat>pdf</SaveFormat>
	            <FileName>OutputDocument.pdf</FileName>
	            <ImageCompression>Jpeg</ImageCompression>
	            <JpegQuality>70</JpegQuality>
                <TextCompression>Flate</TextCompression>
	         </PdfSaveOptions>";

        $result = $document->saveAs($xml_string);

        $this->assertFileExists($result);

    }

    public function testGetAllSections()
    {
        $document = new Document('MainDocument.docx');
        $result = $document->getAllSections();

        $this->assertInstanceOf('stdClass',$result);

    }

    public function testGetSection()
    {
        $document = new Document('MainDocument.docx');
        $result = $document->getSection('0');

        $this->assertInstanceOf('stdClass',$result);

    }

    public function testGetPageSetup()
    {
        $document = new Document('MainDocument.docx');
        $result = $document->getPageSetup('0');

        $this->assertInstanceOf('stdClass',$result);

    }

    public function testUpdatePageSetup()
    {
        $document = new Document('MainDocument.docx');
        $xml_string = '<PageSetup> <LeftMargin>99</LeftMargin> <Orientation>Landscape</Orientation> <PaperSize>A5</PaperSize> </PageSetup>';
        $result = $document->updatePageSetup($xml_string,'0');

        $this->assertInstanceOf('stdClass',$result);

    }

    public function testGetMailMergeFieldNames()
    {
        $document = new Document('MainDocument.docx');
        $result = $document->getMailMergeFieldNames();

        $this->assertInstanceOf('stdClass',$result);

    }

    public function testGetAllParagraphs()
    {
        $document = new Document('MainDocument.docx');
        $result = $document->getAllParagraphs();

        $this->assertInstanceOf('stdClass',$result);

    }

    public function testGetParagraph()
    {
        $document = new Document('MainDocument.docx');
        $result = $document->getParagraph('1');

        $this->assertInstanceOf('stdClass',$result);

    }

    public function testGetParagraphRun()
    {
        $document = new Document('MainDocument.docx');
        $result = $document->getParagraphRun('1','1');

        $this->assertInstanceOf('stdClass',$result);

    }

    public function testGetParagraphRunFont()
    {
        $document = new Document('MainDocument.docx');
        $result = $document->getParagraphRunFont('1','1');

        $this->assertInstanceOf('stdClass',$result);

    }

    public function testUpdateParagraphRunFont()
    {
        $document = new Document('MainDocument.docx');
        $xml_string = '<Font><Name>Calibri</Name></Font>';
        $result = $document->updateParagraphRunFont($xml_string,'1','1');

        $this->assertInstanceOf('stdClass',$result);

    }

}