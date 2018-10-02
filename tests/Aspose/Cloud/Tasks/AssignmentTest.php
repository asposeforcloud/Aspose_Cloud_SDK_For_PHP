<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Tasks\Assignment;

class AssignmentTest extends PHPUnit_Framework_TestCase {
    protected $object;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        // Create assignment object
        $this->object = new Assignment('MyProject.mpp');
    } 
    
    public function testGetAssignments()
    {  
        $result = $this->object->getAssignments();
        $this->assertInternalType('array',$result);
    }
    
    public function testGetAssignment()
    {  
        $assignmentUid = 2;
        $result = $this->object->getAssignment($assignmentUid);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testAddAssignment()
    {
        $taskUid = 1;
        $resourceUid = 1;
        $units = 0.6;
        $changedFileName = 'changed.mpp';
        $this->object->addAssignment($taskUid, $resourceUid, $units, $changedFileName);
        $this->assertFileExists(getcwd(). '/Data/Output/changed.mpp');
    }
    
    public function testDeleteAssignment()
    {
        $assignmentUid = 1;
        $changedFileName = 'changed.mpp';
        $this->object->deleteAssignment($assignmentUid, $changedFileName);
        $this->assertFileExists(getcwd(). '/Data/Output/'. $changedFileName);
    }

}    