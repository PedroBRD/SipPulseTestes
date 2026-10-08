<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FuncController extends Controller
{
    public function home() {
        return view('home');
    }

    public function addDid() {
        //dd('Dentro da addDid');     config('services.sipPulseTeste.dominio')
        //dd(getenv('SIPP_EXT_LOGIN'));
        return view('adddid');
    }

    public function saveDid(Request $request) {
        //dd('dentro da Save DID');

        try {
            $domain = config('services.sipPulseTeste.dominio');
            //$endpoint = '/SipPulse/DidWS?wsdl=';
            //dd($domain . $endpoint);

            $curl = curl_init();
            //dd($curl);
            curl_setopt_array($curl, array(
            CURLOPT_URL => $domain . '/SipPulse/DidWS?wsdl=',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.ws.sippulse.voffice.com.br/">
                <soapenv:Header/>
                <soapenv:Body>
                    <ser:insertDid>
                        <did>
                            <accountCode>'.$request->accountCode.'</accountCode>
                            <aliasUsername>'.$request->aliasUsername.'</aliasUsername>
                            <username>'.$request->username.'</username>
                            <domain>'. getenv('SIPP_EXT_DOMAIN') .'</domain>
                        </did>
                        <principal>
                            <login>'. getenv('SIPP_EXT_LOGIN') .'</login>
                            <password>'. getenv('SIPP_EXT_PASS') .'</password>
                        </principal>
                    </ser:insertDid>
                </soapenv:Body>
            </soapenv:Envelope>',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml'
            ),
            ));

            $response = curl_exec($curl);
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            //dd($response);
            
            //echo $response;

            if($http_code !== 200) {
                echo 'O DID não foi criado. Erro: ' . $http_code;
            } else {
                echo 'O DID foi criado com sucesso. O ID é ' . $response;
            }

            curl_close($curl);
        } catch (Exception $e) {
            dd("Erro: " . $e->getMessage());
        }
    }

    public function findDids() {
        return view('listdids');
    }

    public function listDid(Request $request) {
        try {
            $domain = config('services.sipPulseTeste.dominio');
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $domain . '/SipPulse/DidWS?wsdl=',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.ws.sippulse.voffice.com.br/">
            <soapenv:Header/>
            <soapenv:Body>
                <ser:listByAcc>
                    <accountCode>'.$request->accountCode.'</accountCode>
                    <principal>
                        <login>'. getenv('SIPP_EXT_LOGIN') .'</login>
                        <password>'. getenv('SIPP_EXT_PASS') .'</password>
                    </principal>
                </ser:listByAcc>
            </soapenv:Body>
            </soapenv:Envelope>',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml'
            ),
            ));

            $response = curl_exec($curl);
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($http_code !== 200) {
                echo 'Não foi possível Listar os DIDs. Erro: ' . $http_code;
            } else {
                $xml = simplexml_load_string($response);
                $dids = $xml->xpath('//did');
                dd($dids);
            }

            curl_close($curl);
        } catch (Exception $e) {
            dd("Erro: " . $e->getMessage());
        }
    }

    public function listDomain() {
        //dd('Dentro da listagem de domínios');

        try {
        $domain = config('services.sipPulseTeste.dominio');
        //dd($domain);

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $domain . '/SipPulse/DomainWS?wsdl=',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_VERBOSE => true,
        CURLOPT_ENCODING => '', 
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_POSTFIELDS =>'<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.ws.sippulse.voffice.com.br/">
            <soapenv:Header/>
            <soapenv:Body>
                <ser:listDomains>
                    <principal>
                        <login>'. getenv('SIPP_EXT_LOGIN') .'</login>
                        <password>'. getenv('SIPP_EXT_PASS') .'</password>
                    </principal>
                </ser:listDomains>
            </soapenv:Body>
        </soapenv:Envelope>',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: text/xml'
        ),
        ));
        
        $response = curl_exec($curl);
        //dd($response);  // false
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //dd($http_code);   // 0

        $resposta = json_decode($response, true);
        //dd($resposta);    // null

        if($http_code == 200) {
            $xml = simplexml_load_string($response);

            if ($xml === false) {
                return back()->with('error', 'Não foi Listar os Domínios');
            }

            $domains = $xml->xpath('//domain');
            dd($domains);

        } else {
            echo "Erro: " . $http_code;
        }

        curl_close($curl);
        
        } catch (Exception $e) {
            dd("Erro: " . $e->getMessage());
        }



    }

    public function addCredit() {
        return view('insertcredit');
    }

    public function insertCredit(Request $request) {
        //dd('Dentro da adicionar credito');

        try {
            $domain = config('services.sipPulseTeste.dominio');
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $domain . '/SipPulse/SubscriberWS?wsdl=',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.ws.sippulse.voffice.com.br/">
            <soapenv:Header/>
            <soapenv:Body>
                <ser:addCredit>
                    <username>'.$request->username.'</username>
                    <domain>'. getenv('SIPP_EXT_DOMAIN') .'</domain>
                    <value>'.$request->value.'</value>
                    <obs>'.$request->obs.'</obs>
                    <principal>
                        <login>'. getenv('SIPP_EXT_LOGIN') .'</login>
                        <password>'. getenv('SIPP_EXT_PASS') .'</password>
                    </principal>
                </ser:addCredit>
            </soapenv:Body>
            </soapenv:Envelope>',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml'
            ),
            ));

            $response = curl_exec($curl);
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if($http_code !== 200) {
                echo 'Não foi possível inserir os créditos. Erro: ' . $http_code;
            } else {
                try {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $domain . '/SipPulse/SubscriberWS?wsdl=',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.ws.sippulse.voffice.com.br/">
                <soapenv:Header/>
                <soapenv:Body>
                    <ser:retrieveCredit>
                        <username>'.$request->username.'</username>
                        <domain>'. getenv('SIPP_EXT_DOMAIN') .'</domain>
                        <principal>
                            <login>'. getenv('SIPP_EXT_LOGIN') .'</login>
                            <password>'. getenv('SIPP_EXT_PASS') .'</password>
                        </principal>
                    </ser:retrieveCredit>
                </soapenv:Body>
                </soapenv:Envelope>',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: text/xml'
                ),
                ));

                $response = curl_exec($curl);
                $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                
                if($http_code !== 200) {
                    echo "Não foi possível Verificar seu saldo. Erro: " . $http_code;
                } else {
                    echo "Créditos adicionados com sucesso. O valor do seu Saldo é de R$" . $response . ".";
                }
                curl_close($curl);

                } catch (Exception $e) {
                    dd("Erro: " . $e->getMessage());
                }
            }
            curl_close($curl);
            
        } catch (Exception $e) {
            dd("Erro: " . $e->getMessage());
        }

    }
}
