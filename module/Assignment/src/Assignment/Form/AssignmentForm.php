<?php
namespace Assignment\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Doctrine\ORM\EntityManager;

class AssignmentForm extends Form
{
    public function __construct (EntityManager $em,$name = NULL)
    {
          $this->em = $em;
        parent::__construct('AssignmentForm');
        
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-Freceipt');
       
       $this->add(array(
            'name' => 'todayfeel',
            'type' => 'Textarea ',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'How you feel today ?',
            ),
        ));
         $this->add(array(
            'name' => 'takenmed',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Have you taken your 8:00 am medications ?',
//                'readonly' => 'true',
            ),
        )); 
        $takenmed = new Element\Select('takenmedid');
        $takenmed->setAttributes(array(
            'id'  => 'takenmed',
            "class"=>"form-control select ",
            "title"=> "Select Option",
         ));
        $takenmed->setValueOptions(
            array(
            'No'=>'No',
            'Yes'=>'Yes',
         )
             );
        
        
        $takenmed->setDisableInArrayValidator(TRUE);
        $this->add($takenmed);  
        

        
//      
         $takenmed12 = new Element\Select('takenmed12');
        $takenmed12->setAttributes(array(
            'id'  => 'takenmed12',
            "class"=>"form-control ",
            "title"=> "Select Option",
            "multiple"=>"multiple",
         ));
        $takenmed12->setValueOptions(
//            array(
//            'missed'=>'missed',
//            'was away'=>'was away',
//            'not well'=>'not well',
//         ) 
         $this->getOptionQuestion()
                
             );
        $takenmed12->setDisableInArrayValidator(TRUE);
        $this->add($takenmed12);
//        
      
      $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                //'value' => 'addmodeofpayment',
                'id' => 'submitbutton',
                'class' => "btn btn-primary"
            ),
        ));
      $this->add(array(
            'name' => 'cancel',
            'attributes' => array(
                'type' => 'button',
                //'value' => 'addmodeofpayment',
                'id' => 'cancel',
                'class' => "btn btn-default"
            ),
        ));
    }
        public function getOptionQuestion(){
        $em = $this->em;
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder->add('select', 'q.id ,q.question')
              ->add('from', 'Assignment\Entity\Question q') ;
        $result = $queryBuilder->getQuery()->getArrayResult();
        $selectData = array(''=>'Select Question');
           foreach ($result as $res) {
            $selectData[$res['id']] = $res['question'];
        }
        return $selectData;
    }
    
    
}
