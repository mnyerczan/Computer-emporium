<?php


class CSVHandler extends BaseHandler
{
     /**
     * @param string $path Path of the XML file
     * 
     */
    public function __construct(string $path)
    {
        parent::__construct();
        
        $res                = fopen($path, "r");
        $firstLine          = fgetcsv($res);
        $array["Product"]   = [];
        $indexer            = 0;


        while(!feof($res))
        {
            $currentLine = fgetcsv($res);   
            $heleperArray = [];

            $heleperArray[$firstLine[0]] = $currentLine[0];
            $heleperArray[$firstLine[1]] = $currentLine[1];

            for($i = 2; $i < count($firstLine); $i++)
            {
                $heleperArray["RelId"][$i -2] = $currentLine[$i];
            }
            
            $array["Product"][$indexer] = (object)$heleperArray;
            $indexer++;     
        }

        $this->structure = (object)$array;            
    }
}