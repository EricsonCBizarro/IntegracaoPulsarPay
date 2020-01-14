<?php

class HttpPulsarPay
{
    private $bearerToken = null;
    private $ppToken = null;
    private $password = null;
    private $logado = false;

    // Config
    public $urlApiPP = 'https://api-sandbox.pulsarpay.com/api/';

    function __construct($ppToken, $password, $bearerToken = null, $logado = false)
    {
        $this->ppToken = $ppToken;
        $this->password = $password;
        $this->bearerToken = $bearerToken;
        $this->logado = $logado;
    }

    function get_bearerToken()
    {
        return $this->bearerToken;
    }

    private function update_bearerToken($bearerToken)
    {
        $this->bearerToken = $bearerToken;
    }

    function get_ppToken()
    {
        return $this->ppToken;
    }

    function get_password()
    {
        return $this->password;
    }

    function get_logado()
    {
        return $this->logado;
    }

    function update_logado()
    {
        $this->logado = !$this->logado;
    }

    function get_urlApiPP()
    {
        return $this->urlApiPP;
    }

    public function authApi()
    {
        if ($this->get_bearerToken() !== null) {
//            die('verifica ppToken, se é valido etc');

        } else {
            $responseApiGetBearerToken = $this->httpGetBearerToken($this->get_ppToken(), $this->get_password());
            if ($responseApiGetBearerToken['status'] == 200) {
                $this->update_bearerToken($responseApiGetBearerToken['body']->token);
                $this->update_logado();
                return ['status_code' => 200, 'status' => true];
            } else {
                return ['status_code' => $responseApiGetBearerToken['status'], 'status' => false];
            }
        }
    }

    /**
     * @param
     * pp_token = email de acesso do usuario
     * password = password de acesso do usuario
     * @return array com data json Response
     * 200 - Token = Utilizado em todos os requests da PulsarPay
     */
    private function httpGetBearerToken($ppToken, $password)
    {
        $curl = curl_init();
        if (!$curl) {
            die('Erro iniciacilização Curl');
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->get_urlApiPP() . "usuario/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query(['pp_token' => $ppToken, 'password' => $password]),
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);

        if (empty($response)) {
//            $err = curl_error($curl);
//            curl_close($curl);
            die('Erro no exec do Curl');
        } else {
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if (empty($http_code)) {
                die('Erro sem retorno http code');
            } else {
                return ['status' => $http_code, 'body' => json_decode($response)];
            }
        }
    }

    function httpGetBoletos($filters = [], $itens_por_pagina = 10)
    {
        $url = $this->get_urlApiPP() . "boleto/listar?itens_por_pagina=$itens_por_pagina";

        $keys = array_keys($filters);
        foreach ($keys as $key) {
            $url = $url . '&' . $key . '=' . $filters[$key];
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Cache-Control: no-cache",
                "Content-Type: application/json",
                "Authorization: Bearer " . $this->get_bearerToken()
            ),
        ));

        $response = curl_exec($curl);

        if (empty($response)) {
//            $err = curl_error($curl);
//            curl_close($curl);
            die('Erro no exec do Curl');
        } else {
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if (empty($http_code)) {
                die('Erro sem retorno http code');
            } else {
                return ['status' => $http_code, 'body' => json_decode($response)];
            }
        }
    }

    function httpGetClientes($filters = [], $itens_por_pagina = 10)
    {
        $url = $this->get_urlApiPP() . "cliente?itens_por_pagina=$itens_por_pagina";

        $keys = array_keys($filters);
        foreach ($keys as $key) {
            $url = $url . '&' . $key . '=' . $filters[$key];
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Cache-Control: no-cache",
                "Content-Type: application/json",
                "Authorization: Bearer " . $this->get_bearerToken()
            ),
        ));

        $response = curl_exec($curl);

        if (empty($response)) {
//            $err = curl_error($curl);
//            curl_close($curl);
            die('Erro no exec do Curl');
        } else {
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if (empty($http_code)) {
                die('Erro sem retorno http code');
            } else {
                return ['status' => $http_code, 'body' => json_decode($response)];
            }
        }
    }

    function httpGetProdutos($filters = [], $itens_por_pagina = 10)
    {
        $url = $this->get_urlApiPP() . "produto?itens_por_pagina=$itens_por_pagina";

        $keys = array_keys($filters);
        foreach ($keys as $key) {
            $url = $url . '&' . $key . '=' . $filters[$key];
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Cache-Control: no-cache",
                "Content-Type: application/json",
                "Authorization: Bearer " . $this->get_bearerToken()
            ),
        ));

        $response = curl_exec($curl);

        if (empty($response)) {
//            $err = curl_error($curl);
//            curl_close($curl);
            die('Erro no exec do Curl');
        } else {
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if (empty($http_code)) {
                die('Erro sem retorno http code');
            } else {
                return ['status' => $http_code, 'body' => json_decode($response)];
            }
        }
    }

    function httpPostClientes($dadosRequest){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->get_urlApiPP() . "cliente",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($dadosRequest),
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Cache-Control: no-cache",
                "Content-Type: application/x-www-form-urlencoded",
                "Authorization: Bearer " . $this->get_bearerToken()
            ),
        ));

        $response = curl_exec($curl);

        if (empty($response)) {
//            $err = curl_error($curl);
//            curl_close($curl);
            die('Erro no exec do Curl');
        } else {
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if (empty($http_code)) {
                die('Erro sem retorno http code');
            } else {
                return ['status' => $http_code, 'body' => json_decode($response)];
            }
        }
    }

    function httpPostProduto($dadosRequest){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->get_urlApiPP() . "produto",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($dadosRequest),
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Cache-Control: no-cache",
                "Content-Type: application/x-www-form-urlencoded",
                "Authorization: Bearer " . $this->get_bearerToken()
            ),
        ));

        $response = curl_exec($curl);

        if (empty($response)) {
//            $err = curl_error($curl);
//            curl_close($curl);
            die('Erro no exec do Curl');
        } else {
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if (empty($http_code)) {
                die('Erro sem retorno http code');
            } else {
                return ['status' => $http_code, 'body' => json_decode($response)];
            }
        }
    }

    function httpGerarBoleto($token,$dadosRequest){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->get_urlApiPP() . "boleto/gerar",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($dadosRequest),
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Cache-Control: no-cache",
                "Content-Type: application/x-www-form-urlencoded",
                "Authorization: Bearer " . $this->get_bearerToken()
            ),
        ));

        $response = curl_exec($curl);

        if (empty($response)) {
//            $err = curl_error($curl);
//            curl_close($curl);
            die('Erro no exec do Curl');
        } else {
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if (empty($http_code)) {
                die('Erro sem retorno http code');
            } else {
                return ['status' => $http_code, 'body' => json_decode($response)];
            }
        }
    }


}