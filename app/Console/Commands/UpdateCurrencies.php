<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currencies';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $response = Http::get('http://www.cbr.ru/scripts/XML_daily.asp');
        if (!$response->successful()) {
            throw new \Error();
        }

        $responseData = simplexml_load_string((string)$response);
        $responseData = json_encode($responseData);
        $responseData = json_decode($responseData, TRUE);
        $currencies = [];
        foreach ($responseData['Valute'] as $currency) {
            $currencies[] = [
                'name' => $currency['Name'],
                'rate' => (float)$currency['Value'],
            ];
        }
        \Log::info('i ran');
        \DB::table('currencies')->upsert($currencies, 'name');
    }
}
