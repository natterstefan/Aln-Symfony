<?php

namespace App\Repository;

use App\Entity\AlnFeeder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AlnFeeder>
 *
 * @method AlnFeeder|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlnFeeder|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlnFeeder[]    findAll()
 * @method AlnFeeder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class AlnFeederRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlnFeeder::class);
    }

    public function add(AlnFeeder $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AlnFeeder $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByIdentifier(string $identifier): ?AlnFeeder
    {
        return $this->findOneBy(['identifier' => $identifier]);
    }

    public function findOrCreateFeeder(string $identifier): AlnFeeder
    {
        if ($feeder = $this->findOneByIdentifier($identifier)) {
            return $feeder;
        }
        $feeder = new AlnFeeder();
        $feeder->setIdentifier($identifier);
        $this->add($feeder);

        return $feeder;
    }
}
