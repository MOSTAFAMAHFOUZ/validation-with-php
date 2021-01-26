<?php 

namespace app\rules;
use app\ValidationInterface;


class Min implements ValidationInterface
{
    protected $name ,$value,$rule;

    public function __construct(string $name , string $value,$rule)
    {
        $this->name = $name;
        $this->value = $value;
        $this->rule = $rule;
        
    }


    public function validate():string
    {
        // die($this->value);
        // exit;
        if(strlen($this->value) < $this->rule[1])
        {
            $name = str_replace('_',' ',$this->name);
            return "the {$name} must be greater than {$this->rule[1]} ";
        }
        return '';
    }
}