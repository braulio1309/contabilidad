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
use Knp\Component\Pager\PaginatorInterface;


class ShopGroupController extends AbstractController
{
    
    public function index(Request $request, ManagerRegistry $doctrine, PaginatorInterface $paginator)
    {
    $queryBuilder = $doctrine->getRepository(Shopgroup::class)->createQueryBuilder('c');

    if ($searchTerm = $request->query->get('search')) {
        $queryBuilder->where('c.name LIKE :searchTerm')
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

    return $this->render('/Shopgroups/index.html.twig', [ 'data' => $pagination,
                                                        'total_pages' => $total_pages,
                                                        'current_page' => $current_page,
                                                        'limit_per_page' => $limit_per_page,
                                                        'my_route' => $my_route
                        ]);
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
       
        if(count($errors)){
            $errores=[];
            foreach($errors as $error){
                $errores[$error->getpropertyPath()] = $error->getMessage();
            }
            return $this->render('/Shopgroups/form.html.twig', 
            [
                'errors' => $errores, 
                'data' => $shopgroup,
                'type' =>'POST'
            ]);
        }else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shopgroup);
            $em->flush();
            $session->getFlashBag()->add('success', 'Grupo de Tienda creado con éxito');
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

        if(count($errors)){
            $errores=[];
            foreach($errors as $error){
                $errores[$error->getpropertyPath()] = $error->getMessage();
            }
            return $this->render('/Shopgroups/form.html.twig', 
            [
                'errors' => $errores, 
                'data' => $shopgroup
            ]);
        }else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shopgroup);
            $em->flush();
            $session->getFlashBag()->add('success', 'Grupo de Tienda creado con éxito');
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