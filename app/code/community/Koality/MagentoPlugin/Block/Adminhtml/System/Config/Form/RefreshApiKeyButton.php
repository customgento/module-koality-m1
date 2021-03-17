<?php

declare(strict_types=1);

class Koality_MagentoPlugin_Block_Adminhtml_System_Config_Form_RefreshApiKeyButton
    extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('koality/system/config/button.phtml');
    }

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->_toHtml();
    }

    public function getButtonHtml(): string
    {
        $button = $this->getLayout()
            ->createBlock('adminhtml/widget_button')
            ->setData([
                'label'   => $this->helper('adminhtml')->__('Refresh API Key'),
                'onclick' => 'javascript:refreshKoalityApiKey();'
            ]);

        return $button->toHtml();
    }

    public function getAjaxCheckUrl(): string
    {
        return Mage::helper('adminhtml')->getUrl('adminhtml/api/refresh');
    }
}
