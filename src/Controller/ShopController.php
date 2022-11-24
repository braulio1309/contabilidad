<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\customerPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use App\Entity\Shop;
use App\Repository\ShopRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ShopController extends AbstractController
{
    
    public function index(Request $request, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Shop::class);

        $data = $data->findAll();
        
        return $this->render('/Shops/index.html.twig', ['data' => $data]);
    }

    public function showForm($id, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Shop::class);
        if($id)
            $data = $data->find($id);
        else
            $data = null;
        
        return $this->render('/Shops/form.html.twig', ['data' => $data]);
    }

    public function create(Request $request, ValidatorInterface $validator)
    {
        $session = $request->getSession();        
        $session->start();
        
        $email = $request->get('email');
        $name = $request->get('name');
        $address = $request->get('address');
        $agenteRetencion = $request->get('agenteRetencion');
        $regimenRimpe = $request->get('regimenRimpe');
        $numeroIdentificacion = $request->get('numeroIdentificacion');
        $obligadoContabiliadad = $request->get('obligadoContabilidad');
        $contribuyenteEspecial = $request->get('contribuyenteEspecial');
        $shop = new Shop();

        $shop->setName($name);
        $shop->setDireccionMatriz($address);
        $shop->setEmail($email);
        $shop->setAgenteRetencion($agenteRetencion);
        $shop->setNumeroIdentificacion($numeroIdentificacion);
        $shop->setRegimenRimpe(($regimenRimpe)? true: false);
        $shop->setObligadoContabilidad(($obligadoContabiliadad)? true : false);
        $shop->setContribuyenteEspecial(($contribuyenteEspecial)? 'Si': 'No');


        $errors = $validator->validate($shop);
        if(!count($errors)){
            $em = $this->getDoctrine()->getManager();
            $em->persist($shop);
            $em->flush();
            $session->getFlashBag()->add('success', 'Tienda creado con éxito');
        }else {
            $session->getFlashBag()->add('error', 'No se pudo crear el Tienda');
        }
        
        return $this->redirectToRoute('list_shop');
    }

    public function update($id, Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        $data = $doctrine->getRepository(Shop::class);
        $shop = $data->find($id);

        $email = $request->get('email');
        $name = $request->get('name');
        $address = $request->get('address');
        $agenteRetencion = $request->get('agenteRetencion');
        $regimenRimpe = $request->get('regimenRimpe');
        $numeroIdentificacion = $request->get('numeroIdentificacion');
        $obligadoContabiliadad = $request->get('obligadoContabilidad');
        $contribuyenteEspecial = $request->get('contribuyenteEspecial');

        $shop->setName($name);
        $shop->setDireccionMatriz($address);
        $shop->setEmail($email);
        $shop->setAgenteRetencion($agenteRetencion);
        $shop->setNumeroIdentificacion($numeroIdentificacion);
        $shop->setRegimenRimpe(($regimenRimpe)? true: false);
        $shop->setObligadoContabilidad(($obligadoContabiliadad)? true : false);
        $shop->setContribuyenteEspecial(($contribuyenteEspecial)? 'Si': 'No');

        $errors = $validator->validate($shop);

        if(!count($errors)){
            $em = $this->getDoctrine()->getManager();
            $em->persist($shop);
            $em->flush();
            $session->getFlashBag()->add('success', 'Tienda actualizado con éxito');
        }else {
            $session->getFlashBag()->add('error', 'No se pudo actualizar el Tienda');
        }
        
        return $this->redirectToRoute('list_shop');
    }

    public function delete($id, Request $request, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        $data = $doctrine->getRepository(Shop::class);
        $shop = $data->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($shop);
        $em->flush();
        $session->getFlashBag()->add('success', 'Tienda eliminado con éxito');
        
        return $this->redirectToRoute('list_shop');
    }

    
}