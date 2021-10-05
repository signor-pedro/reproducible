<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\MyEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route(path: '/')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $entityManager->persist(
            $entity = new MyEntity('english'),
        );

        $entityManager->flush();

        $entity->setTranslatableLocale('fr');
        $entityManager->refresh($entity);

        $entity->setName('in french');
        $entityManager->persist($entity);
        $entityManager->flush();

        dd(); // see the database
    }
}
