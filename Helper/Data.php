<?php

namespace TemplateProvider\Hideprice\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Customer\Model\Session;

class Data extends AbstractHelper
{
    const XML_CONFIG_HIDE_ADD_TO_CART = 'catalog/available/hide_add_to_cart';
	
    const XML_CONFIG_HIDE_ADD_TO_CART_GROUPS = 'catalog/available/hide_add_to_cart_groups';
	
    const XML_CONFIG_HIDE_PRICE = 'catalog/available/hide_price';
	
    const XML_CONFIG_HIDE_PRICE_GROUPS = 'catalog/available/hide_price_groups';
	
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_session;

    /**
     * @param Context $context
     * @param Session $session
     */
    public function __construct(
        Context $context,
        Session $session
    ) {
        $this->_session = $session;
		
        parent::__construct(
			$context
		);
    }

    /**
     * @return bool
     */
    public function isAvailableAddToCart()
    {
		if ($this->_getConfig(self::XML_CONFIG_HIDE_ADD_TO_CART)) {
			return !in_array(
				$this->_session->getCustomerGroupId(), 
				explode(',', $this->_getConfig(self::XML_CONFIG_HIDE_ADD_TO_CART_GROUPS))
			);			
		}
		return true;
    }	

    /**
     * @return bool
     */
    public function isAvailablePrice()
    {
		if ($this->_getConfig(self::XML_CONFIG_HIDE_PRICE)) {
			return !in_array(
				$this->_session->getCustomerGroupId(), 
				explode(',', $this->_getConfig(self::XML_CONFIG_HIDE_PRICE_GROUPS))
			);			
		}
		return true;
    }	 
	
    /**
     * @param   string $path
     * @return  string|null
     */
    protected function _getConfig($path)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
    }      
}
