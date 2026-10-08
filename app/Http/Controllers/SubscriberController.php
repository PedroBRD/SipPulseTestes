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
        try {
            $domain = getenv('SIPP_EXT_DOMINIO');
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $domain . '/SipPulse/RateWS?wsdl=',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_VERBOSE => true,
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
            /*dd('<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.ws.sippulse.voffice.com.br/">
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
            </soapenv:Envelope>');  */
            //dd($curl);

            $response = curl_exec($curl);
            //dd($response); 
            echo $response;
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            //dd($http_code);

            if($http_code == 200) {
                echo "Tarifa de Venda Criada com sucesso";
            } else {
                echo "Erro: " . $http_code;
            };

            curl_close($curl);
        } catch (Exception $e) {
            dd("Erro: " . $e->getMessage());
        }

    }

    public function listTvenda() {
        try {
            $domain = getenv('SIPP_EXT_DOMINIO');
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
                    <!--Optional:-->
                    <domain>'. getenv('SIPP_EXT_DOMAIN') .'</domain>
                    <!--Optional:-->
                    <descripion>?</descripion>
                    <!--Optional:-->
                    <rateId>3003</rateId>
                    <!--Optional:-->
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
            //dd($response);

            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            //dd($http_code);

            //$resposta = json_decode($response, true);

            //$tvenda = $xml->xpath('//listRatesByParamsResponse');
            
            
            //dd($xml);
            if ($http_code !== 200) {
                echo "Não foi possível listar as Tarifas de Venda. Erro: " . $http_code;
            } else {
                echo "HTTP: " . $http_code;
                $xml = simplexml_load_string($response);
                //dd($response);
                echo "\n Está retornando estranho até na endpoint no postman";
                dd($xml);
            }

            //$tvenda = $xml->xpath('//rate');
            //dd($tvenda);
            curl_close($curl);

        } catch (Exception $e) {
            dd("Erro: " . $e->getMessage());
        }
    }

    public function deleteTvenda() {
        return view('Assinantes/deleteTvenda');
    }

    public function excludeTvenda(Request $request) {
        try {
        $domain = getenv('SIPP_EXT_DOMINIO');
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
        } catch (Exception $e) {
            dd("Erro: " . $e->getMessage());
        }
        
    }

    public function homePtarifas() {
        return view('Assinantes/homePtarifas');
    }

    public function addPtarifa() {
        return view('Assinantes/addPtarifa');
    }

    public function savePtarifa(Request $request) {
        try {    
            //dd('Dentro da Salvar Plano de Tarifas'); 
            $domain = getenv('SIPP_EXT_DOMINIO');
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
                        <freeMinutes>0</freeMinutes>
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
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            //dd($http_code);
            //dd($response);

            if($http_code !== 200) {
                echo "Plano de Tarifas não pode ser criado. Erro: " . $http_code;
            } else {
                echo "O Plano de Tarifas foi criado com sucesso";
            }
            curl_close($curl);
        } catch (Exception $e) {
            dd("Erro: " . $e->getMessage());
        }   

    }

    public function listPtarifa() {
        try {
            $domain = getenv('SIPP_EXT_DOMINIO');
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
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($http_code !== 200) {
                echo 'Não foi possível Listar os Planos de Tarifa. Erro: ' . $http_code;
            } else {
                $xml = simplexml_load_string($response);
                $ptarifa = $xml->xpath('//ratePlan');
                dd($ptarifa);
            }

            curl_close($curl);
        } catch (Exception $e) {
            dd("Erro: " . $e->getMessage());
        }

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
        try {
            $domain = getenv('SIPP_EXT_DOMINIO');
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
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if($http_code !== 200) {
                echo "Não foi possível excluir este Plano de Tarifas. Erro: " . $http_code;
            } else {
                echo "O Plano de tarifas foi excluído com sucesso";
            }
            curl_close($curl);
        } catch (Exception $e) {
            dd("Erro: " . $e->getMessage());
        }
    }

    public function homeProfile() {
        return view('Assinantes/homeProfile');
    }

    public function listProfile() {
        try {
            $domain = getenv('SIPP_EXT_DOMINIO');
            libxml_use_internal_errors(true);
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
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if($http_code !== 200) {
                echo "Não foi possível listar os Profiles. Erro: " . $http_code;
            } else {
                //dd($response);
                $xml = new \SimpleXMLElement($response);
                $profiles = $xml->xpath('//profile');
                echo "Aqui está dividindo o XML incorretamente. O grupo de Profiles e o nome de cada um está como <profile>, então está mostrando um array para o grupo e outro array com o nome do profile";
                dd($profiles);
            } 
            curl_close($curl);
        } catch (Exception $e) {
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
        try {
            $domain = getenv('SIPP_EXT_DOMINIO');
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
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            //dd($http_code);

            if($http_code !== 200) {
                echo "Não foi possível adicioanr o Assinante. Erro: " . $http_code;
            } else {
                echo "Assinante adicionado com Sucesso";
            }
            curl_close($curl);
        } catch (Exception $e) {
            dd("Erro: " . $e->getMessage());
        }
    }

    public function deleteAssinante() {
        return view('Assinantes/deleteAssinante');
    }

    public function excludeAssinante(Request $request) {
        try {
            $domain = getenv('SIPP_EXT_DOMINIO');
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
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if($http_code !== 200) {
                echo "Não foi possível deletar este assinante. Erro: " . $http_code;
            } else {
                echo "Este usuário foi deletado com sucesso";
            }

            curl_close($curl);
        } catch (Exception $e) {
            dd("Erro: " . $e->getMessage());
        }
    }

    public function changePass() {
        return view('Assinantes/changePass');
    }

    public function savePass(Request $request) {
        try {
            $domain = getenv('SIPP_EXT_DOMINIO');
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
                <ser:changePassword>
                    <username>'.$request->username.'</username>
                    <domain>'. getenv('SIPP_EXT_DOMAIN') .'</domain>
                    <actualPassword>'.$request->actualPassword.'</actualPassword>
                    <newPassword>'.$request->newPassword.'</newPassword>
                    <confirmNewPassword>'.$request->confirmNewPassword.'</confirmNewPassword>
                    <principal>
                        <login>'. getenv('SIPP_EXT_LOGIN') .'</login>
                        <password>'. getenv('SIPP_EXT_PASS') .'</password>
                    </principal>
                </ser:changePassword>
            </soapenv:Body>
            </soapenv:Envelope>',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml'
            ),
            ));
            $response = curl_exec($curl);
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if($http_code !== 200) {
                echo "Não foi possível alterar a senha. Erro: " . $http_code;
            } else {
                echo "Senha atualizada com sucesso";
            }

            curl_close($curl);

        } catch (Exception $e) {
            dd("Erro: " . $e->getMessage());
        }
    }

}
