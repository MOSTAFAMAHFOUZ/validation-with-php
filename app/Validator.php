<?php 
namespace app;
use app\rules as Valid;


class Validator 
{
    private static $errors = [];
    private const F_REQUIRED = "required";
    private const F_EMAIL = "email";
    private const F_STRING = "string";
    private const F_NUMBER = "number";
    // private const F_MOBILE_EG = "mobile_eg";
    private const F_MIN = "min";
    private const F_MAX = "max";
    private const F_IN = "in";
    private const F_SAME = "same";




    public  function validate($request)
    {
        foreach($request as $name => $rule)
        {
            $rules = explode('|',$rule);
            foreach ($rules as $item) 
            {
                $is_complex = str_contains($item,':');
                if($is_complex){
                    $valid_rule = explode(':',$item);
                    //  self::pre($valid_rule[0]);
                    // exit;
                    self::validateArray($name,$valid_rule);
                }else {
                    $valid_rule[0] = $item;
                    self::validateString($name,$item);
                }
            }
            

        }

        return $this;
    }

    public function fails()
    {
        if(count(self::$errors))
        {
            return false;
        }
        return true;
    }

    
    public function errors()
    {
        return self::$errors;
    }


    // validate strait string 
    private static function validateString($name,$item)
    {
        $error = '';
        switch ($item) {
            case self::F_REQUIRED:
                $error = (new ValidationStrategy(new Valid\Required($name,self::sanitizeField($name))))->validate();
                break;
            case self::F_EMAIL:
                $error = (new ValidationStrategy(new Valid\Email($name,self::sanitizeField($name))))->validate();
                break;
            case self::F_STRING:
                $error = (new ValidationStrategy(new Valid\Str($name,self::sanitizeField($name))))->validate();
                break;
            case self::F_NUMBER:
                $error = (new ValidationStrategy(new Valid\Number($name,self::sanitizeField($name))))->validate();
                break;
        }
        if($error)
        {
            self::$errors[] = $error;
        }

    }



    // validate required fields 
    private static function validateArray($name,$item)
    {
        
        $error = '';
        switch ($item[0]) {
            case self::F_MIN:
                $error = (new ValidationStrategy(new Valid\Min($name,self::sanitizeField($name),$item)))->validate();
                break;
            case self::F_MAX:
                $error = (new ValidationStrategy(new Valid\Max($name,self::sanitizeField($name),$item)))->validate();
                break;
            case self::F_SAME:
                $error = (new ValidationStrategy(new Valid\Same($name,self::sanitizeField($name),$item)))->validate();
                break;
            case self::F_IN:
                $error = (new ValidationStrategy(new Valid\In($name,self::sanitizeField($name),$item)))->validate();
                break;
        }
        if($error)
        {
            self::$errors[] = $error;
        }

    }




    





    private static function sanitizeField($name)
    {
        return htmlspecialchars(filter_var(trim($_POST[$name]),FILTER_SANITIZE_STRING));
    }




    public static function pre($data)
    {
        echo "<pre>";
            print_r($data);
        echo "</pre>";
    }
}