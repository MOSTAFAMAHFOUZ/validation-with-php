<?php 
namespace app;

interface ValidationInterface 
{
    /**
     * Class constructor.
     */
    public function __construct(string $value  , string $name,$rule);


    public function validate() : string;
}