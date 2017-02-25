<?php
/* * *************************************************************
 *  Copyright notice
 *
 *  (C) 2015 Filoucrackeur CM Service GmbH & Co. KG <opensource@filoucrackeur.de>
 *
 *  All rights reserved
 *
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

namespace Filoucrackeur\Varnishcache\Hooks;

use Filoucrackeur\Varnishcache\Service\EsiTagService;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;


/**
 * Class StdWrap
 * @package Filoucrackeur\Varnishcache\Hooks
 */
class StdWrap extends AbstractHook {

    /**
     * @var ContentObjectRenderer
     */
    public $cObj;


    /**
     * @var \Filoucrackeur\Varnishcache\Service\EsiTagService
     */
    protected $esiTagService;


    /**
     * @param string $content
     * @param array $params
     * @return string
     */
    public function addEsiTags($content, $params) {
        return $this->getEsiTagService()->render($content, $this->cObj);
    }

    /**
     * @return EsiTagService
     */
    public function getEsiTagService() {
        if (is_null($this->esiTagService)) {
            try {
                $this->esiTagService = $this->objectManager->get(EsiTagService::class);
            } catch (\Exception $e) {
                echo 'EsiTagService could not be initialised: ' . $e->getCode() . $e->getMessage();
            }
        }
        return $this->esiTagService;
    }


}
