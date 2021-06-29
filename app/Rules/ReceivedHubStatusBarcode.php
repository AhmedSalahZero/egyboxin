<?php

namespace App\Rules;

use App\Models\Barcode;
use Illuminate\Contracts\Validation\Rule;

class ReceivedHubStatusBarcode implements Rule
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
        return Barcode::where('status','received hub')->orWhere('status','reschedule')->orWhere('status','RTO')->where($attribute,$value)->exists();
    }
    public function message()
    {
        return 'This Product Is Not In Received Hub , Reschedule Or RTO Status  ';
    }

}
