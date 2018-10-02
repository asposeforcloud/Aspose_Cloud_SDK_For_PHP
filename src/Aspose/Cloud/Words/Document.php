<?php
/**
 * Deals with Word document level aspects.
 */
namespace Aspose\Cloud\Words;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Event\SplitPageEvent;
use Aspose\Cloud\Storage\Folder;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Document {

    public $fileName = '';

    public function __construct($fileName='')
    {
        $this->fileName = $fileName;
    }

    /**
     * Update all document fields.
     * 
     * @return boolean
     * @throws Exception
     */
    public function updateFields()
    {
        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/updateFields';
        
        AsposeApp::getLogger()->info('WordsDocument updateFields call will be made', array(
            'call-uri' => $strURI,
        ));

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return true;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * Reject all tracking changes.
     * 
     * @return boolean
     * @throws Exception
     */
    public function rejectTrackingChanges()
    {
        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/revisions/rejectAll';

        AsposeApp::getLogger()->info('WordsDocument rejectTrackingChanges call will be made', array(
            'call-uri' => $strURI,
        ));
        
        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return true;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * Accept all tracking changes.
     * 
     * @return boolean
     * @throws Exception
     */
    public function acceptTrackingChanges()
    {
        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/revisions/acceptAll';
        
        AsposeApp::getLogger()->info('WordsDocument acceptTrackingChanges call will be made', array(
            'call-uri' => $strURI,
        ));

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return true;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * Get Document's stats. Add 'includeTextInShapes' or 'includeFootnotes' booleans to determine or these
     * words should be added to the word count.
     *
     * Make sure the boolean options are strings, (e.g. true should be 'true').
     * 
     * @link http://www.aspose.com/docs/display/wordscloud/statistics
     *
     * @param array $options
     * @return null|object
     * @throws Exception
     */
    public function getStats(array $options = array())
    {
        $resolver = new OptionsResolver();
        $resolver
            ->setDefaults(array(
                'includeTextInShapes' => 'true',
            ))
            ->setDefined(array(
                'includeFootnotes', 'includeComments',
            ))
        ;
        $options = $resolver->resolve($options);

        //build URI to get document statistics including resolved parameters
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/statistics?' . http_build_query($options);
        
        AsposeApp::getLogger()->info('WordsDocument getStats call will be made', array(
            'call-uri' => $strURI,
        ));

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return $json->StatData;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * @param array $options that will get processed using a OptionsResolver
     * <ul>
     *  <li>'from' => (int) page number,</li>
     *  <li>'to' => (int) page number,</li>
     *  <li>'format' => (string) Returns document in the specified format,</li>
     *  <li>'storageName' => (string) Name of the storage,</li>
     *  <li>'folder' => (string) Name of the folder,</li>
     *  <li>'zipOutput' => (bool) save the results as .zip file,</li>
     * </ul>
     *
     * @return string|boolean
     * @throws Exception|InvalidOptionsException
     * @see OptionsResolver
     */
    public function splitDocument(array $options=array())
    {
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/split?';

        $resolver = new OptionsResolver();
        $resolver->setDefined(array(
            'from',
            'to',
            'format',
            'storage',
            'folder',
            'zipOutput',
        ));
        $options = $resolver->resolve($options);

        $strURI .=  http_build_query($options);
        
        AsposeApp::getLogger()->info('WordsDocument splitDocument call will be made', array(
            'call-uri' => $strURI,
        ));
        
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', '', '');
        $json = json_decode($responseStream);

        if ($json->Code == 200) {

            // Just return the json in case of a zip result
            if (isset($options['zipOutput'])) {
                AsposeApp::getLogger()->info('zipOutput found, so return entire splitResult');
                return $json->SplitResult;
            }
            
            AsposeApp::getLogger()->info('Separately save each of the split pages');

            $dispatcher = AsposeApp::getEventDispatcher();
            foreach ($json->SplitResult->Pages as $pageNumber => $splitPage) {
                $splitFileName = basename($splitPage->Href);

                //build URI to download split slides
                $strURI = Product::$baseProductUri . '/storage/file/' . $splitFileName;
                //sign URI
                $signedURI = Utils::Sign($strURI);
                $responseStream = Utils::processCommand($signedURI, "GET", "", "");

                //save split slides
                $outputFile = AsposeApp::$outPutLocation . $splitFileName;
                Utils::saveFile($responseStream, $outputFile);

                $event = new SplitPageEvent($outputFile, $pageNumber +1);
                $dispatcher->dispatch(SplitPageEvent::PAGE_IS_SPLIT, $event);
            }
            return $json->SplitResult->Pages;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * Appends a list of documents to this one.
     * 
     * @param string $appendDocs List of documents to append.
     * @param string $importFormatModes Documents import format modes.
     * @param string $sourceFolder Name of the folder where documents are present.
     * 
     * @return string Returns the file path.
     * @throws Exception
     */
    public function appendDocument($appendDocs, $importFormatModes, $sourceFolder)
    {
        //check whether required information is complete
        if (count($appendDocs) != count($importFormatModes))
            throw new Exception('Please specify complete documents and import format modes');

        $post_array = array();
        $i = 0;
        foreach ($appendDocs as $doc) {
            $post_array[] = array("Href" => (($sourceFolder != "" ) ? $sourceFolder . "\\" . $doc : $doc), "ImportFormatMode" => $importFormatModes[$i]);
            $i++;
        }
        $data = array("DocumentEntries" => $post_array);
        $json = json_encode($data);

        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/appendDocument';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', 'json', $json);

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            //Save merged docs on server
            $folder = new Folder();
            $outputStream = $folder->GetFile($sourceFolder . (($sourceFolder == '') ? '' : '/') . $this->getFileName());
            $outputPath = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($outputStream, $outputPath);
            return $outputPath;
        }
        
        AsposeApp::getLogger()->warning('Error occured, output could not be validated.', array(
            'v-output' => $v_output,
        ));
        return $v_output;
    }

    /**
     * Get Resource Properties information like document source format, 
     * IsEncrypted, IsSigned and document properties
     * 
     * @return object|boolean
     * @throws Exception
     */
    public function getDocumentInfo()
    {
        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName();

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return $json->Document;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * Get Resource Properties information like document source format, 
     * IsEncrypted, IsSigned and document properties
     * 
     * @param string $propertyName The name of property.
     * 
     * @return object|boolean
     * @throws Exception
     */
    public function getProperty($propertyName)
    {
        if ($propertyName == '')
            throw new Exception('Property Name not specified');

        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/documentProperties/' . $propertyName;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);


        if ($json->Code == 200) {
            return $json->DocumentProperty;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * Set document property.
     *
     * @param array $options that will get processed using a OptionsResolver
     * <ul>
     *  <li>'propertyName' => (string) Name of the Word property,</li>
     *  <li>'propertyValue' => (string) Value of the Word property,</li>
     * </ul>
     *
     * @return object|boolean
     * @throws Exception|InvalidOptionsException
     * @see OptionsResolver
     */
    public function setProperty(array $options)
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired(array('propertyName', 'propertyValue'));
        $options = $resolver->resolve($options);

        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/documentProperties/' . $options['propertyName'];

        $put_data_arr['Value'] = $options['propertyValue'];

        $put_data = json_encode($put_data_arr);

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'PUT', 'json', $put_data);

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return $json->DocumentProperty;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }
    
    /**
     * Protect a document on the Aspose cloud storage.
     * 
     * @param array $options that will get processed using a OptionsResolver
     * <ul>
     *  <li>'ProtectionType' => (string) Document protection password</li>
     *  <li>'ProtectionType' => (string) Document protection type, one from: AllowOnlyComments, AllowOnlyFormFields, AllowOnlyRevisions, ReadOnly, NoProtection</li>
     * </ul>
     * 
     * @return string $filePath.
     * @throws Exception|InvalidOptionsException
     */
    public function protectDocument(array $options)
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired('Password')
                 ->setDefaults(array(
                     'ProtectionType' => 'AllowOnlyComments'
                 ))
                 ->setAllowedValues('ProtectionType', array(
                     'AllowOnlyComments',
                     'AllowOnlyFormFields',
                     'AllowOnlyRevisions',
                     'ReadOnly',
                     'NoProtection',
                 ));
        $options = $resolver->resolve($options);

        $json = json_encode($options);

        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/protection';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'PUT', 'json', $json);
        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $strURI = Product::$baseProductUri . '/storage/file/' . $this->getFileName();
            $signedURI = Utils::sign($strURI);
            $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
            $outputFile = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($responseStream, $outputFile);

            return $outputFile;
        } else {
            return $v_output;
        }
    }

    /**
     * Unprotect a document on the Aspose cloud storage.
     *
     * @param array $options that will get processed using a OptionsResolver
     * <ul>
     *  <li>'ProtectionType' => (string) Document protection password</li>
     *  <li>'ProtectionType' => (string) Document protection type, one from: AllowOnlyComments, AllowOnlyFormFields, AllowOnlyRevisions, ReadOnly, NoProtection</li>
     * </ul>
     *
     * @return string $filePath.
     * @throws Exception|InvalidOptionsException
     */
    public function unprotectDocument(array $options)
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired('Password')
            ->setDefaults(array(
                'ProtectionType' => 'AllowOnlyComments'
            ))
            ->setAllowedValues('ProtectionType', array(
                'AllowOnlyComments',
                'AllowOnlyFormFields',
                'AllowOnlyRevisions',
                'ReadOnly',
                'NoProtection',
            ));
        $options = $resolver->resolve($options);

        $json = json_encode($options);
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/protection';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'DELETE', 'json', $json);
        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {
            $strURI = Product::$baseProductUri . '/storage/file/' . $this->getFileName();
            $signedURI = Utils::sign($strURI);
            $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
            $outputFile = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($responseStream, $outputFile);

            return $outputFile;
        } else {
            return $v_output;
        }
    }
    
    /**
     * Update document protection.
     * 
     * @param string $oldPassword Current document protection password.
     * @param string $newPassword New document protection password. 
     * @param string $protectionType Document protection type.
     * 
     * @return string Returns the file path.
     * @throws Exception
     */
    public function updateProtection($oldPassword, $newPassword, $protectionType = 'AllowOnlyComments')
    {
        if ($oldPassword == '') {
            throw new Exception('Please Specify Old Password');
        }
        if ($newPassword == '') {
            throw new Exception('Please Specify New Password');
        }
        $fieldsArray = array('Password' => $oldPassword, 'NewPassword' => $newPassword, 'ProtectionType' => $protectionType);
        $json = json_encode($fieldsArray);
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/protection';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', 'json', $json);
        $v_output = Utils::validateOutput($responseStream);
        if ($v_output === '') {
            $strURI = Product::$baseProductUri . '/storage/file/' . $this->getFileName();
            $signedURI = Utils::sign($strURI);
            $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
            $outputFile = AsposeApp::$outPutLocation . $this->getFileName();
            Utils::saveFile($responseStream, $outputFile);
            return $outputFile;
        }
        else
            return $v_output;
    }

    /**
     * Delete a document property.
     * 
     * @param string $propertyName The name of property.
     * 
     * @return boolean
     * @throws Exception
     */
    public function deleteProperty($propertyName)
    {
        if ($propertyName == '')
            throw new Exception('Property Name not specified');

        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/documentProperties/' . $propertyName;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return true;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * Get Document's properties.
     * 
     * @return array
     * @throws Exception
     */
    public function getProperties()
    {
        //build URI to merge Docs
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/documentProperties';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);


        if ($json->Code == 200) {
            return $json->DocumentProperties->List;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /*
     * Convert Document to different file format without using storage.
     * 
     * $param string $inputPath The source file path.
     * @param string $outputPath Output directory path.
     * @param string $outputFormat Newly converted file format.
     * 
     * @return string Returns the file path.
     * @throws Exception
     */
    public function convertLocalFile($inputPath = '', $outputPath = '', $outputFormat = '')
    {
        //check whether file is set or not
        if ($inputPath == '')
            throw new Exception('No file name specified');

        if ($outputFormat == '')
            throw new Exception('output format not specified');


        $strURI = Product::$baseProductUri . '/words/convert?format=' . $outputFormat;

        if (!file_exists($inputPath)) {
            throw new Exception('input file doesnt exist.');
        }


        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::uploadFileBinary($signedURI, $inputPath, 'xml');

        $v_output = Utils::validateOutput($responseStream);

        if ($v_output === '') {

            $save_format = $outputFormat;

            if ($outputPath == '') {
                $outputPath = Utils::getFileName($inputPath) . '.' . $save_format;
            }
            $output =  AsposeApp::$outPutLocation . $outputPath;
            Utils::saveFile($responseStream,$output);
            return true;
        }
        else
            return $v_output;
    }

    /*
     * Save Document to different file formats.
     *
     * $param string $options_xml.

     * @return string Returns the file path.
     * @throws Exception
     */

    public function saveAs($options_xml = '')
    {
        if ($options_xml == '')
            throw new Exception('Options not specified.');

        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/saveAs';
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', 'XML', $options_xml,'json');

        $json = json_decode($responseStream);

        if ($json->Code == 200){
            $outputFile = $json->SaveResult->DestDocument->Href;
            $strURI = Product::$baseProductUri . '/storage/file/'.$outputFile.'';
            $signedURI = Utils::sign($strURI);
            $responseStream = Utils::processCommand($signedURI, 'GET');

            $v_output = Utils::validateOutput($responseStream);

            if ($v_output === '') {

                $output =  AsposeApp::$outPutLocation . $outputFile;
                Utils::saveFile($responseStream,$output);
                return $output;
            }
            else
                return $v_output;

        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /*
     * get a list of all sections present in a Word document.
     *

     * @return Object of all sections.
     * @throws Exception
     */

    public function getAllSections()
    {
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/sections';
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET','');

        $json = json_decode($responseStream);
        if ($json->Code == 200) {
            return $json->Sections->SectionLinkList;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /*
     * get specefic section present in a Word document.
     *
     * $param string $filename.
     * $param string $sectionid.

     * @return Object of specefic section.
     * @throws Exception
     */

    public function getSection($sectionid = '')
    {
        if ($sectionid == '')
            throw new Exception('No Section Id specified');

        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/sections/'.$sectionid.'';
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET','');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return $json->Section;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }
    
    /*
     * Remove all Headers and Footers
     *
     * @return Boolean
     * @throws Exception
     */
    public function removeAllHeadersFooters()
    {
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/headersFooters';
        
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'DELETE', '', '');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return true;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * get page setup information from any section of a Word document.
     *
     * $param string $filename.
     * $param string $sectionid.

     * @return Object of page setup information.
     * @throws Exception
     */
    public function getPageSetup($sectionid = '')
    {
        if ($sectionid == '')
            throw new Exception('No Section Id specified');

        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/sections/'.$sectionid.'/pageSetup';
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET','');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return $json->PageSetup;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * update page setup information from any section of a Word document.
     *
     * $param string $filename.
     * $param string $sectionid.

     * @return Object of page setup information.
     * @throws Exception
     */
    public function updatePageSetup($options_xml = '',$sectionid = '')
    {
        if ($options_xml == '')
            throw new Exception('No Options specified');

        if ($sectionid == '')
            throw new Exception('No Section Id specified');

        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/sections/'.$sectionid.'/pageSetup';
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', 'XML', $options_xml,'json');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return $json->PageSetup;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * get mail merge and mustache field names.
     *
     * $param string $filename.

     * @return Object of Field Names.
     * @throws Exception
     */
    public function getMailMergeFieldNames()
    {
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/mailMergeFieldNames';
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET','');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return $json->FieldNames;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * get a list of all paragraphs present in a Word document.
     *
     * $param string $filename.

     * @return Object of All Paragraphs.
     * @throws Exception
     */
    public function getAllParagraphs()
    {
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/paragraphs';
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET','');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return $json->Paragraphs->ParagraphLinkList;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * get specefic paragraphs present in a Word document.
     *
     * $param string $filename.
     * $param string $paragraphid.

     * @return Object of Specefic Paragraphs.
     * @throws Exception
     */
    public function getParagraph($paragraphid = '')
    {
        if ($paragraphid == '')
            throw new Exception('No Paragraph Id specified');

        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/paragraphs/'.$paragraphid.'';
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET','');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return $json->Paragraph;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * get any run of any paragraph from a Word document.
     *
     * $param string $filename.
     * $param string $paragraphid.
     * $param string $runid.

     * @return Object of Specefic Run.
     * @throws Exception
     */
    public function getParagraphRun($paragraphid = '',$runid = '')
    {
        if ($paragraphid == '')
            throw new Exception('No Paragraph Id specified');

        if ($runid == '')
            throw new Exception('No Run Id specified');

        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/paragraphs/'.$paragraphid.'/runs/'.$runid.'';
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET','');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return $json->Run;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * get font information from any run of a paragraph.
     *
     * $param string $paragraphid.
     * $param string $runid.

     * @return Object of Font.
     * @throws Exception
     */
    public function getParagraphRunFont($paragraphid = '', $runid = '')
    {
        if ($paragraphid == '')
            throw new Exception('No Paragraph Id specified');

        if ($runid == '')
            throw new Exception('No Run Id specified');

        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/paragraphs/'.$paragraphid.'/runs/'.$runid.'/font';
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET','');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return $json->Font;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * update font information from any run of a paragraph.
     *
     * $param string $options_xml.
     * $param string $paragraphid.
     * $param string $runid.

     * @return Object of Font.
     * @throws Exception
     */
    public function updateParagraphRunFont($options_xml = '', $paragraphid = '', $runid = '')
    {
        if ($options_xml == '')
            throw new Exception('Options not specified.');

        if ($paragraphid == '')
            throw new Exception('No Paragraph Id specified');

        if ($runid == '')
            throw new Exception('No Run Id specified');

        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/paragraphs/'.$paragraphid.'/runs/'.$runid.'/font';
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'POST', 'XML', $options_xml,'json');

        $json = json_decode($responseStream);

        if ($json->Code == 200) {
            return $json->Font;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }
    
    /**
     * Get all Hyperlinks from a Word
     * 
     * @return array|boolean
     * @throws Exception
     */
    public function getHyperlinks()
    {
        //build URI
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/hyperlinks';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);        

        if ($json->Code == 200) {
            return $json->Hyperlinks->HyperlinkList;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }
    
    /**
     * Get a Particular Hyperlink from a Word
     * 
     * @param int $hyperlinkIndex The index of hyperlink.
     * 
     * @return object|boolean
     * @throws Exception
     */
    public function getHyperlink($hyperlinkIndex)
    {
        if ($hyperlinkIndex == '')
            throw new Exception('Hyperlink index not specified');
        
        //build URI
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/hyperlinks/' . $hyperlinkIndex;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);        

        if ($json->Code == 200) {
            return $json->Hyperlink;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }
    
    /**
     * Get Hyperlinks Count from a Word
     * 
     * @return int|boolean
     * @throws Exception
     */
    public function getHyperlinksCount()
    {
        //build URI
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/hyperlinks';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);        

        if ($json->Code == 200) {
            return count($json->Hyperlinks->HyperlinkList);
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }
    
    /**
     * Get all Bookmarks from a Word
     * 
     * @return array|boolean
     * @throws Exception
     */
    public function getBookmarks()
    {
        //build URI
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/bookmarks';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);        
        
        if ($json->Code == 200) {
            return $json->Bookmarks->BookmarkList;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }
    
    /**
     * Get a Specific Bookmark from a Word
     * 
     * @param string $bookmarkName Name of the Bookmark.
     * 
     * @return object|boolean
     * @throws Exception
     */
    public function getBookmark($bookmarkName)
    {
        if ($bookmarkName == '')
            throw new Exception('Bookmark name not specified');
        
        //build URI
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/bookmarks/' . $bookmarkName;

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);        
        
        if ($json->Code == 200) {
            return $json->Bookmark;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }
    
    /**
     * Get Bookmarks count from a Word
     * 
     * @return int|boolean
     * @throws Exception
     */
    public function getBookmarksCount()
    {
        //build URI
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/bookmarks';

        //sign URI
        $signedURI = Utils::sign($strURI);

        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');

        $json = json_decode($responseStream);        
        
        if ($json->Code == 200) {
            return count($json->Bookmarks->BookmarkList);
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }
    
    /**
     * Update Bookmark Text of a Word
     * 
     * @return boolean
     * @throws Exception
     */
    public function updateBookmark($bookmarkName, $bookmarkText)
    {
        if ($bookmarkName == '')
            throw new Exception('Bookmark name not specified');
        
        if ($bookmarkText == '')
            throw new Exception('Bookmark text not specified');
        
        //build URI
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/bookmarks/' . $bookmarkName;

        //sign URI
        $signedURI = Utils::sign($strURI);
        
        $post_data_arr['Text'] = $bookmarkText;
        $postData = json_encode($post_data_arr);
        $responseStream = Utils::processCommand($signedURI, 'POST', 'JSON', $postData);

        $json = json_decode($responseStream);        
        
        if ($json->Code == 200) {
            return true;
        }
        
        AsposeApp::getLogger()->warning('Error occured, http 200 code was not found.', array(
            'json-code' => $json->Code,
        ));
        return false;
    }

    /**
     * Compare the currently active $this->fileName with the passed $compareWithFilename. Make sure
     * that $this->fileName does not have any pending revision changes.
     *
     * @see http://api.aspose.com/v1.1/swagger/ui/index#!/words/WordsDocumentSaveAs_PostDocumentSaveAs
     *
     * @param string $compareWithFilename
     * @param array $compareData
     * @param array $options
     *
     * @return bool
     * @throws Exception
     */
    public function compareDocument($compareWithFilename, array $compareData = array(), array $options = array())
    {
        // POST parameters
        $resolver = new OptionsResolver();
        $resolver
            ->setDefault('ComparingWithDocument', $compareWithFilename)
            ->setRequired(array(
                'Author',
            ))
            ->setDefined(array(
                'DateTime',
            ))
        ;
        $compareData = json_encode($resolver->resolve($compareData));

        // GET parameters
        $resolver = new OptionsResolver();
        $resolver
            ->setDefined(array(
                'filename', // Target filename of the file saved in the Folder
                'storage',
                'folder',
            ))
        ;
        $options = $resolver->resolve($options);

        // Create request with resolved POST and GET parameters
        $strURI = Product::$baseProductUri . '/words/' . $this->getFileName() . '/compareDocument?' . http_build_query($options);
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'POST', 'JSON', $compareData);
        $json = json_decode($responseStream);

        if ($json->Code == 200 && isset($json->Document)) {

            $outputFile = $json->Document->FileName;

            $folder = new Folder();
            $outputStream = $folder->getFile($outputFile);
            $outputPath = AsposeApp::$outPutLocation . $outputFile;
            Utils::saveFile($outputStream, $outputPath);

            return $outputPath;
        }

        AsposeApp::getLogger()->warning('Error occured while processing `compareDocument` command, HTTP 200 code or result `Document` was not found.', array(
            'json-code' => $json->Code,
        ));
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
