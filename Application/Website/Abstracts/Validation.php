<?php
/**
 * User: andrei
 * Date: 1/25/14
 * Time: 12:09 AM
 */
namespace Abstracts;

/*
 * Class Validation
 */
abstract class Validation {

    protected $inputs;//the inputs that need validation

    protected $result;//the result of the validation goes here

    protected $errors = array();//the list of errors if the validation failed

    /**
     * @var array
     *
     * If the validation have a variable (e.g. ignore a give ID) just type a placeholder (e.g. id_to_replace)
     * and add the value as the third param when init validation object (e.g. array('id_to_replace' => 1)
     */
    protected $rules = array(
        'default' => array()
    );//the validation rules


    /**
     * @param $inputs
     * @param string $rule
     * @param array $rules_params //key => value
     */
    public function __construct($inputs, $rule = 'default', $rules_params = array())
    {

        /*
         * Check if the rules were declared
         */
        if( !isset($this->rules) ) die('No rules were provided');

        /*
         * Check if the rules provided exist
         */
        if( !isset($this->rules[$rule]) ) die('The rules provided are not defined');


        /*
         * Assign inputs
         */
        $this->inputs = $inputs;

        /*
         * Check if the validation rules have params
         */
        if( count( $rules_params ) > 0 )
        {

            $this->validation_rules_params($rules_params, $rule);

        }//if the validation rules have params


        /*
         * We run the validation and assign the result to $this->result
         */
        $this->result = \Validator::make($this->inputs, $this->rules[$rule]);

    }//construct


    public function passes()
    {

        /*
         * If the validation passed return true, otherwise assign the errors
         */
        if( $this->result->passes() ) return true;

        /*
         * Assign the errors
         */
        $this->errors = $this->result->messages();

        return false;

    }//passes


    public function validation_rules_params($params, $validation_rule)
    {

        /*
         * Iterate through each validation and add the param
         */
        foreach( $this->rules[$validation_rule] as $key => $value )
        {

            $this->rules[$validation_rule][$key] = str_replace( array_keys($params), array_values($params), $value );

        }//foreach validation rule

    }//validation_rules_params

    public function errors()
    {

        return $this->errors;

    }//errors


}//end Validation