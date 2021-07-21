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
    protected $session;

    /**
     * @param Context $context
     * @param Session $session
     */
    public function __construct(
        Context $context,
        Session $session
    ) {
        $this->session = $session;

        parent::__construct(
			$context
		);
    }

    /**
     * @return bool
     */
    public function hideAddToCart()
    {
        if ($this->scopeConfig->isSetFlag(self::XML_CONFIG_HIDE_ADD_TO_CART, ScopeInterface::SCOPE_STORE)) {
			return in_array(
				$this->session->getCustomerGroupId(),
				explode(',', $this->scopeConfig->getValue(self::XML_CONFIG_HIDE_ADD_TO_CART_GROUPS, ScopeInterface::SCOPE_STORE))
			);
		}
		return false;
    }

    /**
     * @return bool
     */
    public function hidePrice()
    {
		if ($this->scopeConfig->isSetFlag(self::XML_CONFIG_HIDE_PRICE, ScopeInterface::SCOPE_STORE)) {
			return in_array(
				$this->session->getCustomerGroupId(),
				explode(',', $this->scopeConfig->getValue(self::XML_CONFIG_HIDE_PRICE_GROUPS, ScopeInterface::SCOPE_STORE))
			);
		}
		return false;
    }
}
