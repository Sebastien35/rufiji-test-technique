<?php

class Coingecko extends CommonModels
{
	private $apiUrl = COINGECKO_API_URL;
    private $apiKey = COINGECKO_API_KEY;
    private $rateApiKey = CURRENCY_API_KEY;

    public function __construct(){   
        parent::__construct();
    }
    public function checkApiKey(){
        if(empty($this->apiKey) && empty($this->rateApiKey)){
            throw new Exception("Les API Keys de coingecko et currencyapi ne sont pas configurées.");
        }
        if(empty($this->apiKey)){
            throw new Exception("L'API Key de coingecko n'est pas configurée.");
        }
        if(empty($this->rateApiKey)){
            throw new Exception("L'API Key de currencyapi n'est pas configurée.");
        }
        
    }

    public function getCurrentEurToUsdRate(){
        $this->checkApiKey();
        $url = "https://api.currencyapi.com/v3/latest?apikey=$this->rateApiKey&currencies=USD&base_currency=EUR";
        $response = $this->sendGetRequest($url);
        if ($response === false) {
            throw new Exception("Une erreur a eu lieu pendant la communication avec currencyapi");
        }
        $data = json_decode($response, true);
        if (empty($data)) {
            throw new Exception("Pas de données reçues.");
        }
        if (!isset($data['data']['USD']['value'])) {
            throw new Exception("Le taux de change n'est pas disponible.");
        }
        $rate = $data['data']['USD']['value'];
        return $rate;
    }
    

    public function SendRequestToCurrencyApi($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    

    public function getTop100Cryptos(){
        $this->checkApiKey();
        
        $url = "$this->apiUrl/coins/markets?vs_currency=eur&sparkline=true&price_change_percentage=24h%2C7d%2C30d&precision=2";
        $response = $this->sendGetRequest($url);
        if($response === false){
            throw new Exception("Une erreur a eu lieu pendant la communication avec coingecko");

        }
        $data = json_decode($response, true);
        if(empty($data)){
            throw new Exception("Pas de données reçues.");
        }
        return $data;

    }

    


    //cette fonction envoie la requête Get à l'API de coingecko
    private function sendGetRequest($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'x-cg-demo-api-key: ' . $this->apiKey
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    
}