<?php

declare(strict_types=1);

class Koality_MagentoPlugin_HealthController extends Mage_Core_Controller_Front_Action
{
    public function statusAction()
    {
        $currentApiKey = $this->getRequest()->getParam('apikey');

        if ($currentApiKey === null) {
            $this->getResponse()->setHttpResponseCode(Mage_Api2_Model_Server::HTTP_INTERNAL_ERROR);

            return $this->getResponse()->setBody('API key is missing. Please provide an API key and try again.');
        }

        if ($currentApiKey !== Mage::getModel('koality_magentoplugin/service_config')->getApiKey()) {
            $this->getResponse()->setHttpResponseCode(Mage_Api2_Model_Server::HTTP_INTERNAL_ERROR);

            return $this->getResponse()->setBody('API key does not match. Please check API key and try again.');
        }
        $this->getResponse()->setHttpResponseCode(Mage_Api2_Model_Server::HTTP_OK);

        return $this->getResponse()->setBody(Mage::getModel('koality_magentoplugin/checkCollector')
            ->generateResponse());
    }
}
