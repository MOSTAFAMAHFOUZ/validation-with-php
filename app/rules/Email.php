<?php 

namespace app\rules;
use app\ValidationInterface;

class Email implements ValidationInterface
{
    protected $name ,$value;

    public function __construct(string $name , string $value,$rule = 'required')
    {
        $this->name = $name;
        $this->value = $value;
        
    }


    public function validate():string
    {
        if(!filter_var($this->value,FILTER_VALIDATE_EMAIL))
        {
            $name = str_replace('_',' ',$this->name);
            return "the {$name} is not a valid email";
        }
        return '';
    }
}