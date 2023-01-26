<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends AbstractController
{
    #[Route('/ajax_check_user', name: 'ajax_check_user', methods: ['POST'])]
    public function index(Request $request, ManagerRegistry $doctrine)
    {
        $return = "false";

        if($request->isXmlHttpRequest()){
            
            $email = $request->get('email');
            $password = $request->get('password');
           
            $exists = $doctrine->getRepository(Utilisateur::class)->checkEmailExists($email, $password);
           
            if(count($exists) > 0){
                $return = "true";
            }
        }
        
        return new Response($return);
    }
}
