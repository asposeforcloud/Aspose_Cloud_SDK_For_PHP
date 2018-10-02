<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Barcode\BarcodeReader;

class BarcodeReaderTest extends PHPUnit_Framework_TestCase {
    
    protected $barcodereader;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->barcodereader = new BarcodeReader('barcodeQR.png');
    } 
        
    public function testRead()
    {  
        $symbology = 'QR';
        $result = $this->barcodereader->read($symbology);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testReadR()
    {  
        $result = $this->barcodereader->readR('barcodeQR.png', '', 'QR');
        $this->assertInternalType('array',$result);
    }
    
    public function testReadFromLocalImage()
    {  
        $localImage = getcwd(). '/Data/Input/barcodeQR.png';
        $remoteFolder = '';
        $barcodeReadType = 'QR';
        $result = $this->barcodereader->readFromLocalImage($localImage, $remoteFolder, $barcodeReadType);
        $this->assertInternalType('array',$result);
    }
       
    public function testReadFromURL()
    {  
        $url = "http://upload.wikimedia.org/wikipedia/commons/c/ce/WikiQRCode.png";
        $result = $this->barcodereader->readFromURL($url, $symbology='QR');
        $this->assertInternalType('array',$result);
    }
    
    public function testReadSpecificRegion()
    {  
        $result = $this->barcodereader->readSpecificRegion($symbology='QR', $rectX=20, $rectY=20, $rectWidth=100, $rectHeight=100);
        $this->assertInternalType('array',$result);
    }
    
    public function testReadWithChecksum()
    {  
        $result = $this->barcodereader->readWithChecksum($symbology='QR', $checksumValidation='Default');
        $this->assertInternalType('array',$result);
    }
    
    public function testReadBarcodeCount()
    {  
        $result = $this->barcodereader->readBarcodeCount($symbology='QR', $barcodesCount=2);
        $this->assertInternalType('array',$result);
    }
    
}    