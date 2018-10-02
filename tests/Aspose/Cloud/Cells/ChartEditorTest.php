<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Cells\ChartEditor;

class ChartEditorTest extends PHPUnit_Framework_TestCase {
    
    protected $charteditor;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->charteditor = new ChartEditor('MyBook.xlsx', 'Sheet3');
    } 
        
    public function testAddChart()
    {  
        $chartType = "bar";
        $upperLeftRow = 12;
        $upperLeftColumn = 12;
        $lowerRightRow = 20;
        $lowerRightColumn = 20;

        $this->charteditor->addChart($chartType, $upperLeftRow, $upperLeftColumn, $lowerRightRow, $lowerRightColumn);
        $this->assertFileExists(getcwd(). '/Data/Output/MyBook.xlsx');
    }
    
    public function testDeleteCharts()
    {  
        $this->charteditor->deleteCharts();
        $this->assertFileExists(getcwd(). '/Data/Output/MyBook.xlsx');
    }
    
    public function testDeleteChart()
    {  
        $chartIndex = 0;
        $this->charteditor->deleteChart($chartIndex);
        $this->assertFileExists(getcwd(). '/Data/Output/MyBook.xlsx');
    }
    
    public function testHideChartLegend()
    {  
        $chartIndex = 0;
        $this->charteditor->hideChartLegend($chartIndex);
        $this->assertFileExists(getcwd(). '/Data/Output/MyBook.xlsx');
    }
    
    public function testShowChartLegend()
    {  
        $chartIndex = 0;
        $this->charteditor->showChartLegend($chartIndex);
        $this->assertFileExists(getcwd(). '/Data/Output/MyBook.xlsx');
    }
    
    public function testUpdateChartLegend()
    {  
        $chartIndex = 0;
        $properties =  '{"Position":"Top"}';
        $this->charteditor->updateChartLegend($chartIndex,$properties);
        $this->assertFileExists(getcwd(). '/Data/Output/MyBook.xlsx');
    }
    
    public function testReadChartLegend()
    {  
        $chartIndex = 0;
        $result = $this->charteditor->readChartLegend($chartIndex);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testGetChartArea()
    {  
        $chartIndex = 0;
        $result = $this->charteditor->getChartArea($chartIndex);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testGetFillFormat()
    {  
        $chartIndex = 0;
        $result = $this->charteditor->getFillFormat($chartIndex);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testGetBorder()
    {  
        $chartIndex = 0;
        $result = $this->charteditor->getBorder($chartIndex);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testSetChartTitle()
    {  
        $xml = <<<XML
                <Title>
                    <Text>Sales Chart</Text>
                </Title>
XML;
        $strXML = simplexml_load_string($xml);
        
        $result = $this->charteditor->setChartTitle($chartIndex=0, $strXML);
        $this->assertTrue($result);
    }
    
    public function testUpdateChartTitle()
    {  
        $xml = <<<XML
                <Title>
                    <Text>Update Sales Chart</Text>
                </Title>
XML;
        $strXML = simplexml_load_string($xml);
        
        $result = $this->charteditor->updateChartTitle($chartIndex=0, $strXML);
        $this->assertTrue($result);
    }
    
    public function testDeleteChartTitle()
    {        
        $result = $this->charteditor->deleteChartTitle($chartIndex=0);
        $this->assertTrue($result);
    }
    
}    