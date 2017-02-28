<?php
namespace Filoucrackeur\Varnishcache\Renderer;

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Cache\Frontend\VariableFrontend;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class ContentElement
{

    /**
     * @var ContentObjectRenderer
     */
    public $cObj;

    /**
     * @return string
     */
    public function render()
    {
        if (($identifier = GeneralUtility::_GET('identifier')) && ($key = GeneralUtility::_GET('key'))) {
            if ($row = $this->getCacheManager()->get($identifier)) {
                /* @var $INTiS_cObj ContentObjectRenderer */
                $INTiS_cObj = unserialize($row['cache_data']['INTincScript'][$key]['cObj']);
                $INTiS_cObj->INT_include = 1;
                return $INTiS_cObj->cObjGetSingle($row['cache_data']['INTincScript'][$key]['type'] . '_INT', $row['cache_data']['INTincScript'][$key]['conf']);
            }
        }

        if (!($cUid = GeneralUtility::_GET('element'))) {
            return '';
        }

        $configArray = [
            'tables' => 'tt_content',
            'source' => $cUid,
            'dontCheckPid' => 1,
        ];

        return $this->cObj->cObjGetSingle('RECORDS', $configArray);

    }

    /**
     * @return VariableFrontend
     */
    protected function getCacheManager()
    {
        return GeneralUtility::makeInstance(CacheManager::class)->getCache('cache_pages');
    }
}
