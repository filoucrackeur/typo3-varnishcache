<?php
namespace Filoucrackeur\Varnishcache\Domain\Repository;


use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\Repository;

abstract class AbstractDisrespectStoragePageRepository extends Repository {

    /**
     * Reset query settings
     */
    public function initializeObject() {
        $querySettings = $this->getQuerySettingsObject();
        $querySettings->setRespectStoragePage(FALSE);
        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * @return Typo3QuerySettings
     */
    protected function getQuerySettingsObject() {
        return $this->objectManager->get(Typo3QuerySettings::class);
    }
}
