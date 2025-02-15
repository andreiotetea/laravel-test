<?php

namespace App\Repositories;


class CsvRepository
{

    public function getTransactions() 
    {
        
        $filename = app()->basePath().'/resources/csv_files/transactions.csv';
        $results = $this->csv_to_array($filename);
    
        return $results;
    }
    
    public function csv_to_array($filename='', $delimiter=',')
    {
        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

}
