<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\OrderCustomReferenceWidget;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\OrderCustomReferenceWidget\Dependency\Client\OrderCustomReferenceWidgetToOrderCustomReferenceClientBridge;
use SprykerShop\Yves\OrderCustomReferenceWidget\Dependency\Client\OrderCustomReferenceWidgetToQuoteClientBridge;

class OrderCustomReferenceWidgetDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_ORDER_CUSTOM_REFERENCE = 'CLIENT_ORDER_CUSTOM_REFERENCE';

    /**
     * @var string
     */
    public const CLIENT_QUOTE = 'CLIENT_QUOTE';

    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);
        $container = $this->addOrderCustomReferenceClient($container);
        $container = $this->addQuoteClient($container);

        return $container;
    }

    protected function addOrderCustomReferenceClient(Container $container): Container
    {
        $container->set(static::CLIENT_ORDER_CUSTOM_REFERENCE, function (Container $container) {
            return new OrderCustomReferenceWidgetToOrderCustomReferenceClientBridge(
                $container->getLocator()->orderCustomReference()->client(),
            );
        });

        return $container;
    }

    protected function addQuoteClient(Container $container): Container
    {
        $container->set(static::CLIENT_QUOTE, function (Container $container) {
            return new OrderCustomReferenceWidgetToQuoteClientBridge(
                $container->getLocator()->quote()->client(),
            );
        });

        return $container;
    }
}
