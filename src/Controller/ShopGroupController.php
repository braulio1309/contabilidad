<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use App\Entity\ShopGroup;
use App\Repository\ShopgroupRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ShopGroupController extends AbstractController
{
    
    public function index(Request $request, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Shopgroup::class);

        $data = $data->findAll();
        
        return $this->render('/Shopgroups/index.html.twig', ['data' => $data]);
    }

    public function showForm($id, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Shopgroup::class);
        if($id)
            $data = $data->find($id);
        else
            $data = null;
        
        return $this->render('/Shopgroups/form.html.twig', ['data' => $data]);
    }

    public function create(Request $request, ValidatorInterface $validator)
    {
        $session = $request->getSession();        
        $session->start();
        
        $name = $request->get('name');

        $shopgroup = new ShopGroup();

        $shopgroup->setName($name);

        $errors = $validator->validate($shopgroup);
        if(!count($errors)){
            $em = $this->getDoctrine()->getManager();
            $em->persist($shopgroup);
            $em->flush();
            $session->getFlashBag()->add('success', 'Shopgroupo creado con éxito');
        }else {
            $session->getFlashBag()->add('error', 'No se pudo crear el Shopgroupo');
        }
        
        return $this->redirectToRoute('list_shopgroup');
    }

    public function update($id, Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        $data = $doctrine->getRepository(Shopgroup::class);
        $shopgroup = $data->find($id);

        $name = $request->get('name');

        $shopgroup->setName($name);
        
        $errors = $validator->validate($shopgroup);

        if(!count($errors)){
            $em = $this->getDoctrine()->getManager();
            $em->persist($shopgroup);
            $em->flush();
            $session->getFlashBag()->add('success', 'Shopgroupo actualizado con éxito');
        }else {
            $session->getFlashBag()->add('error', 'No se pudo actualizar el Shopgroupo');
        }
        
        return $this->redirectToRoute('list_shopgroup');
    }

    public function delete($id, Request $request, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        $data = $doctrine->getRepository(Shopgroup::class);
        $shopgroup = $data->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($shopgroup);
        $em->flush();
        $session->getFlashBag()->add('success', 'Shopgroup eliminado con éxito');
        
        return $this->redirectToRoute('list_shopgroup');
    }

    
}