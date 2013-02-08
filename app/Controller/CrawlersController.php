<?php

class CrawlersController extends AppController {
        
    public $components = array(
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'authError' => 'Did you really think you are allowed to see that?'
        )
    );

    public function beforeFilter(){
        //which actions are public (dont require login)?
        $this->Auth->allow(array('index', 'create', 'crawl'));
    }

    public function index(){
        $params = array(
            'fields' => array('name', 'resources'),
            //'fields' => array('Post.title', ),
            'conditions' => array('resources' => array('name' => 'people')),
            //'conditions' => array('hoge' => array('$gt' => '10', '$lt' => '34')),
            //'order' => array('title' => 1, 'body' => 1),
            'order' => array('_id' => -1),
            'limit' => 35,
            'page' => 1
        );

        $results = $this->Dataset->find('all', $params);
        //$result = $this->Post->find('count', $params);
        echo '<pre>';
        var_dump($results);
        exit();
    }

    public function create(){

            $this->Dataset->create();
            $this->Dataset->save(array("Dataset" => array("name" => "Traffic Data", "author"=>"Sam", "resources" => array("_id", array("name"=>"people"), array("name"=>"traffic") ))));

            exit();

    }


    public function crawl($website, $action){

        set_time_limit(0);

        App::import("model", "Dataset");
        $Dataset = new Dataset();


        switch ($website) {

            case 'ckan':
                
                //configure all available ckan sites
                $ckanSites = array(
                    array('name'=>'thedatahub','url'=>'http://datahub.io'),
                    array('name'=>'opendataeuropa','url'=>'http://open-data.europa.eu/open-data/data'),
                    array('name'=>'publicdataeu','url'=>'http://publicdata.eu'),
                    array('name'=>'datagovuk','url'=>'http://data.gov.uk'),
                    array('name'=>'deckan','url'=>'http://de.ckan.net'),
                    array('name'=>'itckan','url'=>'http://it.ckan.net/api'),
                    array('name'=>'opengoves','url'=>'http://opengov.es'),
                    array('name'=>'opendatarotterdam','url'=>'http://data.rotterdamopendata.nl'),
                    array('name'=>'datospublicos','url'=>'http://datospublicos.org'),
                    array('name'=>'santacruzdata','url'=>'http://data.cityofsantacruz.com'),
                    array('name'=>'buenosairesgob','url'=>'http://data.buenosaires.gob.ar'),
                    array('name'=>'emapfgvbr','url'=>'http://ckan.emap.fgv.br'),
                    array('name'=>'dadosgovbr','url'=>'http://dados.gov.br'),
                    array('name'=>'dataqueensland','url'=>'https://data.qld.gov.au'),
                    array('name'=>'manchesterdata','url'=>'http://www.datagm.org.uk'),
                    array('name'=>'dadosabertossenado','url'=>'http://dadosabertos.senado.gov.br'),
                    array('name'=>'koreadatahub','url'=>'http://thedatahub.kr'),
                    array('name'=>'codingfordemocracy','url'=>'http://data.codingfordemocracy.org'),
                    array('name'=>'datitoscana','url'=>'http://dati.toscana.it'),
                    array('name'=>'datacolorado','url'=>'http://data.opencolorado.org'),
                    array('name'=>'datadenvergov','url'=>'http://data.denvergov.org'),
                    array('name'=>'datagovat','url'=>'http://www.data.gv.at/katalog'),
                    array('name'=>'opendataroma','url'=>'http://www.opendata.provincia.roma.it'),
                    array('name'=>'ieckan','url'=>'http://ie.ckan.net'),
                    array('name'=>'czckan','url'=>'http://cz.ckan.net'),
                    array('name'=>'brckan','url'=>'http://br.ckan.net'),
                    array('name'=>'iatireg','url'=>'http://iatiregistry.org'),
                    array('name'=>'rsckan','url'=>'http://rs.ckan.net')
                );
                
                $ckanApiGetDatasets = '/api/2/rest/dataset';

                if($action == 'getDatasetListsFromCatalogs'){
                    foreach ($ckanSites as $ckanSite) {

                        $ckanSiteDatasetList = $this->CurlHTTP->Get($ckanSite['url'].$ckanApiGetDatasets);
                        $ckanSiteDatasetList = json_decode($ckanSiteDatasetList);
                        
                        foreach ($ckanSiteDatasetList as $ckanSiteDatasetId) {

                            //create a preliminary dataset document in the database for the crawler to then fill with metadata
                            $Dataset->create();
                            $Dataset->save(array("Dataset" => array("ckanId" => $ckanSiteDatasetId, "ckanSiteUrl" => $ckanSite['url'], "lastCrawled" => 'never')));

                        }

                        sleep(3);

                    }

                    echo 'done';
                    exit();
                }


                if($action == 'getDatasetMetadata'){

                    $randomCkanSiteUrl = $ckanSites[array_rand($ckanSites)]['url'];

                    $datasetsNeverCrawled = $Dataset->find('all', array(
                                    'fields' => array('ckanId'),
                                    'conditions' => array('lastCrawled' => 'never', 'ckanSiteUrl' => $randomCkanSiteUrl ),
                                    'order' => array('_id' => -1),
                                    'limit' => 50,
                                    'page' => 1
                                ));



                    foreach ($datasetsNeverCrawled as $datasetNeverCrawled) {

                        //get data from api
                        $ckanSiteDatasetMeta = $this->CurlHTTP->Get($randomCkanSiteUrl.$ckanApiGetDatasets.'/'.$datasetNeverCrawled['Dataset']['ckanId']);
                        
                        //clean and prepare for db
                        $ckanSiteDatasetMeta = json_decode($ckanSiteDatasetMeta, true);
                        $ckanSiteDatasetMeta["_id"] = $datasetNeverCrawled['Dataset']['_id'];
                        $ckanSiteDatasetMeta["lastCrawled"] = time();

                        if($ckanSiteDatasetMeta){
                            $Dataset->save(array("Dataset" => $ckanSiteDatasetMeta));
                        }

                        sleep(2);

                    }

                    echo 'done';
                    exit();
                }
               


                break;
        }
       

    }
}