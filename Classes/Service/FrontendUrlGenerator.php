<?php
namespace Filoucrackeur\Varnishcache\Service;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\TimeTracker\TimeTracker;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class FrontendUrlGenerator
{
    /**
     * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     * @inject
     */
    protected $contentObjectRenderer;


    /**
     * @param int $uid
     * @return string
     */
    public function getFrontendUrl(int $uid)
    {
        $this->initFrontend($uid);

        if ($this->isRootPage($uid)) {
            return '/';
        }

        return $this->contentObjectRenderer->typoLink_URL([
            'parameter' => $uid,
        ]);
    }

    /**
     * @param int $uid
     */
    protected function initFrontend(int $uid)
    {
        if (!is_object($GLOBALS['TT'])) {
            $GLOBALS['TT'] = new TimeTracker();
            $GLOBALS['TT']->start();
        }

        $GLOBALS['TSFE'] = GeneralUtility::makeInstance(TypoScriptFrontendController::class, $GLOBALS['TYPO3_CONF_VARS'], $uid, 0);

        $GLOBALS['TSFE']->connectToDB();
        $GLOBALS['TSFE']->initFEuser();
        $GLOBALS['TSFE']->determineId();
        $GLOBALS['TSFE']->initTemplate();
        $GLOBALS['TSFE']->getConfigArray();

        if (ExtensionManagementUtility::isLoaded('realurl')) {
            $rootline = BackendUtility::BEgetRootLine($uid);
            $host = BackendUtility::firstDomainRecord($rootline);
            $_SERVER['HTTP_HOST'] = $host;
        }
    }

    /**
     * @param int $uid
     * @return bool
     */
    protected function isRootPage(int $uid)
    {
        $rootline = BackendUtility::BEgetRootLine($uid);
        if (is_array($rootline) && count($rootline) > 1) {
            return ($uid === $rootline[1]['uid']);
        }
        return FALSE;
    }
}
