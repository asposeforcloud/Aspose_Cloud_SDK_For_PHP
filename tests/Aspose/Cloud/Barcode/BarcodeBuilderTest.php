<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Barcode\BarcodeBuilder;

class BarcodeBuilderTest extends PHPUnit_Framework_TestCase {
    
    protected $barcodebuilder;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->barcodebuilder = new BarcodeBuilder();
    } 
        
    public function testSave()
    {  
        $this->barcodebuilder->save('Barcode Text','QR','png');
        $this->assertFileExists(getcwd(). '/Data/Output/barcodeQR.png');
    }
    
}    