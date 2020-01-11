<?php

namespace TemplateProvider\Hideprice\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use TemplateProvider\Hideprice\Helper\Data as ProductAvailableHelper;
use Magento\Framework\Exception\LocalizedException;

class QuoteObserver implements ObserverInterface
{
    /**
     * @var \TemplateProvider\Hideprice\Helper\Data
     */
    protected $_helper; 
	
    /**
     * @param ProductAvailableHelper $helper
     */
    public function __construct(
		ProductAvailableHelper $helper
    ) {
		$this->_helper = $helper;
    }
	
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
		if (!$this->_helper->isAvailableAddToCart()) {
			throw new LocalizedException(
				__('You can not add products to cart.')
			);		
		}
    }
} 