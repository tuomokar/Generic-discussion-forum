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
        $this -> validateFieldsExist(array($field => $string), $errors);

        if (strlen($string) < $minLength) {
            $errors[] = $field . ' must have at least ' . $minLength . ' characters';
        }
        $this -> validateStringMaxLength($string, $maxLength, $field, $errors);

        return $errors;
    }

    public function validateStringMaxLength($string, $maxLength, $field, $errors) {
        if (strlen($string) > $maxLength) {
            $errors[] = $field . 'must have max ' . $maxLength . ' characters';
        }
    }

    public function validateFieldsExist($fields) {
        $errors = array();
        foreach ($fields as $field => $value) {
            if ($value == '' || $value == null) {
                $errors[] = $field . " can't be empty";
            }
        }
        return $errors;
    }

}
