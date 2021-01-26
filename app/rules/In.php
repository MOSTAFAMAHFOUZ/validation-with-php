<?php 

namespace app\rules;
use app\ValidationInterface;


class In implements ValidationInterface
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
        $array = explode(',',$this->rule[1]);
        if(!in_array($this->value,$array))
        {
            $name = str_replace('_',' ',$this->name);
            return "the {$name} is not valid ";
        }
        return '';
    }
}