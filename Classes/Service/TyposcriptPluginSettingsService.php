<?php
namespace Filoucrackeur\Varnishcache\Service;

use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;

class TyposcriptPluginSettingsService
{

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
     * @inject
     */
    protected $configurationManager;

    /**
     * @var array
     */
    protected $configuration = [];


    /**
     * @return array
     */
    public function getConfiguration()
    {
        if (empty($this->configuration)) {
            $fullConfig = $this->configurationManager->getConfiguration(ConfigurationManager::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
            $this->configuration = $fullConfig['plugin.']['varnishcache.']['settings.'];
        }
        return $this->configuration;
    }
}
