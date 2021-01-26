<?php 

namespace app\rules;
use app\ValidationInterface;


class Str implements ValidationInterface
{
    protected $name ,$value;

    public function __construct(string $name , string $value,$rule = 'required')
    {
        $this->name = $name;
        $this->value = $value;
    }


    public function validate():string
    {
        if(!preg_match('/^[a-zA-z0-9 .]*$/',$this->value))
        {
            $name = str_replace('_',' ',$this->name);
            return "the {$name} must be a string  ";
        }
        return '';
    }
}