<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function addDid() {
        //dd('Dentro da addDid');     config('services.sipPulseTeste.dominio')
        //dd(getenv('SIPP_EXT_LOGIN'));
        return view('adddid');
    }

    public function saveDid(Request $request) {
        //dd('dentro da Save DID');
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
        //dd($response);
        curl_close($curl);
        //echo $response;

        if(is_null('didId')) {
            echo 'O DID não foi criado.';
        } else {
            echo 'O DID foi criado com sucesso. O ID é ' . $response;
        }
    }

    public function findDids() {
        return view('listdids');
    }

    public function listDid(Request $request) {
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
        curl_close($curl);

        $xml = simplexml_load_string($response);

        if ($xml === false) {
            return back()->with('error', 'Não foi possível Listar os DIDs.');
        }

        $dids = $xml->xpath('//did');
        dd($dids);
    }

    public function listDomain() {
        //dd('Dentro da listagem de domínios');
        $domain = config('services.sipPulseTeste.dominio');

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $domain . '/SipPulse/DomainWS?wsdl=',
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

        //dd($curl);
        $response = curl_exec($curl);
        curl_close($curl);

        //dd($response);
        $xml = simplexml_load_string($response);

        if ($xml === false) {
            return back()->with('error', 'Não foi Listar os Domínios');
        }

        $domains = $xml->xpath('//domain');
        dd($domains);
    }

    public function addCredit() {
        return view('insertcredit');
    }

    public function insertCredit(Request $request) {
        //dd('Dentro da adicionar credito');

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

        curl_close($curl);
        //dd($response);
        //echo $response;

        if(is_null($response)) {
            echo "Não foi possível adicionar os créditos";
        } else {
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
            curl_close($curl);

            echo "Créditos adicionados com sucesso. O valor do seu Saldo é de R$" . $response . ".";

            //return redirect()->route('home');
            
        }

    }
}
