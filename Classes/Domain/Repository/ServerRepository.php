<?php
namespace Filoucrackeur\Varnishcache\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;

class ServerRepository extends AbstractDisrespectStoragePageRepository {


    /**
     * @param array $rootLine
     */
    public function findByDomainIsInRootLine(array $rootLine) {
        $query = $this->createQuery();
        $query->matching($this->buildRootLineConstraints($query, $rootLine));
        return $query->execute();
    }

    /**
     * @param QueryInterface $query
     * @param array $rootLine
     * @return array|object|\TYPO3\CMS\Extbase\Persistence\Generic\Qom\OrInterface
     */
    protected function buildRootLineConstraints(QueryInterface $query, array $rootLine) {

        $constraints = [];
        if (count($rootLine) > 1) {
            foreach ($rootLine as $pageArray) {
                $constraints[] = $query->equals('domains.pid', $pageArray['uid']);
            }
            $constraints = $query->logicalOr($constraints);
        }

        return $constraints;
    }
}
