<?php
/* * *************************************************************
 *  Copyright notice
 *
 *  (C) 2015 Filoucrackeur CM Service GmbH & Co. KG <opensource@filoucrackeur.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

namespace Filoucrackeur\Varnishcache\Domain\Repository;


use TYPO3\CMS\Extbase\Persistence\Generic\Query;
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

        $constraints = array();
        if (count($rootLine) > 1) {
            foreach ($rootLine as $pageArray) {
                $constraints[] = $query->equals('domains.pid', $pageArray['uid']);
            }
            $constraints = $query->logicalOr($constraints);
        }

        return $constraints;
    }
}
