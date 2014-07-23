<?php 

namespace Staffdotcom\tdrest;

class Client {
 
    private $_accessToken;
    private $_debug;
    private $_apiHost;
    
    /**
     * The constructor
     *
     * @param  array  $config (
     *              string $accessToken - User access token taken from your app authorization page.
     *              boolean $debug      - Optional debug flag
     * )
     * @return void
     **/
    public function __construct($config)
    {
        $this->_accessToken = isset($config['accessToken']) ? $config['accessToken'] : null ;
        $this->_debug = isset($config['debug']) ? $config['debug'] : false ;
        $this->_apiHost = 'https://webapi.timedoctor.com/v1';
    }
    
    public function getCompanies()
    {
        $resourceUrl = '/companies';
        $url = $this->_apiHost.$resourceUrl;
        return $this->getRequest($url);
    }
    
    private function getRequest($url)
    {
        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "Authorization: Bearer {$this->_accessToken}";
        

        $ch = curl_init($url);

        if ($this->debug) {
            curl_setopt($ch, CURLOPT_VERBOSE, true);
        }

        if ($method != 'GET') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_BUFFERSIZE, 4096);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
        curl_setopt($ch, CURLOPT_USERPWD, $this->appId . ':' . $this->apiKey);

        $response = curl_exec($ch);

        // Set HTTP error, if any
        $this->lastError = array('code' => curl_errno($ch), 'message' => curl_error($ch));

        return json_decode($response);
    }
    
    
 
}
