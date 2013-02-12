<?php

class VisualisationsController extends AppController {

    public function beforeFilter(){
        //which actions are public (dont require login)?
        $this->Auth->allow(array('index', 'add', 'show'));
    }
    
    public function index(){
    	
        $visualisations = $this->Visualisation->find('all');

        $this->set('visualisations', $visualisations);
	}


    public function show($id = ''){
        if($id){
            $visualisation = $this->Visualisation->find('all', array('conditions' => array('_id' => $id)));
            $visualisation = $visualisation[0]['Visualisation'];
            $visualisation['created'] = explode(' ', $visualisation['created']);
            $visualisation['created'] = date('d.m.Y H:i:s', $visualisation['created'][1]);

            if($visualisation){
                $this->set('visualisation', $visualisation);
            }else{
                exit();
            }
            
        }else{
            exit();
        }
    }



	public function add(){

		//if postback
        if ($this->data){



        	$data = $this->data;

            $fileOK = $this->uploadFile('files/visualisations/', $data['Visualisation']['image']);
            if($fileOK){

                $data['Visualisation']['image'] = $fileOK;

                //create in db
                $this->Visualisation->create();
                
                if($this->Visualisation->save($data)){

                    $this->Session->setFlash('<div class="alert alert-success">Visualisation added!</div>');
                    $this->redirect('/visualisations');

                }else{
                    $this->Session->setFlash('<div class="alert alert-error">Check your data!</div>');
                    debug($this->Visualisation->validationErrors);
                }


            }else{
                 $this->Session->setFlash('<div class="alert alert-error">Please check the file types allowed (JPG, GIF or PNG)</div>');
            }

          
		}
    }

}