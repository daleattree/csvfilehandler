<?php

class valuesTest extends PHPUnit_Framework_TestCase
{
    public function testGetValues(){
        $testFile = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'test.csv';
        $csvFileHandler = new daleattree\CsvFileHandler\CsvFileHandler($testFile);

        $records = $csvFileHandler->getRecords();

        foreach($records as $record){
            /** @var $record daleattree\CsvFileHandler\RecordObject */

            $this->assertEquals(1, $record->getCol0(), 'Col0 getter passed and values matched');
            $this->assertEquals('Regards, Test', $record->getCol1(), 'Col1 getter passed and values matched');
            $this->assertEquals('hello', $record->getCol2(), 'Col2 getter passed and values matched');
            $this->assertEquals('there', $record->getCol3(), 'Col3 getter passed and values matched');
        }
    }

    public function testSetValues(){
        $testFile = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'test.csv';
        $csvFileHandler = new daleattree\CsvFileHandler\CsvFileHandler($testFile);

        $records = $csvFileHandler->getRecords();

        foreach($records as $record){
            /** @var $record daleattree\CsvFileHandler\RecordObject */

            $record->setCol0(3);
            $this->assertEquals(3, $record->getCol0(), 'Col0 setter failed');
        }
    }
}