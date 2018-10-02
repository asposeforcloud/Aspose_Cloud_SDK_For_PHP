<?php
/**
 * Deals with PowerPoint document level aspects.
 */
namespace Aspose\Cloud\Slides;

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
        //set default values
        $this->fileName = $fileName;
    }

    /**
     * Change slide position.
     *
     * @param integer $old_position The old slide position.
     * @param integer $new_position The new slid position.
     * @param string $storageName The presentation storage name.
     * @param string $folder The presentation folder name.
     *
     * @return object|boolean
     * @throws Exception
     */
    public function changeSlidePosition($old_position = '', $new_position = '', $storageName = '', $folder = '')
    {
        if ($old_position == '' || $new_position == '')
            throw new Exception('Missing Required Params');


        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides?OldPosition=' . $old_position . '&NewPosition=' . $new_position;
        if ($folder != '') {
            $strURI .= 'folder=' . $folder;
        }

        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($responseStream);


        if ($json->Code == 200)
            return $json->Slides;
        else
            return false;
    }

    /**
     * Clone slide in a presentation.
     *
     * @param integer $slideno The slide number.
     * @param integer $position Position of the slide.
     * @param string $storageName The presentation storage name.
     * @param string $folder The presentation folder name.
     *
     * @return object|boolean
     * @throws Exception
     */
    public function cloneSlide($slideno = '', $position = '', $storageName = '', $folder = '')
    {
        if ($position == '')
            throw new Exception('Position not speciefied.');

        if ($slideno == '')
            throw new Exception('Slide not speciefied.');


        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides?SlideToClone=' . $slideno . '&Position=' . $position;
        if ($folder != '') {
            $strURI .= 'folder=' . $folder;
        }

        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->Slides;
        else
            return false;
    }

    /**
     * Add new slide in presentation.
     *
     * @param integer $position The position of slide.
     * @param string $storageName The presentation storage name.
     * @param string $folder The presentation folder name.
     *
     * @return object|boolean
     * @throws Exception
     */
    public function addSlide($position = '', $storageName = '', $folder = '')
    {
        if ($position == '')
            throw new Exception('Position not speciefied.');


        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides?Position=' . $position;
        if ($folder != '') {
            $strURI .= 'folder=' . $folder;
        }

        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->Slides;
        else
            return false;
    }

    /**
     * Split presentation.
     *
     * @param integer $from The slide number.
     * @param integer $to The slide number.
     * @param string $destination The desitination folder name.
     * @param string $format Return the presentation in the specified format.
     * @param string $storageName The presenatation storage name.
     * @param string $folder The presentation folder name.
     *
     * @return string|boolean
     * @throws Exception
     */
    public function splitPresentation($from = '', $to = '', $destination = '', $format = '', $storageName = '', $folder = '')
    {
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/split?';
        if ($folder != '') {
            $strURI .= '&folder=' . $folder;
        }

        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }

        if ($from != '') {
            $strURI .= '&from=' . $from;
        }

        if ($to != '') {
            $strURI .= '&to=' . $to;
        }

        if ($destination != '') {
            $strURI .= '&destFolder=' . $destination;
        }

        if ($format != '') {
            $strURI .= '&format=' . $format;
        }

        $strURI = rtrim($strURI, '?');
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            foreach ($json->SplitResult->Slides as $splitPage) {
                $splitFileName = basename($splitPage->Href);

                //build URI to download split slides
                $strURI = Product::$baseProductUri . '/storage/file/' . $splitFileName;
                //sign URI
                $signedURI = Utils::Sign($strURI);
                $responseStream = Utils::processCommand($signedURI, "GET", "", "");
                //save split slides
                $outputFile = AsposeApp::$outPutLocation . $splitFileName;
                Utils::saveFile($responseStream, $outputFile);
            }
        } else
            return false;
    }

    /**
     * Merge multiple presentations into single presentation.
     *
     * @param array $presentationsList The list of presenation.
     * @param string $storageName The presentation storage name.
     * @param string $folder The presenation folder name.
     *
     * @return object|boolean
     * @throws Exception
     */
    public function mergePresentations($presentationsList = array(), $storageName = '', $folder = '')
    {
        if (!is_array($presentationsList) || empty($presentationsList))
            throw new Exception('Presentation list not speciefied');


        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/merge';
        if ($folder != '') {
            $strURI .= '?folder=' . $folder;
        }

        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }
        $signedURI = Utils::sign($strURI);

        $json_data = json_encode($presentationsList);

        $responseStream = Utils::processCommand($signedURI, 'PUT', 'json', $json_data);

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->Document;
        else
            return false;
    }

    /**
     * Merge multiple presentations into single presentation.
     *
     * @param array $fileNames The presentation file names as known on the given storage
     * @param string $storageName The presentation storage name.
     * @param string $folder The presentation folder name.
     *
     * @return object|false
     * @throws Exception
     */
    public function mergePresentationsByFileNames($fileNames = array(), $storageName = '', $folder = '')
    {
        if (!is_array($fileNames) || empty($fileNames)) {
            throw new Exception('Presentation file names are not speciefied');
        }

        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/merge';
        if ($folder != '') {
            $strURI .= '?folder=' . $folder;
        }

        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }
        $signedURI = Utils::sign($strURI);

        $json_data = json_encode(array('PresentationPaths' => $fileNames));
        $responseStream = Utils::processCommand($signedURI, 'POST', 'json', $json_data);

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return $json->Document;
        } else {
            return false;
        }
    }

    /**
     * Create empty presenation and store it on Aspose cloud storage.
     *
     * @param string $storageName The presentation storage name.
     * @param string $folder The presenation folder name.
     *
     * @return object|boolean
     * @throws Exception
     */
    public function createEmptyPresentation($storageName = '', $folder = '')
    {
        //Build URI to get a list of slides
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName();
        if ($folder != '') {
            $strURI .= '?folder=' . $folder;
        }

        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'PUT', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 201)
            return $json->Document;
        else
            return false;
    }

    /**
     * Finds the slide count of the specified PowerPoint document.
     *
     * @param string $storageName The presentation storage name.
     * @param string $folder The presenation folder name.
     *
     * @return integer
     * @throws Exception
     */
    public function getSlideCount($storageName = '', $folder = '')
    {


        //Build URI to get a list of slides
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides';
        if ($folder != '') {
            $strURI .= '?folder=' . $folder;
        }

        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        return count($json->Slides->SlideList);
    }

    /**
     * Replaces all instances of old text with new text in a presentation or a particular slide.
     *
     * @param string $oldText The old text.
     * @param string $newText The new text.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function replaceText()
    {
        $parameters = func_get_args();

        //set parameter values
        if (count($parameters) == 2) {
            $oldText = $parameters[0];
            $newText = $parameters[1];
        } else if (count($parameters) == 3) {
            $oldText = $parameters[0];
            $newText = $parameters[1];
            $slideNumber = $parameters[2];
        } else
            throw new Exception('Invalid number of arguments');



        //Build URI to replace text
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . ((isset($parameters[2])) ? '/slides/' . $slideNumber : '') .
            '/replaceText?oldValue=' . $oldText . '&newValue=' . $newText . '&ignoreCase=true';

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            //Save doc on server
            $folder = new Folder();
            $outputStream = $folder->GetFile($this->getFileName());
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }

    /**
     * Gets all the text items in a slide or presentation.
     *
     * @param integer $slideNumber The number of slide.
     * @param string $withEmpty
     *
     * @return array
     * @throws Exception
     */
    public function getAllTextItems()
    {
        $parameters = func_get_args();

        //set parameter values
        if (count($parameters) == 2) {
            $slideNumber = $parameters[0];
            $withEmpty = $parameters[1];
        }




        //Build URI to get all text items
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() .
            ((isset($parameters[0])) ? '/slides/' . $slideNumber . '/textItems?withEmpty=' . $withEmpty : '/textItems');

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        return $json->TextItems->Items;
    }

    /**
     * Deletes all slides from a presentation.
     *
     * @param string $storageName The presentation storage name.
     * @param string $folder The presenation folder name.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function deleteAllSlides($storageName = '', $folder = '')
    {


        //Build URI to replace text
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides';
        if ($folder != '') {
            $strURI .= '?folder=' . $folder;
        }
        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            //Save doc on server
            $folder = new Folder();
            $outputStream = $folder->GetFile($this->getFileName());
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        } else
            return $v_output;
    }
    
    /**
     * Delete a Slides from a PowerPoint Presentation.
     * 
     * @param integer $slideNumber The number of slide.
     * 
     * @return boolean
     * @throws Exception
     */
    public function deleteSlide($slideNumber) {    
        if ($slideNumber == '')
            throw new Exception('Slide number not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slideNumber;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return true;
        else
            return false;
    }

    /**
     * Get Document's properties.
     *
     * @return array|boolean
     * @throws Exception
     */
    public function getDocumentProperties()
    {


        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/documentProperties';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);


        if ($json->Code == 200)
            return $json->DocumentProperties->List;
        else
            return false;
    }

    /**
     * Get Resource Properties information like document source format,
     * IsEncrypted, IsSigned and document properties.
     *
     * @param string $propertyName The name of property.
     *
     * @return object|boolean
     * @throws Exception
     */
    public function getDocumentProperty($propertyName)
    {

        if ($propertyName == '')
            throw new Exception('Property Name not specified');

        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/presentation/documentProperties/' . $propertyName;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);


        if ($json->Code == 200)
            return $json->DocumentProperty;
        else
            return false;
    }

    /**
     * Remove All Document's properties.
     *
     * @return boolean
     * @throws Exception
     */
    public function removeAllProperties()
    {


        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/documentProperties';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'DELETE');

        $json = json_decode($responseStream);
        if (is_object($json)) {
            if ($json->Code == 200)
                return true;
            else
                return false;
        }

        return true;
    }

    /**
     * Delete a document property
     *
     * @param string $propertyName The name of property.
     *
     * @return boolean
     * @throws Exception
     */
    public function deleteDocumentProperty($propertyName)
    {

        if ($propertyName == '')
            throw new Exception('Property Name not specified');

        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/documentProperties/' . $propertyName;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return true;
        else
            return false;
    }

    /**
     * Set document property.
     *
     * @param string $propertyName The name of property.
     * @param string $propertyValue The value of property.
     *
     * @return array|boolean
     * @throws Exception
     */
    public function setProperty($propertyName, $propertyValue)
    {

        if ($propertyName == '')
            throw new Exception('Property Name not specified');

        if ($propertyValue == '')
            throw new Exception('Property Value not specified');

        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/documentProperties/' . $propertyName;

        $put_data_arr['Value'] = $propertyValue;

        $put_data = json_encode($put_data_arr);

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'PUT', 'json', $put_data);

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return $json->DocumentProperty;
        else
            return false;
    }

    /**
     * Add custom document properties.
     *
     * @param array $propertiesList The list of property.
     *
     * @return array
     * @throws Exception
     */
    public function addCustomProperty($propertiesList)
    {

        if ($propertiesList == '')
            throw new Exception('Properties not specified');


        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/documentProperties';

        $put_data = json_encode($propertiesList);

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'PUT', 'json', $put_data);

        $json = json_decode($responseStream);

        return $json;
    }

    /**
     * saves the document into various formats.
     *
     * @param string $outputPath The output directory path.
     * @param string $saveFormat Return the presentation in the specified format.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function saveAs($outputPath, $saveFormat, $jpegQuality = '', $storageName = '', $folder = '')
    {


        if ($outputPath == '')
            throw new Exception('Output path not specified');

        if ($saveFormat == '')
            throw new Exception('Save format not specified');


        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '?format=' . $saveFormat;
        if ($folder != '') {
            $strURI .= '&folder=' . $folder;
        }
        if ($storageName != '') {
            $strURI .= '&storage=' . $storageName;
        }
        if ($jpegQuality != '') {
            $strURI .= '&jpegQuality=' . $jpegQuality;
        }
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $output = $outputPath . Utils::getFileName($this->getFileName()) . '.' . $saveFormat;
            Utils::saveFile($responseStream, $output);
            return $output;
        } else
            return $v_output;
    }

    /**
     * Saves a particular slide into various formats.
     *
     * @param integer $slideNumber The slide number.
     * @param string $outputPath The output directory path.
     * @param string $saveFormat Return the presentation in the specified format.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function saveSlideAs($slideNumber, $outputPath, $saveFormat)
    {


        if ($outputPath == '')
            throw new Exception('Output path not specified');

        if ($saveFormat == '')
            throw new Exception('Save format not specified');

        if ($slideNumber == '')
            throw new Exception('Slide number not specified');


        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slideNumber . '?format=' . $saveFormat;

        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $output = $outputPath . Utils::getFileName($this->getFileName()) . '_' . $slideNumber . '.' . $saveFormat;
            Utils::saveFile($responseStream, $output);
            return $output;
        } else
            return $v_output;
    }
    
    /**
     * Delete Background of a PowerPoint Slide.
     * 
     * @param integer $slideNumber The number of slide.
     * 
     * @return boolean
     * @throws Exception
     */
    public function deleteBackground($slideNumber) {
        if ($slideNumber == '')
            throw new Exception('Slide number not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slideNumber .'/background';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200)
            return true;
        else
            return false;
    }
    
    /**
     * Get Background of a PowerPoint Slide.
     * 
     * @param integer $slideNumber The number of slide.
     * 
     * @return object|boolean
     * @throws Exception
     */
    public function getBackground($slideNumber) {        
        if ($slideNumber == '')
            throw new Exception('Slide number not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slideNumber .'/background';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);
        
        if ($json->Code == 200)
            return $json->Background;
        else
            return false;
    }
    
    /**
     * Get Aspect Ratio of a PowerPoint Slide
     * 
     * @param type $slideNumber The number of slide.
     * 
     * @return float|boolean
     * @throws Exception
     */
    public function aspectRatio($slideNumber)
    {
        if ($slideNumber == '')
            throw new Exception('Slide number not specified');

        //build URI
        $strURI = Product::$baseProductUri . '/slides/' . $this->getFileName() . '/slides/' . $slideNumber;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $response = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($response);
        
        if ($json->Code == 200)
            return $json->Slide->Width / $json->Slide->Height;
        else
            return false;
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