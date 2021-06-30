<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\CallLogsAssigned;

class SearchCallIsAvailable implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        //
        return CallLogsAssigned::is_not_assigned($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Call is already claimed';
    }
}