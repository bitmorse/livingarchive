<?php

App::uses('Component', 'Controller');

class CurlHTTPComponent extends Component {

    public function Post($url, $datastring) {

    
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $datastring);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);

        return $result;
    }
    
    public function Get($url) {
        // is cURL installed yet?
        if (!function_exists('curl_init')){
            die('Sorry cURL is not installed!');
        }
     
        // OK cool - then let's create a new cURL resource handle
        $ch = curl_init();
     
        // Now set some options (most are optional)
     
        // Set URL to download
        curl_setopt($ch, CURLOPT_URL, $url);
     
        // Set a referer
        curl_setopt($ch, CURLOPT_REFERER, "Curl");
     
        // User agent
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/1.0");
     
        // Include header in result? (0 = yes, 1 = no)
        curl_setopt($ch, CURLOPT_HEADER, 0);
     
        // Should cURL return or print out the data? (true = return, false = print)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     
        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
     
        // Download the given URL, and return output
        $output = curl_exec($ch);
     
        // Close the cURL resource, and free system resources
        curl_close($ch);
     
        return $output;
    }
}


