<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SellerIdRule implements Rule
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
        return ! Auth()->user()->isAdmin() || (Auth()->user()->isAdmin() && Request()->seller_id !=0) ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You Have To Choose Seller ';
    }

}
