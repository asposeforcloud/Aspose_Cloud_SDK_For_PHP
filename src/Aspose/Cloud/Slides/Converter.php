<?php
/**
 * Converts pages or document into different formats.
 */
namespace Aspose\Cloud\Slides;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;

class Converter
{

    public $fileName = '';
    public $saveFormat = '';

    public function __construct($fileName='', $saveFormat = 'PPT')
    {
        //set default values
        $this->fileName = $fileName;

        $this->saveFormat = $saveFormat;
    }

    /**
     * Saves a particular slide into various formats with specified width and height.
     *
     * @param integer $slideNumber The number of slide.
     * @param string $imageFormat The image format.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function convertToImage($slideNumber, $imageFormat)
    {


        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slideNumber . '?format=' . $imageFormat;

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $v_output = Utils::validateOutput($responseStream);
        if ($v_output == '') {
            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '.' . $imageFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else {
            return $v_output;
        }
    }

    /**
     * Convert a particular slide into various formats with specified width and height.
     *
     * @param integer $slideNumber The slide number.
     * @param string $imageFormat The image format.
     * @param integer $width The width of image.
     * @param integer $height The height of image.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function convertToImagebySize($slideNumber, $imageFormat, $width, $height)
    {


        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slideNumber . '?format=' . $imageFormat . '&width=' . $width . '&height=' . $height;

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $v_output = Utils::validateOutput($responseStream);
        if ($v_output == '') {
            $outputPath = AsposeApp::$outPutLocation . 'output.' . $imageFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else {
            return $v_output;
        }
    }

    /**
     * Convert a document to the specified format.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function convert()
    {


        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '?format=' . $this->saveFormat;

        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            if ($this->saveFormat == 'html') {
                $save_format = 'zip';
            } else {
                $save_format = $this->saveFormat;
            }
            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '.' . $save_format;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else {
            return $v_output;
        }
    }
    
    /**
     * Convert a document to SaveFormat without using Aspose storage.
     * 
     * @param string $inputPath The path of source file.
     * @param string $outputFile Path where you want to file after conversion.
     * @param string $saveFormat New file format.
     * 
     * @return string|boolean Return the file path.
     * @throws Exception
     */
    public function convertLocalFile($inputPath, $outputFile, $saveFormat) {
        if ($inputPath == '')
            throw new Exception('Please specify input file');
            
        if ($outputFile == '') 
            throw new Exception('Please specify output file');
            
        if ($saveFormat == '') 
            throw new Exception('Please specify save format');
        
        $strURI = Product::$baseProductUri . '/slides/convert?format=' . $saveFormat;

        $signedURI = Utils::sign($strURI);
        
        $responseStream = Utils::uploadFileBinary($signedURI, $inputPath, 'xml');        

        $v_output = Utils::validateOutput($responseStream);
        
        if ($v_output === '') {
            if ($saveFormat == 'html') {
                $outputFormat = 'zip';
            } else {
                $outputFormat = $saveFormat;
            }
            
            $outputFileName = Utils::getFileName($outputFile) . '.' . $outputFormat;
            Utils::saveFile($responseStream, AsposeApp::$outPutLocation . $outputFileName);
            return $outputFileName;
        } else {
            return $v_output;
        }
    }
    
    /**
     * Convert PowerPoint Documents to other File Formats with Additional Settings
     * 
     * @param type $saveFormat Return the presentation in the specified format. 
     * @param type $textCompression Specifies compression type to be used for all textual content in the document. 
     * @param type $embedFullFonts Determines if all characters of font should be embedded or only used subset. 
     * @param type $compliance Desired conformance level for generated PDF document.
     * @param type $jpegQuality Value determining the quality of the JPEG images inside PDF document. 
     * @param type $saveMetafilesAsPng True to convert all metafiles used in a presentation to the PNG images. 
     * @param type $pdfPassword Setting user password to protect the PDF document. 
     * @param type $embedTrueTypeFontsForASCII Determines service will embed common fonts for ASCII.
     * 
     * @return string Returns the file path.
     */
    public function convertWithAdditionalSettings($saveFormat = 'pdf', $textCompression = '', $embedFullFonts = '', $compliance ='', $jpegQuality = '', $saveMetafilesAsPng = '', $pdfPassword = '', $embedTrueTypeFontsForASCII = '')
    {
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '?format=' . $saveFormat;
        if ($textCompression != '')
            $strURI .= '&TextCompression=' . $textCompression;
        
        if ($embedFullFonts != '')
            $strURI .= '&EmbedFullFonts=' . $embedFullFonts;
        
        if ($compliance != '')
            $strURI .= '&Compliance=' . $compliance;
        
        if ($jpegQuality != '')
            $strURI .= '&JpegQuality=' . $jpegQuality;
        
        if ($saveMetafilesAsPng != '')
            $strURI .= '&SaveMetafilesAsPng=' . $saveMetafilesAsPng;
        
        if ($pdfPassword != '')
            $strURI .= '&PdfPassword=' . $pdfPassword;
        
        if ($embedTrueTypeFontsForASCII != '')
            $strURI .= '&EmbedTrueTypeFontsForASCII=' . $embedTrueTypeFontsForASCII;

        $signedURI = Utils::sign($strURI);
        
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $outputPath = AsposeApp::$outPutLocation . Utils::getFileName($this->getFileName()) . '.' . $saveFormat;
            Utils::saveFile($responseStream, $outputPath);
            return $outputPath;
        } else {
            return $v_output;
        }
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

    /**
     * @return string
     */
    public function getSaveFormat()
    {
        return $this->saveFormat;
    }

    /**
     * @param string $saveFormat
     */
    public function setSaveFormat($saveFormat)
    {
        $this->saveFormat = $saveFormat;
        return $this;
    }

}