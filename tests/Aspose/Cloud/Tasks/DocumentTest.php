<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Tasks\Document;

class DocumentTest extends PHPUnit_Framework_TestCase {
    protected $object;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        $this->object = new Document('MyProject.mpp');
    } 
    
    public function testGetProperties()
    {  
        $result = $this->object->getProperties();
        $this->assertInternalType('array',$result);
    }
    
    public function testGetTasks()
    {  
        $result = $this->object->getTasks();
        $this->assertInternalType('array',$result);
    }
    
    public function testGetTask()
    {  
        $taskId = 2;
        $result = $this->object->getTask($taskId);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testAddTask()
    {  
        $taskName = 'task name here';
        $beforeTaskId = 2;
        $changedFileName = 'changed.mpp';
        $this->object->addTask($taskName, $beforeTaskId, $changedFileName);
        $this->assertFileExists(getcwd(). '/Data/Output/changed.mpp');
    }
    
    public function testDeleteTask()
    {  
        $taskId = 3;
        $this->object->deleteTask($taskId, '');
        $this->assertFileExists(getcwd(). '/Data/Output/MyProject.mpp');
    }
    
    public function testGetLinks()
    {  
        $result = $this->object->getLinks();
        $this->assertInternalType('array',$result);
    }
    
    public function testAddLink()
    {  
        $result = $this->object->addLink($link="NewProductDev.mpp/taskLinks/1", $index=1, $predecessorUid=1, $successorUid=2, $linkType="StartToStart", $lag=0, $lagFormat="Day");
        $this->assertTrue($result);
    }
    
    public function testDeleteLink()
    {  
        $index = 1;
        $changedFileName = 'changed.mpp';
        $this->object->deleteLink($index, $changedFileName);
        $this->assertFileExists(getcwd(). '/Data/Output/changed.mpp');
    }
    
    public function testGetOutlineCodes()
    {  
        $result = $this->object->getOutlineCodes();
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testGetOutlineCode()
    {  
        $outlineCodeId = 1;
        $result = $this->object->getOutlineCode($outlineCodeId);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testDeleteOutlineCode()
    {  
        $outlineCodeId = 1;
        $changedFileName = 'changed.mpp';
        $this->object->deleteOutlineCode($outlineCodeId, $changedFileName);
        $this->assertFileExists(getcwd(). '/Data/Output/changed.mpp');
    }
    
    public function testGetExtendedAttributes()
    {  
        $result = $this->object->getExtendedAttributes();
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testGetExtendedAttribute()
    {  
        $index = 1;
        $result = $this->object->getExtendedAttribute($index);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testDeleteExtendedAttribute()
    {  
        $extendedAttributeId = 1;
        $changedFileName = 'changed.mpp';
        $this->object->deleteExtendedAttribute($extendedAttributeId, $changedFileName);
        $this->assertFileExists(getcwd(). '/Data/Output/changed.mpp');
    }

}    