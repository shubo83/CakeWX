<?php

class Soap {

        var $curl;

        function __construct() 
        {
                // require_once("./_curl.php");
                // $this->curl = new Curl();
        }

        /**
        * undocumented function
        *
        * @return void
        * @author apple
        **/
        function sendmsg($phone, $content, $account = array(), $manage = 0)
        {
                $manage = 0;
                $url = "http://service.winic.org/sys_port/gateway/?id=%s&pwd=%s&to=%s&content=%s&time=";
                $config['uid'] = isset($account['user']) ? $account['user'] : ($manage ? '手机验证测试' : '');
                $config['pwd'] = isset($account['pass']) ? $account['pass'] : ($manage ? 'x077968' : '');
                $config['tos'] = $phone;
                $config['msg'] = $content;
                $client = new SoapClient("http://service2.winic.org:8003/Service.asmx?WSDL");
                $result = $client->__soapCall('SendMessages', array('parameters' => $config));
                if ($result->SendMessagesResult > 0) return TRUE;
        }
}

if (isset($_GET['type']) && $_GET['type'] == 'soap')
{
        $server = new SoapServer(null, array('soap_version' => SOAP_1_2, 'uri' => "soap123" ));
        $server->setClass('Soap');
        $server->handle();
}


?>