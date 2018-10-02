<?php
/**
 * Created by PhpStorm.
 * User: AssadMahmood
 * Date: 2/24/14
 * Time: 2:59 PM
 */

namespace Aspose\Cloud\Imaging;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;
use Aspose\Cloud\Storage\Folder;

class Image
{


    public $fileName;

    public function __construct($fileName='')
    {
        $this->fileName = $fileName;
    }

    /**
     * Converts Tiff image to Fax compatible format (TIFF-F specification)
     * with scaling and padding.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function convertTiffToFax()
    {


        $strURI = Product::$baseProductUri . '/imaging/tiff/' . $this->getFileName() . '/toFax';

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Appends second tiff image to the original.
     *
     * @param string $appendFile The tiff image file to append.
     *
     * @return string|boolean
     * @throws Exception
     */
    public function appendTiff($appendFile = "")
    {
        //check whether file is set or not
        if ($appendFile == '')
            throw new Exception('No file name specified');

        $strURI = Product::$baseProductUri . '/imaging/tiff/' . $this->getFileName() . '/appendTiff?appendFile=' . $appendFile;

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');

        $json = json_decode($responseStream);

        if ($json->Status == 'OK') {
            $folder = new Folder();
            $outputStream = $folder->getFile($this->getFileName());
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else {
            return false;
        }
    }

    /**
     * Resize Image without Storage.
     *
     * @param integer $backgroundColorIndex Index of the background color.
     * @param integer $pixelAspectRatio Pixel aspect ratio.
     * @param boolean $interlaced Specifies if image is interlaced.
     * @param string $outPath Name of the output file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function resizeImage($inputPath, $newWidth, $newHeight, $outputFormat)
    {
        //check whether files are set or not
        if ($inputPath == '')
            throw new Exception('Base file not specified');

        if ($newWidth == '')
            throw new Exception('New image width not specified');

        if ($newHeight == '')
            throw new Exception('New image height not specified');

        if ($outputFormat == '')
            throw new Exception('Format not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/resize?newWidth=' . $newWidth . '&newHeight=' . $newHeight . '&format=' . $outputFormat;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::uploadFileBinary($signedURI, $inputPath, 'xml', 'POST');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            if ($outputFormat == 'html') {
                $saveFormat = 'zip';
            } else {
                $saveFormat = $outputFormat;
            }

            $outputFilename = Utils::getFileName($inputPath) . '.' . $saveFormat;

            Utils::saveFile($responseStream, AsposeApp::$outPutLocation . $outputFilename);
            return $outputFilename;
        } else
            return $v_output;
    }

    /**
     * Crop Image with Format Change.
     *
     * @param integer $x X position of start point for cropping rectangle.
     * @param integer $y Y position of start point for cropping rectangle.
     * @param integer $width Width of cropping rectangle.
     * @param integer $height Height of cropping rectangle.
     * @param string $outPath Name of the output file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function cropImage($x, $y, $width, $height, $outputFormat, $outPath)
    {
        //check whether files are set or not
        if ($this->getFileName() == '')
            throw new Exception('Base file not specified');

        if ($x == '')
            throw new Exception('X position not specified');

        if ($y == '')
            throw new Exception('Y position not specified');

        if ($width == '')
            throw new Exception('Width not specified');

        if ($height == '')
            throw new Exception('Height not specified');

        if ($outputFormat == '')
            throw new Exception('Format not specified');

        if ($outPath == '')
            throw new Exception('Output file name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/' . $this->getFileName() . '/crop?x=' . $x . '&y=' . $y . '&width=' . $width . '&height=' . $height . '&format=' . $outputFormat . '&outPath=' . $outPath;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            if ($outputFormat == 'html') {
                $saveFormat = 'zip';
            } else {
                $saveFormat = $outputFormat;
            }

            Utils::saveFile($responseStream, AsposeApp::$outPutLocation . $outPath);
            return $outPath;
        } else
            return $v_output;
    }

    /**
     * RotateFlip Image on Storage.
     *
     * @param string $method RotateFlip method.
     * @param string $outputFormat Output file format.
     * @param string $outPath Name of the output file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function rotateImage($method, $outputFormat, $outPath)
    {

        if ($method == '')
            throw new Exception('RotateFlip method not specified');

        if ($outputFormat == '')
            throw new Exception('Format not specified');

        if ($outPath == '')
            throw new Exception('Output file name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/' . $this->getFileName() . '/rotateflip?method=' . $method . '&format=' . $outputFormat . '&outPath=' . $outPath;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            if ($outputFormat == 'html') {
                $saveFormat = 'zip';
            } else {
                $saveFormat = $outputFormat;
            }

            Utils::saveFile($responseStream, AsposeApp::$outPutLocation . $outPath);
            return $outPath;
        } else
            return $v_output;
    }
    
    /**
     * Perform Several Operations on Image
     * 
     * @param string $rotateFlipMethod RotateFlip method.
     * @param integer $newWidth New width of the scaled image.
     * @param integer $newHeight New height of the scaled image.
     * @param integer $xPosition X position of start point for cropping rectangle.
     * @param integer $yPosition Y position of start point for cropping rectangle.
     * @param integer $rectWidth Width of cropping rectangle.
     * @param integer $rectHeight Height of cropping rectangle.
     * @param string $saveFormat Save image in another format.
     * @param string $outPath Path to updated file.
     * 
     * @return boolean|string
     * @throws Exception
     */
    public function updateImage($rotateFlipMethod, $newWidth, $newHeight, $xPosition, $yPosition, $rectWidth, $rectHeight, $saveFormat, $outPath)
    {
        if ($rotateFlipMethod == '')
            throw new Exception('Rotate Flip Method not specified');
        
        if ($newWidth == '')
            throw new Exception('New width not specified');
        
        if ($newHeight == '')
            throw new Exception('New Height not specified');
        
        if ($xPosition == '')
            throw new Exception('X position not specified');
        
        if ($yPosition == '')
            throw new Exception('Y position not specified');
        
        if ($rectWidth == '')
            throw new Exception('Rectangle width not specified');
        
        if ($rectHeight == '')
            throw new Exception('Rectangle Height not specified');
        
        if ($saveFormat == '')
            throw new Exception('Format not specified');
        
        if ($outPath == '')
            throw new Exception('Output file name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/' . $this->getFileName() . '/updateimage?rotateFlipMethod=' . $rotateFlipMethod .
                '&newWidth=' . $newWidth . '&newHeight=' . $newHeight . '&x=' . $xPosition . '&y=' . $yPosition .
                '&rectWidth=' . $rectWidth . '&rectHeight=' . $rectHeight . '&format=' . $saveFormat . '&outPath=' . $outPath;

        //sign URI
        $signedURI = Utils::sign($strURI);
        
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        //$json = json_decode($response);
        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($responseStream, $outputPath);
            
            return $outputPath;
        } else
            return false;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        if ($this->fileName == '') {
            throw new Exception('No File Name Specified');
        }
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }


} 