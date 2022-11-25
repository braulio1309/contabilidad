<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ProductController extends AbstractController
{
    
    public function index(Request $request, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Product::class);

        $data = $data->findAll();
        
        return $this->render('/Products/index.html.twig', ['data' => $data]);
    }

    public function showForm($id, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Product::class);
        if($id)
            $data = $data->find($id);
        else
            $data = null;
        
        return $this->render('/Products/form.html.twig', ['data' => $data]);
    }

    public function create(Request $request, ValidatorInterface $validator)
    {
        $session = $request->getSession();        
        $session->start();
        
        $name = $request->get('name');
        $code = $request->get('code');
        $description = $request->get('description');
        $description1 = $request->get('description1');
        $description2 = $request->get('description2');
        $description3 = $request->get('description3');
        $price = $request->get('price');

        $product = new Product();

        $product->setName($name);
        $product->setCode($code);
        $product->setPrice($price);
        $product->setDescription($description);
        $product->setDescriptionAditional1($description1);
        $product->setDescriptionAditional2($description2);
        $product->setDescriptionAditional3($description3);

        $errors = $validator->validate($product);
        if(!count($errors)){
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $session->getFlashBag()->add('success', 'Producto creado con éxito');
        }else {
            $session->getFlashBag()->add('error', 'No se pudo crear el Producto');
        }
        
        return $this->redirectToRoute('list_product');
    }

    public function update($id, Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        $data = $doctrine->getRepository(Product::class);
        $product = $data->find($id);

        $name = $request->get('name');
        $code = $request->get('code');
        $description = $request->get('description');
        $description1 = $request->get('description1');
        $description2 = $request->get('description2');
        $description3 = $request->get('description3');
        $price = $request->get('price');


        $product->setName($name);
        $product->setCode($code);
        $product->setPrice($price);
        $product->setDescription($description);
        $product->setDescriptionAditional1($description1);
        $product->setDescriptionAditional2($description2);
        $product->setDescriptionAditional3($description3);

        $errors = $validator->validate($product);

        if(!count($errors)){
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $session->getFlashBag()->add('success', 'Producto actualizado con éxito');
        }else {
            $session->getFlashBag()->add('error', 'No se pudo actualizar el Producto');
        }
        
        return $this->redirectToRoute('list_product');
    }

    public function delete($id, Request $request, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        $data = $doctrine->getRepository(Product::class);
        $product = $data->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        $session->getFlashBag()->add('success', 'Producto eliminado con éxito');
        
        return $this->redirectToRoute('list_product');
    }

    
}