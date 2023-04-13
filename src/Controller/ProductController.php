<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use App\Entity\Product;
use App\Entity\Taxes;
use Doctrine\ORM\EntityManagerInterface;

use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Knp\Component\Pager\PaginatorInterface;


class ProductController extends AbstractController
{
    public $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
   

    public function index(Request $request, ManagerRegistry $doctrine, PaginatorInterface $paginator)
    {
    $queryBuilder = $doctrine->getRepository(Product::class)->createQueryBuilder('c');

    if ($searchTerm = $request->query->get('search')) {
        $queryBuilder->where('c.codigo_producto LIKE :searchTerm')
            ->orWhere('c.description LIKE :searchTerm')
            ->orWhere('c.name LIKE :searchTerm')
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

    return $this->render('/Products/index.html.twig', [ 'data' => $pagination,
                                                        'total_pages' => $total_pages,
                                                        'current_page' => $current_page,
                                                        'limit_per_page' => $limit_per_page,
                                                        'my_route' => $my_route
                        ]);
    }

    public function showForm($id, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Product::class);
        if($id)
            $data = $data->find($id);
        else
            $data = null;
        
        $tax = $doctrine->getRepository(Taxes::class);

        $tax = $tax->findAll();
        
        return $this->render('/Products/form.html.twig', ['data' => $data, 'taxes' => $tax]);
    }

    public function create(Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine)
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
        $tax = $request->get('tax');
        
        $product = new Product();
        
        $product->setName($name);
        $product->setCode($code);
        $product->setPrice($price);
        $product->setDescription($description);
        $product->setDescriptionAditional1($description1);
        $product->setDescriptionAditional2($description2);
        $product->setDescriptionAditional3($description3);
        $taxes = $doctrine->getRepository(Taxes::class);
        $taxes = $taxes->find($tax);
        $product->setTax($taxes);
        $errors = $validator->validate($product);

        
        if(count($errors)){
            $errores=[];
            foreach($errors as $error){
                $errores[$error->getpropertyPath()] = $error->getMessage();
            }
            return $this->render('/Products/form.html.twig', 
            [
                'errors' => $errores, 
                'data' => $product,
                'taxes' => $doctrine->getRepository(Taxes::class)->findAll(),
                'type' =>'POST'
            ]);
        }else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $session->getFlashBag()->add('success', 'Producto creado con éxito');
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
        $tax = $request->get('tax');


        $product->setName($name);
        $product->setCode($code);
        $product->setPrice($price);
        $product->setDescription($description);
        $product->setDescriptionAditional1($description1);
        $product->setDescriptionAditional2($description2);
        $product->setDescriptionAditional3($description3);
        $taxes = $doctrine->getRepository(Taxes::class);
        $taxes = $taxes->find($tax);
        $product->setTax($taxes);

        $errors = $validator->validate($product);

        if(count($errors)){
            $errores=[];
            foreach($errors as $error){
                $errores[$error->getpropertyPath()] = $error->getMessage();
            }
            return $this->render('/Products/form.html.twig', 
            [
                'errors' => $errores, 
                'data' => $product,
                'taxes' => $doctrine->getRepository(Taxes::class)->findAll()
            ]);
        }else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $session->getFlashBag()->add('success', 'Producto creado con éxito');
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

    public function getProductsJson(Request $request, ManagerRegistry $doctrine)
    {
        if ($request->isXmlHttpRequest()) {
            // Procesa los datos de la petición AJAX
            $param1 = $request->get('search');
            $data = $this->entityManager->getRepository(Product::class)->findAll();
            // $query = $data->createQueryBuilder('a')
            //             ->where('a.name LIKE :name')
            //             ->setParameter('name', '%'.$param1.'%')
            //             ->getQuery()->getResult();
            foreach($data as $product){
                $pro[] = [
                    'id' => $product->getId(),
                    'name' => $product->getName(),
                    'code' => $product->getCode(),
                    'price' => $product->getPrice(),
                    'quantity' => 1,
                    'tax' => $product->getTax()->getPorcentaje()
                ];
            }
            // Devuelve una respuesta en formato JSON
            return new JsonResponse(array(
            'status' => 'ok',
            'products' => $pro,
            ));
        }
    }
}