<?php
namespace App\Http\Requests;

use App\Models\DestinationsModel;
use App\Traits\ResponseAPI;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DestinationMasterRequest extends FormRequest
{
    use ResponseAPI;
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            DestinationsModel::ID => "bail|required_if:action,update,enable,disable|nullable|exists:destination_master,id",
            DestinationsModel::DESTINATION_NAME => "bail|required_if:action,update,insert|nullable",
            // Allow multiple images and validate each file as an image
            DestinationsModel::DESTINATION_IMAGE => "bail|nullable|array", // Accept multiple images as array
            DestinationsModel::DESTINATION_IMAGE . ".*" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048", // Validate each image
            DestinationsModel::DESTINATION_DETAILS => "bail|nullable|string",
            DestinationsModel::META_TITLE => "bail|nullable",
            DestinationsModel::META_KEYWORD => "bail|nullable",
            DestinationsModel::META_DESCRIPTION => "bail|nullable",
            DestinationsModel::POSITION => "required_if:action,update,insert|numeric|gt:0",
            // DestinationsModel::SORTING_NUMBER => "required_if:action,update,insert|numeric|gt:0", // Uncomment if needed
            "action" => "bail|required|in:insert,update,enable,disable"
        ];
    }

    /**
     * Custom error messages.
     * @return array
     */
    public function messages()
    {
        return [
            "DESTINATION_IMAGE.dimensions" => "Dimensions should be in aspect ratio 208/121 or pixels w*h 374*250",
            "DESTINATION_IMAGE.*.image" => "Each uploaded file must be an image.",
            "DESTINATION_IMAGE.*.mimes" => "Each image must be a file of type: jpeg, png, jpg, gif, svg.",
            "DESTINATION_IMAGE.*.max" => "Each image may not be greater than 2MB."
        ];
    }

    /**
     * Handle failed validation.
     * @param Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->error($validator->getMessageBag()->first(), 200));
    }
}
