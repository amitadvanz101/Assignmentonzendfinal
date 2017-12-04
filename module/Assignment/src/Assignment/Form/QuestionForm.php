<?php
namespace Assignment\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Doctrine\ORM\EntityManager;

class QuestionForm extends Form
{
    public function __construct (EntityManager $em,$name = NULL)
    {
          $this->em = $em;
        parent::__construct('QuestionForm');
        
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-Freceipt');
       
       $this->add(array(
            'name' => 'question1',
            'type' => 'Textarea ',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'add your Question here',
            ),
        ));
       
      
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
    
}
