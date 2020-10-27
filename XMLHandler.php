<?php


class XMLHandler extends BaseHandler
{

    /**
     * @param string $path Path of the XML file
     * 
     */
    public function __construct(string $path)
    {
        parent::__construct();
        
        $this->structure = json_decode(json_encode(simplexml_load_file($path)));


        // var_dump($this->structure);
    }


  
    
}