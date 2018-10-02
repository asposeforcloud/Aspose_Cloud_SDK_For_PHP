<?php
/**
 * Extract various types of information from the document.
 */
namespace Aspose\Cloud\Slides;

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
     * Get comments from a slide.
     *
     * @param integer $slideNo The number of slide.
     * @param string $storageName The presentation storage name.
     * @param string $folderName The presentation folder name.
     *
     * @return object|boolean
     * @throws Exception
     */
    public function getComments($slideNo = '', $storageName = '', $folder = '')
    {
        //check whether file is set or not
        if ($slideNo == '')
            throw new Exception('Missing required parameter slideNo');

        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slideNo . '/comments';
        if ($folder != '') {
            $strURI .= '?folder=' . $folder;
        }
        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Status == 'OK')
            return $json->SlideComments;
        else
            return false;
    }

    /**
     * Gets total number of images in a presentation.
     *
     * @param string $storageName The presentation storage name.
     * @param string $folderName The presentation folder name.
     *
     * @return integer Returns the presentation image count.
     * @throws Exception
     */
    public function getImageCount($storageName = '', $folder = '')
    {


        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/images';
        if ($folder != '') {
            $strURI .= '?folder=' . $folder;
        }
        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        return count($json->Images->List);
    }

    /**
     * Gets number of images in the specified slide.
     *
     * @param integer $slidenumber The number of slide.
     * @param string $storageName The presentation storage name.
     * @param string $folderName The presentation folder name.
     *
     * @return integer Return the slide image count.
     * @throws Exception
     */
    public function getSlideImageCount($slidenumber, $storageName = '', $folder = '')
    {


        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slidenumber . '/images';
        if ($folder != '') {
            $strURI .= '?folder=' . $folder;
        }
        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        return count($json->Images->List);
    }

    /**
     * Gets all shapes from the specified slide.
     *
     * @param integer $slidenumber The number of slide.
     * @param string $storageName The presentation storage name.
     * @param string $folderName The presentation folder name.
     *
     * @return array
     * @throws Exception
     */
    public function getShapes($slidenumber, $storageName = '', $folder = '')
    {


        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slidenumber . '/shapes';
        if ($folder != '') {
            $strURI .= '?folder=' . $folder;
        }
        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        $shapes = array();

        foreach ($json->ShapeList->ShapesLinks as $shape) {

            $signedURI = Utils::sign($shape->Uri->Href);

            $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

            $json = json_decode($responseStream);

            $shapes[] = $json;
        }

        return $shapes;
    }
    
    /**
     * Get a Particular Shape from the Slide.
     * 
     * @param integer $slideNumber The number of slide.
     * @param integer $shapeIndex The index of shape.
     * @param string $storageName The presentation storage name.
     * @param string $folderName The presentation folder name.
     * 
     * @return array|boolean
     * @throws Exception
     */
    public function getShape($slideNumber, $shapeIndex, $storageName = '', $folderName = '') {    
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slideNumber . '/shapes/' . $shapeIndex;
        if ($folderName != '') {
            $strURI .= '?folder=' . $folderName;
        }
        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }
        
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);
        
        if ($json->Code == 200)
            return $json->Shape;
        else 
            return false;
    }

    /**
     * Get color scheme from the specified slide.
     *
     * @param integer $slideNumber The number of slide.
     * @param string $storageName The presentation storage name.
     *
     * @return object
     * @throws Exception
     */
    public function getColorScheme($slideNumber, $storageName = '')
    {


        //Build URI to get color scheme
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slideNumber . '/theme/colorScheme';
        if ($storageName != '') {
            $strURI .= '?storage=' . $storageName;
        }
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        return $json->ColorScheme;
    }

    /**
     * Get font scheme from the specified slide.
     *
     * @param integer $slideNumber The number of slide.
     * @param string $storageName The presentation storage name.
     *
     * @return object
     * @throws Exception
     */
    public function getFontScheme($slideNumber, $storageName = '')
    {


        //Build URI to get font scheme
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slideNumber . '/theme/fontScheme';
        if ($storageName != '') {
            $strURI .= '?storage=' . $storageName;
        }
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        return $json->FontScheme;
    }

    /**
     * Get format scheme from the specified slide.
     *
     * @param integer $slideNumber The number of slide.
     * @param string $storageName The presentation storage name.
     *
     * @return object
     * @throws Exception
     */
    public function getFormatScheme($slideNumber, $storageName = '')
    {


        //Build URI to get format scheme
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slideNumber . '/theme/formatScheme';
        if ($storageName != '') {
            $strURI .= '?storage=' . $storageName;
        }
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        return $json->FormatScheme;
    }

    /**
     * Gets placeholder count from a particular slide.
     *
     * @param integer $slideNumber The number of slide.
     * @param string $storageName The presentation storage name.
     * @param string $folderName The presentation folder name.
     *
     * @return integer
     * @throws Exception
     */
    public function getPlaceholderCount($slideNumber, $storageName = '', $folder = '')
    {


        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slideNumber . '/placeholders';
        if ($folder != '') {
            $strURI .= '?folder=' . $folder;
        }
        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }
        //Build URI to get placeholders
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        return count($json->Placeholders->PlaceholderLinks);
    }

    /**
     * Gets a placeholder from a particular slide.
     *
     * @param integer $slideNumber The number of slide.
     * @param integer $placeholderIndex The index of placeholder.
     * @param string $storageName The presentation storage name.
     * @param string $folderName The presentation folder name.
     *
     * @return object
     * @throws Exception
     */
    public function getPlaceholder($slideNumber, $placeholderIndex, $storageName = '', $folder = '')
    {


        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slideNumber . '/placeholders/' . $placeholderIndex;
        if ($folder != '') {
            $strURI .= '?folder=' . $folder;
        }
        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }
        //Build URI to get placeholders
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        return $json->Placeholder;
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