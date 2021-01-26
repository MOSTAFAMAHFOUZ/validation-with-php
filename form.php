<?php 

require_once 'vendor/autoload.php';
$validator = new \app\Validator;

$data = [
    'name'=>'required|string|max:30',
    'email'=>'required|email'
];

if(!$validator->validate($data)->fails())
{
    echo "<pre>";
        print_r($validator->errors());
    echo "</pre>";
}
else 
{
    echo "hello validation";
}

?>