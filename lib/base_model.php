<?php

class BaseModel{

    protected $validators;

    public function __construct($attributes = null) {
        foreach($attributes as $attribute => $value) {
            if(property_exists($this, $attribute)) {
                $this -> {$attribute} = $value;
            }
        }
    }

    public function errors(){
        $errors = array();

        foreach($this -> validators as $validator){
            $validatorErrors = $this -> {$validator}();
            $errors = array_merge($errors, $validatorErrors);
        }

        return $errors;
    }

    public function validateStringLength($string, $length, $field) {
        $errors = array();
        if ($string == '' || $string == null) {
            $errors[] = $field . " can't be empty!";
        }

        if (strlen($string) < $length) {
            $errors[] = $field . ' must have at least ' . $length . ' characters';
        }

        return $errors;
    }

}
