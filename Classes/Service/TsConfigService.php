<?php
namespace Filoucrackeur\Varnishcache\Service;

use TYPO3\CMS\Backend\Utility\BackendUtility;


/**
 * Class TsConfigService
 * @package Filoucrackeur\Varnishcache\Service
 */
class TsConfigService
{
    /**
     * @param int $pid
     * @return bool
     */
    public function isEsiAllowed(int $pid)
    {
        $varnishPageConfig = $this->getConfiguration($pid);
        return (isset($varnishPageConfig['esiDisallowed']) && (1 == $varnishPageConfig['esiDisallowed'])) ? FALSE : TRUE;
    }

    /**
     * @param int $pid
     * @return array
     */
    public function getConfiguration(int $pid)
    {
        $config = BackendUtility::getModTSconfig($pid, 'mod.varnishcache');
        return $config['properties'];
    }
}
