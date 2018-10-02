<?php
/**
 * Deals with Word document builder aspects.
 */
namespace Aspose\Cloud\Words;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;
use Aspose\Cloud\Storage\Folder;

class Field
{

    /**
     * Inserts page number field into the document.
     *
     * @param string $fileName Name of the file.
     * @param string $alignment Alignment of page number.
     * @param string $format Format for page numbers.
     * @param boolean $isTop Either True or False.
     * @param integer $setPageNumberOnFirstPage Set value for first page number.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function insertPageNumber($fileName, $alignment, $format, $isTop, $setPageNumberOnFirstPage)
    {
        //check whether files are set or not
        if ($fileName == '')
            throw new Exception('File not specified');

        //Build JSON to post
        $fieldsArray = array('Format' => $format, 'Alignment' => $alignment,
            'IsTop' => $isTop, 'SetPageNumberOnFirstPage' => $setPageNumberOnFirstPage);
        $json = json_encode($fieldsArray);

        //build URI to insert page number
        $strURI = Product::$baseProductUri . '/words/' . $fileName . '/insertPageNumbers';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', 'json', $json);

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            //Save docs on server
            $folder = new Folder();
            $outputStream = $folder->GetFile($fileName);
            $outputPath = AsposeApp::$outPutLocation . $fileName;
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Gets all merge filed names from document.
     *
     * @param string $fileName The name of source file.
     *
     * @return array
     * @throws Exception
     */
    public function getMailMergeFieldNames($fileName)
    {
        //check whether file is set or not
        if ($fileName == '')
            throw new Exception('No file name specified');

        $strURI = Product::$baseProductUri . '/words/' . $fileName . '/mailMergeFieldNames';

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        return $json->FieldNames->Names;
    }

}