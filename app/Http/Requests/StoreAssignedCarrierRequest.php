<?php

namespace App\Http\Requests;

use App\Rules\NotEqualToZeroRule;
use App\Rules\ReceivedHubStatusBarcode;
use Illuminate\Foundation\Http\FormRequest;

class StoreAssignedCarrierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'courier_id'=>[new NotEqualToZeroRule()] ,
            'barcode_number'=>['required','exists:barcodes,barcode_number' , new ReceivedHubStatusBarcode()]
        ];
    }
    public function messages()
    {
        return[
            'barcode_number.exists'=>'This Barcode Number Does Not Exists' ,
            'barcode_number'.'required'=>'You Have To Enter Barcode Number ' ,
        ];
    }
}
