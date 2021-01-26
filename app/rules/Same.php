<?php 

namespace app\rules;
use app\ValidationInterface;


class Same implements ValidationInterface
{
    protected $name ,$value,$rule;

    public function __construct(string $name , string $value,$rule)
    {
        $this->name     = $name;
        $this->value    = $value;
        $this->rule     = $rule;
    }


    public function validate():string
    {
        if($this->value !== self::sanitizeField($this->rule[1]))
        {
            $name = str_replace('_',' ',$this->name);
            return "the {$name} must be equal {$this->rule[1]} ";
        }
        return '';
    }


    private static function sanitizeField($name)
    {
        return htmlspecialchars(filter_var(trim($_POST[$name]),FILTER_SANITIZE_STRING));
    }


    

    
}