<?php
/**
 * This class contains features to work with worksheet.
 */
namespace Aspose\Cloud\Cells;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;

class Worksheet
{

    public $fileName = '';
    public $worksheetName = '';

    public function __construct($fileName='', $worksheetName='')
    {
        $this->fileName = $fileName;
        $this->worksheetName = $worksheetName;
    }

    /**
     * Gets a list of cells.
     *
     * @param integer $offset
     * @param integer $count
     *
     * @return array
     * @throws Exception
     */
    public function getCellsList($offset, $count)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells?offset=' .
            $offset . '&count=' . $count;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        $listCells = array();
        foreach ($json->Cells->CellList as $cell) {
            $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
                '/worksheets/' . $this->worksheetName . '/cells' . $cell->link->Href;
            $signedURI = Utils::sign($strURI);
            $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
            $json = json_decode($responseStream);
            array_push($listCells, $json->Cell);
        }
        return $listCells;

    }

    /**
     * Gets a list of rows from the worksheet.
     *
     * @return array
     * @throws Exception
     */
    public function getRowsList()
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells/rows';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        $listRows = array();
        foreach ($json->Rows->RowsList as $row) {
            $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
                '/worksheets/' . $this->worksheetName . '/cells/rows' . $row->link->Href;
            $signedURI = Utils::sign($strURI);
            $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
            $json = json_decode($responseStream);
            array_push($listRows, $json->Row);
        }
        return $listRows;

    }

    /**
     * Gets a list of columns from the worksheet.
     *
     * @return array
     * @throws Exception
     */
    public function getColumnsList()
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells/columns';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        $listColumns = array();
        foreach ($json->Columns->ColumnsList as $column) {
            $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
                '/worksheets/' . $this->worksheetName . '/cells/columns' . $column->link->Href;
            $signedURI = Utils::sign($strURI);
            $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
            $json = json_decode($responseStream);
            array_push($listColumns, $json->Column);
        }

        return $listColumns;

    }

    /**
     * Gets maximum column index of cell which contains data or style.
     *
     * @param integer $offset
     * @param integer $count
     *
     * @return integer
     * @throws Exception
     */
    public function getMaxColumn($offset, $count)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells?offset=' .
            $offset . '&count=' . $count;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Cells->MaxColumn;

    }

    /**
     * Gets maximum row index of cell which contains data or style.
     *
     * @param integer $offset
     * @param integer $count
     *
     * @return integer
     * @throws Exception
     */
    public function getMaxRow($offset, $count)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells?offset=' .
            $offset . '&count=' . $count;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Cells->MaxRow;

    }

    /**
     * Gets cell count in the worksheet.
     *
     * @param integer $offset
     * @param integer $count
     *
     * @return integer
     * @throws Exception
     */
    public function getCellsCount($offset, $count)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells?offset=' .
            $offset . '&count=' . $count;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Cells->CellCount;

    }

    /**
     * Gets AutoShape count in the worksheet.
     *
     * @return integer
     * @throws Exception
     */
    public function getAutoShapesCount()
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/autoshapes';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return count($json->AutoShapes->AutoShapeList);

    }

    /**
     * Gets a specific AutoShape from the sheet.
     *
     * @param integer $index
     *
     * @return object
     * @throws Exception
     */
    public function getAutoShapeByIndex($index)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/autoshapes/' . $index;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->AutoShape;

    }

    /**
     * Gets charts count in the worksheet.
     *
     * @return integer
     * @throws Exception
     */
    public function getChartsCount()
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/charts';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return Count($json->Charts->ChartList);

    }

    /**
     * Gets a specific chart from the sheet.
     *
     * @param integer $index
     *
     * @return object
     * @throws Exception
     */
    public function getChartByIndex($index)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/charts/' . $index;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Chart;

    }

    /**
     * Gets hyperlinks count in the worksheet.
     *
     * @return integer
     * @throws Exception
     */
    public function getHyperlinksCount()
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/hyperlinks';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return Count($json->Hyperlinks->HyperlinkList);

    }

    /**
     * Gets a specific hyperlink from the sheet.
     *
     * @param integer $index Index of the hyperlink.
     *
     * @return object
     * @throws Exception
     */
    public function getHyperlinkByIndex($index)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/hyperlinks/' . $index;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Hyperlink;

    }

    /**
     * Delete a specific hyperlink from the sheet.
     *
     * @param integer $index Index of the hyperlink.
     *
     * @return boolean
     * @throws Exception
     */
    public function deleteHyperlinkByIndex($index)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/hyperlinks/' . $index;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');
        $json = json_decode($responseStream);
        if ($json->Status == 'OK') {
            return true;
        } else {
            return false;
        }

    }
    
    /**
     * Add Hyperlinks to Excel Worksheet
     *
     * @param integer $firstRow Index of the first row.
     * @param integer $firstColumn Index of the first column.
     * @param integer $totalRows Number of rows to be operated.
     * @param integer $totalColumns Number of column to be operated.
     * @param string $url The address of a hyperlink.
     *
     * @return boolean
     * @throws Exception
     */
    public function addHyperlink($firstRow, $firstColumn, $totalRows, $totalColumns, $url)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
	
        if ($firstRow == '')
            throw new Exception('First Row not specified');
	
        if ($firstColumn == '')
            throw new Exception('First Column not specified');
	
        if ($totalRows == '')
            throw new Exception('Total Rows not specified');
	
        if ($totalColumns == '')
            throw new Exception('Total Columns not specified');
	
        if ($url == '')
            throw new Exception('URL not specified');				
						
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/hyperlinks?firstRow=' . $firstRow .
			'&firstColumn=' . $firstColumn . '&totalRows=' . $totalRows . '&totalColumns=' . $totalColumns .
			'&address=' . $url;
        $signedURI = Utils::sign($strURI);
        $response = Utils::processCommand($signedURI, 'PUT', '', '');
        $json = json_decode($response);
        if ($json->Code == 200)
            return true;
        else
            return false;
    }
	
    /**
     * Update Hyperlinks to Excel Worksheet
     *
     * @param integer $hyperlinkIndex The index of a hyperlink.
     * @param string $url The address of a hyperlink.
     * @param string $screenTip The ScreenTip text for the specified hyperlink.
     * @param string $displayText The text to be displayed for the specified hyperlink.
     *
     * @return boolean
     * @throws Exception
     */
    public function updateHyperlink($hyperlinkIndex, $url, $screenTip, $displayText)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
	
        if ($hyperlinkIndex == '')
            throw new Exception('Hyperlink Index not specified');
	
        if ($url == '')
            throw new Exception('URL not specified');
	
        if ($screenTip == '')
            throw new Exception('Screen Tip not specified');
	
        if ($displayText == '')
            throw new Exception('Display Text not specified');
			
	$data = array('address' => $url, 'ScreenTip' => $screenTip, 'TextToDisplay' => $displayText);
	$json_data = json_encode($data);	
						
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/hyperlinks/' . $hyperlinkIndex;
        $signedURI = Utils::sign($strURI);
        $response = Utils::processCommand($signedURI, 'POST', 'json', $json_data);
        $json = json_decode($response);
        if ($json->Code == 200)
            return true;
        else
            return false;
    }

    /**
     * Get comments from cell.
     *
     * @param string $cellName
     *
     * @return string
     * @throws Exception
     */
    public function getComment($cellName)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/comments/' . $cellName;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Comment->HtmlNote;

    }

    /**
     * Get OLE object from document.
     *
     * @param integer $index Index of the OLE object.
     *
     * @return object
     * @throws Exception
     */
    public function getOleObjectByIndex($index)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/oleobjects/' . $index;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->OleObject;

    }

    /**
     * Deletes an OLE object.
     *
     * @param integer $index Index of the OLE object.
     *
     * @return boolean
     * @throws Exception
     */
    public function deleteOleObjectByIndex($index)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/oleobjects/' . $index;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Deletes all OLE objects.
     *
     * @return boolean
     * @throws Exception
     */
    public function deleteAllOleObject()
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/oleobjects';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Get picture from worksheet.
     *
     * @param integer $index Index of the picture.
     *
     * @return object
     * @throws Exception
     */
    public function getPictureByIndex($index)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/pictures/' . $index;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Picture;

    }

    /**
     * Get validation.
     *
     * @param integer $index
     *
     * @return object
     * @throws Exception
     */
    public function getValidationByIndex($index)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/validations/' . $index;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Validation;

    }

    /**
     * Get merged cells.
     *
     * @param integer $index
     *
     * @return object
     * @throws Exception
     */
    public function getMergedCellByIndex($index)
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/mergedCells/' . $index;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->MergedCell;

    }

    /**
     * Get count of merged cells.
     *
     * @return integer
     * @throws Exception
     */
    public function getMergedCellsCount()
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/mergedCells';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->MergedCells->Count;

    }

    /**
     * Get count of validation.
     *
     * @return integer
     * @throws Exception
     */
    public function getValidationsCount()
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/validations';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return count($json->Validations->ValidationList);

    }

    /**
     * Get count of pictures.
     *
     * @return integer
     * @throws Exception
     */
    public function getPicturesCount()
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/pictures';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return count($json->Pictures->PictureList);

    }

    /**
     * Get count of OLE objects.
     *
     * @return integer
     * @throws Exception
     */
    public function getOleObjectsCount()
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/oleobjects';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return count($json->OleObjects->OleObjectList);

    }

    /**
     * Get count of comments.
     *
     * @return integer
     * @throws Exception
     */
    public function getCommentsCount()
    {
        //check whether workshett name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/comments';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return count($json->Comments->CommentList);

    }

    /**
     * Hide workseet.
     *
     * @return boolean
     * @throws Exception
     */
    public function hideWorksheet()
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/visible?isVisible=false';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'PUT', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Unhide worksheet.
     *
     * @return boolean
     * @throws Exception
     */
    public function unhideWorksheet()
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/visible?isVisible=true';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'PUT', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Freeze panes of a worksheet.
     *
     * @param integer $row
     * @param integer $col
     * @param integer $freezedRows
     * @param integer $freezedCols
     *
     * @return boolean
     * @throws Exception
     */
    public function freezePanes($row = 1, $col = 1, $freezedRows = 1, $freezedCols = 1)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');

        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/FreezePanes?row=' . $row . '&column=' . $col . '&freezedRows=' . $freezedRows . '&freezedColumns=' . $freezedCols;

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'PUT', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Unfreeze panes of a worksheet.
     *
     * @return boolean
     * @throws Exception
     */
    public function unfreezePanes()
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');

        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/FreezePanes';

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Delete background image from worksheet.
     *
     * @return boolean
     * @throws Exception
     */
    public function deleteBackgroundImage()
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');

        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/Background';

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Set background image of a worksheet.
     *
     * @param string $backgroundImage
     *
     * @return boolean
     * @throws Exception
     */
    public function setBackgroundImage($backgroundImage = "")
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');

        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/Background?imageFile=' . $backgroundImage;

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'PUT', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Update document properties.
     *
     * @param array $properties
     *
     * @return object|boolean
     * @throws Exception
     */
    public function updateProperties($properties = array())
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');

        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/workbook/worksheets/' . $this->worksheetName;

        $signedURI = Utils::sign($strURI);

        $json_data = json_encode($properties);

        $responseStream = Utils::processCommand($signedURI, 'POST', 'json', $json_data);
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return $json->Worksheet;
        else
            return false;

    }

    /**
     * Rename worksheet.
     *
     * @param string $newName New name of worksheet.
     *
     * @return boolean
     * @throws Exception
     */
    public function renameWorksheet($newName)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');

        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/Rename?newname=' . $newName;

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Copy worksheet.
     *
     * @param string $newWorksheetName Name of worksheet.
     *
     * @return boolean
     * @throws Exception
     */
    public function copyWorksheet($newWorksheetName)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');

        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $newWorksheetName . '/copy?sourcesheet=' . $this->worksheetName;

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Change position of the worksheet.
     *
     * @param string $worksheetName Name of the worksheet.
     * @param integer $position New position of the worksheet.
     *
     * @return boolean
     * @throws Exception
     */
    public function moveWorksheet($worksheetName, $position)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $fieldsArray['DestinationWorsheet'] = $worksheetName;
        $fieldsArray['Position'] = $position;
        $jsonData = json_encode($fieldsArray);
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/position';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', 'json', $jsonData);
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Calculate formula.
     *
     * @param string $formula
     *
     * @return number
     * @throws Exception
     */
    public function calculateFormula($formula)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/formulaResult?formula=' . $formula;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Value->Value;

    }

    /**
     * Set cell value.
     *
     * @param string $cellName Name of the cell.
     * @param string $valueType Type of the value.
     * @param string $value Value of the cell.
     *
     * @return boolean
     * @throws Exception
     */
    public function setCellValue($cellName, $valueType, $value)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells/' . $cellName . '?value=' . $value . '&type=' . $valueType;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Get count of rows.
     *
     * @param integer $offset
     * @param integer $count
     *
     * @return integer
     * @throws Exception
     */
    public function getRowsCount($offset, $count)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells/rows?offset=' . $offset . '&count=' . $count;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Rows->RowsCount;

    }

    /**
     * Copy rows in a worksheet.
     *
     * @param integer $sourceRowIndex
     * @param integer $destRowIndex
     * @param integer $rowNumber
     *
     * @return boolean
     * @throws Exception
     */
    public function copyRows($sourceRowIndex = 1, $destRowIndex = 1, $rowNumber = 1)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells/rows/copy?sourceRowIndex=' . $sourceRowIndex . '&destinationRowIndex=' . $destRowIndex . '&rowNumber=' . $rowNumber;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Autfit rows in worksheet.
     *
     * @param integer $firstIndex
     * @param integer $lastIndex
     *
     * @return boolean
     * @throws Exception
     */
    public function autofitRows($firstIndex = 1, $lastIndex = 1)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells/rows/autofit?firstIndex=' . $firstIndex . '&lastIndex=' . $lastIndex;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Group rows in worksheet.
     *
     * @param integer $firstIndex
     * @param integer $lastIndex
     * @param boolean $hide
     *
     * @return boolean
     * @throws Exception
     */
    public function groupRows($firstIndex = 1, $lastIndex = 1, $hide = false)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells/rows/group?firstIndex=' . $firstIndex . '&lastIndex=' . $lastIndex . '&hide=' . $hide;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Ungroup rows in worksheet.
     *
     * @param integer $firstIndex
     * @param integer $lastIndex
     *
     * @return boolean
     * @throws Exception
     */
    public function ungroupRows($firstIndex = 1, $lastIndex = 1)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells/rows/ungroup?firstIndex=' . $firstIndex . '&lastIndex=' . $lastIndex;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Unhide rows in worksheet.
     *
     * @param integer $startRow
     * @param integer $totalRows
     *
     * @return boolean
     * @throws Exception
     */
    public function unhideRows($startRow = 1, $totalRows = 1)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells/rows/unhide?startrow=' . $startRow . '&totalRows=' . $totalRows;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Hide rows in worksheet.
     *
     * @param integer $startRow
     * @param integer $totalRows
     *
     * @return boolean
     * @throws Exception
     */
    public function hideRows($startRow = 1, $totalRows = 1)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells/rows/hide?startrow=' . $startRow . '&totalRows=' . $totalRows;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Get row from a worksheet.
     *
     * @param integer $rowIndex
     *
     * @return string
     * @throws Exception
     */
    public function getRow($rowIndex)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells/rows/' . $rowIndex;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Row;

    }

    /**
     * Delete row from a worksheet.
     *
     * @param integer $rowIndex
     *
     * @return boolean
     * @throws Exception
     */
    public function deleteRow($rowIndex)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells/rows/' . $rowIndex;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Get column from a worksheet.
     *
     * @param integer $columnIndex
     *
     * @return object
     * @throws Exception
     */
    public function getColumn($columnIndex)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells/columns/' . $columnIndex;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Column;

    }

    /**
     * Sort data in worksheet.
     *
     * @param array $dataSort Array to hold data.
     * @param string $cellArea Cells area to sort.
     *
     * @return boolean
     * @throws Exception
     */

    public function sortData(array $dataSort, $cellArea = '')
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/sort?cellArea=' . $cellArea;
        $json_array = json_encode($dataSort);
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', 'json', $json_array);
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Set cell style in worksheet.
     *
     * @param string $cellName Name of the cell.
     * @param array $style Style for the cell.
     *
     * @return boolean
     * @throws Exception
     */
    public function setCellStyle($cellName, array $style)
    {
        //check whether worksheet name is set or not
        if ($this->worksheetName == '')
            throw new Exception('Worksheet name not specified');
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() .
            '/worksheets/' . $this->worksheetName . '/cells/' . $cellName . '/style';
        $jsonArray = json_encode($style);
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', 'json', $jsonArray);
        $json = json_decode($responseStream);
        if ($json->Code == 200)
            return true;
        else
            return false;

    }

    /**
     * Get cell from a worksheet.
     *
     * @param string $cellName Name of the cell.
     *
     * @return object|boolean
     * @throws Exception
     */
    public function getCell($cellName)
    {
        if ($this->worksheetName == '') {
            throw new Exception('No Worksheet Specified');
        }
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/cells/' . $cellName;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', 'json');
        $json = json_decode($responseStream);
        if ($json->Code == 200) {
            return $json->Cell;
        } else {
            return false;
        }

    }

    /**
     * Get cell style from a worksheet.
     *
     * @param string $cellName Name of the cell.
     *
     * @return object|boolean
     * @throws Exception
     */
    public function getCellStyle($cellName)
    {
        if ($this->worksheetName == '') {
            throw new Exception('No Worksheet Specified');
        }
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/cells/' . $cellName . '/style';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', 'json');
        $json = json_decode($responseStream);
        if ($json->Code == 200) {
            return $json->Style;
        } else {
            return false;
        }

    }

    /**
     * Add picture to worksheet.
     *
     * @param string $picturePath The picture file path at storage.
     * @param string $pictureLocation The location of picture.
     * @param integer $upperLeftRow New image left row position.
     * @param integer $upperLeftColumn New image left column position.
     * @param integer $lowerRightRow New image right row position.
     * @param integer $lowerRightColumn New image right column position.
     *
     * @return boolean
     * @throws Exception
     */
    public function addPicture($picturePath, $pictureLocation, $upperLeftRow = 0, $upperLeftColumn = 0, $lowerRightRow = 0, $lowerRightColumn = 0)
    {
        if ($this->worksheetName == '') {
            throw new Exception('No Worksheet Specified');
        }
        if ($pictureLocation == 'Server' || $pictureLocation == 'server') {
            $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/pictures?upperLeftRow=' .
                $upperLeftRow . '&upperLeftColumn=' . $upperLeftColumn .
                '&lowerRightRow=' . $lowerRightRow . '&lowerRightColumn=' . $lowerRightColumn .
                '&picturePath=' . $picturePath;
            $signedURI = Utils::sign($strURI);
            $responseStream = Utils::processCommand($signedURI, 'PUT');
        } else if ($pictureLocation == 'Local' || $pictureLocation == 'local') {
            if (!file_exists($picturePath)) {
                throw new Exception('File Does not Exists');
            }
            $stream = file_get_contents($picturePath);
            $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/pictures?upperLeftRow=' .
                $upperLeftRow . '&upperLeftColumn=' . $upperLeftColumn .
                '&lowerRightRow=' . $lowerRightRow . '&lowerRightColumn=' . $lowerRightColumn .
                '&picturePath=' . $picturePath;
            $signedURI = Utils::sign($strURI);
            $responseStream = Utils::processCommand($signedURI, 'PUT', '', $stream);
        }
        $json = json_decode($responseStream);
        if ($json->Code == 200) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Add OLE object to worksheet.
     *
     * @param string $oleFile The name of ole file.
     * @param string $imageFile The name of image file.
     * @param integer $upperLeftRow Upper left row index.
     * @param integer $upperLeftColumn Upper left column index.
     * @param integer $height Height of oleObject, in unit of pixel.
     * @param integer $width Width of oleObject, in unit of pixel.
     *
     * @return boolean
     * @throws Exception
     */
    public function addOleObject($oleFile = '', $imageFile = '', $upperLeftRow = 0, $upperLeftColumn = 0, $height = 0, $width = 0)
    {
        if ($this->worksheetName == '') {
            throw new Exception('No Worksheet Specified');
        }
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/oleobjects?upperLeftRow=' .
            $upperLeftRow . '&upperLeftColumn=' . $upperLeftColumn .
            '&height=' . $height . '&width=' . $width .
            '&oleFile=' . $oleFile . '&imageFile=' . $imageFile;
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'PUT');
        $json = json_decode($responseStream);
        if ($json->Code == 200) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Update a specific object from worksheet.
     *
     * @param integer $objectIndex Index of the object.
     * @param array $object_data Object data.
     *
     * @return object
     * @throws Exception
     */

    public function updateOleObject($objectIndex, $object_data)
    {
        //Build URI
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/oleobjects/' . $objectIndex;
        //Sign URI
        $signedURI = Utils::sign($strURI);
        //Send request and receive response stream
        $responseStream = Utils::processCommand($signedURI, 'POST', 'json', $object_data);
        $json = json_decode($responseStream);
        return $json;

    }

    /**
     * Update a specific picture from worksheet.
     *
     * @param integer $pictureIndex Index of the picture.
     * @param array $picture_data Picture data.
     *
     * @return object
     * @throws Exception
     */
    public function updatePicture($pictureIndex, $picture_data)
    {
        //Build URI
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/pictures/' . $pictureIndex;
        //Sign URI
        $signedURI = Utils::sign($strURI);
        //Send request and receive response stream
        $responseStream = Utils::processCommand($signedURI, 'POST', 'json', $picture_data);
        $json = json_decode($responseStream);
        return $json;

    }

    /**
     * Delete a specific picture from a worksheet.
     *
     * @param integer $pictureIndex Index of the picture.
     *
     * @return boolean
     * @throws Exception
     */
    public function deletePicture($pictureIndex)
    {
        //Build URI
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/pictures/' . $pictureIndex;
        //Sign URI
        $signedURI = Utils::sign($strURI);
        //Send request and receive response stream
        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Delete all pictures from a worksheet.
     *
     * @return boolean
     * @throws Exception
     */
    public function deleteAllPictures()
    {
        //Build URI
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/pictures';
        //Sign URI
        $signedURI = Utils::sign($strURI);
        //Send request and receive response stream
        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');
        $json = json_decode($responseStream);
        if ($json->Code == 200) {
            return true;
        } else {
            return false;
        }

    }
    
    /**
     * Add an Empty Row in a Worksheet
     * 
     * @param integer $rowId ID of the row.
     * 
     * @return object|boolean
     * @throws Exception
     */
    public function addEmptyRow($rowId)
    {
        if ($rowId == '')
            throw new Exception('Row ID not specified');
        
        //Build URI
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . '/cells/rows/' . $rowId;
        //Sign URI
        $signedURI = Utils::sign($strURI);
        
        //Send request and receive response
        $response = Utils::processCommand($signedURI, 'PUT', '', '');
        $json = json_decode($response);
        if ($json->Code == 200)
            return $json->Row;
        else
            return false;
    }
    
    /**
     * Set Formula for a Cell in Excel Worksheets
     * 
     * @param string $cellName Name of the cell.
     * @param string $formula Formula for the cell.
     * 
     * @return object|boolean
     * @throws Exception
     */
    public function setFormula($cellName, $formula)
    {
        if ($cellName == '')
            throw new Exception('Cell Name not specified');
        
        if ($formula == '')
            throw new Exception('Formula not specified');
        
        //Build URI
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . 
                  '/cells/' . $cellName . '?formula=' . $formula;
        //Sign URI
        $signedURI = Utils::sign($strURI);
        
        //Send request and receive response
        $response = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($response);
        if ($json->Code == 200)
            return $json->Cell;
        else
            return false;
    }
    
    /**
     * Clear Contents and Styles of Cells in Excel Worksheet
     * 
     * @param type $range Range of cells.
     * 
     * @return boolean
     * @throws Exception
     */
    public function clearCellsContents($range)
    {
        if ($range == '')
            throw new Exception('Range not specified');
        
        //Build URI
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . 
                  '/cells/clearcontents?range=' . $range;
        //Sign URI
        $signedURI = Utils::sign($strURI);
        
        //Send request and receive response
        $response = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($response);
        if ($json->Code == 200)
            return true;
        else
            return false;
    }
    
    /**
     * Merge Cells in Excel Worksheet
     * 
     * @param integer $startRow Start row index.
     * @param integer $startColumn Start column index.
     * @param integer $totalRows Number of rows.
     * @param integer $totalColumns Number of columns.
     * 
     * @return string|boolean
     * @throws Exception
     */
    public function mergeCells($startRow, $startColumn, $totalRows, $totalColumns)
    {
        if ($startRow == '')
            throw new Exception('Start Row not specified');
        
        if ($startColumn == '')
            throw new Exception('Start Column not specified');
        
        if ($totalRows == '')
            throw new Exception('Total Rows not specified');
        
        if ($totalColumns == '')
            throw new Exception('Total Columns not specified');
        
        //Build URI
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . 
                  '/cells/merge?startrow=' . $startRow . '&startcolumn=' . $startColumn .
                  '&totalrows=' . $totalRows . '&totalcolumns=' . $totalColumns;
        //Sign URI
        $signedURI = Utils::sign($strURI);
        
        //Send request and receive response
        $response = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($response);
        if ($json->Code == 200) {
            $strURI = Product::$baseProductUri . '/storage/file/' . $this->getFileName();
            $signedURI = Utils::Sign($strURI);
            $responseStream = Utils::processCommand($signedURI, "GET", "", "");

            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        }    
        else
            return false;
    }
    
    /**
     * Unmerge Cells in Excel Worksheet
     * 
     * @param integer $startRow Start row index.
     * @param integer $startColumn Start column index.
     * @param integer $totalRows Number of rows.
     * @param integer $totalColumns Number of columns.
     * 
     * @return string|boolean
     * @throws Exception
     */
    public function unmergeCells($startRow, $startColumn, $totalRows, $totalColumns)
    {
        if ($startRow == '')
            throw new Exception('Start Row not specified');
        
        if ($startColumn == '')
            throw new Exception('Start Column not specified');
        
        if ($totalRows == '')
            throw new Exception('Total Rows not specified');
        
        if ($totalColumns == '')
            throw new Exception('Total Columns not specified');
        
        //Build URI
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . 
                  '/cells/unmerge?startrow=' . $startRow . '&startcolumn=' . $startColumn .
                  '&totalrows=' . $totalRows . '&totalcolumns=' . $totalColumns;
        //Sign URI
        $signedURI = Utils::sign($strURI);
        
        //Send request and receive response
        $response = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($response);
        if ($json->Code == 200) {
            $strURI = Product::$baseProductUri . '/storage/file/' . $this->getFileName();
            $signedURI = Utils::Sign($strURI);
            $responseStream = Utils::processCommand($signedURI, "GET", "", "");

            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        }    
        else
            return false;
    }
    
    /**
     * Set Range Value in Excel Worksheet
     * 
     * @param string $cellarea Cells area.
     * @param string $value Value of the cell.
     * @param string $type Type of the value.
     * 
     * @return string Returns the file path.
     * @throws Exception
     */
    public function setRangeValue($cellarea, $value, $type)
    {
        if ($cellarea == '')
            throw new Exception('Cellarea not specified');
        
        if ($value == '')
            throw new Exception('Value not specified');
        
        if ($type == '')
            throw new Exception('Type not specified');
        
        //Build URI
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . 
                  '/cells?cellarea=' . $cellarea . '&value=' . $value . '&type=' . $type;
        //Sign URI
        $signedURI = Utils::sign($strURI);
        
        //Send request and receive response stream
        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        
        $v_output = Utils::validateOutput($responseStream);
        
        if ($v_output == '') {
            $strURI = Product::$baseProductUri . '/storage/file/' . $this->getFileName();
            $signedURI = Utils::Sign($strURI);
            $responseStream = Utils::processCommand($signedURI, "GET", "", "");

            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        }    
        else
            return $v_output;
    }
    
    /**
     * Clear Cells Formatting in Excel Worksheet
     * 
     * @param type $startRow Start row index.
     * @param type $startColumn Start column index.
     * @param type $endRow End row index.
     * @param type $endColumn End column index.
     * 
     * @return string Returns the file path.
     * @throws Exception
     */
    public function clearCellsFormatting($startRow, $startColumn, $endRow, $endColumn)
    {
        if ($startRow == '')
            throw new Exception('Start Row not specified');
        
        if ($startColumn == '')
            throw new Exception('Start Column not specified');
        
        if ($endRow == '')
            throw new Exception('End Row not specified');
        
        if ($endColumn == '')
            throw new Exception('End Column not specified');
        
        //Build URI
        $strURI = Product::$baseProductUri . '/cells/' . $this->getFileName() . '/worksheets/' . $this->worksheetName . 
                  '/cells/ClearFormats?startRow=' . $startRow . '&startColumn=' . $startColumn . 
                  '&endRow=' . $endRow . '&endColumn=' . $endColumn;
        //Sign URI
        $signedURI = Utils::sign($strURI);
        
        //Send request and receive response stream
        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        
        $v_output = Utils::validateOutput($responseStream);
        
        if ($v_output == '') {
            $strURI = Product::$baseProductUri . '/storage/file/' . $this->getFileName();
            $signedURI = Utils::Sign($strURI);
            $responseStream = Utils::processCommand($signedURI, "GET", "", "");

            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        }    
        else
            return $v_output;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        if ($this->fileName == '') {
            throw new Exception('No File Name Specified');
        }
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @return string
     */
    public function getWorksheetName()
    {
        return $this->worksheetName;
    }

    /**
     * @param string $worksheetName
     */
    public function setWorksheetName($worksheetName)
    {
        $this->worksheetName = $worksheetName;
        return $this;
    }

}