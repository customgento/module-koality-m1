<?php

declare(strict_types=1);

class Koality_MagentoPlugin_HealthController extends Mage_Core_Controller_Front_Action
{
    public function statusAction()
    {
        $currentApiKey = $this->getRequest()->getParam('apikey');
        if ($currentApiKey === null) {
            $this->getResponse()->setHttpResponseCode(401);

            return $this->getResponse()->setBody('API key is missing. Please provide an API key and try again.');
        }
        if ($currentApiKey !== Mage::getModel('koality_magentoplugin/service_config')->getApiKey()) {
            $this->getResponse()->setHttpResponseCode(401);

            return $this->getResponse()->setBody('API key does not match. Please check API key and try again.');
        }
        return $this->getResponse()->setBody(Mage::getModel('koality_magentoplugin/checkCollector')
            ->generateResponse());
    }
}
