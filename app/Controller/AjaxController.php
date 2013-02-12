<?php

class AjaxController extends AppController {

    public function beforeFilter(){
        //which actions are public (dont require login)?
        $this->Auth->allow(array('recentlyCrawled'));
    }

    public function recentlyCrawled(){
           
            //get similar datasets
            $recentlyCrawledQuery = '{"query":{"bool":{"must":[{"range":{"lastCrawled":{"lt":"'.time().'"}}}]}},"size":5,"sort":[{"lastCrawled":"desc"}],"facets":{}}';
            $recentlyCrawled = $this->CurlHTTP->Post('http://localhost:9200/livingarchive/datasets/_search', $recentlyCrawledQuery);
            
            header ('Content-type: application/json; charset=utf-8');
            echo $recentlyCrawled;

            exit();

    }



}