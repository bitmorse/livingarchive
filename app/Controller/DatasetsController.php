<?php

class DatasetsController extends AppController {

    public function beforeFilter(){
        //which actions are public (dont require login)?
        $this->Auth->allow(array('index', 'stats', 'show', 'add'));
    }
    
    public function index(){

        if(@$_GET['from'] == ''){
            $from = 0;
        }else{
            $from = $_GET['from'];
        }

        if(@$_GET['term'] != ''){

            $queryterm = '?term='.@$_GET['term'];
            
            $query = '{"query":{"bool":{"must":[{"fuzzy":{"_all":{"value":"'.$_GET['term'].'"}}}],"must_not":[],"should":[]}},"from":'.$from.',"size":10,"sort":[],"facets": { "tag" : { "terms" : { "field" : "tags", "size" : 50 } } }}';
            
            $results = $this->CurlHTTP->Post('http://localhost:9200/livingarchive/_search', $query);
            $results = json_decode($results, true);
            $this->set('results', $results);

        }elseif (@$_GET['tag'] != '') {

            $queryterm = '?term='.@$_GET['tag'];
            
            $tagQuery = '{"query":{"bool":{"should":[{"term":{"tags":"'.$_GET['tag'].'"}}]}},"from":'.$from.',"size":10,"sort":[],"facets":{}}';
            $results = $this->CurlHTTP->Post('http://localhost:9200/livingarchive/_search', $tagQuery);
            $results = json_decode($results, true);

            if(@$results['hits']['total'] == 0){
                $this->redirect('/datasets?term='.$_GET['tag']);
            }else{
                $this->set('results', $results);
            }


        }else{
            $results = array();
        }


        //pagination
        if(@$results['hits']['total'] > 10){
            
            $pagination = '<div class="pagination"><ul>';
            
            $from = 0;
            $page = 1;       
            for ($i=10; $i < $results['hits']['total']; $i++) {
                if($page < 16){
                    if($i%10 == 0) {
                        $pagination .= '<li><a href="'.$queryterm.'&from='.$from.'&to='.$i.'">'.$page.'</a></li>';
                        $from += 10;
                        $page += 1;
                    }
                }
            }

            //add last page
            if($results['hits']['total']%10 > 0){
                $pagination .= '<li><a href="'.$queryterm.'&from='.$from.'&to='.$results['hits']['total'].'">'.$page.'</a></li>';
            }

                                                
            $pagination .= '</ul></div>';
            $this->set('pagination', $pagination);
        }


        //output result count 
        $this->set('resultcount', (@$results['hits']['total'] == 0 ? 0 : @$results['hits']['total']));
    }

    public function show($datasetId){

            //get dataset
            $params = array(
                'conditions' => array('_id' => $datasetId),
                'order' => array('_id' => -1),
                'limit' => 1,
                'page' => 1
            );

            $results = $this->Dataset->find('all', $params);
            $dataset = $results[0]['Dataset'];
            $this->set('dataset', $dataset);


            //get similar datasets
            $mlt_query = '{
                    "more_like_this" : {
                        "fields" : "title",
                        "like_text" : "'.$dataset['title'].'",
                        "min_term_freq" : 1,
                        "max_query_terms" : 12
                    }
                }';
            $mlt = $this->CurlHTTP->Get('http://localhost:9200/livingarchive/datasets/'.$datasetId.'/_mlt?mlt_fields=title,notes');
            $mlt = json_decode($mlt, true);
            $mlt = $mlt['hits']['hits'];
            $this->set('mlt', $mlt);


    }




    public function stats(){
        //count datasets
        $countDatasets = $this->Dataset->find('count', array('fields' => 'lastCrawled', 'conditions' => array('lastCrawled' => array('$ne' => 'never')  )));
        Cache::write('countDatasets', $countDatasets, 'long');

        //get tags
        $tagsQuery = '{
            "query" : { "query_string" : {"query" : "*"}},
            "from": 0,
            "size": 1000,
            "facets" : {
                "tags" : { "terms" : {"field" : "tags", "size": 200 }}
            }
        }';

        $tagsInDatasets = $this->CurlHTTP->Post('http://localhost:9200/livingarchive/datasets/_search', $tagsQuery);
        $tagsInDatasets = json_decode($tagsInDatasets, true);
        $tagsInDatasets = $tagsInDatasets['facets']['tags']['terms'];

        foreach ($tagsInDatasets as $tagsInDataset) {
            $crawledDatasetsTags[] = array('text'=>$tagsInDataset['term'], 'weight'=>$tagsInDataset['count'], 'link'=>'/datasets/?tag='.$tagsInDataset['term']);
        }

        $crawledDatasetsTagsJSON = json_encode($crawledDatasetsTags);


        $this->set('amountOfCrawledDatasets', $countDatasets);
        $this->set('crawledDatasetsTagsJSON', $crawledDatasetsTagsJSON);

    }


    public function add(){

        /*
            $this->Dataset->create();
            $this->Dataset->save(array("Dataset" => array("name" => "Traffic Data", "author"=>"Sam", "resources" => array("_id", array("name"=>"people"), array("name"=>"traffic") ))));

            exit();
        */
    }




}