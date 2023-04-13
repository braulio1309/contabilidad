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
use Knp\Component\Pager\PaginatorInterface;

class EmployeeController extends AbstractController
{

    public function index(Request $request, ManagerRegistry $doctrine, PaginatorInterface $paginator)
    {
    $queryBuilder = $doctrine->getRepository(Employee::class)->createQueryBuilder('c');

    if ($searchTerm = $request->query->get('search')) {
        $queryBuilder->where('c.firstname LIKE :searchTerm')
            ->orWhere('c.lastname LIKE :searchTerm')
            ->orWhere('c.email LIKE :searchTerm')
            ->setParameter('searchTerm', '%'.$searchTerm.'%');
    }
    
    $data = $queryBuilder->getQuery()->getResult();
    $pagination = $paginator->paginate(
        $data,
        $request->query->getInt('page', 1),
        $request->query->get('limit_per_page') ?? 10 // número de elementos por página
    );
    
    $total_pages    = $pagination->getPageCount();
    $current_page   = $pagination->getCurrentPageNumber();
    $limit_per_page = $pagination->getItemNumberPerPage();
    $my_route       = $request->attributes->get('_route');

    return $this->render('/Employees/index.html.twig', [ 'data' => $pagination,
                                                        'total_pages' => $total_pages,
                                                        'current_page' => $current_page,
                                                        'limit_per_page' => $limit_per_page,
                                                        'my_route' => $my_route
                        ]);
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

        if(count($errors)){
            $errores=[];
            foreach($errors as $error){
                $errores[$error->getpropertyPath()] = $error->getMessage();
            }
            return $this->render('/Employees/form.html.twig', ['errors' => $errores, 'data' => $user,'type' =>'POST']);
        }else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $session->getFlashBag()->add('success', 'Empleado creado con éxito');
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

        if(count($errors)){
            $errores=[];
            foreach($errors as $error){
                $errores[$error->getpropertyPath()] = $error->getMessage();
            }
            return $this->render('/Employees/form.html.twig', ['errors' => $errores, 'data' => $user]);
        }else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $session->getFlashBag()->add('success', 'Empleado actualizado con éxito');
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