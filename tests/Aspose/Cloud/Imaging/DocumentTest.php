<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Imaging\Document;

class DocumentTest extends PHPUnit_Framework_TestCase {
    
    protected $image;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->image = new Image('Test.jpg');
    } 
        
    public function testGetProperties()
    {  
        $result = $this->image->getProperties($inputPath, $outputFormat);
        $this->assertInternalType('array', $result);
    }
    
    public function testUpdateBMPProperties()
    {  
        $document = new Document('barcodeQR.bmp');
        $result = $document->updateBMPProperties($bitsPerPixel=24, $horizontalResolution=100, $verticalResolution=100, $outPath='barcodeQR_updated.bmp');
        $this->assertFileExists(getcwd(). '/Data/Output/barcodeQR_updated.bmp');
    }
    
    public function testUpdateBMPPropertiesFromLocalFile()
    {  
        $document = new Document('barcodeQR.bmp');
        $inputPath = getcwd() . '/Data/Input/barcodeQR.bmp';
        $result = $document->updateBMPPropertiesFromLocalFile($inputPath, $bitsPerPixel=24, $horizontalResolution=100, $verticalResolution=100, $outPath='barcodeQR_updated.bmp');
        $this->assertFileExists(getcwd(). '/Data/Output/barcodeQR_updated.bmp');
    }
    
    public function testUpdateGIFProperties()
    {  
        $document = new Document('macbook.gif');
        $result = $document->updateGIFProperties($backgroundColorIndex=32, $pixelAspectRatio=3, $interlaced=true, $outPath='macbook_updated.gif');
        $this->assertFileExists(getcwd(). '/Data/Output/macbook_updated.gif');
    }
    
    public function testUpdateGIFPropertiesFromLocalFile()
    {  
        $document = new Document('macbook.gif');
        $inputPath = getcwd() . '/Data/Input/barcodeQR.bmp';
        $result = $document->updateGIFPropertiesFromLocalFile($inputPath, $backgroundColorIndex=32, $pixelAspectRatio=3, $interlaced=true, $outPath='macbook_updated.gif');
        $this->assertFileExists(getcwd(). '/Data/Output/macbook_updated.gif');
    }
    
    public function testUpdateJPGProperties()
    {  
        $document = new Document('barcodeQR.jpg');
        $result = $document->updateJPGProperties($quality=45, $compressionType='baseline', $outPath='barcodeQR_updated.jpg');
        $this->assertFileExists(getcwd(). '/Data/Output/barcodeQR_updated.jpg');
    }
    
    public function testUpdateJPGPropertiesFromLocalFile()
    {  
        $document = new Document('');
        $inputPath = getcwd() . '/Data/Input/barcodeQR.jpg';
        $result = $document->updateJPGPropertiesFromLocalFile($inputPath, $quality=45, $compressionType='baseline', $outPath='barcodeQR_updated.jpg');
        $this->assertFileExists(getcwd(). '/Data/Output/barcodeQR_updated.jpg');
    }
    
    public function testUpdateTIFFProperties()
    {  
        $document = new Document('Test.tiff');
        $result = $document->updateTIFFProperties($resolutionUnit='inch', $newWidth=200, $newHeight=200, $horizontalResolution=96, $verticalResolution=96, $outPath='Test_updated.tiff');
        $this->assertFileExists(getcwd(). '/Data/Output/Test_updated.tiff');
    }
    
    public function testUpdateTIFFPropertiesFromLocalFile()
    {  
        $document = new Document('');
        $inputPath = getcwd() . '/Data/Input/Test.tiff';
        $result = $document->updateTIFFPropertiesFromLocalFile($inputPath, $compression='CcittFax3', $resolutionUnit='inch', $newWidth=200, $newHeight=200, $horizontalResolution=96, $verticalResolution=96, $outPath='Test_updated.tiff');
        $this->assertFileExists(getcwd(). '/Data/Output/Test_updated.tiff');
    }
    
    public function testUpdatePSDProperties()
    {  
        $document = new Document('bizcard.psd');
        $result = $document->updatePSDProperties($channelsCount=3, $compression='rle', $outPath='bizcard_updated.psd');
        $this->assertFileExists(getcwd(). '/Data/Output/bizcard_updated.psd');
    }
    
    public function testUpdatePSDPropertiesFromLocalFile()
    {  
        $document = new Document('');
        $inputPath = getcwd() . '/Data/Input/bizcard.psd';
        $result = $document->updatePSDPropertiesFromLocalFile($inputPath, $channelsCount=3, $compression='rle', $outPath='bizcard_updated.psd');
        $this->assertFileExists(getcwd(). '/Data/Output/bizcard_updated.psd');
    }
      
}    