<?php

class exceptionsTest extends PHPUnit_Framework_TestCase
{

    /**
     * @return \daleattree\CsvFileHandler\CsvFileHandler
     */
    protected  function setUpHandler()
    {
        $testFile = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'test.csv';
        return new daleattree\CsvFileHandler\CsvFileHandler($testFile);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Unknown column: DoesNotExist. Unable to set value
     */
    public function testSetException()
    {
        $csvFileHandler = $this->setUpHandler();
        $records = $csvFileHandler->getRecords();

        /** @var $firstRecord daleattree\CsvFileHandler\RecordObject */
        $firstRecord = $records[0];
        $firstRecord->setDoesNotExist('value');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Unknown column: DoesNotExist. Unable to get value
     */
    public function testGetException()
    {
        $csvFileHandler = $this->setUpHandler();
        $records = $csvFileHandler->getRecords();

        /** @var $firstRecord daleattree\CsvFileHandler\RecordObject */
        $firstRecord = $records[0];
        $firstRecord->getDoesNotExist();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage One character only for delimiter
     */
    public function testSetDelimiterException()
    {
        $csvFileHandler = $this->setUpHandler();
        $csvFileHandler->setDelimiter('.,');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage One character only for enclosure
     */
    public function testSetEnclosureException()
    {
        $csvFileHandler = $this->setUpHandler();
        $csvFileHandler->setEnclosure('\'"');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage One character only for escape
     */
    public function testSetEscapeException()
    {
        $csvFileHandler = $this->setUpHandler();
        $csvFileHandler->setEscape('\\/');
    }
}