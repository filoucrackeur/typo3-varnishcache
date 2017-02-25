<?php
namespace Filoucrackeur\Varnishcache\Frontend\ContentObject;

use Filoucrackeur\Varnishcache\Service\EsiTagService;
use TYPO3\CMS\Core\TimeTracker\TimeTracker;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\AbstractContentObject;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * Contains COA_INT class object.
 */
class ContentObjectArrayInternalContentObject extends AbstractContentObject
{
    /**
     * @var \Filoucrackeur\Varnishcache\Service\EsiTagService
     * @inject
     */
    protected $esiTagService;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager;

    /**
     * Rendering the cObject, COA_INT
     *
     * @param array $conf Array of TypoScript properties
     * @return string Output
     */
    public function render($conf = [])
    {
        parent::render($conf);
        if (!is_array($conf)) {
            $this->getTimeTracker()->setTSlogMessage('No elements in this content object array (COA_INT).', 2);
            return '';
        }
        $substKey = 'INT_SCRIPT.' . $this->getTypoScriptFrontendController()->uniqueHash();
        $content = '<!--' . $substKey . '-->';
        $this->getTypoScriptFrontendController()->config['INTincScript'][$substKey] = [
            'conf' => $conf,
            'cObj' => serialize($this->cObj),
            'type' => 'COA'
        ];

/*
        if (!($formVarnish = GeneralUtility::_GET('varnish'))) {
            $content = $this->getEsiTagService()->render($content, $this->getContentObject());
        }
  */
        return $content;
    }

    /**
     * @return object
     */
    protected function getTimeTracker()
    {
        return GeneralUtility::makeInstance(TimeTracker::class);
    }

    /**
     * @return TypoScriptFrontendController
     */
    protected function getTypoScriptFrontendController()
    {
        return $GLOBALS['TSFE'];
    }

    /**
     * @return EsiTagService
     */
    protected function getEsiTagService() {
        if (is_null($this->esiTagService)) {
            $this->esiTagService = $this->objectManager->get(EsiTagService::class);
        }
        return $this->esiTagService;
    }
}
