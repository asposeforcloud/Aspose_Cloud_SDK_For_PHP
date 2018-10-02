<?php

namespace Aspose\Cloud\Event;

class ValidateOutputEvent extends AbstractEvent
{
    const VALIDATE_OUTPUT = 'aspose.utils.validate_output';

    /**
     * This value will be set during the POST_CURL event
     * @var string
     */
    private $result;

    /**
     * @var bool
     */
    private $invalid;


    function __construct($result, $invalid)
    {
        $this->result = $result;
        $this->invalid = $invalid;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param string $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return boolean
     */
    public function isInvalid()
    {
        return $this->invalid;
    }

    /**
     * @param boolean $invalid
     */
    public function setInvalid($invalid)
    {
        $this->invalid = $invalid;
    }

}