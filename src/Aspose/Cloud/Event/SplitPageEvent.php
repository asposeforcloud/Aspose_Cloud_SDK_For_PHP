<?php

namespace Aspose\Cloud\Event;

use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Exception\AsposeCloudException;

class SplitPageEvent extends AbstractEvent
{
    /**
     * Will trigger when a specific page number is split and Utils::saveFile was completed
     */
    const PAGE_IS_SPLIT = 'aspose.sdk.page_is_split';

    /**
     * @var string with absolute path to file
     */
    private $outputFile;

    /**
     * @var integer
     */
    private $pageNumber;


    function __construct($outputFile, $pageNumber=null)
    {
        $this->outputFile = $outputFile;
        $this->pageNumber = $pageNumber;
    }

    /**
     * @return string
     */
    public function getOutputFile()
    {
        return $this->outputFile;
    }

    /**
     * @param string $outputFile
     */
    public function setOutputFile($outputFile)
    {
        $this->outputFile = $outputFile;
    }

    /**
     * @return int
     */
    public function getPageNumber()
    {
        if (null === $this->pageNumber) {
            AsposeApp::getLogger()->error('PageNumber is not set for this event.');
            throw new AsposeCloudException('PageNumber is not set for this event.');
        }
        return $this->pageNumber;
    }

    /**
     * @param int $pageNumber
     */
    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;
    }

}