<?php
namespace Filoucrackeur\Varnishcache\Service;

use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class EsiTagService
{

    /**
     * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     */
    protected $contentObjectRenderer;

    /**
     * @var \Filoucrackeur\Varnishcache\Service\TyposcriptPluginSettingsService
     * @inject
     */
    protected $typoscriptPluginSettingsService;

    /**
     * @var \Filoucrackeur\Varnishcache\Service\TsConfigService
     * @inject
     */
    protected $tsConfigService;

    /**
     * @param $content
     * @param ContentObjectRenderer $contentObjectRenderer
     * @return string
     */
    public function render($content, ContentObjectRenderer $contentObjectRenderer)
    {

        $this->contentObjectRenderer = $contentObjectRenderer;
        $typoScriptConfig = $this->typoscriptPluginSettingsService->getConfiguration();

        $ttl = $this->contentObjectRenderer->data['ttl'] > 0 ? $this->contentObjectRenderer->data['ttl'] . $this->contentObjectRenderer->data['ttl_unit'] : null;

        if ($this->isIntObject($content)) {
            $link = $this->contentObjectRenderer->typoLink_URL(array(
                'parameter' => $GLOBALS['TSFE']->id,
                'forceAbsoluteUrl' => 1,
                'additionalParams' => '&type=' . $typoScriptConfig['typeNum']
                    . '&identifier=' . $GLOBALS['TSFE']->newHash
                    . '&key=' . $this->getKey($content)
                    . '&varnish=1',

            ));
            $content = $this->wrapEsiTag($link, $ttl);
        } elseif ($this->contentObjectRenderer->data['exclude_from_cache'] && $GLOBALS['TSFE']->type != $typoScriptConfig['typeNum']) {
            $link = $this->contentObjectRenderer->typoLink_URL(array(
                'parameter' => $GLOBALS['TSFE']->id,
                'forceAbsoluteUrl' => 1,
                'additionalParams' => '&element=' . $this->contentObjectRenderer->data['uid']
                    . '&type=' . $typoScriptConfig['typeNum']
                    . '&varnish=1',

            ));
            $content = $this->wrapEsiTag($link, $ttl);

            if (($cUid = $this->contentObjectRenderer->data['alternative_content'])) {
                $cConf = [
                    'tables' => 'tt_content',
                    'source' => $cUid,
                    'dontCheckPid' => 1,
                ];
                $content .= '<esi:remove>' . $this->contentObjectRenderer->cObjGetSingle('RECORDS', $cConf) . '</esi:remove>';
            }
        }

        return $content;
    }

    /**
     * @param $content
     * @return bool
     */
    protected function isIntObject($content)
    {
        return (boolean)preg_match('/INT_SCRIPT/', $content);
    }

    /**
     * @param $content
     * @return string
     */
    protected function getKey($content)
    {
        return $substKey = str_replace(array('<!--', '-->'), '', $content);
    }

    /**
     * @param $content
     * @return string
     */
    protected function wrapEsiTag($content, $ttl)
    {
        return '<!--esi <esi:include src="' . $content . '" ttl="' . $ttl . '" />-->';
    }

}
