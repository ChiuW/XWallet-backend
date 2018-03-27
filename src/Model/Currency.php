<?php

namespace XWallet\Model;

class Currency extends Base {

    public function getSupportCurrency()
    {
        $currency = $this->db->select('currency', ['name', 'symbol', 'node'], ['enable' => '1']);
        return $currency;
    }

    public function getCurrencyData($symbol, $tagetCurrency)
    {
        $response                       = $this->currencyClient->request('GET', 'data/pricemultifull?fsyms='.$symbol.'&tsyms='.$tagetCurrency);
        $data                           = json_decode($response->getBody(), TRUE);
        $responseObj                    = array();
        $rawObj                         = array_values(array_values($data['RAW'])[0])[0];
        $displayObj                     = array_values(array_values($data['DISPLAY'])[0])[0];
        $responseObj['fromCurrency']    = $rawObj['FROMSYMBOL'];
        $responseObj['toCurrency']      = $rawObj['TOSYMBOL'];
        $responseObj['rawPrice']        = $rawObj['PRICE'];
        $responseObj['disPrice']        = $displayObj['PRICE'];
        $responseObj['rawDif']          = $rawObj['CHANGE24HOUR'];
        $responseObj['difference']      = $displayObj['CHANGE24HOUR'];
        return $responseObj;
    }

    public function getCurrencyHistoryData($symbol, $tagetCurrency)
    {   
        $response               = $this->currencyClient->request('GET', 'data/histohour?fsym='.$symbol.'&tsym='.$tagetCurrency.'&limit=23');
        $response_price         = $this->currencyClient->request('GET', 'data/price?fsym='.$symbol.'&tsyms='.$tagetCurrency);
        $data                   = json_decode($response->getBody(), TRUE);
        $data_price             = json_decode($response_price->getBody(), TRUE);
        $responseObj            = array();
        foreach($data['Data'] as $item){
            $obj = array();
            $obj['price']   = $item['close'];
            $obj['time']    = $item['time'];
            array_push($responseObj, $obj);
        }
        $obj = array();
        $obj['price']   = $data_price[$tagetCurrency];
        $obj['time']    = time();
        array_push($responseObj, $obj);
        return $responseObj;
    }
    
}