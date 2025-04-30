<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Burada, kullanıcıya izin verilmesi gerektiğini belirtiyoruz
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tc_no' => 'required|string|max:255|unique:students,tc_no',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'school' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'room_id' => 'nullable|exists:rooms,id', // room_id'yi, rooms tablosundaki id'lere karşı kontrol ediyoruz
        ];
    }

    /**
     * Get the custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'tc_no' => 'TC No',
            'name' => 'Ad',
            'surname' => 'Soyad',
            'birth_date' => 'Doğum Tarihi',
            'school' => 'Okul',
            'department' => 'Bölüm',
            'phone' => 'Telefon',
            'room_id' => 'Oda',
        ];
    }
}
