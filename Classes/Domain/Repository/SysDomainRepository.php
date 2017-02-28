<?php
namespace Filoucrackeur\Varnishcache\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;

class SysDomainRepository extends AbstractDisrespectStoragePageRepository
{
    /**
     * Returns all domains in rootline
     *
     * @param array $rootLine
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByRootLine(array $rootLine)
    {
        $query = $this->createQuery();
        $query->matching($this->buildConstraints($query, $rootLine));
        return $query->execute();
    }

    /**
     * Build constraints by rootline pages
     *
     * @param QueryInterface $query
     * @param array $rootLine
     * @return array|object|\TYPO3\CMS\Extbase\Persistence\Generic\Qom\OrInterface
     */
    protected function buildConstraints(QueryInterface $query, array $rootLine)
    {
        $constraints = [];
        if (count($rootLine) > 1) {
            foreach ($rootLine as $pageArray) {
                $constraints[] = $query->equals('pid', $pageArray['uid']);
            }
            $constraints = $query->logicalOr($constraints);
        }

        return $constraints;
    }
}
