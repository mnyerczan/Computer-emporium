<?php

class BaseHandler
{

    // PHP verion >= 7.4
    protected stdClass $structure;

    /**
     * Empty constructor
     */
    public function __construct(){}


    /**
     * Save datas in DB
     * 
     * @param PDO $pdo PDO object
     * 
     * @return void
     */
    public function export(PDO $pdo): void
    {
        $sql = "";
        $binds = [];

        var_dump($this->structure);

        // Generating SQL script and bind parameters
        for($i = 0; $i < count($this->structure->Product); $i++)
        {

            // Create INSERT SQL Script for Product and save bind parameters
            $sql .= "INSERT INTO `Products` VALUES (:Id_{$i}, :Name_{$i});".PHP_EOL;

            $binds[":Id_{$i}"]      = $this->structure->Product[$i]->Id;
            $binds[":Name_{$i}"]    = $this->structure->Product[$i]->Name;


            // If exists the the RelId variable (XML), can only enter.
            if (array_key_exists("RelId", (array)$this->structure->Product[$i]))
            {

                // We go step by step on the resulting array.
                for($j = 0; $j < count($this->structure->Product[$i]->RelId); $j++ )
                {

                    // The csv structure contains RelId key, that have empty string value.
                    if ($this->structure->Product[$i]->RelId[$j] != "")
                    {

                        // Create INSERT SQL Script for ProductRel and save bind parameters
                        $sql .= "INSERT INTO `ProductsRel` VALUES (:ProdId_{$i}{$j}, :RelId_{$i}{$j});".PHP_EOL;
                        $binds[":ProdId_{$i}{$j}"]  = $this->structure->Product[$i]->Id;
                        $binds[":RelId_{$i}{$j}"]   = $this->structure->Product[$i]->RelId[$j];
                    }                    
                }
            }            
        
        }

        // If execute fails, throw an exception with error info,
        // cause execute function doesn't do it.
        if (!($smt = $pdo->prepare($sql))->execute($binds))
            throw new PDOException($smt->errorInfo()[2]);
        
    }



    /**
     * Rendering html list from datastructure
     * 
     * @return string Rendered html code
     * 
     */
    public function render(): string
    {

        $output ="<dl>";
        $output.="<dt>Products in ".get_class($this)."</dt>";
        $output.="<hr>";
        $output.="<dd>";


        // We crawl the data structure.
        foreach($this->structure->Product as $product)
        { 
 
            $output.="<dt>Id</dt><dd>{$product->Id}</dd>";  
            $output.="<dt>Name</dt><dd>{$product->Name}</dd>";  
            
            // Here we select the names of the products assigned to the 
            // current product, based on their IDs. Is Object variable (RelId) exist,
            // we test it.

            if (array_key_exists("RelId", (array)($product)) && 
                $product->RelId[0] != "")
            {
                // The csv structure contains RelId key, that have empty string value.
                 
                $output.="<dt>RelIds</dt>";
                // We examine RelIDs throughout.
                foreach($product->RelId as $relIdItem)
                {
                    // And let's look at the other IDs. (Linear search)
                    foreach ($this->structure->Product as $subProduct) 
                    {
                        if ($subProduct->Id == $relIdItem)
                            $output.="<dd>{$subProduct->Name}</dd>";  
                    }
                    
                }
            }
            $output.="<hr>";
            
        }                     

        return $output.="</dd></dl><br>";
    }
}