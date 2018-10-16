<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class CustomSumVerification implements Rule
{
    private $control_value;
    private $field_name;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $field_name, string $control_value)
    {
        $this->control_value = $control_value;
        $this->field_name = $field_name;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (string)$value === $this->control_value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The $this->field_name field has a wrong value. Please enter the sum of the 2 numbers displayed.";
    }
}
