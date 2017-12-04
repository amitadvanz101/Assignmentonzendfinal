<?php

namespace Assignment\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Form\Element;

/**
 *
 * @ORM\Entity  
 * @ORM\Table(name="addcall")
 * 
 *
 * @property int $id;
 * @property int $how_u_feel;
 * @property int $question;
 * @property int $ans;
 * @property int $reason;
 */
class Assignment implements InputFilterAwareInterface {

    protected $inputFilter;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *   @ORM\Column(type="string")     
     */
    protected $how_u_feel;


    /**
     *   @ORM\Column(type="string")     
     */
    protected $question;

    /**
     *   @ORM\Column(type="integer")     
     */
    protected $ans;

    /**
     *   @ORM\Column(type="string")     
     */
    protected $reason;

    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property) {
        return $this->$property;
    }

    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value) {
        $this->$property = $value;
    }

   
    
    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function exchangeArray($data = array()) {
//        print_r($data);die;
        $this->how_u_feel = $data['how_u_feel'];
        $this->question = $data['question'];
        $this->ans = $data['ans'];
        $this->reason = $data['reason'];
       
       
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {

        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();
            

             $inputFilter->add($factory->createInput(array(
                        'name' => 'todayfeel',
                        'requiered' => TRUE,
            //     'validators' => array(array('name' => 'digits'),)
            )));
               

            $inputFilter->add($factory->createInput(array(
                        'name' => 'takenmed',
                        'requiered' => TRUE,
//                        'validators' => array(array('name' => 'digits'),)
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'takenmedid',
                        'requiered' => TRUE,
//                        'validators' => array(array('name' => 'digits'),)
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'takenmed12',
                        'requiered' => TRUE,
//                        'validators' => array(array('name' => 'digits'),)
            )));

            
                      $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}


