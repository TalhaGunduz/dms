<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    /**
     * Belirtilen kullanıcıların bu isteği yapmaya yetkisi olup olmadığını kontrol eder.
     *
     * @return bool
     */
    public function authorize()
    {
        // Eğer tüm kullanıcılara izin vermek istiyorsanız true dönebilirsiniz.
        return true;
    }

    /**
     * İsteğin doğrulama kurallarını tanımlar.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'number' => 'required|string',
            'capacity' => 'required|integer|max:5', // Kapasiteyi 5 ile sınırlıyoruz
            'block' => 'nullable|string', // Blok alanı opsiyonel
        ];
    }

    /**
     * Doğrulama başarısız olduğunda geri gönderilecek hata mesajları.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'number.required' => 'Oda numarası gereklidir.',
            'capacity.required' => 'Kapasite gereklidir.',
            'capacity.max' => 'Kapasite en fazla 5 olabilir.',
            'block.nullable' => 'Blok alanı isteğe bağlıdır.',
        ];
    }
}
