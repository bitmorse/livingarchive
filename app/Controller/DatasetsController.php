<?php

class DatasetsController extends AppController {

    public function beforeFilter(){
        //which actions are public (dont require login)?
        $this->Auth->allow(array('index', 'stats'));
    }
    
    public function index(){

        if(@$_GET['term'] != ''){
            $params = array(
                'fields' => array('title', 'ckanSiteUrl', 'notes', 'name', 'isopen', 'url', 'ckanId', 'resources', 'tags'),
                'conditions' => array('notes' => array('$regex' => '.'.$_GET['term'].'.')),
                'order' => array('_id' => -1),
                'limit' => 1000,
                'page' => 1
            );

            $results = $this->Dataset->find('all', $params);

            $this->set('results', $results);
        }else{
            $results = array();
        }
    }

    public function stats(){

        ini_set('memory_limit', '164M');
        
        $results = $this->Dataset->find('all', array('fields' => array('tags', 'resources', 'ckanSiteUrl', 'lastCrawled'), 'conditions' => array('lastCrawled' => array('$ne' => 'never')  )));

        if(is_array($results)){
            foreach ($results as $result) {


                //store the tags
                if(@$result['Dataset']['tags']){
                    foreach ($result['Dataset']['tags'] as $tag) {
                        $tags[] = $tag;

                        echo $tag. ' ';
                    }
                }

            }
        }

        $this->set('amountOfCrawledDatasets', count($results));
        $this->set('crawledDatasets', $results);
        $this->set('crawledDatasetsTags', $tags);


    }


    public function create(){

            $this->Dataset->create();
            $this->Dataset->save(array("Dataset" => array("name" => "Traffic Data", "author"=>"Sam", "resources" => array("_id", array("name"=>"people"), array("name"=>"traffic") ))));

            exit();

    }




}