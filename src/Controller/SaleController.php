<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use App\Entity\Venta;
use App\Repository\VentaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\Shop;
use App\Entity\Customer;
use App\Entity\Product;
use App\Entity\VentaDetail;

class SaleController extends AbstractController
{
    
    public function index(Request $request, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Venta::class);

        $data = $data->findAll();
        
        return $this->render('/Sales/index.html.twig', ['data' => $data]);
    }

    public function showForm($id, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Venta::class);
        $shops = $doctrine->getRepository(Shop::class)->findAll();
        $customers = $doctrine->getRepository(Customer::class)->findAll();
        $products = $doctrine->getRepository(Product::class)->findAll();
        $details = null;
        foreach($products as $product){
            $pro[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice()
            ];
        }

        foreach($customers as $client){
            $clients[] = [
                'id' => $client->getId(),
                'name' => $client->getCompany(),
                'tipoDocumento' => $client->getTipoIdentificacion(),
                'numeroDocumento' => $client->getNumeroIdentificacion(),
                'email' => $client->getEmail()
            ];
        }
        if($id){
            $data = $data->find($id);
            $details = $data->getVentaDetails();
        }else
            $data = null;

        $root = ($id)? 'edit': 'form';
        
        return $this->render('/Sales/'.$root.'.html.twig', [
            'data' => $data, 
            'shops' => $shops, 
            'customers' => $customers, 
            'products' => $products, 
            'product' => $pro,
            'clients' => $clients,
            'details' => $details
        ]);
    }

    public function create(Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        
        $tipo = $request->get('tipo_identificacion');
        $email = $request->get('email');
        $numero = $request->get('numero_identificacion');
        $description = $request->get('description');
        $ambiente = $request->get('ambiente');
        $customer = $request->get('customer');
        $xmlEstado = $request->get('xml_estado');
        $fechaAutorizacion = $request->get('fecha_autorizacion');
        $fechaAutorizacion = new \DateTime($fechaAutorizacion);
        $fechaEmision = $request->get('fecha_emision');
        $fechaEmision = new \DateTime($fechaEmision);
        $products = $request->get('products');
        $items = $request->get('items');
        $subtotals = $request->get('subtotals');
        $discount = $request->get('discount');
        $total = $request->get('total');
        $shop = $request->get('shop');
        $subtotal = $request->get('subtotalFinal');
        $discount = $request->get('discount');
        $ambiente = $request->get('ambiente');
        $tipoEmision = $request->get('tipoEmision');

        $sale = new Venta();
        $sale->setTipoIdentificacion($tipo);
        $sale->setEmail($email);
        $sale->setNumeroIdentificacion($numero);
        $sale->setTipoDocumento($tipo);
        $data = $doctrine->getRepository(Customer::class);
        $customer = $data->find($customer);
        $data = $doctrine->getRepository(Shop::class);
        $shop = $data->find($shop);
        $sale->setShopId($shop);
        $sale->setCustomerId($customer);
        $sale->setXmlEstado($xmlEstado);
        $sale->setFechaEmision($fechaEmision);
        $sale->setFechaAutorizacion($fechaAutorizacion);
        $sale->setTotal($total);
        $sale->setSubtotal($subtotal);
        $sale->setDescuento($discount);
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $sale->setClaveAcceso(substr(str_shuffle($permitted_chars), 0, mt_rand(0, 100)));
        $sale->setAmbiente($ambiente);
        $sale->setTipoEmision(strval($tipoEmision));
        $sale->setDescuento($tipoEmision);
        $sale->setCreatedAt(new \DateTimeImmutable(date('d-m-Y H:i:s')));
        $sale->setUpdatedAt(new \DateTimeImmutable(date('d-m-Y H:i:s')));


        $i = 0;
        foreach($products as $productId){
            $data = $doctrine->getRepository(Product::class);
            $productEntity = $data->find($productId);
            $saleDetail = $doctrine->getRepository(VentaDetail::class);
            $saleDetail = new VentaDetail();
            $saleDetail->setProductPrice($productEntity->getPrice());
            $saleDetail->setProductSubtotal($subtotals[$i]);
            $saleDetail->setProductQuantity($items[$i]);
            $saleDetail->setCodigoProducto($productEntity->getCode());
            $saleDetail->setProductId($productEntity);
            $i++;
            //dd('a');
            $sale->addVentaDetail($saleDetail);
        }

        $errors = $validator->validate($sale);
        if(!count($errors)){
            $em = $this->getDoctrine()->getManager();
            $em->persist($sale);
            $em->flush();
            $session->getFlashBag()->add('success', 'Venta creada con éxito');
        }else {
            $session->getFlashBag()->add('error', 'No se pudo crear el Saleo');
        }
        
        return $this->redirectToRoute('list_sales');
    }

    public function update($id, Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        $data = $doctrine->getRepository(Venta::class);
        $sale = $data->find($id);
        foreach($sale->getVentaDetails() as $details){
            $sale->removeVentaDetail($details);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($sale);
        $em->flush();
        
        $tipo = $request->get('tipo_identificacion');
        $email = $request->get('email');
        $numero = $request->get('numero_identificacion');
        $description = $request->get('description');
        $ambiente = $request->get('ambiente');
        $customer = $request->get('customer');
        $xmlEstado = $request->get('xml_estado');
        $fechaAutorizacion = $request->get('fecha_autorizacion');
        $fechaAutorizacion = new \DateTime($fechaAutorizacion);
        $fechaEmision = $request->get('fecha_emision');
        $fechaEmision = new \DateTime($fechaEmision);
        $products = $request->get('products');
        $items = $request->get('items');
        $subtotals = $request->get('subtotals');
        $discount = $request->get('discount');
        $total = $request->get('total');
        $shop = $request->get('shop');
        $subtotal = $request->get('subtotalFinal');
        $discount = $request->get('discount');
        $ambiente = $request->get('ambiente');
        $tipoEmision = $request->get('tipoEmision');

        $sale->setTipoIdentificacion($tipo);
        $sale->setEmail($email);
        $sale->setNumeroIdentificacion($numero);
        $sale->setTipoDocumento($tipo);
        $data = $doctrine->getRepository(Customer::class);
        $customer = $data->find($customer);
        $data = $doctrine->getRepository(Shop::class);
        $shop = $data->find($shop);
        $sale->setShopId($shop);
        $sale->setCustomerId($customer);
        $sale->setXmlEstado($xmlEstado);
        $sale->setFechaEmision($fechaEmision);
        $sale->setFechaAutorizacion($fechaAutorizacion);
        $sale->setTotal($total);
        $sale->setSubtotal($subtotal);
        $sale->setDescuento($discount);
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $sale->setClaveAcceso(substr(str_shuffle($permitted_chars), 0, mt_rand(0, 100)));
        $sale->setAmbiente($ambiente);
        $sale->setTipoEmision(strval($tipoEmision));
        $sale->setDescuento($tipoEmision);
        $sale->setCreatedAt(new \DateTimeImmutable(date('d-m-Y H:i:s')));
        $sale->setUpdatedAt(new \DateTimeImmutable(date('d-m-Y H:i:s')));


        $i = 0;
        foreach($products as $productId){
            $data = $doctrine->getRepository(Product::class);
            $productEntity = $data->find($productId);
            $saleDetail = $doctrine->getRepository(VentaDetail::class);
            $saleDetail = new VentaDetail();
            $saleDetail->setProductPrice($productEntity->getPrice());
            $saleDetail->setProductSubtotal($subtotals[$i]);
            $saleDetail->setProductQuantity($items[$i]);
            $saleDetail->setCodigoProducto($productEntity->getCode());
            $saleDetail->setProductId($productEntity);
            $i++;
            
            $sale->addVentaDetail($saleDetail);
        }

        $errors = $validator->validate($sale);

        if(!count($errors)){
            $em = $this->getDoctrine()->getManager();
            $em->persist($sale);
            $em->flush();
            $session->getFlashBag()->add('success', 'Venta actualizada con éxito');
        }else {
            $session->getFlashBag()->add('error', 'No se pudo actualizar el Saleo');
        }
        
        return $this->redirectToRoute('list_sales');
    }

    public function delete($id, Request $request, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        $data = $doctrine->getRepository(Venta::class);
        $sale = $data->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($sale);
        $em->flush();
        $session->getFlashBag()->add('success', 'Venta eliminada con éxito');
        
        return $this->redirectToRoute('list_sales');
    }

    
}