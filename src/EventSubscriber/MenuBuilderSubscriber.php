<?php
// src/EventSubscriber/MenuBuilderSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use KevinPapst\AdminLTEBundle\Model\MenuItemModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MenuBuilderSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            SidebarMenuEvent::class => ['onSetupMenu', 100],
        ];
    }
    
    public function onSetupMenu(SidebarMenuEvent $event)
    {
        $user = new MenuItemModel('user', 'Usuarios', 'home', [], 'fas fa-tachometer-alt');
        $empleados = new MenuItemModel('Empleados', 'Empleados', 'home', [], 'fas fa-tachometer-alt');
        $groups = new MenuItemModel('grupos', 'Grupos', 'home', [], 'fas fa-tachometer-alt');
        $shop = new MenuItemModel('tiendas', 'Tiendas', 'home', [], 'fas fa-tachometer-alt');
        $series = new MenuItemModel('series', 'Series', 'home', [], 'fas fa-tachometer-alt');
        $clients = new MenuItemModel('Clients', 'Clientes', 'home', [], 'fas fa-tachometer-alt');
        $products = new MenuItemModel('Product', 'Productos', 'home', [], 'fas fa-tachometer-alt');
        $buy = new MenuItemModel('Ventas', 'Ventas', 'home', [], 'fas fa-tachometer-alt');

        /*$blog->addChild(
            new MenuItemModel('ChildOneItemId', 'ChildOneDisplayName', 'home', [], 'fas fa-rss-square')
        )->addChild(
            new MenuItemModel('ChildTwoItemId', 'ChildTwoDisplayName', 'home')
        );*/
        
        $event->addItem($empleados);
        $event->addItem($user);
        $event->addItem($groups);
        $event->addItem($shop);
        $event->addItem($series);
        $event->addItem($clients);
        $event->addItem($products);
        $event->addItem($buy);


        $this->activateByRoute(
            $event->getRequest()->get('_route'),
            $event->getItems()
        );
    }

    /**
     * @param string $route
     * @param MenuItemModel[] $items
     */
    protected function activateByRoute($route, $items)
    {
        foreach ($items as $item) {
            if ($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            } elseif ($item->getRoute() == $route) {
                $item->setIsActive(true);
            }
        }
    }
}