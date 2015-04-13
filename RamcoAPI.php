<?php

  /**
  * API Written by Jason Normandin and Mark Lesswing
  * Class Design  Dave Conroy, Luis Pena
  * dconroy@marealtor.com March 2015
  * API Doc URL : https://api.ramcoams.com/api/v2/ramco_api_v2_doc.pdf
  */
 
class RamcoAPI
{   
    private $api_key= '';
    private $api_url= '';
    private $cert= '';
    
    var $attribute='';          
    var $attributes='';         // used with operation GetEntity, GetEntities
    var $attribute_values=''; //used with operation UpdateEntity
    var $entity='';
    var $filter ='';
    var $guid='';
    var $maxresults='';
    var $operation='';
    var $string_delimiter='';
    var $stream_token=''; //currently not supported
    var $timezone_offset = '+0 Hours'; // GMT
    
    public function __construct($aConfig){     
      $aConfig = (object) $aConfig;
      $this->setURL($aConfig->url);
      $this->setKey($aConfig->key);
      $this->setCert($aConfig->cert);
      $this->setTimezoneOffset($aConfig->timezone_offset);
        return true;
        //echo 'The class "', __CLASS__, '" was initiated!<br />';
    }
    
    public function __destruct(){
        //echo 'The class "', __CLASS__, '" was destroyed.<br />';
        return true;
    }
    
    public function __toString(){
      echo "Using the toString method: ";
      return $this->getProperty();
    }
    
    public function setURL($url) {
        $this->api_url = $url;
        
        return true;
    } // end function setURL()
    
    public function getURL() {
        return $this->url;
    } // end function getURL()
    
    public function setCert($cert) {
        $this->cert = $cert;
        
        return true;
    } // end function setCert()
    
     public function getCert() {
        return $this->cert;
    } // end function getCert()
    
    public function setKey($key) {
        $this->api_key = $key;
        
        return true;
    } // end function setKey()
        
    private function getKey() {
        return $this->api_key;
    } // end function getKey()
        
    public function setEntity($entity) {
        $this->entity = $entity;
        
        return true;
    } // end function setEntity()
    
    public function getEntity() {
        return $this->entity;
    } // end function getEntity()
    

    public function setOperation($operation) {
        $this->operation = $operation;
        
        return true;
    } // end function setOperation()
        
    public function getOperation() {
        return $this->operation;
    } // end function getOperation()
    
    public function setMaxResults($max_results) {
        $this->maxresults = $max_results;
        
        return true;
    } // end function setMaxResults()
    
    public function getMaxResults() {
        return $this->maxresults;
    } // end function getMaxResults()
    
    public function setStringDelimiter($string_delimiter) {
        $this->string_delimiter = $string_delimiter;
        
        return true;
    } // end function setStringDelimiter()
    
    public function getStringDelimiter() {
        return $this->string_delimiter;
    } // end function getStringDelimiter()
        
    public function setAttributes($attributes) {
        $this->attributes = $attributes;
        
        return true;
    } // end function setAttributes()

    public function getAttributes() {
        return $this->attributes;
    } // end function getAttributes()
    
    
    public function setFilter($filter) {
        $this->filter = $filter;
        
        return true;
    } // end function setFilter()

    public function getFilter() {
        return $this->filter;
    } // end function getFilter()
    
    
    public function setGUID($guid) {
        $this->guid = $guid;
        
        return true;
    } // end function setGUID()

    
    public function getGUID() {
        return $this->guid;
    } // end function getGUID()
    
        
    public function setTimezoneOffset($timezone_offset){
        $this->timezone_offset = $timezone_offset;
    } // end function setTimezoneOffset()
    
      public function getTimezoneOffset(){
        return $this->timezone_offset;
    } // end function geTimezoneOffset()
    
    public function setAttributeValues($attribute_values) {
        $this->attribute_values = $attribute_values;
        
        return true;
    } // end function setAttributeValues()
    
    public function getAttributeValues() {
        return $this->attribute_values;
    } // end function getAttributeValues()
    
    public function setStreamToken($stream_token) {
        $this->stream_token = $stream_token;
        
        return true;
    } // end function setAttributeValues()
    
    public function getStreamToken() {
        return $this->stream_token;
    } // end function setStreamToken()
    

    public function clearVars(){
        $this->attribute='';
        $this->attributes='';
        $this->attribute_values='';
        $this->entity='';
        $this->filter ='';
        $this->guid='';
        $this->maxresults='';
        $this->operation='';
        $this->stream_token='';
        $this->string_delimiter='';
        
    }  // end function clearVars()    
    
    protected function initializeRequest() {
        
         //tbc error checking
        $post['key']= $this->api_key;
        $post['Attribute'] = $this->attribute;
        $post['Attributes'] = $this->attributes;
        $post['AttributeValues'] = $this->attribute_values;
        $post['Entity'] = $this->entity;
        $post['Filter'] = $this->filter;
        $post['Guid'] = $this->guid;
        $post['MaxResults'] = $this->maxresults;
        $post['Operation'] = $this->operation;
        $post['StreamToken'] = $this->stream_token;
        $post['StringDelimiter'] = $this->string_delimiter;
         
         return $post;
        
    } // end function initializeRequest()    

    
    public function sendMessage() {
        
        $query=$this->initializeRequest();
        $curl = curl_init();
        
        //print_r($query);
        // Set the request url and specify port 443 for SSL.
        curl_setopt($curl, CURLOPT_URL, $this->api_url);
        curl_setopt($curl, CURLOPT_PORT , 443);
    
        // Specify that the request should be posted and add the post data.
        curl_setopt($curl, CURLOPT_POST, True);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
    
        // Verbose can be turned on to see LOTS of detail about the request and response.
        curl_setopt($curl, CURLOPT_VERBOSE, False);
        
        // No custom headers are needed.
        curl_setopt($curl, CURLOPT_HEADER, False);
    
        // Tell curl how to verify the SSL certificate.
       // curl_setopt($curl, CURLOPT_SSLVERSION,3); * DEPRECATED , DO NOT USE 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($curl, CURLOPT_CAINFO, PEM_FILE);
    
        // Tell curl that curl_exec should return the response as a string instead of a direct output.
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
        // Get the response.
        $resp_data = curl_exec($curl);
        $resp_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl); 
        
        // Return the response
        return $resp_data;
        }
        
}

?>
