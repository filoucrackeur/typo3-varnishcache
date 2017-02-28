<?php
namespace Filoucrackeur\Varnishcache\Hooks;

/**
 * Class Cache
 */
class DataHandler {

    /**
     * Hook for clearing all forntend cache and single cache and even if an tt_content object has changed
     *
     * @param $params
     * @param  \TYPO3\CMS\Core\DataHandling\DataHandler $parent
     *
     * @return void
     */
    public function clearCacheCommand($params) {

        if (isset($params['cacheCmd']) && 'pages' === $params['cacheCmd']) {
            $this->getVarnishCacheService()->flushCache(0);
        }

        if (($params['table'] === 'pages' || $params['table'] === 'tt_content' || isset($params['cacheCmd']))
                && isset($params['pageIdArray']) && is_array($params['pageIdArray']) && !empty($params['pageIdArray'])
        ) {
            foreach ($params['pageIdArray'] as $pageId) {
                $this->getVarnishCacheService()->flushCache($pageId);
            }
        }

    }
}
