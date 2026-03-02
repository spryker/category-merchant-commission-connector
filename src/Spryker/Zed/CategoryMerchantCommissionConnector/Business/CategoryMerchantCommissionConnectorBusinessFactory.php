<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CategoryMerchantCommissionConnector\Business;

use Spryker\Zed\CategoryMerchantCommissionConnector\Business\CollectorRule\CategoryCollectorRule;
use Spryker\Zed\CategoryMerchantCommissionConnector\Business\CollectorRule\CategoryCollectorRuleInterface;
use Spryker\Zed\CategoryMerchantCommissionConnector\Business\Reader\CategoryReader;
use Spryker\Zed\CategoryMerchantCommissionConnector\Business\Reader\CategoryReaderInterface;
use Spryker\Zed\CategoryMerchantCommissionConnector\Business\Reader\ProductCategoryReader;
use Spryker\Zed\CategoryMerchantCommissionConnector\Business\Reader\ProductCategoryReaderInterface;
use Spryker\Zed\CategoryMerchantCommissionConnector\Business\Reader\ProductReader;
use Spryker\Zed\CategoryMerchantCommissionConnector\Business\Reader\ProductReaderInterface;
use Spryker\Zed\CategoryMerchantCommissionConnector\CategoryMerchantCommissionConnectorDependencyProvider;
use Spryker\Zed\CategoryMerchantCommissionConnector\Dependency\Facade\CategoryMerchantCommissionConnectorToCategoryFacadeInterface;
use Spryker\Zed\CategoryMerchantCommissionConnector\Dependency\Facade\CategoryMerchantCommissionConnectorToProductCategoryFacadeInterface;
use Spryker\Zed\CategoryMerchantCommissionConnector\Dependency\Facade\CategoryMerchantCommissionConnectorToProductFacadeInterface;
use Spryker\Zed\CategoryMerchantCommissionConnector\Dependency\Facade\CategoryMerchantCommissionConnectorToRuleEngineFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Spryker\Zed\CategoryMerchantCommissionConnector\CategoryMerchantCommissionConnectorConfig getConfig()
 */
class CategoryMerchantCommissionConnectorBusinessFactory extends AbstractBusinessFactory
{
    public function createCategoryCollectorRule(): CategoryCollectorRuleInterface
    {
        return new CategoryCollectorRule(
            $this->createProductReader(),
            $this->createProductCategoryReader(),
            $this->createCategoryReader(),
            $this->getRuleEngineFacade(),
        );
    }

    public function createProductReader(): ProductReaderInterface
    {
        return new ProductReader($this->getProductFacade());
    }

    public function createProductCategoryReader(): ProductCategoryReaderInterface
    {
        return new ProductCategoryReader($this->getProductCategoryFacade());
    }

    public function createCategoryReader(): CategoryReaderInterface
    {
        return new CategoryReader($this->getCategoryFacade());
    }

    public function getCategoryFacade(): CategoryMerchantCommissionConnectorToCategoryFacadeInterface
    {
        return $this->getProvidedDependency(CategoryMerchantCommissionConnectorDependencyProvider::FACADE_CATEGORY);
    }

    public function getProductCategoryFacade(): CategoryMerchantCommissionConnectorToProductCategoryFacadeInterface
    {
        return $this->getProvidedDependency(CategoryMerchantCommissionConnectorDependencyProvider::FACADE_PRODUCT_CATEGORY);
    }

    public function getProductFacade(): CategoryMerchantCommissionConnectorToProductFacadeInterface
    {
        return $this->getProvidedDependency(CategoryMerchantCommissionConnectorDependencyProvider::FACADE_PRODUCT);
    }

    public function getRuleEngineFacade(): CategoryMerchantCommissionConnectorToRuleEngineFacadeInterface
    {
        return $this->getProvidedDependency(CategoryMerchantCommissionConnectorDependencyProvider::FACADE_RULE_ENGINE);
    }
}
