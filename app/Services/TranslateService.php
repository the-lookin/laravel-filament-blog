<?php

namespace App\Services;

class TranslateService
{
    public static function aiTranslatedText($text)
    {
        return self::aiAnswer($text);
    }

    private static function aiAnswer($text) {
        $api_key = config('integration.OPENAI_API_KEY');

        $payload = [
            "model" => "gpt-4o",
            "messages" => [
                [
                    "role" => "user",
                    "content" => 'Переведи текст и отдай в том же формате что и получил: ' . $text
                ]
            ],
        ];

        $ch = curl_init('https://api.openai.com/v1/chat/completions');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key,
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        return $data['choices'][0]['message']['content'] ?? 'Нет ответа';
    }
}