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

class Document
{

    public $fileName = '';

    public function __construct($fileName='')
    {
        $this->fileName = $fileName;
    }

    /**
     * Get Image Properties.
     *
     * @return array|boolean Returns the image properties.
     * @throws Exception
     */
    public function getProperties()
    {
        //build URI
        $strURI = Product::$baseProductUri . '/imaging/' . $this->getFileName() . '/properties';

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
     * Update BMP Image Properties on Aspose cloud storage.
     *
     * @param integer $bitsPerPixel Color depth.
     * @param integer $horizontalResolution New horizontal resolution.
     * @param integer $verticalResolution New vertical resolution.
     * @param string $outPath Name of the output file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function updateBMPProperties($bitsPerPixel, $horizontalResolution, $verticalResolution, $outPath)
    {
        if ($bitsPerPixel == '')
            throw new Exception('Color Depth not specified');

        if ($horizontalResolution == '')
            throw new Exception('Horizontal Resolution not specified');

        if ($verticalResolution == '')
            throw new Exception('Vertical Resolution not specified');

        if ($outPath == '')
            throw new Exception('Output file name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/' . $this->getFileName() . '/bmp?bitsPerPixel=' . $bitsPerPixel . '&horizontalResolution=' . $horizontalResolution . '&verticalResolution=' . $verticalResolution . '&outPath=' . $outPath;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', 'json', '');

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
     * Update BMP Image Properties Without Storage.
     *
     * @param integer $bitsPerPixel Color depth.
     * @param integer $horizontalResolution New horizontal resolution.
     * @param integer $verticalResolution New vertical resolution.
     * @param string $outPath Name of the output file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function updateBMPPropertiesFromLocalFile($inputPath, $bitsPerPixel, $horizontalResolution, $verticalResolution, $outPath)
    {
        //check whether files are set or not
        if ($inputPath == '')
            throw new Exception('Input file not specified');

        if ($bitsPerPixel == '')
            throw new Exception('Color Depth not specified');

        if ($horizontalResolution == '')
            throw new Exception('Horizontal Resolution not specified');

        if ($verticalResolution == '')
            throw new Exception('Vertical Resolution not specified');

        if ($outPath == '')
            throw new Exception('Output file name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/bmp?bitsPerPixel=' . $bitsPerPixel . '&horizontalResolution=' . $horizontalResolution . '&verticalResolution=' . $verticalResolution;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::uploadFileBinary($signedURI, $inputPath, 'xml', 'POST');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            Utils::saveFile($responseStream, AsposeApp::$outPutLocation . $outPath);
            return $outPath;
        } else {
            return $v_output;
        }
    }

    /**
     * Update GIF Image Properties on Aspose cloud storage.
     *
     * @param integer $backgroundColorIndex Index of the background color.
     * @param integer $pixelAspectRatio Pixel aspect ratio.
     * @param boolean $interlaced Specifies if image is interlaced.
     * @param string $outPath Name of the output file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function updateGIFProperties($backgroundColorIndex, $pixelAspectRatio, $interlaced, $outPath)
    {

        if ($backgroundColorIndex == '')
            throw new Exception('Background color index not specified');

        if ($pixelAspectRatio == '')
            throw new Exception('Pixel aspect ratio not specified');

        if ($outPath == '')
            throw new Exception('Output file name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/' . $this->getFileName() . '/gif?backgroundColorIndex=' . $backgroundColorIndex . '&pixelAspectRatio=' . $pixelAspectRatio . '&interlaced=' . $interlaced . '&outPath=' . $outPath;

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
     * Update GIF Image Properties without storage.
     *
     * @param integer $backgroundColorIndex Index of the background color.
     * @param integer $pixelAspectRatio Pixel aspect ratio.
     * @param boolean $interlaced Specifies if image is interlaced.
     * @param string $outPath Name of the output file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function updateGIFPropertiesFromLocalFile($inputPath, $backgroundColorIndex, $pixelAspectRatio, $interlaced, $outPath)
    {
        //check whether files are set or not
        if ($inputPath == '')
            throw new Exception('Input file not specified');

        if ($backgroundColorIndex == '')
            throw new Exception('Background color index not specified');

        if ($pixelAspectRatio == '')
            throw new Exception('Pixel aspect ratio not specified');

        if ($outPath == '')
            throw new Exception('Output file name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/gif?backgroundColorIndex=' . $backgroundColorIndex . '&pixelAspectRatio=' . $pixelAspectRatio;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::uploadFileBinary($signedURI, $inputPath, 'xml', 'POST');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            Utils::saveFile($responseStream, AsposeApp::$outPutLocation . $outPath);
            return $outPath;
        } else {
            return $v_output;
        }
    }

    /**
     * Update JPG Image Properties on Aspose cloud storage.
     *
     * @param integer $backgroundColorIndex Index of the background color.
     * @param integer $pixelAspectRatio Pixel aspect ratio.
     * @param boolean $interlaced Specifies if image is interlaced.
     * @param string $outPath Name of the output file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function updateJPGProperties($quality, $compressionType, $outPath)
    {

        if ($quality == '')
            throw new Exception('Quality not specified');

        if ($compressionType == '')
            throw new Exception('Compression Type not specified');

        if ($outPath == '')
            throw new Exception('Output file name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/' . $this->getFileName() . '/jpg?quality=' . $quality . '&compressionType=' . $compressionType . '&outPath=' . $outPath;

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
     * Update JPG Image Properties on Aspose cloud storage.
     *
     * @param integer $backgroundColorIndex Index of the background color.
     * @param integer $pixelAspectRatio Pixel aspect ratio.
     * @param boolean $interlaced Specifies if image is interlaced.
     * @param string $outPath Name of the output file.
     *
     * @return array|boolean Returns the file path.
     * @throws Exception
     */
    public function updateJPGPropertiesFromLocalFile($inputPath, $quality, $compressionType, $outPath)
    {
        //check whether files are set or not
        if ($inputPath == '')
            throw new Exception('Input file not specified');

        if ($quality == '')
            throw new Exception('Quality not specified');

        if ($compressionType == '')
            throw new Exception('Compression Type not specified');

        if ($outPath == '')
            throw new Exception('Output file name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/jpg?quality=' . $quality . '&compressionType=' . $compressionType . '&outPath=' . $outPath;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::uploadFileBinary($signedURI, $inputPath, 'xml', 'POST');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            Utils::saveFile($responseStream, AsposeApp::$outPutLocation . $outPath);
            return $outPath;
        } else {
            return $v_output;
        }
    }

    /**
     * Update GIF Image Properties on Aspose cloud storage.
     *
     * @param integer $backgroundColorIndex Index of the background color.
     * @param integer $pixelAspectRatio Pixel aspect ratio.
     * @param boolean $interlaced Specifies if image is interlaced.
     * @param string $outPath Name of the output file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function updateTIFFProperties($resolutionUnit, $newWidth, $newHeight, $horizontalResolution, $verticalResolution, $outPath)
    {

        if ($resolutionUnit == '')
            throw new Exception('Resolution unit not specified');

        if ($newWidth == '')
            throw new Exception('New image width not specified');

        if ($newHeight == '')
            throw new Exception('New image height not specified');

        if ($horizontalResolution == '')
            throw new Exception('Horizontal resolution not specified');

        if ($verticalResolution == '')
            throw new Exception('Vertical resolution not specified');

        if ($outPath == '')
            throw new Exception('Output file name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/' . $this->getFileName() . '/tiff?resolutionUnit=' . $resolutionUnit . '&newWidth=' . $newWidth . '&newHeight=' . $newHeight . '&horizontalResolution=' . $horizontalResolution . '&verticalResolution=' . $verticalResolution . '&outPath=' . $outPath;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');

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
     * Update TIFF Image Properties Without Storage.
     *
     * @param string $inputPath Input file path.
     * @param string $compression Tiff compression.
     * @param integer $backgroundColorIndex Index of the background color.
     * @param integer $pixelAspectRatio Pixel aspect ratio.
     * @param boolean $interlaced Specifies if image is interlaced.
     * @param string $outPath Name of the output file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function updateTIFFPropertiesFromLocalFile($inputPath, $compression, $resolutionUnit, $newWidth, $newHeight, $horizontalResolution, $verticalResolution, $outPath)
    {
        if ($inputPath == '')
            throw new Exception('Input file not specified');
        
        if ($compression == '')
            throw new Exception('Compression not specified');
        
        if ($resolutionUnit == '')
            throw new Exception('Resolution unit not specified');

        if ($newWidth == '')
            throw new Exception('New image width not specified');

        if ($newHeight == '')
            throw new Exception('New image height not specified');

        if ($horizontalResolution == '')
            throw new Exception('Horizontal resolution not specified');

        if ($verticalResolution == '')
            throw new Exception('Vertical resolution not specified');

        if ($outPath == '')
            throw new Exception('Output file name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/tiff?compression=' . $compression . '&resolutionUnit=' . $resolutionUnit . '&newWidth=' . $newWidth . '&newHeight=' . $newHeight . '&horizontalResolution=' . $horizontalResolution . '&verticalResolution=' . $verticalResolution . '&outPath=' . $outPath;

        //sign URI
        $signedURI = Utils::sign($strURI);
        
        $responseStream = Utils::uploadFileBinary($signedURI, $inputPath, 'xml', 'POST');

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
     * Update PSD Image Properties on Aspose cloud storage.
     *
     * @param integer $channelsCount Count of channels.
     * @param string $compression Compression method.
     * @param string $outPath Name of the output file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function updatePSDProperties($channelsCount, $compression, $outPath)
    {

        if ($channelsCount == '')
            throw new Exception('Channels count not specified');

        if ($compression == '')
            throw new Exception('Compression method not specified');

        if ($outPath == '')
            throw new Exception('Output file name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/' . $this->getFileName() . '/psd?channelsCount=' . $channelsCount . '&compression=' . $compression . '&outPath=' . $outPath;

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
     * Update PSD Image Properties without storage.
     *
     * @param integer $channelsCount Count of channels.
     * @param string $compression Compression method.
     * @param string $outPath Name of the output file.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function updatePSDPropertiesFromLocalFile($inputPath, $channelsCount, $compression, $outPath)
    {

        if ($channelsCount == '')
            throw new Exception('Channels count not specified');

        if ($compression == '')
            throw new Exception('Compression method not specified');

        if ($outPath == '')
            throw new Exception('Output file name not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/imaging/psd?channelsCount=' . $channelsCount . '&compression=' . $compression . '&outPath=' . $outPath;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::uploadFileBinary($signedURI, $inputPath, 'xml', 'POST');

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