<?php
/**
 * Generates new barcodes.
 */
namespace Aspose\Cloud\Barcode;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;

class BarcodeBuilder
{

    /**
     * Generates new barcodes with specific text, symbology, image format,
     * resolution and dimensions.
     *
     * @param string $codeText Text to encode inside barcode.
     * @param string $symbology Type of barcode.
     * @param string $imageFormat Returns an image in the specified format.
     * @param float $xResolution Resolution along X in dpi.
     * @param float $yResolution Resolution along Y in dpi.
     * @param float $xDimension Width of barcode unit (bar or space).
     * @param float $yDimension Height of barcode unit (for 2D barcodes).
     *
     * @return string Returns the file path.
     * @throws Exception
     */

    public function save($codeText, $symbology, $imageFormat = 'png', $xResolution = 0, $yResolution = 0, $xDimension = 0, $yDimension = 0, $codeLocation = null, $folder = null, $storage = null, $name = null, $grUnit = null, $autoSize = null, $barHeight = 0, $imageHeight = 0, $imageWidth = 0, $imageQuality = null, $rotAngle = 0, $topMargin = 0, $bottomMargin = 0, $leftMargin = 0, $rightMargin = 0, $enableChecksum = null)
    {

        //build URI to generate barcode
        $strURI = Product::$baseProductUri . '/barcode' . (strlen($name) <= 0 ? '' : '/' . $name) . '/generate?text=' . $codeText . '&type=' . $symbology . '&format=' . $imageFormat . ($xResolution <= 0 ? '' : '&resolutionX=' . $xResolution) . ($yResolution <= 0 ? '' : '&resolutionY=' . $yResolution) . ($xDimension <= 0 ? '' : '&dimensionX=' . $xDimension) . ($yDimension <= 0 ? '' : '&dimensionY=' . $yDimension) . (strlen($codeLocation) <= 0 ? '' : '&codeLocation=' . $codeLocation) . (strlen($grUnit) <= 0 ? '' : '&grUnit=' . $grUnit) . (strlen($autoSize) <= 0 ? '' : '&autoSize=' . $autoSize) . ($barHeight <= 0 ? '' : '&barHeight=' . $barHeight) . ($imageHeight <= 0 ? '' : '&imageHeight=' . $imageHeight) . ($imageWidth <= 0 ? '' : '&imageWidth=' . $imageWidth) . (strlen($imageQuality) <= 0 ? '' : '&imageQuality=' . $imageQuality) . ($rotAngle <= 0 ? '' : '&rotAngle=' . $rotAngle) . ($topMargin <= 0 ? '' : '&topMargin=' . $topMargin) . ($bottomMargin <= 0 ? '' : '&bottomMargin=' . $bottomMargin) . ($leftMargin <= 0 ? '' : '&leftMargin=' . $leftMargin) . ($rightMargin <= 0 ? '' : '&rightMargin=' . $rightMargin) . (strlen($folder) <= 0 ? '' : '&folder=' . $folder) . (strlen($storage) <= 0 ? '' : '&storage=' . $storage) . (strlen($enableChecksum) <= 0 ? '' : '&enableChecksum=' . $enableChecksum);

        if ((strlen($codeLocation) <= 0) AND (strlen($grUnit) <= 0) AND (strlen($autoSize) <= 0) AND ($barHeight <= 0) AND ($imageHeight <= 0) AND ($imageWidth <= 0) AND (strlen($imageQuality) <= 0) AND ($rotAngle <= 0) AND ($topMargin <= 0) AND ($bottomMargin <= 0) AND ($leftMargin <= 0) AND ($rightMargin <= 0) AND (strlen($folder) <= 0) AND (strlen($storage) <= 0) AND (strlen($name) <= 0) AND (strlen($enableChecksum) <= 0)) {
            //sign URI
            $signedURI = Utils::sign($strURI);
            //get response stream
            $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
            //Save output barcode image
            $outputPath = AsposeApp::$outPutLocation . 'barcode' . $symbology . '.' . $imageFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else {
            //sign URI
            $signedURI = Utils::sign($strURI);
            //get response stream
            $responseStream = Utils::processCommand($signedURI, 'PUT', '', '');
            //build URI to execute mail merge
            $strURI = 'http://api.aspose.com/v1.0/storage/file/' . $name;
            //sign URI
            $signedURI = Utils::sign($strURI);
            //get response stream
            $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
            //Save output barcode image
            $outputPath = AsposeApp::$outPutLocation . 'barcode' . $symbology . '.' . $imageFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        }

    }

}
