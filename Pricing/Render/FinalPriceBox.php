<?php

namespace TemplateProvider\Hideprice\Pricing\Render;

use Magento\Catalog\Model\Product\Pricing\Renderer\SalableResolverInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Pricing\SaleableInterface;
use Magento\Framework\Pricing\Price\PriceInterface;
use Magento\Framework\Pricing\Render\RendererPool;
use Magento\Catalog\Pricing\Price\MinimalPriceCalculatorInterface;
use TemplateProvider\Hideprice\Helper\Data as ProductAvailableHelper;

class FinalPriceBox extends \Magento\Catalog\Pricing\Render\FinalPriceBox
{
    /** @var \Magento\Framework\App\Http\Context */
    protected $httpContext;
    
    private ProductAvailableHelper $helper;

    /**
     * @param Context $context
     * @param SaleableInterface $saleableItem
     * @param PriceInterface $price
     * @param RendererPool $rendererPool
     * @param array $data
     * @param SalableResolverInterface $salableResolver
     * @param MinimalPriceCalculatorInterface $minimalPriceCalculator
     * @param \Magento\Framework\App\Helper\Context $httpContext
     */
    public function __construct(
        Context $context,
        ProductAvailableHelper $helper,
        SaleableInterface $saleableItem,
        PriceInterface $price,
        RendererPool $rendererPool,
        array $data = [],
        \Magento\Framework\App\Http\Context $httpContext,
        SalableResolverInterface $salableResolver = null,
        MinimalPriceCalculatorInterface $minimalPriceCalculator = null
    ) {
        $this->httpContext = $httpContext;
        $this->helper = $helper;
        parent::__construct($context, $saleableItem, $price, $rendererPool, $data, $salableResolver, $minimalPriceCalculator);
    }

    protected function _toHtml()
    {
        if ($this->helper->hidePrice()) {
            $isLoggedIn = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
            $value = $this->_scopeConfig->getValue('catalog/available/hide_price_text', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            if (!empty($value) && !$isLoggedIn) {
                return $value;
            }
        }
        return parent::_toHtml();
    }
}
