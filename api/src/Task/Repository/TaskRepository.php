<?php

namespace App\Task\Repository;

use App\Task\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 *
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function saveOrUpdate(Task $task, bool $flush = true): void
    {
        $em = $this->getEntityManager();
        $em->persist($task);

        if ($flush) {
            $em->flush();
        }
    }

    public function delete(Task $task, bool $flush = true): void
    {
        $em = $this->getEntityManager();
        $em->remove($task);

        if ($flush) {
            $em->flush();
        }
    }
}
