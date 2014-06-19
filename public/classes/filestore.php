<?php

class Filestore {

    public $filename = '';

    function __construct($filename = '')
    {
        $this->filename = $filename;
    }

    /**
     * Returns array of lines in $this->filename
     */
    function read_lines()
    {

    }

    /**
     * Writes each element in $array to a new line in $this->filename
     */
    function write_lines($array)
    {

    }

    /**
     * Reads contents of csv $this->filename, returns an array
     */
    function read_csv()
    {
        $handle = fopen($this->filename, 'r');
        $array = [];
        while(!feof($handle))
        {
            $row = fgetcsv($handle);
            if(is_array($row))
            {
                $array[] = $row;
            }
        }
        fclose($handle);
        return $array;
    }

    /**
     * Writes contents of $array to csv $this->filename
     */
    function write_csv($array)
    {
        if(is_writeable($this->filename))
        {
            $handle = fopen($this->filename, 'w');
            foreach ($array as $fields)
            {
                fputcsv($handle, $fields);
            }
            fclose($handle);
        }
    }

}
