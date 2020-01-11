<?php

namespace TemplateProvider\Hideprice\Pricing\Render;

class FinalPriceBox extends \Magento\Catalog\Pricing\Render\FinalPriceBox
{
    protected function _toHtml()
    {
        $value = $this->_scopeConfig->getValue('catalog/available/hide_price_text', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if (!empty($value)) {
            return $value;
        }
        return parent::_toHtml();
    }
}
