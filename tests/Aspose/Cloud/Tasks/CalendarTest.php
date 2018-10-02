<?php

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Tasks\Calendar;

class CalendarTest extends PHPUnit_Framework_TestCase {
    protected $object;

    protected function setUp()
    {        
        Product::$baseProductUri = $_SERVER['BASE_PRODUCT_URI'];
        AsposeApp::$appSID = $_SERVER['APP_SID'];
        AsposeApp::$appKey = $_SERVER['APP_KEY'];
        AsposeApp::$outPutLocation = getcwd(). '/Data/Output/';

        // Create calendar object
        $this->object = new Calendar('MyProject.mpp');
    } 
    
    public function testGetCalendars()
    {  
        $result = $this->object->getCalendars();
        print_r($result);
        $this->assertInternalType('array',$result);
    }
    
    public function testGetCalendar()
    {  
        $calendarUid = 5;
        $result = $this->object->getCalendar($calendarUid);
        $this->assertInstanceOf('stdClass',$result);
    }
    
    public function testAddCalendar()
    {  
        $jsonData = '';
        $result = $this->object->addCalendar($jsonData);
        $this->assertInstanceOf('stdClass',$result);
    }
     
    public function testDeleteCalendar()
    {
        $calendarUid = 5;
        $changedFileName = 'changed.mpp';
        $this->object->deleteCalendar($calendarUid, $changedFileName);
        $this->assertFileExists(getcwd(). '/Data/Output/'. $changedFileName);
    }

}    