<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Cells\Workbook;

class WorkbookTest extends PHPUnit_Framework_TestCase {
    
    protected $workbook;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->workbook = new Workbook('Test.xlsx');
    } 
        
    public function testGetProperties()
    {  
        $result = $this->workbook->getProperties();
        $this->assertInternalType('array', $result);
    }
    
    public function testGetProperty()
    {  
        $propertyName = 'Author';
        $result = $this->workbook->getProperty($propertyName);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testSetProperty()
    {  
        $propertyName = 'property name';
        $propertyValue = 'property value';
        $result = $this->workbook->setProperty($propertyName, $propertyValue);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testRemoveAllProperties()
    {  
        $result = $this->workbook->removeAllProperties();
        $this->assertEquals(true,$result);
    }
    
    public function testRemoveProperty()
    {  
        $propertyName = 'property name';
        $result = $this->workbook->removeProperty($propertyName);
        $this->assertEquals(true,$result);
    }
    
    public function testCreateEmptyWorkbook()
    {  
        $workbook = new Workbook('MyWorkbook.xls');
        $result = $workbook->createEmptyWorkbook();
        $this->assertEquals(null,$result);
    }
    
    public function testCreateWorkbookFromTemplate()
    {  
        $workbook = new Workbook('MyBook.xlsx');
        $result = $workbook->createWorkbookFromTemplate('Test.xlsx');
        $this->assertEquals(null,$result);
    }
    
    public function testGetWorksheetsCount()
    {  
        $result = $this->workbook->getWorksheetsCount();
        $this->assertInternalType('int', $result);
    }
    
    public function testGetNamesCount()
    {  
        $result = $this->workbook->getNamesCount();
        $this->assertInternalType('int', $result);
    }
    
    public function testGetDefaultStyle()
    {  
        $result = $this->workbook->getDefaultStyle();
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testEncryptWorkbook()
    {  
        $result = $this->workbook->encryptWorkbook('XOR', '123456', '128');
        $this->assertEquals(true,$result);
    }
    
    public function testDecryptWorkbook()
    {  
        $password = '123456';
        $result = $this->workbook->decryptWorkbook($password);
        $this->assertEquals(true,$result);
    }
    
    public function testProtectWorkbook()
    {  
        $password = '123456';
        $protectionType = 'all';
        $result = $this->workbook->protectWorkbook($password, $protectionType);
        $this->assertEquals(true,$result);
    }
    
    public function testUnprotectWorkbook()
    {  
        $password = '123456';
        $result = $this->workbook->unprotectWorkbook($password);
        $this->assertEquals(true,$result);
    }
    
    public function testSetModifyPassword()
    {  
        $password = '123456';
        $result = $this->workbook->setModifyPassword($password);
        $this->assertEquals(true,$result);
    }
    
    public function testClearModifyPassword()
    {  
        $password = '123456';
        $result = $this->workbook->clearModifyPassword($password);
        $this->assertEquals(true,$result);
    }
    
    public function testAddWorksheet()
    {  
        $worksheetName = 'Sheet Name';
        $result = $this->workbook->addWorksheet($worksheetName);
        $this->assertEquals(true,$result);
    }
    
    public function testRemoveWorksheet()
    {  
        $worksheetName = 'Sheet Name';
        $result = $this->workbook->removeWorksheet($worksheetName);
        $this->assertEquals(true,$result);
    }
    
    public function testMergeWorkbook()
    {  
        $mergeFileName = 'MyBook.xlsx';
        $result = $this->workbook->mergeWorkbook($mergeFileName);
        $this->assertEquals(true,$result);
    }
    
    public function testAutofitRows()
    {  
        $result = $this->workbook->autofitRows($saveFormat='pdf');
        $this->assertFileExists(getcwd(). '/Data/output/Test.pdf');
    }
    
    public function testSaveAs()
    {  
        $xml = <<<XML
                <PdfSaveOptions>
                    <desiredPPI>300</desiredPPI>
                    <jpegQuality>70</jpegQuality>
                    <OnePagePerSheet>true</OnePagePerSheet>
                    <SaveFormat>Pdf</SaveFormat>
                 </PdfSaveOptions>
XML;
        $strXML = simplexml_load_string($xml);

        $result = $this->workbook->saveAs($strXML, $outputFile='saveas.pdf');
        $this->assertFileExists(getcwd(). '/Data/output/saveas.pdf');
    }
    
}