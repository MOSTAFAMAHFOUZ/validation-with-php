<?php 
namespace app;



class ValidationStrategy 
{
    protected $validation;
    public function __construct(ValidationInterface $validation)
    {
        $this->validation = $validation;
    }


    public function validate():string 
    {
        return $this->validation->validate();
    }


    
}