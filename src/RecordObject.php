<?php
/**
 * Created by PhpStorm.
 * User: dale
 * Date: 2015/10/04
 * Time: 11:20 AM
 */

namespace daleattree\CsvFileHandler;


class RecordObject
{
    /** @var array */
    private $headers;

    private $data = array();

    /**
     * Creates a object based on the array.
     * If no header row is available, object defaults to col[n]
     * @param $headers
     * @param $values
     */
    public function __construct($headers, $values){
        if(empty($headers)){
            foreach($values as $k => $v) {
                $headers[$k] = 'col' . $k;
            }
        }

        $this->headers = $headers;

        foreach($headers as $k => $v){
            $key = $this->formatKey($v);
            $this->data[$key] = $values[$k];
        }
    }

    /**
     * Camel-cases column names
     * @param $header
     * @return string
     */
    private function formatKey($header){
        $field = explode("_", $header);

        foreach($field as $k => $v){
            if($k > 0) {
                $field[$k] = ucfirst(strtolower($v));
            } else {
                $field[$k] = strtolower($v);
            }
        }

        $header = implode("", $field);

        return $header;
    }

    /**
     * Overload of magic set function
     * @param $name
     * @param $arguments
     * @throws \Exception
     */
    public function __set($name, $arguments){
        $key = $this->formatKey($name);

        if(!array_key_exists($key, $this->data)){
            throw new \Exception("Unknown column: " . $name . ". Unable to set value");
        }

        if(count($arguments) == 1){
            $arguments = array_shift($arguments);
        }

        $this->data[$key] = $arguments;
    }

    /**
     * Overload of magic get function
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function __get($name){
        $key = $this->formatKey($name);

        if(!array_key_exists($key, $this->data)){
            throw new \Exception("Unknown column: " . $name . ". Unable to get value");
        }

        return $this->data[$key];
    }

    /**
     * Overload of magic call function when calling set or get methods
     * @param $name
     * @param $arguments
     * @return mixed|void
     * @throws \Exception
     */
    public function __call($name, $arguments){
        $action = substr($name, 0, 3);
        $name = substr($name, 3);

        switch($action){
            case 'get':
                return $this->__get($name);
                break;
            case 'set':
                return $this->__set($name, $arguments);
                break;
        }
    }

    /**
     * Get array of header names
     * @return array
     */
    public function getHeaders(){
        return array_keys($this->data);
    }

    /**
     * Get array of object values
     * @return array
     */
    public function getValues(){
        return array_values($this->data);
    }

    /**
     * Get Record object as array
     * @return array
     */
    public function getData(){
        return $this->data;
    }

    /**
     * Alias for getData
     * @see getData
     * @return array
     */
    public function toArray(){
        return $this->getData();
    }
}