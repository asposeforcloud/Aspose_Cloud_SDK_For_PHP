<?php
/**
 * Deals with Annotations, Bookmarks, Attachments and Links in PDF document.
 */
namespace Aspose\Cloud\Pdf;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;
use Aspose\Cloud\Exception\AsposeCloudException as Exception;

class AnnotationEditor
{

    public $fileName = '';

    public function __construct($fileName='')
    {
        $this->fileName = $fileName;
    }

    /**
     * Gets list of all the annotations on a specified document page.
     *
     * @param integer $pageNumber Number of the page.
     *
     * @return array
     * @throws Exception
     */
    public function getAllAnnotations($pageNumber)
    {

        $iTotalAnnotation = $this->GetAnnotationsCount($pageNumber);
        $listAnnotations = array();
        for ($index = 1; $index <= $iTotalAnnotation; $index++) {
            array_push($listAnnotations, $this->GetAnnotation($pageNumber, $index));
        }
        return $listAnnotations;
    }

    /**
     * Gets number of annotations on a specified document page.
     *
     * @param integer $pageNumber Number of the page.
     *
     * @return integer
     * @throws Exception
     */
    public function getAnnotationsCount($pageNumber)
    {

        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/pages/' . $pageNumber . '/annotations';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return count($json->Annotations->List);
    }

    /**
     * Gets a specfied annotation on a specified document page.
     *
     * @param integer $pageNumber Number of the page.
     * @param integer $annotationIndex Index of th annotation.
     *
     * @return object
     * @throws Exception
     */
    public function getAnnotation($pageNumber, $annotationIndex)
    {

        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/pages/' . $pageNumber . '/annotations/' . $annotationIndex;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Annotation;
    }

    /**
     * Gets number of child bookmarks in a specfied parent bookmark.
     *
     * @param integer $parent
     *
     * @return integer
     * @throws Exception
     */
    public function getChildBookmarksCount($parent)
    {

        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/bookmarks/' . $parent . '/bookmarks';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return count($json->Bookmarks->List);
    }

    /**
     * Gets a specfied child Bookmark for selected parent bookmark in Pdf document.
     *
     * @param integer $parentIndex Parent index.
     * @param integer $childIndex Child index.
     *
     * @return object
     * @throws Exception
     */
    public function getChildBookmark($parentIndex, $childIndex)
    {

        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/bookmarks/' . $parentIndex . '/bookmarks/' . $childIndex;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Bookmark;
    }

    /**
     * Checks whether selected bookmark is parent or child Gets a specfied child
     * Bookmark for selected parent bookmark in Pdf document.
     *
     * @param integer $bookmarkIndex Index of the bookmark.
     *
     * @return object
     * @throws Exception
     */
    public function isChildBookmark($bookmarkIndex)
    {

        if ($bookmarkIndex === '')
            throw new Exception('bookmark index not specified');
        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/bookmarks/' . $bookmarkIndex;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Bookmark;
    }

    /**
     * Gets list of all the Bookmarks in a Pdf document.
     *
     * @return array
     * @throws Exception
     */
    public function getAllBookmarks()
    {

        $iTotalBookmarks = $this->GetBookmarksCount();
        $listBookmarks = array();
        for ($index = 1; $index <= $iTotalBookmarks; $index++) {
            array_push($listBookmarks, $this->GetBookmark($index));
        }
        return $listBookmarks;
    }

    /**
     * Gets total number of Bookmarks in a Pdf document.
     *
     * @return integer
     * @throws Exception
     */
    public function getBookmarksCount()
    {

        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/bookmarks';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return count($json->Bookmarks->List);
    }

    /**
     * Gets a specfied Bookmark from a PDF document.
     *
     * @param integer $bookmarkIndex Index of the bookmark.
     *
     * @return object
     * @throws Exception
     */
    public function getBookmark($bookmarkIndex)
    {

        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/bookmarks/' . $bookmarkIndex;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Bookmark;
    }

    /**
     * Gets List of all the attachments in Pdf document.
     *
     * @return array
     * @throws Exception
     */
    public function getAllAttachments()
    {
        $iTotalAttachments = $this->GetAttachmentsCount();
        $listAttachments = array();
        for ($index = 1; $index <= $iTotalAttachments; $index++) {
            array_push($listAttachments, $this->GetAttachment($index));
        }
        return $listAttachments;
    }

    /**
     * Gets number of attachments in the Pdf document.
     *
     * @return integer
     * @throws Exception
     */
    public function getAttachmentsCount()
    {
        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/attachments';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return count($json->Attachments->List);
    }

    /**
     * Gets selected attachment from Pdf document.
     *
     * @param integer $attachmentIndex Index of the attachment.
     *
     * @return object
     * @throws Exception
     */
    public function getAttachment($attachmentIndex)
    {

        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/attachments/' . $attachmentIndex;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Attachment;
    }

    /**
     * Download the selected attachment from Pdf document.
     *
     * @param string $attachmentIndex Index of the attachment.
     *
     * @return string Returns the file path.
     * @throws Exception
     */
    public function downloadAttachment($attachmentIndex)
    {
        $fileInformation = $this->GetAttachment($attachmentIndex);
        //build URI to download attachment
        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/attachments/' . $attachmentIndex . '/download';
        //sign URI
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $v_output = Utils::validateOutput($responseStream);
        if ($v_output === '') {
            Utils::saveFile($responseStream, AsposeApp::$outPutLocation . $fileInformation->Name);
            return '';
        } else
            return $v_output;
    }

    /**
     * Gets list of all the links on a specified document page.
     *
     * @param integer $pageNumber Number of the page.
     *
     * @return array
     * @throws Exception
     */
    public function getAllLinks($pageNumber)
    {

        $iTotalLinks = $this->GetLinksCount($pageNumber);
        $listLinks = array();
        for ($index = 1; $index <= $iTotalLinks; $index++) {
            array_push($listLinks, $this->GetLink($pageNumber, $index));
        }
        return $listLinks;
    }

    /**
     * Gets number of links on a specified document page.
     *
     * @param integer $pageNumber Number of the page.
     *
     * @return integer
     * @throws Exception
     */
    public function getLinksCount($pageNumber)
    {

        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/pages/' . $pageNumber . '/links';
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return count($json->Links->List);
    }

    /**
     * Gets a specfied link on a specified document page
     *
     * @param integer $pageNumber Number of the page.
     * @param integer $linkIndex Index of the link.
     *
     * @return object
     * @throws Exception
     */
    public function getLink($pageNumber, $linkIndex)
    {

        $strURI = Product::$baseProductUri . '/pdf/' . $this->getFileName() . '/pages/' . $pageNumber . '/links/' . $linkIndex;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
        $json = json_decode($responseStream);
        return $json->Link;
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