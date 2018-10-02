<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Imaging\Extractor;

class ExtractorTest extends PHPUnit_Framework_TestCase {
    
    protected $image;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->image = new Image('Test.tiff');
    } 
        
    public function testGetTiffFrameProperties()
    {  
        $result = $this->image->getTiffFrameProperties($frameId=1);
        $this->assertInternalType('array', $result);
    }
    
    public function testExtractFrames()
    {  
        $this->image->extractFrames($frameId=1, $outPath='extract_frame.tiff');
        $this->assertFileExists(getcwd(). '/Data/Output/extract_frame.tiff');
    }
    
    public function testResizeFrame()
    {  
        $this->image->resizeFrame($frameId=1, $newWidth=100, $newHeight=100, $outPath='resize_frame.tiff');
        $this->assertFileExists(getcwd(). '/Data/Output/resize_frame.tiff');
    }
    
    public function testCropFrame()
    {  
        $this->image->cropFrame($frameId=1, $x=20, $y=20, $recWidth=100, $recHeight=100, $outPath='crop_frame.tiff');
        $this->assertFileExists(getcwd(). '/Data/Output/crop_frame.tiff');
    }
    
    public function testRotateFrame()
    {  
        $this->image->rotateFrame($frameId=1, $rotateFlipMethod='', $outPath='rotate_frame.tiff');
        $this->assertFileExists(getcwd(). '/Data/Output/rotate_frame.tiff');
    }
    
    public function testManipulateFrame()
    {  
        $this->image->manipulateFrame($frameId=1, $rotateFlipMethod='', $newWidth=100, $newHeight=100, $x=20, $y=20, $rectWidth=50, $rectHeight=50, $outPath='manipulate_frame.tiff');
        $this->assertFileExists(getcwd(). '/Data/Output/manipulate_frame.tiff');
    }
    
}    