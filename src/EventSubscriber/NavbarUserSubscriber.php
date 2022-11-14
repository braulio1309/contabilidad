<?php
namespace App\EventSubscriber;

use App\Entity\User;
use KevinPapst\AdminLTEBundle\Event\ShowUserEvent;
use KevinPapst\AdminLTEBundle\Event\NavbarUserEvent;
use KevinPapst\AdminLTEBundle\Event\SidebarUserEvent;
use KevinPapst\AdminLTEBundle\Model\UserModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class NavbarUserSubscriber implements EventSubscriberInterface
{
    protected $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            NavbarUserEvent::class => ['onShowUser', 100],
            SidebarUserEvent::class => ['onShowUser', 100],
        ];
    }

    public function onShowUser(ShowUserEvent $event)
    {
        if (null === $this->security->getUser()) {
            return;
        }

        /* @var $myUser User */
        $myUser = $this->security->getUser();

        //$user = new UserModel();
        $user
            ->setId(1)
            ->setName('Braulio')
            ->setUsername('Braulio')
            ->setIsOnline(true)
            ->setTitle('demo user')
            ->setAvatar($myUser->getAvatar())
            ->setMemberSince($myUser->getRegisteredAt())
        ;

        $event->setUser($user);
    }
}