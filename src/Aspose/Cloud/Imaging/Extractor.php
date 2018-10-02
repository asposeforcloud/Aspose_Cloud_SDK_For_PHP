<?php
/**
 * Deals with image document level aspects.
 */
namespace Aspose\Cloud\Imaging;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;
use Aspose\Cloud\Storage\Folder;

class Extractor
{

    public $fileName = '';

    public function __construct($fileName='')
    {
        $this->fileName = $fileName;
    }

    /**
     * Get TIFF Frame Properties.
     *
     * @param integer $frameId Number of frame.
     *
     * @return array|boolean Returns the document properties.
     * @throws Exception
     */
    public function getTiffFrameProperties($frameId)
    {

        if ($frameId == '')
            throw new Exception('Frame ID not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/' . $this->getFileName() . '/frames/' . $frameId . '/properties';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json;
        else
            return false;
    }

    /**
     * Extract Frame from a Multi-Frame TIFF Image.
     *
     * @param integer $frameId Number of frame.
     * @param string $outPath Path to updated file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function extractFrames($frameId, $outPath)
    {

        if ($frameId == '')
            throw new Exception('Frame ID not specified');

        if ($outPath == '')
            throw new Exception('Output file not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/' . $this->getFileName() . '/frames/' . $frameId . '?saveOtherFrames=false&outPath=' . $outPath;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $folder = new Folder();
            $outputStream = $folder->GetFile($outPath);
            $outputPath = AsposeApp::$outPutLocation . $outPath;
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Resize a TIFF Frame.
     *
     * @param integer $frameId Number of frame.
     * @param integer $newWidth New width of the scaled image.
     * @param integer $newHeight New height of the scaled image.
     * @param string $outPath Path to updated file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function resizeFrame($frameId, $newWidth, $newHeight, $outPath)
    {

        if ($frameId == '')
            throw new Exception('Frame ID not specified');

        if ($newWidth == '')
            throw new Exception('New width not specified');

        if ($newHeight == '')
            throw new Exception('New Height not specified');

        if ($outPath == '')
            throw new Exception('Output file not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/' . $this->getFileName() . '/frames/' . $frameId . '?saveOtherFrames=false&newWidth=' . $newWidth . '&newHeight=' . $newHeight . '&outPath=' . $outPath;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $folder = new Folder();
            $outputStream = $folder->GetFile($outPath);
            $outputPath = AsposeApp::$outPutLocation . $outPath;
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Crop a TIFF Frame.
     *
     * @param integer $frameId Number of the frame.
     * @param integer $x X position of start point for cropping rectangle.
     * @param integer $y Y position of start point for cropping rectangle.
     * @param integer $rectWidth Width of cropping rectangle.
     * @param integer $rectHeight Height of cropping rectangle.
     * @param string $outPath Path to updated file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function cropFrame($frameId, $x, $y, $recWidth, $recHeight, $outPath)
    {

        if ($frameId == '')
            throw new Exception('Frame ID not specified');

        if ($x == '')
            throw new Exception('X position not specified');

        if ($y == '')
            throw new Exception('Y position not specified');

        if ($recWidth == '')
            throw new Exception('Width of cropping rectangle not specified');

        if ($recHeight == '')
            throw new Exception('Height of cropping rectangle not specified');

        if ($outPath == '')
            throw new Exception('Output file not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/' . $this->getFileName() . '/frames/' . $frameId . '?saveOtherFrames=true&$x=' . $x . '&y=' . $y . '&rectWidth=' . $recWidth . '&rectHeight=' . $recHeight . '&outPath=' . $outPath;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $folder = new Folder();
            $outputStream = $folder->GetFile($outPath);
            $outputPath = AsposeApp::$outPutLocation . $outPath;
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * RotateFlip a TIFF Frame.
     *
     * @param integer $frameId Number of frame.
     * @param string $rotateFlipMethod RotateFlip method.
     * @param string $outPath Path to updated file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function rotateFrame($frameId, $rotateFlipMethod, $outPath)
    {

        if ($frameId == '')
            throw new Exception('Frame ID not specified');

        if ($rotateFlipMethod == '')
            throw new Exception('RotateFlip method not specified');

        if ($outPath == '')
            throw new Exception('Output file not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/' . $this->getFileName() . '/frames/' . $frameId . '?saveOtherFrames=false&rotateFlipMethod=' . $rotateFlipMethod . '&outPath=' . $outPath;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $folder = new Folder();
            $outputStream = $folder->GetFile($outPath);
            $outputPath = AsposeApp::$outPutLocation . $outPath;
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Manipulate a Frame and Save the Modified Frame Along with Unmodified Frames.
     *
     * @param integer $frameId Number of frame.
     * @param string $rotateFlipMethod RotateFlip method.
     * @param integer $newWidth New width of the scaled image.
     * @param integer $newHeight New height of the scaled image.
     * @param integer $x X position of start point for cropping rectangle.
     * @param integer $y Y position of start point for cropping rectangle.
     * @param integer $rectWidth Width of cropping rectangle.
     * @param integer $rectHeight Height of cropping rectangle.
     * @param string $outPath Path to updated file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function manipulateFrame($frameId, $rotateFlipMethod, $newWidth, $newHeight, $x, $y, $rectWidth, $rectHeight, $outPath)
    {

        if ($frameId == '')
            throw new Exception('Frame ID not specified');

        if ($rotateFlipMethod == '')
            throw new Exception('RotateFlip method not specified');

        if ($newWidth == '')
            throw new Exception('New width not specified');

        if ($newHeight == '')
            throw new Exception('New height not specified');

        if ($x == '')
            throw new Exception('X position not specified');

        if ($y == '')
            throw new Exception('Y position not specified');

        if ($rectWidth == '')
            throw new Exception('Width of cropping rectangle not specified');

        if ($rectHeight == '')
            throw new Exception('Height of cropping rectangle not specified');

        if ($outPath == '')
            throw new Exception('Output file not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/' . $this->getFileName() . '/frames/' . $frameId . '?saveOtherFrames=false&rotateFlipMethod=' . $rotateFlipMethod . '&newWidth=' . $newWidth . '&newHeight=' . $newHeight . '&x=' . $x . '&y=' . $y . '&rectWidth=' . $rectWidth . '&rectHeight=' . $rectHeight . '&outPath=' . $outPath;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $folder = new Folder();
            $outputStream = $folder->GetFile($outPath);
            $outputPath = AsposeApp::$outPutLocation . $outPath;
            Utils::saveFile($outputStream, $outputPath);
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

}