<?php

namespace AppBundle\Test;

use AppBundle\Entity\Student;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;

/**
 * Trait used in ApiTestCase to help load data into the database
 */
trait DataHelperTrait
{
    abstract protected function getService($id);

    /**
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        return $this->getService('doctrine.orm.entity_manager');
    }

    protected function createStudent($email, $firstName = null, $lastName = null)
    {
        $student = new Student();
        $student->setEmail($email);
        $student->setFirstName($firstName);
        $student->setLastName($lastName);

        $this->getEntityManager()->persist($student);
        $this->getEntityManager()->flush();

        return $student;
    }

    private function purgeDatabase()
    {
        $purger = new ORMPurger($this->getEntityManager());
        $purger->purge();
    }
}
