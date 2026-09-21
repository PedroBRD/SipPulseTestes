<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function homeTvendas() {
        //dd('dentro da tarifa de vendas');
        return view('Assinantes/homeTvendas');
    }

    public function addTvenda() {
        return view('Assinantes/addTvenda');
    }

    public function saveTvendas(Request $request) {
        $domain = config('services.sipPulseTeste.dominio');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $domain . '/SipPulse/RateWS?wsdl=',
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
            <ser:insertRates>
                <rate>
                    <cadency>'.$request->cadency.'</cadency>
                    <domain>'. getenv('SIPP_EXT_DOMAIN') .'</domain>
                    <id>?</id>
                    <name>'.$request->name.'</name>
                    <prefix>'.$request->prefix.'</prefix>
                    <rateId>'.$request->rateId.'</rateId>
                    <rateValue>'.$request->rateValue.'</rateValue>
                    <serviceType>'.$request->serviceType.'</serviceType>
                    <txConnection>'.$request->txConnection.'</txConnection>
                    <txDelay>'.$request->txDelay.'</txDelay>
                    <txDiscard>'.$request->txDiscard.'</txDiscard>
                </rate>
                <principal>
                    <login>'. getenv('SIPP_EXT_LOGIN') .'</login>
                    <password>'. getenv('SIPP_EXT_PASS') .'</password>
                </principal>
            </ser:insertRates>
        </soapenv:Body>
        </soapenv:Envelope>',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: text/xml'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        if(is_null($response)) {
            echo "Não foi possível Incluir esta Tarifa de Venda";
        } else {
            echo "Sucesso" . $response;
        };

    }

    public function listTvenda() {
        $domain = config('services.sipPulseTeste.dominio');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $domain . '/SipPulse/RateWS?wsdl=',
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
            <ser:listRatesByParams>
                <domain>'. getenv('SIPP_EXT_DOMAIN') .'</domain>
                <descripion>?</descripion>
                <rateId>?</rateId>
                <prefix>?</prefix>
                <principal>
                    <login>'. getenv('SIPP_EXT_LOGIN') .'</login>
                    <password>'. getenv('SIPP_EXT_PASS') .'</password>
                </principal>
            </ser:listRatesByParams>
        </soapenv:Body>
        </soapenv:Envelope>',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: text/xml'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        //dd($response);
        $xml = simplexml_load_string($response);
        
        if ($xml === false) {
            return back()->with('error', 'Não foi Listar as Tarifas');
        } else {
            echo "Apresentando problema até na endpoint";
        }

        $tvenda = $xml->xpath('//rate');
        dd($tvenda);
    }

    public function deleteTvenda() {
        return view('Assinantes/deleteTvenda');
    }

    public function excludeTvenda(Request $request) {
        $domain = config('services.sipPulseTeste.dominio');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $domain . '/SipPulse/RateWS?wsdl=',
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
            <ser:removeAllRatesByRateId>
                <domain>'. getenv('SIPP_EXT_DOMAIN') .'</domain>
                <rateId>'.$request->rateId.'</rateId>
                <principal>
                    <login>'. getenv('SIPP_EXT_LOGIN') .'</login>
                    <password>'. getenv('SIPP_EXT_PASS') .'</password>
                </principal>
            </ser:removeAllRatesByRateId>
        </soapenv:Body>
        </soapenv:Envelope>',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: text/xml'
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if(is_null($response)) {
            echo "Não foi possível excluir esta Tarifa";
        } else {
            echo "A tarifa foi excluída com sucesso";
        }
        /*
        $xml = simplexml_load_string($response);

        if ($xml === false) {
            return back()->with('error', 'Não foi excluir esta Tarifa');
        }
        $tvenda = $xml->xpath('//ratesRemoved');
        dd($tvenda);
        */
    }

    public function homePtarifas() {
        return view('Assinantes/homePtarifas');
    }

    public function addPtarifa() {
        return view('Assinantes/addPtarifa');
    }

    public function savePtarifa(Request $request) {
        //dd('Dentro da Salvar Plano de Tarifas');
        $domain = config('services.sipPulseTeste.dominio');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $domain . '/SipPulse/RatePlanWS?wsdl=',
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
            <ser:insertRatePlan>
                <ratePlan>
                    <name>'.$request->name.'</name>
                    <domain>'. getenv('SIPP_EXT_DOMAIN') .'</domain>
                    <rateId>'.$request->rateId.'</rateId>
                    <prepaId>'.$request->prepaId.'</prepaId>
                    <blockCallsWithoutRate>'.$request->blockCallsWithoutRate.'</blockCallsWithoutRate>
                    <txConnection>'.$request->txConnection.'</txConnection>
                    <cadency>'.$request->cadency.'</cadency>
                    <txDiscard>'.$request->txDiscard.'</txDiscard>
                    <txDelay>'.$request->txDelay.'</txDelay>
                    <markup>0.0</markup>
                    <limitToCreditsExpires>'.$request->limitToCreditsExpires.'</limitToCreditsExpires>
                </ratePlan>
                <principal>
                    <login>'. getenv('SIPP_EXT_LOGIN') .'</login>
                    <password>'. getenv('SIPP_EXT_PASS') .'</password>
                </principal>
            </ser:insertRatePlan>
        </soapenv:Body>
        </soapenv:Envelope>',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: text/xml'
        ),
        ));
        
        $response = curl_exec($curl);
        //dd($response);
        curl_close($curl);

        if(!is_null($response)) {
            echo "Plano de Tarifas Criado com sucesso";
        }    

    }

    public function listPtarifa() {
        $domain = config('services.sipPulseTeste.dominio');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $domain . '/SipPulse/RatePlanWS?wsdl=',
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
            <ser:listRatePlansByDomain>
                <domain>'. getenv('SIPP_EXT_DOMAIN') .'</domain>
                <principal>
                    <login>'. getenv('SIPP_EXT_LOGIN') .'</login>
                    <password>'. getenv('SIPP_EXT_PASS') .'</password>
                </principal>
            </ser:listRatePlansByDomain>
        </soapenv:Body>
        </soapenv:Envelope>',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: text/xml'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        //echo $response;
        $xml = simplexml_load_string($response);

        if ($xml === false) {
            return back()->with('error', 'Não foi possível Listar os Planos de Tarifa');
        }

        $ptarifa = $xml->xpath('//ratePlan');
        dd($ptarifa);

    }

    public function alterPtarifa() {
        //dd('Dentro da Alteração do plano de tarifas');
        return view('Assinantes/alterPtarifa');
        //a endpoint não está funcionando, mas seria necessário também adicionar uma nova rota e função aqui para enviar a requisição com os dados alterados
    }

    public function deletePtarifa() {
        return view('Assinantes/deletePtarifa');
    }

    public function excludePtarifa(Request $request) {
        $domain = config('services.sipPulseTeste.dominio');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $domain . '/SipPulse/RatePlanWS?wsdl=',
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
            <ser:removeRatePlan>
                <idRatePlan>'.$request->idRatePlan.'</idRatePlan>
                <principal>
                    <login>'. getenv('SIPP_EXT_LOGIN') .'</login>
                    <password>'. getenv('SIPP_EXT_PASS') .'</password>
                </principal>
            </ser:removeRatePlan>
        </soapenv:Body>
        </soapenv:Envelope>',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: text/xml'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        if(is_null($response)) {
            echo "Não foi possível excluir este Plano de Tarifas";
        } else {
            echo "O Plano de tarifas foi excluído com sucesso";
        }
    }

    public function homeProfile() {
        return view('Assinantes/homeProfile');
    }

    public function listProfile() {
        $domain = config('services.sipPulseTeste.dominio');
        libxml_use_internal_errors(true);

        try {
            $curl = curl_init();
            

            if($curl === false) {   
                throw new \Exception("Falha de conexão. Erro: ");
            }

            curl_setopt_array($curl, array(
            CURLOPT_URL => $domain . '/SipPulse/ProfileWS?wsdl=',
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
                <ser:listProfilesByDomain>
                    <domain>'. getenv('SIPP_EXT_DOMAIN') .'</domain>
                    <principal>
                        <login>'. getenv('SIPP_EXT_LOGIN') .'</login>
                        <password>'. getenv('SIPP_EXT_PASS') .'</password>
                    </principal>
                </ser:listProfilesByDomain>
            </soapenv:Body>
            </soapenv:Envelope>',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml'
            ),
            ));  //dd($curl);
            $response = curl_exec($curl);
            //dd($response);
            $curlError = curl_error($curl);
            curl_close($curl);

            $xml = new \SimpleXMLElement($response);
            $xml->registerXPathNamespace('S', 'http://schemas.xmlsoap.org/soap/envelope/');
            $xml->registerXPathNamespace('ns2', 'http://service.ws.sippulse.voffice.com.br/');
            //dd($xml);

            $profiles = $xml->xpath('//profile');
            dd($profiles);

            if($profiles === false || empty($profiles)) {
                $errors = libxml_get_errors();
                if(!empty($errors)) {
                    libxml_clear_errors();
                    throw new \Exception('Não foi possível ler o XML');
                }
                return back()->with('error', 'Nenhum profile foi encontrado');
            } 
            //dd($profile);
        } catch (\Exception $e) {
            libxml_clear_errors();
            dd($e);
            //echo $e;
            //return back()->with('error', 'Não foi possível listar os Profiles. Error: ' . $e->getMessage());
        }
    }

    public function changeProfile() {
        echo "Está apresentando erro na Endpoint";
    }

    public function homeAssinantes() {
        return view('Assinantes/homeAssinantes');
    }

    public function addAssinante() {
        return view('Assinantes/addAssinantes');
    }

    public function saveAssinante(Request $request) {
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
            <ser:insertSubscriber>
                <subscriber>
                    <username>'.$request->username.'</username>
                    <domain>'. getenv('SIPP_EXT_DOMAIN') .'</domain>
                    <password>'. getenv('SIPP_EXT_PASS') .'</password>
                    <passwordPortal>'. getenv('SIPP_EXT_PASS') .'</passwordPortal>
                    <profile>'.$request->profile.'</profile>
                    <ratePlanId>'.$request->ratePlanId.'</ratePlanId>
                    <emailAddress>'.$request->emailAddress.'</emailAddress>
                    <countryCode>'.$request->countryCode.'</countryCode>
                    <areaCode>'.$request->areaCode.'</areaCode>
                    <callLimit>'.$request->callLimit.'</callLimit>
                    <voicemail>'.$request->voicemail.'</voicemail>
                    <resellerId>'.$request->resellerId.'</resellerId>
                    <callsOnlyByIp>'.$request->callsOnlyByIp.'</callsOnlyByIp>

                    <contractNumber>'.$request->contractNumber.'</contractNumber>
                    <cityCode>'.$request->cityCode.'</cityCode>
                    <localArea>0</localArea>
                    <firstName>'.$request->firstName.'</firstName>
                    <lastName>'.$request->lastName.'</lastName>
                    <document>'.$request->document.'</document>
                    <address>'.$request->address.'</address>
                    <number>'.$request->number.'</number>
                    <complement>'.$request->complement.'</complement>
                    <quarter>'.$request->quarter.'</quarter>
                    <city>'.$request->city.'</city>
                    <state>'.$request->state.'</state>
                    <zip>'.$request->zip.'</zip>
                    <phone>'.$request->phone.'</phone>
                    <mobile>0</mobile>
                    <voicePassword>0</voicePassword>
                    <resellerBillingType>0</resellerBillingType>
                    <resellerMarkup>0</resellerMarkup>
                    <resellerRatePlanId>0</resellerRatePlanId>
                    <rpid>1</rpid>
                    <callFwd>0</callFwd>
                    <fwdBusy>0</fwdBusy>
                    <noAnswer>0</noAnswer>
                    <activeIncomingCalls>1</activeIncomingCalls>
                    <activeOutgoingCalls>1</activeOutgoingCalls>
                    <blockCollectCalls>0</blockCollectCalls>
                    <blockAnonymousCalls>0</blockAnonymousCalls>
                    <lowCreditNotification>0</lowCreditNotification>
                    <lowCreditLimit>0</lowCreditLimit>
                    <!-- <softphoneAllowed>0</softphoneAllowed> -->
                    <!-- <blockedEntry0303>0</blockedEntry0303>
                    <validateSource0303>0</validateSource0303> -->
                </subscriber>
                <principal>
                    <login>'. getenv('SIPP_EXT_LOGIN') .'</login>
                    <password>'. getenv('SIPP_EXT_PASS') .'</password>
                </principal>
            </ser:insertSubscriber>
        </soapenv:Body>
        </soapenv:Envelope>',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: text/xml'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo "Assinante adicionado com sucesso. O ID é " . $response;
    }

    public function deleteAssinante() {
        return view('Assinantes/deleteAssinante');
    }

    public function excludeAssinante(Request $request) {
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
            <ser:removeSubscriber>
                <username>'.$request->username.'</username>
                <domain>'. getenv('SIPP_EXT_DOMAIN') .'</domain>
                <principal>
                    <login>'. getenv('SIPP_EXT_LOGIN') .'</login>
                    <password>'. getenv('SIPP_EXT_PASS') .'</password>
                </principal>
            </ser:removeSubscriber>
        </soapenv:Body>
        </soapenv:Envelope>',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: text/xml'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo "Este usuário foi deletado com sucesso" . $response;
    }

}
