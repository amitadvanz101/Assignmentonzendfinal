<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonAssignment for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Assignment\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Assignment\Entity\Question;
use Assignment\Entity\Assignment;

class IndexController extends AbstractActionController {

    protected $em;

    /**
     * Returns an instance of the Doctrine entity manager loaded from the service 
     * locator
     * 
     * @return Doctrine\ORM\EntityManager
     */
    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }


    public function indexAction() {
        
            $em = $this->getEntityManager();
       $form = new \Assignment\Form\QuestionForm($em);
        $form->get('submit')->setValue('Save');
        $form->get('cancel')->setValue('Cancel');
//
        $request = $this->getRequest();
        if ($request->isPost()) {
            $Question = new \Assignment\Entity\Question();
            $form->setInputFilter($Question->getInputFilter());
//            print_r($request->getPost());die;
            $form->setData($request->getPost());
//
            if ($form->isValid()) {
                  $data=$form->getData();
              
              $insertdata['question']=$data['question1'];
              
                $Question->exchangeArray($insertdata);            
                $this->getEntityManager()->persist($Question);
                $this->getEntityManager()->flush();   
               
                return $this->redirect()->toRoute('assignment/default', array(
                            'controller' => 'index',
                            'action' => 'addassignment'
                ));
            }
        }
        return array('form' => $form);

 }
    
    public function addassignmentAction() {

            $em = $this->getEntityManager();
       $form = new \Assignment\Form\AssignmentForm($em);
        $form->get('submit')->setValue('Save');
        $form->get('cancel')->setValue('Cancel');
//
        $request = $this->getRequest();
        if ($request->isPost()) {
            $Assignment = new \Assignment\Entity\Assignment();
            $form->setInputFilter($Assignment->getInputFilter());
//            print_r($request->getPost());die;
            $form->setData($request->getPost());
//
            if ($form->isValid()) {
                  $data=$form->getData();
              $insertdata['how_u_feel']=$data['todayfeel'];
              $insertdata['question']=$data['takenmed'];
              $insertdata['ans']=$data['takenmedid'];
              $insertdata['reason']=$data['takenmed12'];
                $Assignment->exchangeArray($insertdata);            
                $this->getEntityManager()->persist($Assignment);
                $this->getEntityManager()->flush();   
               
                return $this->redirect()->toRoute('assignment/default', array(
                            'controller' => 'index',
                            'action' => 'index'
                ));
            }
        }
        return array('form' => $form);
//   
//             
    }
   

}
