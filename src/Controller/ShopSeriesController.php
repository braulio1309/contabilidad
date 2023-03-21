<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use App\Entity\ShopSerie;
use App\Entity\Shop;
use App\Repository\ShopserieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ShopSeriesController extends AbstractController
{
    
    public function index(Request $request, ManagerRegistry $doctrine)
    {

        $data = $doctrine->getRepository(ShopSerie::class);

        $data = $data->findAll();


        return $this->render('/Shopseries/index.html.twig', ['data' => $data]);
    }

    public function showForm($id, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(ShopSerie::class);
        $shops = $doctrine->getRepository(Shop::class)->findAll();
        if($id)
            $data = $data->find($id);
        else
            $data = null;
        
        return $this->render('/Shopseries/form.html.twig', ['data' => $data, 'shops' => $shops]);
    }

    public function create(Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        
        $name = $request->get('name');
        $address = $request->get('address');
        $shop = $request->get('shop');
        $secuencia = $request->get('secuencia');
        $serie = $request->get('serie');
        $tipoDocumento = $request->get('codigoDocumento');
        $shop = $doctrine->getRepository(Shop::class)->findById((int) $shop);
        $shopserie = new ShopSerie();


        $shopserie->setNombreComercial($name);
        $shopserie->setDireccionEstablecimiento($address);
        $shopserie->setShopId($shop[0]);
        $shopserie->setSecuencia($secuencia);
        $shopserie->setSerie($serie);
        $shopserie->setCodigoDocumento($tipoDocumento);

        $errors = $validator->validate($shopserie);

        if(count($errors)){
            $errores=[];
            foreach($errors as $error){
                $errores[$error->getpropertyPath()] = $error->getMessage();
            }
            return $this->render('/Shopseries/form.html.twig', 
            [
                'errors' => $errores, 
                'data' => $shopserie,
                'shops' => $doctrine->getRepository(Shop::class)->findAll(),
                'type' =>'POST'
            ]);
        }else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shopserie);
            $em->flush();
            $session->getFlashBag()->add('success', 'Serie de Tienda creado con éxito');
        }
        
        return $this->redirectToRoute('list_shopseries');
    }

    public function update($id, Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        $data = $doctrine->getRepository(Shopserie::class);
        $shopserie = $data->find($id);

        $name = $request->get('name');
        $address = $request->get('address');
        $shop = $request->get('shop');
        $secuencia = $request->get('secuencia');
        $serie = $request->get('serie');
        $tipoDocumento = $request->get('codigoDocumento');

        $shop = $doctrine->getRepository(Shop::class)->findById((int) $shop);
        $shopserie->setNombreComercial($name);
        $shopserie->setDireccionEstablecimiento($address);
        $shopserie->setShopId($shop[0]);
        $shopserie->setSecuencia($secuencia);
        $shopserie->setSerie($serie);
        $shopserie->setCodigoDocumento($tipoDocumento);
        
        $errors = $validator->validate($shopserie);

        if(count($errors)){
            $errores=[];
            foreach($errors as $error){
                $errores[$error->getpropertyPath()] = $error->getMessage();
            }
            return $this->render('/Shopseries/form.html.twig', 
            [
                'errors' => $errores, 
                'data' => $shopserie,
                'shops' => $doctrine->getRepository(Shop::class)->findAll()
            ]);
        }else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shopserie);
            $em->flush();
            $session->getFlashBag()->add('success', 'Serie de Tienda actualizado con éxito');
        }
        
        return $this->redirectToRoute('list_shopseries');
    }

    public function delete($id, Request $request, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        $data = $doctrine->getRepository(Shopserie::class);
        $shopserie = $data->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($shopserie);
        $em->flush();
        $session->getFlashBag()->add('success', 'Serie de Tienda eliminado con éxito');
        
        return $this->redirectToRoute('list_shopseries');
    }

    
}