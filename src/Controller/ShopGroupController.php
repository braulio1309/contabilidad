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
use App\Entity\ShopGroup;

class ShopGroupController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index(Request $request, DataTableFactory $dataTableFactory)
    {

        $table = $dataTableFactory->create()
            ->add('id', TextColumn::class, ['label' => '#'])
            ->add('name', TextColumn::class, ['label' => 'Nombre'])
            
            ->createAdapter(ORMAdapter::class, [
                'entity' => ShopGroup::class,
            ])
            ->add('buttons', TwigColumn::class, [
                'className' => 'buttons',
                'template' => 'tables/buttonbar.html.twig',
                'label' => 'Acciones'
            ])
            ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }
        return $this->render('/ShopGroups/index.html.twig', ['datatable' => $table]);
    }
}