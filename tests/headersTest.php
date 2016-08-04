<?php

class headersTest extends PHPUnit_Framework_TestCase
{
    public function testHeadersSpecified(){
        $testFile = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'test.csv';
        $csvFileHandler = new daleattree\CsvFileHandler\CsvFileHandler($testFile);

        $records = $csvFileHandler->getRecords();

        foreach($records as $record){
            /** @var $record daleattree\CsvFileHandler\RecordObject */

            $this->assertArrayHasKey('Col0', $record->getData());
            $this->assertArrayHasKey('Col1', $record->getData());
            $this->assertArrayHasKey('Col2', $record->getData());
            $this->assertArrayHasKey('Col3', $record->getData());
        }
    }
}