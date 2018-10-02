<?php
/**
 * Extract various types of information from the document.
 */
namespace Aspose\Cloud\Pdf;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;

class Extractor
{

    public $fileName = '';

    public function __construct($fileName='')
    {
        $this->fileName = $fileName;
    }

    /**
     * Gets number of images in a specified page.
     *
     * @param string $pageNumber Number of the page.
     *
     * @return integer
     * @throws Exception
     */
    public function getImageCount($pageNumber)
    {


        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/pages/' . $pageNumber . '/images';

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        return count($json->Images->List);
    }

    /**
     * Get the particular image from the specified page with the default image size.
     *
     * @param integer $pageNumber Number of the page.
     * @param integer $imageIndex Index of the image.
     * @param string $imageFormat Returns image in the specified format.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function getImageDefaultSize($pageNumber, $imageIndex, $imageFormat)
    {


        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/pages/' . $pageNumber . '/images/' . $imageIndex . '?format=' . $imageFormat;

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '_' . $imageIndex . '.' . $imageFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Get the particular image from the specified page with the default image size.
     *
     * @param int $pageNumber Number of the page.
     * @param int $imageIndex Index of the page.
     * @param string $imageFormat Returns image in the specified format.
     * @param int $imageWidth Width of the image.
     * @param int $imageHeight Height of the image.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function getImageCustomSize($pageNumber, $imageIndex, $imageFormat, $imageWidth, $imageHeight)
    {


        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/pages/' . $pageNumber . '/images/' . $imageIndex . '?format=' . $imageFormat . '&width=' . $imageWidth . '&height=' . $imageHeight;

        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '_' . $imageIndex . '.' . $imageFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        if ($this->fileName == '') {
            AsposeApp::getLogger()->error(Exception::MSG_NO_FILENAME);
            throw new Exception(Exception::MSG_NO_FILENAME);
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

}