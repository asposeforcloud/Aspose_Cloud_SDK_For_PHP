<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Cells\Worksheet;

class WorksheetTest extends PHPUnit_Framework_TestCase {
    
    protected $worksheet;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->worksheet = new Worksheet('Test.xlsx', 'Sheet1');
    } 
    
    public function testGetRowsList()
    {  
        $result = $this->worksheet->getRowsList();
        $this->assertInternalType('array', $result);
    }
    
    public function testGetColumnsList()
    {  
        $result = $this->worksheet->getColumnsList();
        $this->assertInternalType('array', $result);
    }
    
    public function testHideWorksheet()
    {  
        $result = $this->worksheet->hideWorksheet();
        $this->assertEquals(true,$result);
    }
    
    public function testUnhideWorksheet()
    {  
        $result = $this->worksheet->unhideWorksheet();
        $this->assertEquals(true,$result);
    }
    
    public function testGetAutoShapeByIndex()
    {  
        $index = 0;
        $result = $this->worksheet->getAutoShapeByIndex($index);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testGetComment()
    {  
        $cellName = 'A2';
        $result = $this->worksheet->getComment($cellName);
        $this->assertInternalType('string',$result);
    }
    
    public function testGetValidationByIndex()
    {  
        $index = 0;
        $result = $this->worksheet->getValidationByIndex($index);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testCalculateFormula()
    {  
        $output = 9;
        $formula = "SUM(B4:C4)";
        $result = $this->worksheet->calculateFormula($formula);
        $this->assertEquals($output, $result);
    }
    
    public function testSortData()
    {  
        $order = array(
        "CaseSensitive" => true,
        "HasHeaders" => true,
        'SortLeftToRight'=> false,
        "KeyList" => array(
          array(
            "Key"=> 4,
            "SortOrder"=> "descending"
          ),
          array(
            "Key"=> 5,
            "SortOrder"=> "descending"
          )
        )
        );

        $area = "A3:C4";
        $result = $this->worksheet->sortData($order, $area);
        $this->assertEquals(true, $result);
    }
    
    public function testGetColumn()
    {  
        $columnIndex = 0;
        $result = $this->worksheet->getColumn($columnIndex);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testCopyWorksheet()
    {  
        $newWorksheetName = 'new worksheet name';
        $result = $this->worksheet->copyWorksheet($newWorksheetName);
        $this->assertEquals(true,$result);
    }
    
    public function testDeleteBackgroundImage()
    {  
        $result = $this->worksheet->deleteBackgroundImage();
        $this->assertEquals(true,$result);
    }
    
    public function testGetRow()
    {  
        $rowIndex = 0;
        $result = $this->worksheet->getRow($rowIndex);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testDeleteRow()
    {  
        $rowIndex = 1;
        $result = $this->worksheet->deleteRow($rowIndex);
        $this->assertEquals(true,$result);
    }
    
    public function testCopyRows()
    {  
        $rowIndex = 1;
        $result = $this->worksheet->copyRows($sourceRowIndex=1,$destRowIndex=6,$rowNumber=1);
        $this->assertEquals(true,$result);
    }
    
    public function testHideRows()
    {  
        $startRow = 1;
        $totalRows = 1;
        $result = $this->worksheet->hideRows($startRow, $totalRows);
        $this->assertEquals(true,$result);
    }
    
    public function testUnhideRows()
    {  
        $startRow = 1;
        $totalRows = 1;
        $result = $this->worksheet->unhideRows($startRow, $totalRows);
        $this->assertEquals(true,$result);
    }
    
    public function testGroupRows()
    {  
        $result = $this->worksheet->groupRows($firstIndex=1,$lastIndex=1,$hide=false);
        $this->assertEquals(true,$result);
    }
    
    public function testUngroupRows()
    {  
        $result = $this->worksheet->ungroupRows($firstIndex=1,$lastIndex=1);
        $this->assertEquals(true,$result);
    }
    
    public function testSetCellValue()
    {  
        $cell = "A22";
        $type = "int";
        $value = "1";
        $result = $this->worksheet->setCellValue($cell, $type, $value);
        $this->assertEquals(true,$result);
    }
    
    public function testGetCellStyle()
    {  
        $cellName = 'A2';
        $result = $this->worksheet->getCellStyle($cellName);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testGetCell()
    {  
        $cellName = 'A2';
        $result = $this->worksheet->getCell($cellName);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testGetMergedCellByIndex()
    {  
        $index = 0;
        $result = $this->worksheet->getMergedCellByIndex($index);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testGetPictureByIndex()
    {  
        $index = 0;
        $result = $this->worksheet->getPictureByIndex($index);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testUpdatePicture()
    {  
        $pictureData = '{
        "Picture": {
          "Name": "picture_test",
          "AutoShapeType": "Rectangle",
          "Placement": "MoveAndSize",
          "UpperLeftRow": 5,
          "Top": 100,
          "UpperLeftColumn": 5,
          "Left": 100,
          "LowerRightRow": 9,
          "Bottom": 0,
          "LowerRightColumn": 11,
          "Right": 0,
          "Width": 100,
          "Height": 100,
          "X": 687,
          "Y": 100,
          "RotationAngle": 0,
          "LinkedCell": null,
          "HtmlText": "sfsdfsdf",
          "Text": "sfsdfsdf",
          "AlternativeText": "",
          "TextHorizontalAlignment": "Left",
          "TextHorizontalOverflow": "Clip",
          "TextOrientationType": "NoRotation",
          "TextVerticalOverflow": "Clip",
          "TextVerticalAlignment": "Top",
          "IsGroup": false,
          "IsHidden": false,
          "IsLockAspectRatio": false,
          "IsLocked": true,
          "IsPrintable": true,
          "IsTextWrapped": true,
          "ZOrderPosition": 2
        }
        }';
        $pictureIndex = 0;
        $result = $this->worksheet->updatePicture($pictureIndex,$pictureData);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testDeletePicture()
    {  
        $pictureIndex = 0;
        $result = $this->worksheet->deletePicture($pictureIndex);
        $this->assertEquals(true,$result);
    }
    
    public function testDeleteAllPictures()
    {  
        $result = $this->worksheet->deleteAllPictures();
        $this->assertEquals(true,$result);
    }
    
    public function testGetOleObjectByIndex()
    {  
        $index = 0;
        $result = $this->worksheet->getOleObjectByIndex($index);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testAddOleObject()
    {  
        $imageFile = "ole.png";
        $oleFile = "ole.docx";
        $upperLeftRow = 0; 
        $upperLeftColumn = 0; 
        $height = 200; 
        $width = 400;
        $result = $this->worksheet->addOleObject($oleFile, $imageFile, $upperLeftRow, $upperLeftColumn, $height, $width);
        $this->assertEquals(true,$result);
    }
    
    public function testUpdateOleObject()
    {  
        $object_data = '{
        "OleObject": {
          "Name" : "ole",
          "UpperLeftRow" : "18",
          "Top" : "100",
          "UpperLeftColumn" : "18",
          "Left" : "100",
          "LowerRightRow" : "24",
          "Bottom" : "0",
          "LowerRightColumn" : "2",
          "Right" : "0",
          "Width" : "100",
          "Height" : "100",
          "X" : "64",
          "Y" : "360",
          "DisplayAsIcon" : "false",
          "FileType" : "Unknown",
          "IsAutoSize" : "false",
          "IsLink" : "false",
          "SourceFullName" : "ole.docx",
          "ImageSourceFullName" : "WaterMark.png",
        }}';
        $objectIndex = 0;
        $result = $this->worksheet->updateOleObject($objectIndex, $object_data);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testDeleteOleObjectByIndex()
    {  
        $index = 0;
        $result = $this->worksheet->deleteOleObjectByIndex($index);
        $this->assertEquals(true,$result);
    }
    
    public function testDeleteAllOleObject()
    {  
        $result = $this->worksheet->deleteAllOleObject();
        $this->assertEquals(true,$result);
    }
    
    public function testGetHyperlinkByIndex()
    {  
        $index = 0;
        $result = $this->worksheet->getHyperlinkByIndex($index);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testDeleteHyperlinkByIndex()
    {  
        $index = 0;
        $result = $this->worksheet->deleteHyperlinkByIndex($index);
        $this->assertEquals(true,$result);
    }
    
    public function testGetCellsList()
    {  
        $result = $this->worksheet->getCellsList($offset=0, $count=0);
        $this->assertInternalType('array',$result);
    }
    
    public function testGetMaxColumn()
    {  
        $result = $this->worksheet->getMaxColumn($offset=0, $count=0);
        $this->assertInternalType('integer',$result);
    }
    
    public function testGetMaxRow()
    {  
        $result = $this->worksheet->getMaxRow($offset=0, $count=0);
        $this->assertInternalType('integer',$result);
    }
    
    public function testGetCellsCount()
    {  
        $result = $this->worksheet->getCellsCount($offset=0, $count=0);
        $this->assertInternalType('integer',$result);
    }
    
    public function testGetAutoShapesCount()
    {  
        $result = $this->worksheet->getAutoShapesCount($offset=0, $count=0);
        $this->assertInternalType('integer',$result);
    }
    
    public function testGetChartsCount()
    {  
        $result = $this->worksheet->getChartsCount();
        $this->assertInternalType('integer',$result);
    }
    
    public function testGetChartByIndex()
    {  
        $index = 0;
        $result = $this->worksheet->getChartByIndex($index);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testGetHyperlinksCount()
    {  
        $result = $this->worksheet->getHyperlinksCount();
        $this->assertInternalType('integer',$result);
    }
    
    public function testGetMergedCellsCount()
    {  
        $result = $this->worksheet->getMergedCellsCount();
        $this->assertInternalType('integer',$result);
    }
    
    public function testGetValidationsCount()
    {  
        $result = $this->worksheet->getValidationsCount();
        $this->assertInternalType('integer',$result);
    }
    
    public function testGetPicturesCount()
    {  
        $result = $this->worksheet->getPicturesCount();
        $this->assertInternalType('integer',$result);
    }
    
    public function testGetOleObjectsCount()
    {  
        $result = $this->worksheet->getOleObjectsCount();
        $this->assertInternalType('integer',$result);
    }
    
    public function testGetCommentsCount()
    {  
        $result = $this->worksheet->getCommentsCount();
        $this->assertInternalType('integer',$result);
    }
    
    public function testFreezePanes()
    {  
        $result = $this->worksheet->FreezePanes($row=1,$col=1,$freezedRows=1,$freezedCols=1);
        $this->assertEquals(true,$result);
    }
    
    public function testRenameWorksheet()
    {  
        $newName = 'new sheet name';
        $result = $this->worksheet->renameWorksheet($newName);
        $this->assertEquals(true,$result);
    }
    
    public function testMoveWorksheet()
    {  
        $worksheetName = 'Sheet1'; 
        $position = 1;
        $result = $this->worksheet->moveWorksheet($worksheetName, $position);
        $this->assertEquals(true,$result);
    }
    
    public function testGetRowsCount()
    {  
        $result = $this->worksheet->getRowsCount($offset=0, $count=0);
        $this->assertInternalType('integer',$result);
    }
    
    public function testAddEmptyRow()
    {  
        $result = $this->worksheet->addEmptyRow($rowId=1);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testSetFormula()
    {  
        $result = $this->worksheet->setFormula($cellName="A1", $formula="sum(b1:b8)");
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testClearCellsContents()
    {  
        $result = $this->worksheet->clearCellsContents($range="A1:C4");
        $this->assertTrue($result);
    }
    
    public function testMergeCells()
    {  
        $result = $this->worksheet->mergeCells($startRow=1, $startColumn=1, $totalRows=2, $totalColumns=2);
        $this->assertFileExists(getcwd(). '/Data/output/Test.xlsx');
    }
    
    public function testUnmergeCells()
    {  
        $result = $this->worksheet->unmergeCells($startRow=1, $startColumn=1, $totalRows=2, $totalColumns=2);
        $this->assertFileExists(getcwd(). '/Data/output/Test.xlsx');
    }
    
    public function testSetRangeValue()
    {  
        $result = $this->worksheet->setRangeValue($cellarea="A1:A10", $value="Sample", $type="string");
        $this->assertFileExists(getcwd(). '/Data/output/Test.xlsx');
    }
    
    public function testClearCellsFormatting()
    {  
        $result = $this->worksheet->clearCellsFormatting($startRow=1, $startColumn=1, $endRow=2, $endColumn=2);
        $this->assertFileExists(getcwd(). '/Data/output/Test.xlsx');
    }
    
}    