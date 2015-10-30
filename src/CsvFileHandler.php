<?php
/**
 * Created by PhpStorm.
 * User: dale
 * Date: 2015/10/04
 * Time: 11:08 AM
 */

namespace daleattree\CsvFileHandler;

use daleattree\CsvFileHandler\RecordObject;

/**
 * Class CsvFileHandler
 * @package daleattree\CsvFileHandler
 */
class CsvFileHandler
{
    /** @var String */
    protected $filename;

    /** @var Array */
    protected $records;

    /** @var Boolean */
    protected $headerRow;

    /**
     * @var string
     */
    protected $delimiter = ',';

    /**
     * @var string
     */
    protected $enclosure = '"';

    /**
     * @var string
     */
    protected $escape  = '\\';

    /**
     * Specify file for loading. Configuration settings optional
     * @param $filename
     * @param string $delimiter
     * @param boolean $headerRow
     * @param string $enclosure
     * @param string $escape
     * @throws \Exception
     */
    public function __construct($filename, $headerRow = true, $delimiter = ',', $enclosure = '"', $escape = '\\'){
        if(!file_exists($filename)){
            throw new \Exception($filename . " not found");
        }

        $this->setHeaderRow($headerRow);

        if($delimiter != $this->getDelimiter()){
            $this->setDelimiter($delimiter);
        }

        if($enclosure != $this->getEnclosure()){
            $this->setEnclosure($enclosure);
        }

        if($escape != $this->getEscape()){
            $this->setEscape($escape);
        }

        $this->setFilename($filename);
        $this->parseFile();
    }

    /**
     * @return boolean
     */
    public function getHeaderRow()
    {
        return $this->headerRow;
    }

    /**
     * @param boolean $headerRow
     */
    public function setHeaderRow($headerRow)
    {
        $this->headerRow = $headerRow;
    }

    /**
     * Get field delimiter
     * @return string
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * Set field delimiter value (One character only)
     * @param string $delimiter
     * @throws \Exception
     */
    public function setDelimiter($delimiter)
    {
        if(1 != strlen($delimiter)){
            throw new \Exception("One character only for delimiter");
        }

        $this->delimiter = $delimiter;
    }

    /**
     * Get enclosure character
     * @return string
     */
    public function getEnclosure()
    {
        return $this->enclosure;
    }

    /**
     * Set field enclosure value (One character only)
     * @param string $enclosure
     * @throws \Exception
     */
    public function setEnclosure($enclosure)
    {
        if(1 != strlen($enclosure)){
            throw new \Exception("One character only for enclosure");
        }

        $this->enclosure = $enclosure;
    }

    /**
     * Get escape character
     * @return string
     */
    public function getEscape()
    {
        return $this->escape;
    }

    /**
     * Set escape character (One character only)
     * @param string $escape
     * @throws \Exception
     */
    public function setEscape($escape)
    {
        if(1 != strlen($escape)){
            throw new \Exception("One character only for escape");
        }
        $this->escape = $escape;
    }

    /**
     * Get filename as specified in constructor
     * @return String
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set filename for parsing
     * @param String $filename
     */
    protected function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Get array of RecordObject representing lines in the file
     * @return Array
     */
    public function getRecords()
    {
        return $this->records;
    }

    /**
     * Add RecordObject to array representative of each line in the file
     * @param RecordObject $record
     */
    public function addRecord(RecordObject $record){
        $this->records[] = $record;
    }

    /**
     * Load file into array and convert each line to RecordObject
     * @internal
     */
    protected function parseFile(){
        $fp = fopen($this->getFilename(), 'r');

        $headers = null;
        if($this->getHeaderRow()) {
            $headers = fgetcsv($fp, null, $this->getDelimiter(), $this->getEnclosure(), $this->getEscape());
        }

        while ($values = fgetcsv($fp, null, $this->getDelimiter(), $this->getEnclosure(), $this->getEscape())) {
            $record = new RecordObject($headers, $values);
            $this->addRecord($record);
        }

        fclose($fp);

    }
}
