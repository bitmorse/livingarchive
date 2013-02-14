<?php

class AjaxController extends AppController {

    public function beforeFilter(){
        //which actions are public (dont require login)?
        $this->Auth->allow(array('recentlyCrawled', 'autocomplete', 'logQueryResultClick'));
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


    public function logQueryResultClick(){
        
        App::import('model', 'SearchQuery');

        //update record with the clicked result id
        $data['SearchQuery']['dataset_id'] = $_POST['dsid'];
        $data['SearchQuery']['link_clicked'] = $_POST['hrefa'];
        $data['SearchQuery']['referer'] = $_SERVER['HTTP_REFERER'];
        $data['SearchQuery']['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['SearchQuery']['session_id'] = $this->Session->id(session_id());
        $data['SearchQuery']['resultcount'] = $_POST['resc'];
        $data['SearchQuery']['site'] = 'livingarchive';


        if($_POST['site']){
            $data['SearchQuery']['term'] = $_POST['term'];
            $data['SearchQuery']['site'] = $_POST['site'];
            $data['SearchQuery']['session_id'] = $_POST['session_id'];
            $data['SearchQuery']['ip'] = $_POST['ip'];
            $data['SearchQuery']['referer'] = $_POST['referer'];
        }

        //authorized?

        if(Cache::read($_SERVER['REMOTE_ADDR']) || $_POST['key'] == '906E47E371865A60C30F7ADF3AF78B24BECC483'){
            echo 'a';

            $SearchQuery = new SearchQuery();
            $SearchQuery->create();
                
            if($SearchQuery->save($data)){ echo '1'; }else{ echo '0'; }
        }else{
            echo 'na';
        }

        exit();
    }


}