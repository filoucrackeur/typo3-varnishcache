<?php
namespace Filoucrackeur\Varnishcache\Hooks;

use Filoucrackeur\Varnishcache\Service\EsiTagService;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Class StdWrap
 * @package Filoucrackeur\Varnishcache\Hooks
 */
class StdWrap extends AbstractHook
{

    /**
     * @var ContentObjectRenderer
     */
    public $cObj;


    /**
     * @var EsiTagService
     */
    protected $esiTagService;


    /**
     * @param string $content
     * @return string
     */
    public function addEsiTags(string $content)
    {
        return $this->getEsiTagService()->render($content, $this->cObj);
    }

    /**
     * @return EsiTagService
     */
    public function getEsiTagService()
    {
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
