<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\OrderCustomReferenceWidget\Widget;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;
use SprykerShop\Yves\OrderCustomReferenceWidget\Form\OrderCustomReferenceForm;

/**
 * @method \SprykerShop\Yves\OrderCustomReferenceWidget\OrderCustomReferenceWidgetFactory getFactory()
 */
class OrderCustomReferenceWidget extends AbstractWidget
{
    /**
     * @var string
     */
    protected const PARAMETER_QUOTE = 'quote';

    /**
     * @var string
     */
    protected const FORM_ORDER_CUSTOM_REFERENCE = 'orderCustomReferenceForm';

    public function __construct(QuoteTransfer $quoteTransfer, string $backUrl)
    {
        $this->addQuoteParameter($quoteTransfer);
        $this->addOrderCustomReferenceFormParameter($quoteTransfer, $backUrl);
    }

    public static function getName(): string
    {
        return 'OrderCustomReferenceWidget';
    }

    public static function getTemplate(): string
    {
        return '@OrderCustomReferenceWidget/views/order-custom-reference/order-custom-reference.twig';
    }

    protected function addQuoteParameter(QuoteTransfer $quoteTransfer): void
    {
        $this->addParameter(static::PARAMETER_QUOTE, $quoteTransfer);
    }

    protected function addOrderCustomReferenceFormParameter(QuoteTransfer $quoteTransfer, string $backUrl): void
    {
        $this->addParameter(
            static::FORM_ORDER_CUSTOM_REFERENCE,
            $this->getFactory()->getOrderCustomReferenceForm(
                [
                    OrderCustomReferenceForm::FIELD_ORDER_CUSTOM_REFERENCE => $quoteTransfer->getOrderCustomReference(),
                    OrderCustomReferenceForm::FIELD_BACK_URL => $backUrl,
                ],
            )->createView(),
        );
    }
}
