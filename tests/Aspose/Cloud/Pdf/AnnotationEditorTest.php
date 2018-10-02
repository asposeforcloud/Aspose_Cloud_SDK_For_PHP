<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Pdf\AnnotationEditor;

class AnnotationEditorTest extends PHPUnit_Framework_TestCase {
    
    protected $annotationeditor;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->annotationeditor = new AnnotationEditor('Test.pdf');
    } 
        
    public function testGetAnnotationsCount()
    {  
        $pageNumber = 3;
        $result = $this->annotationeditor->getAnnotationsCount($pageNumber);
        $this->assertInternalType('integer', $result);
    }
    
    public function testGetAnnotation()
    {  
        $pageNumber = 3;
        $annotationIndex = 1;
        $result = $this->annotationeditor->getAnnotation($pageNumber, $annotationIndex);
        $this->assertInstanceOf('stdClass', $result);
    }
    
    public function testGetAllAnnotations()
    {  
        $pageNumber = 3;
        $result = $this->annotationeditor->getAllAnnotations($pageNumber);
        $this->assertInternalType('array', $result);
    }
    
    public function testGetBookmarksCount()
    {  
        $result = $this->annotationeditor->getBookmarksCount();
        $this->assertInternalType('integer', $result);
    }
    
    public function testGetAllBookmarks()
    {  
        $result = $this->annotationeditor->getAllBookmarks();
        $this->assertInternalType('array', $result);
    }
    
    public function testGetChildBookmarksCount()
    {  
        $parent = 1;
        $result = $this->annotationeditor->getChildBookmarksCount($parent);
        $this->assertInternalType('integer', $result);
    }
    
    public function testGetBookmark()
    {  
        $bookmarkIndex = 1;
        $result = $this->annotationeditor->getBookmark($bookmarkIndex);
        $this->assertInstanceOf('stdClass', $result);
    }
    
    public function testGetChildBookmark()
    {  
        $parentIndex = 1;
        $childIndex = 0;
        $result = $this->annotationeditor->getChildBookmark($parentIndex, $childIndex);
        $this->assertInstanceOf('stdClass', $result);
    }
    
    public function testIsChildBookmark()
    {  
        $bookmarkIndex = 1;
        $result = $this->annotationeditor->isChildBookmark($bookmarkIndex);
        $this->assertInstanceOf('stdClass', $result);
    }
    
    public function testGetAttachmentsCount()
    {  
        $result = $this->annotationeditor->getAttachmentsCount();
        $this->assertInternalType('integer', $result);
    }
    
    public function testGetAllAttachments()
    {  
        $result = $this->annotationeditor->getAllAttachments();
        $this->assertInternalType('array', $result);
    }
    
    public function testDownloadAttachment()
    {  
        $attachmentIndex = 1;
        $result = $this->annotationeditor->downloadAttachment($attachmentIndex);
        $this->assertFileExists(getcwd(). '/Data/Output/attach.xls');
    }
    
    public function testGetLinksCount()
    {  
        $pageNumber = 2;
        $result = $this->annotationeditor->getLinksCount($pageNumber);
        $this->assertInternalType('integer', $result);
    }
    
    public function testGetLink()
    {  
        $pageNumber = 2;
        $linkIndex = 1;
        $result = $this->annotationeditor->getLink($pageNumber, $linkIndex);
        $this->assertInstanceOf('stdClass', $result);
    }
    
    public function testGetAllLinks()
    {  
        $pageNumber = 2;
        $result = $this->annotationeditor->getAllLinks($pageNumber);
        $this->assertInternalType('array', $result);
    }
     
}   