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

    public function validateStringLength($string, $minLength, $maxLength, $field) {
        $errors = array();
        if ($string == '' || $string == null) {
            $errors[] = $field . " can't be empty!";
        }

        if (strlen($string) < $minLength) {
            $errors[] = $field . ' must have at least ' . $minLength . ' characters';
        }
        $this -> validateStringMaxLength($string, $maxLength, $errors);

        return $errors;
    }

    public function validateStringMaxLength($string, $maxLength, $field, $errors) {
        if (strlen($string) > $maxLength) {
            $errors[] = $field . 'must have less than ' . $maxLength . ' characters';
        }
    }

}
