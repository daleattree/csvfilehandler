<?php

class bulkTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var daleattree\CsvFileHandler\CsvFileHandler
     */
    protected $handler;

    public function setUp(){
        $testFile = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'large.csv';
        $this->handler = new daleattree\CsvFileHandler\CsvFileHandler($testFile, true, ',', '"', '\\', false);
    }

    public function testRecordCount(){
        $expected = 2000000;

        $counter = 0;
        while(false !== ($row = $this->handler->readRecord())){
            $counter += 1;
        }

        $this->assertEquals($expected, $counter);
    }
}