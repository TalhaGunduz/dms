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
    public function rules(): array
    {
        return [
            'number' => 'required|string', // Oda numarasının gerekli ve string olması
            'capacity' => 'required|integer|min:1|max:5', // Kapasite en az 1, en fazla 5 olmalı
            'block_id' => 'required|exists:blocks,id', // Blok id'si geçerli bir blok olmalı
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
            'capacity.min' => 'Kapasite en az 1 olmalıdır.',
            'capacity.max' => 'Kapasite en fazla 5 olabilir.',
            'block_id.required' => 'Blok alanı gereklidir.',
            'block_id.exists' => 'Seçilen blok geçersiz.',
        ];
    }
}
