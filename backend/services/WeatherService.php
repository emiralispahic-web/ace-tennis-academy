
<?php

class WeatherService
{
    private $apiKey;
    private $city;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/config.php';

        $this->apiKey = $config['weather_api_key'] ?? '';
        $this->city = $config['weather_city'] ?? 'Sarajevo,BA';
    }

    public function getWeather()
    {
        if (empty($this->apiKey)) {
            $this->logError('Weather API key is missing.');

            throw new Exception(
                'Weather information is temporarily unavailable.',
                500
            );
        }

        $url = 'https://api.openweathermap.org/data/2.5/weather?' .
            http_build_query([
                'q' => $this->city,
                'appid' => $this->apiKey,
                'units' => 'metric'
            ]);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 10
        ]);

        $response = curl_exec($curl);

        $httpCode = curl_getinfo(
            $curl,
            CURLINFO_HTTP_CODE
        );

        $curlError = curl_errno($curl);

        curl_close($curl);

        // Handle connection errors and timeouts

        if ($response === false || $curlError !== 0) {
            $this->logError(
                'Weather API connection failed. cURL error: ' .
                $curlError
            );

            throw new Exception(
                'Weather information is temporarily unavailable. Please try again later.',
                500
            );
        }

        // Handle external API errors

        if ($httpCode !== 200) {
            $this->logError(
                'Weather API returned HTTP status: ' .
                $httpCode
            );

            throw new Exception(
                'Weather information is temporarily unavailable. Please try again later.',
                500
            );
        }

        $data = json_decode($response, true);

        // Validate the external API response

        if (
            !is_array($data) ||
            !isset(
                $data['name'],
                $data['main']['temp'],
                $data['main']['feels_like'],
                $data['main']['humidity'],
                $data['weather'][0]['description'],
                $data['wind']['speed']
            )
        ) {
            $this->logError(
                'Weather API returned an invalid response.'
            );

            throw new Exception(
                'Weather information could not be retrieved.',
                500
            );
        }

        // Return only the information our application needs

        return [
            'city' => $data['name'],
            'temperature' => $data['main']['temp'],
            'feels_like' => $data['main']['feels_like'],
            'humidity' => $data['main']['humidity'],
            'description' => $data['weather'][0]['description'],
            'wind_speed' => round(
                $data['wind']['speed'] * 3.6,
                2
            ),
            'temperature_unit' => 'Celsius',
            'wind_speed_unit' => 'km/h'
        ];
    }

    private function logError($message)
    {
        $logFile = __DIR__ . '/../logs/weather.log';

        $logMessage = '[' . date('Y-m-d H:i:s') . '] ' .
            $message . PHP_EOL;

        error_log($logMessage, 3, $logFile);
    }
}
