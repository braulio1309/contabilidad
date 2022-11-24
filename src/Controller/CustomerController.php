<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\customerPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class CustomerController extends AbstractController
{
    
    public function index(Request $request, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Customer::class);

        $data = $data->findAll();
        
        return $this->render('/Customers/index.html.twig', ['data' => $data]);
    }

    public function showForm($id, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Customer::class);
        if($id)
            $data = $data->find($id);
        else
            $data = null;
        
        return $this->render('/Customers/form.html.twig', ['data' => $data]);
    }

    public function create(Request $request, ValidatorInterface $validator)
    {
        $session = $request->getSession();        
        $session->start();
        
        $email = $request->get('email');
        $company = $request->get('customer');
        $address = $request->get('address1');
        $tipoIdentificacion = $request->get('tipo_identificacion');
        $numeroIdentificacion = $request->get('numero_identificacion');
        $city = $request->get('city');
        $phone = $request->get('phone');

        $customer = new Customer();

        $customer->setCompany($company);
        $customer->setAddress1($address);
        $customer->setEmail($email);
        $customer->setTipoIdentificacion($tipoIdentificacion);
        $customer->setNumeroIdentificacion($numeroIdentificacion);
        $customer->setPhone($phone);
        $customer->setCity($city);


        $errors = $validator->validate($customer);
        if(!count($errors)){
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();
            $session->getFlashBag()->add('success', 'Cliente creado con éxito');
        }else {
            $session->getFlashBag()->add('error', 'No se pudo crear el Cliente');
        }
        
        return $this->redirectToRoute('list_customer');
    }

    public function update($id, Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        $data = $doctrine->getRepository(Customer::class);
        $customer = $data->find($id);

        $email = $request->get('email');
        $company = $request->get('customer');
        $address = $request->get('address1');
        $tipoIdentificacion = $request->get('tipo_identificacion');
        $numeroIdentificacion = $request->get('numero_identificacion');
        $city = $request->get('city');
        $phone = $request->get('phone');

        $customer->setCompany($company);
        $customer->setAddress1($address);
        $customer->setEmail($email);
        $customer->setTipoIdentificacion($tipoIdentificacion);
        $customer->setNumeroIdentificacion($numeroIdentificacion);
        $customer->setPhone($phone);
        $customer->setCity($city);

        $errors = $validator->validate($customer);

        if(!count($errors)){
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();
            $session->getFlashBag()->add('success', 'Cliente actualizado con éxito');
        }else {
            $session->getFlashBag()->add('error', 'No se pudo actualizar el Cliente');
        }
        
        return $this->redirectToRoute('list_customer');
    }

    public function delete($id, Request $request, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        $data = $doctrine->getRepository(Customer::class);
        $customer = $data->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($customer);
        $em->flush();
        $session->getFlashBag()->add('success', 'Cliente eliminado con éxito');
        
        return $this->redirectToRoute('list_customer');
    }

    
}