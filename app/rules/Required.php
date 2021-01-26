<?php 

namespace app\rules;
use app\ValidationInterface;

class Required implements ValidationInterface
{
    protected $name ,$value;

    public function __construct(string $name , string $value , $rule = 'required')
    {
        $this->name = $name;
        $this->value = $value;
        
    }


    public function validate():string
    {
        if(strlen(trim($this->value)) === 0)
        {
            $name = str_replace('_',' ',$this->name);
            return "the {$name} is rquired  ";
        }
        return '';
    }
}