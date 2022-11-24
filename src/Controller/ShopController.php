<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Omines\DataTablesBundle\Adapter\ArrayAdapter;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\Column\BoolColumn;
use Omines\DataTablesBundle\Column\TwigColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use App\Entity\Shop;
use App\Repository\ShopRepository;
use Doctrine\Persistence\ManagerRegistry;



class ShopController extends AbstractController
{
    
    public function index(Request $request, ManagerRegistry $doctrine)
    {
        $data = $doctrine->getRepository(Shop::class);

        $data = $data->findAll();
        
        return $this->render('/Shops/index.html.twig', ['data' => $data]);
    }
}