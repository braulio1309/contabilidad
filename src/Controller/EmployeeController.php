<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Security;

class EmployeeController extends AbstractController
{
    
    public function index(Request $request, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Employee::class);

        $data = $data->findAll();
        
        return $this->render('/Employees/index.html.twig', ['data' => $data]);
    }

    public function showForm($id, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Employee::class);
        if($id)
            $data = $data->find($id);
        else
            $data = null;
        
        return $this->render('/Employees/form.html.twig', ['data' => $data]);
    }

    public function create(Request $request, UserPasswordHasherInterface $passwordEncoder, ValidatorInterface $validator)
    {
        $session = $request->getSession();        
        $session->start();
        
        $email = $request->get('email');
        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');
        $password = $request->get('password');

        $user = new Employee();

        $user->setPassword(
                    $passwordEncoder->hashPassword(
                        $user,
                        $password,
                    )
                );
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setEmail($email);
        $errors = $validator->validate($user);

        if(!count($errors)){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $session->getFlashBag()->add('success', 'Empleado creado con éxito');
        }else {
            $session->getFlashBag()->add('error', 'No se pudo crear el empleado');
        }
        
        return $this->redirectToRoute('list_employees');
    }

    public function update($id, Request $request, UserPasswordHasherInterface $passwordEncoder, ValidatorInterface $validator, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        $data = $doctrine->getRepository(Employee::class);
        $user = $data->find($id);

        $email = $request->get('email');
        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');
        $password = $request->get('password');

        if($password) {
            $user->setPassword(
                $passwordEncoder->hashPassword(
                    $user,
                    $password,
                )
            );
        }
        
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setEmail($email);
        $errors = $validator->validate($user);

        if(!count($errors)){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $session->getFlashBag()->add('success', 'Empleado actualizado con éxito');
        }else {
            $session->getFlashBag()->add('error', 'No se pudo actualizar el empleado');
        }
        
        return $this->redirectToRoute('list_employees');
    }

    public function delete($id, Request $request, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        $data = $doctrine->getRepository(Employee::class);
        $user = $data->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        $session->getFlashBag()->add('success', 'Empleado eliminado con éxito');
        
        return $this->redirectToRoute('list_employees');
    }

    
}