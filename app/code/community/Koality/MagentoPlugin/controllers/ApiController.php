<?php

declare(strict_types=1);

class Koality_MagentoPlugin_ApiController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/system/config/koality_service');
    }

    public function refreshAction()
    {
        $newApiKey = Mage::helper('koality_magentoplugin')->createRandomApiKey();
        Mage::getModel('core/config')
            ->saveConfig(Koality_MagentoPlugin_Model_Service_Config::KOALITY_API_KEY, $newApiKey);
        $this->getResponse()->setBody($newApiKey);
    }

}
