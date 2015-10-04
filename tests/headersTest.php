<?php

class headersTest extends PHPUnit_Framework_TestCase
{
    public function testHeadersSpecified(){
        $testFile = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'test.csv';
        $csvFileHandler = new daleattree\CsvFileHandler\CsvFileHandler($testFile);

        $records = $csvFileHandler->getRecords();

        foreach($records as $record){
            /** @var $record daleattree\CsvFileHandler\RecordObject */

            $this->assertArrayHasKey('col0', $record->getData());
            $this->assertArrayHasKey('col1', $record->getData());
            $this->assertArrayHasKey('col2', $record->getData());
            $this->assertArrayHasKey('col3', $record->getData());
        }
    }
}