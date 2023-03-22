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
use App\Entity\ShopSerie;
use App\Entity\Taxes;
use App\Entity\VentaDetail;

class SaleController extends AbstractController
{
    
    public function index(Request $request, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Venta::class);

        $data = $data->findBy(array(), array('id' => 'desc'));
        // dd($data);
        return $this->render('/Sales/index.html.twig', ['data' => $data]);
    }

    public function showForm($id, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Venta::class);
        $shops = $doctrine->getRepository(Shop::class)->findAll();
        $series = $doctrine->getRepository(ShopSerie::class)->findAll();
        $customers = $doctrine->getRepository(Customer::class)->findAll();
        $products = $doctrine->getRepository(Product::class)->findAll();
        $details = null;
        $details_js = null;
        $seri = [];
        foreach($products as $product){
            $pro[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'code' => $product->getCode(),
                'price' => $product->getPrice(),
                'quantity' => 1,
                'tax' => $product->getTax()->getPorcentaje()
            ];
        }
        foreach($series as $serie){
            $seri[] = [
                'id' => $serie->getId(),
                'serie' => $serie->getSerie(),
                'codigo_documento' => $serie->getCodigoDocumento(),
                'secuencia' => $serie->getSecuencia(),
                'shop_id' => $serie->getShopId()->getId()
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
            $formas = json_decode($data->getFormaPago());
            $informacion_adicionales = json_decode($data->getInformacionAdicional());
            foreach($details as $detail){
                $details_js[] =[
                    'id'   => $detail->getProductId()->getId(),
                    'code' => $detail->getCodigoProducto() ,
                    'name' => $detail->getProductId()->getName(),
                    'price' => $detail->getProductPrice(),
                    'quantity' => (int) $detail->getProductQuantity(),
                    'tax' => $detail->getTaxId()
                ]; 
            }
        }else
            $data = null;

        $root = ($id)? 'edit': 'form';
        
        return $this->render('/Sales/'.$root.'.html.twig', [
            'data'          => $data, 
            'shops'         => $shops, 
            'customers'     => $customers, 
            'series'        => $seri, 
            'products'      => $products ?? [], 
            'product'       => $pro ?? [],
            'formas'        => $formas ?? [],
            'informaciones' => $informacion_adicionales ?? [],
            'clients'       => $clients,
            'details'       => $details,
            'details_js'    => $details_js
        ]);
    }

    public function create(Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();        
        $session->start();
        
        $tipo                   = $request->get('tipo_identificacion');
        $email                  = $request->get('email');
        $numero                 = $request->get('numero_identificacion');
        $description            = $request->get('description');
        $ambiente               = $request->get('ambiente');
        $customer               = $request->get('customer');
        $xmlEstado              = $request->get('xml_estado');
        $fechaAutorizacion      = $request->get('fecha_autorizacion');
        $fechaAutorizacion      = new \DateTime($fechaAutorizacion);
        $fechaEmision           = $request->get('fecha_emision');
        $fechaEmision           = new \DateTime($fechaEmision);
        $products               = $request->get('products');
        $items                  = $request->get('items');
        $discounts              = $request->get('discounts');
        $subtotals              = $request->get('subtotals');
        $discount               = $request->get('discount');
        $total                  = $request->get('total');
        $shop                   = $request->get('shop');
        $subtotal               = $request->get('subtotalFinal');
        $descripcion            = $request->get('descripcion');
        $descripcion_adicional  = $request->get('descripcion_adicional1');
        $descripcion_adicional2 = $request->get('descripcion_adicional2');
        $descripcion_adicional3 = $request->get('descripcion_adicional3');
        $discount               = $request->get('discount');
        $impuesto               = $request->get('impuestoFinal');
        $impuestos              = $request->get('impuestos');
        $ambiente               = $request->get('ambiente');
        $tipoEmision            = '1';
        $serie                  = $request->get('serie');
        $numeroSerie            = $request->get('numeroSerie');
        $codigoDocumento        = $request->get('codigoDocumento');

        $forma_pago             = $request->get('forma_pago');
        $valor                  = $request->get('valor');
        $tiempo                 = $request->get('tiempo');
        $plazo                  = $request->get('plazo');

        $titulo_informacion_adicional       = $request->get('titulo_informacion_adicional');
        $description_informacion_adicional  = $request->get('description_informacion_adicional');    


        foreach($forma_pago as $key => $form){
            $forma[]=[
                  'forma_pago' => $forma_pago[$key],  
                  'valor'      => $valor[$key],  
                  'tiempo'     => $tiempo[$key],  
                  'plazo'      => $plazo[$key],  
            ];
        }
        
        foreach($titulo_informacion_adicional as $key => $form){
            $adicional[]=[
                  'titulo_informacion_adicional'        => $titulo_informacion_adicional[$key],  
                  'description_informacion_adicional'   => $description_informacion_adicional[$key]
            ];
        }

        $data       = $doctrine->getRepository(ShopSerie::class);
        $shopserie = $data->find($serie);
        $shopserie->setSecuencia(str_pad(((int) $numeroSerie + 1), 8, '0', STR_PAD_LEFT));
        $sale = new Venta();
        $sale->setTipoIdentificacion($tipo);
        $sale->setCodigoDocumento($codigoDocumento);
        $sale->setEmail($email);
        $sale->setNumeroIdentificacion($numero);
        // $sale->setTipoDocumento($tipo);
        $data = $doctrine->getRepository(Customer::class);
        $customer = $data->find($customer);
        $data = $doctrine->getRepository(Shop::class);
        $shop = $data->find($shop);
        $sale->setShopId($shop);
        $sale->setCustomerId($customer);
        $sale->setXmlEstado($xmlEstado);
        $sale->setFechaEmision($fechaEmision);
        $sale->setAddress1($customer->getAddress1());
        $sale->setFormaPago(json_encode($forma));
        $sale->setInformacionAdicional(json_encode($adicional));
        // $sale->setFechaAutorizacion($fechaAutorizacion);
        $sale->setTotal($total);
        $sale->setSubtotal($subtotal);
        $sale->setDescuento($discount);
        $sale->setSerie($shopserie->getSerie());
        $sale->setSecuencia($numeroSerie);
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $sale->setClaveAcceso(substr(str_shuffle($permitted_chars), 0, mt_rand(0, 100)));
        $sale->setAmbiente($ambiente);
        $sale->setTipoEmision(strval($tipoEmision));
        $sale->setDescuento($discount);
        $sale->setIdTax((float) $impuesto);


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
            $saleDetail->setDescription($descripcion[$i]);
            $saleDetail->setDescriptionAditional1($descripcion_adicional[$i]);
            $saleDetail->setDescriptionAditional2($descripcion_adicional2[$i]);
            $saleDetail->setDescriptionAditional3($descripcion_adicional3[$i]);
            $saleDetail->setProductQuantity($items[$i]);
            $saleDetail->setProductDescuento($discounts[$i] ?? 0);
            $saleDetail->setProductTotal($subtotals[$i]-$impuestos[$i]);
            $saleDetail->setCodigoProducto($productEntity->getCode());
            $saleDetail->setProductId($productEntity);
            $saleDetail->setTaxId((float) $impuestos[$i]);
            $i++;
            $sale->addVentaDetail($saleDetail);
        }

        $errors = $validator->validate($sale);
        if(!count($errors)){
            $em = $this->getDoctrine()->getManager();
            $em->persist($sale);
            $em->persist($shopserie);
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
        
        $tipo                   = $request->get('tipo_identificacion');
        $email                  = $request->get('email');
        $numero                 = $request->get('numero_identificacion');
        $description            = $request->get('description');
        $ambiente               = $request->get('ambiente');
        $customer               = $request->get('customer');
        $xmlEstado              = $request->get('xml_estado');
        $fechaAutorizacion      = $request->get('fecha_autorizacion');
        $fechaAutorizacion      = new \DateTime($fechaAutorizacion);
        $fechaEmision           = $request->get('fecha_emision');
        $fechaEmision           = new \DateTime($fechaEmision);
        $products               = $request->get('products');
        $items                  = $request->get('items');
        $discounts              = $request->get('discounts');
        $subtotals              = $request->get('subtotals');
        $discount               = $request->get('discount');
        $total                  = $request->get('total');
        $shop                   = $request->get('shop');
        $subtotal               = $request->get('subtotalFinal');
        $descripcion            = $request->get('descripcion');
        $descripcion_adicional  = $request->get('descripcion_adicional1');
        $descripcion_adicional2 = $request->get('descripcion_adicional2');
        $descripcion_adicional3 = $request->get('descripcion_adicional3');
        $discount               = $request->get('discount');
        $impuesto               = $request->get('impuestoFinal');
        $impuestos              = $request->get('impuestos');
        $ambiente               = $request->get('ambiente');
        $tipoEmision            = '1';
        $serie                  = $request->get('serie');
        $numeroSerie            = $request->get('numeroSerie');
        $codigoDocumento        = $request->get('codigoDocumento');

        $forma_pago             = $request->get('forma_pago');
        $valor                  = $request->get('valor');
        $tiempo                 = $request->get('tiempo');
        $plazo                  = $request->get('plazo');

        $titulo_informacion_adicional       = $request->get('titulo_informacion_adicional');
        $description_informacion_adicional  = $request->get('description_informacion_adicional');   


        foreach($forma_pago as $key => $form){
            $forma[]=[
                  'forma_pago' => $forma_pago[$key],  
                  'valor'      => $valor[$key],  
                  'tiempo'     => $tiempo[$key],  
                  'plazo'      => $plazo[$key],  
            ];
        }
        
        foreach($titulo_informacion_adicional as $key => $form){
            $adicional[]=[
                  'titulo_informacion_adicional'        => $titulo_informacion_adicional[$key],  
                  'description_informacion_adicional'   => $description_informacion_adicional[$key]
            ];
        }

        $sale->setTipoIdentificacion($tipo);
        $sale->setCodigoDocumento($codigoDocumento);
        $sale->setEmail($email);
        $sale->setNumeroIdentificacion($numero);
        // $sale->setTipoDocumento($tipo);
        $data = $doctrine->getRepository(Customer::class);
        $customer = $data->find($customer);
        $data = $doctrine->getRepository(Shop::class);
        $shop = $data->find($shop);
        $sale->setShopId($shop);
        $sale->setCustomerId($customer);
        $sale->setXmlEstado($xmlEstado);
        $sale->setFechaEmision($fechaEmision);
        $sale->setAddress1($customer->getAddress1());
        $sale->setFormaPago(json_encode($forma));
        $sale->setInformacionAdicional(json_encode($adicional));
        $sale->setFechaAutorizacion($fechaAutorizacion);
        $sale->setTotal($total);
        $sale->setSubtotal($subtotal);
        $sale->setDescuento($discount);
        $sale->setSerie($serie);
        $sale->setSecuencia($numeroSerie);
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $sale->setAmbiente($ambiente);
        $sale->setTipoEmision(strval($tipoEmision));
        $sale->setDescuento($discount);
        $sale->setIdTax((float) $impuesto);

        $sale->setUpdatedAt(new \DateTimeImmutable(date('d-m-Y H:i:s')));

        $i = 0;
        foreach($products as $productId){
            $data = $doctrine->getRepository(Product::class);
            $productEntity = $data->find($productId);
            $saleDetail = $doctrine->getRepository(VentaDetail::class);
            $saleDetail = new VentaDetail();
            $saleDetail->setProductPrice($productEntity->getPrice());
            $saleDetail->setProductSubtotal($subtotals[$i]);
            $saleDetail->setDescription($descripcion[$i]);
            $saleDetail->setDescriptionAditional1($descripcion_adicional[$i]);
            $saleDetail->setDescriptionAditional2($descripcion_adicional2[$i]);
            $saleDetail->setDescriptionAditional3($descripcion_adicional3[$i]);
            $saleDetail->setProductQuantity($items[$i]);
            $saleDetail->setProductDescuento($discounts[$i] ?? 0);
            $saleDetail->setProductTotal($subtotals[$i]-$impuestos[$i]);
            $saleDetail->setCodigoProducto($productEntity->getCode());
            $saleDetail->setProductId($productEntity);
            $saleDetail->setTaxId((float) $impuestos[$i]);

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