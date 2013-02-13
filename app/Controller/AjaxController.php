<?php

class AjaxController extends AppController {

    public function beforeFilter(){
        //which actions are public (dont require login)?
        $this->Auth->allow(array('recentlyCrawled', 'autocomplete'));
    }

    public function recentlyCrawled(){
           
            //get similar datasets
            $recentlyCrawledQuery = '{"query":{"bool":{"must":[{"range":{"lastCrawled":{"lt":"'.time().'"}}}]}},"size":5,"sort":[{"lastCrawled":"desc"}],"facets":{}}';
            $recentlyCrawled = $this->CurlHTTP->Post('http://localhost:9200/livingarchive/datasets/_search', $recentlyCrawledQuery);
            
            header ('Content-type: application/json; charset=utf-8');
            echo $recentlyCrawled;

            exit();

    }


    public function autocomplete($type = ''){

        App::import('model', 'Dataset');
        $Dataset = new Dataset();

        $term = @$_GET['term'];

        if($term){

            switch ($type) {
                case 'licenses':
                    $licensesQuery = '{"query":{"bool":{"must":[{"wildcard":{"license_title":"'.$term.'*"}}]}},"from":0,"size":10}';
                    $licenses = $this->CurlHTTP->Post('http://localhost:9200/livingarchive/datasets/_search', $licensesQuery);
                
                    header ('Content-type: application/json; charset=utf-8');
                    echo $licenses;

                    break;
              
            }

        }

        exit();
    }



}