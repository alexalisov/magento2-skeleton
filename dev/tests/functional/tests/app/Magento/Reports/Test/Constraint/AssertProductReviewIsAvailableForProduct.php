<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Reports\Test\Constraint;

use Mtf\Constraint\AbstractConstraint;
use Magento\Review\Test\Fixture\ReviewInjectable;
use Magento\Review\Test\Page\Adminhtml\ReviewIndex;
use Magento\Reports\Test\Page\Adminhtml\ProductReportReview;
use Magento\Review\Test\Constraint\AssertProductReviewInGrid;

/**
 * Class AssertProductReviewIsVisibleInGrid
 * Assert that review is visible in review grid for select product
 */
class AssertProductReviewIsAvailableForProduct extends AbstractConstraint
{
    /**
     * Constraint severeness
     *
     * @var string
     */
    protected $severeness = 'low';

    /**
     * Assert that review is visible in review grid for select product
     *
     * @param ReviewIndex $reviewIndex
     * @param ReviewInjectable $review
     * @param ProductReportReview $productReportReview
     * @param AssertProductReviewInGrid $assertProductReviewInGrid
     * @return void
     */
    public function processAssert(
        ReviewIndex $reviewIndex,
        ReviewInjectable $review,
        ProductReportReview $productReportReview,
        AssertProductReviewInGrid $assertProductReviewInGrid
    ) {
        $productReportReview->open();
        $product = $review->getDataFieldConfig('entity_id')['source']->getEntity();
        $productReportReview->getGridBlock()->openReview($product->getName());
        unset($assertProductReviewInGrid->filter['visible_in']);
        $filter = $assertProductReviewInGrid->prepareFilter($product, $review->getData(), '');
        \PHPUnit_Framework_Assert::assertTrue(
            $reviewIndex->getReviewGrid()->isRowVisible($filter, false),
            'Review for ' . $product->getName() . ' product is not visible in reports grid.'
        );
    }

    /**
     * Returns a string representation of the object
     *
     * @return string
     */
    public function toString()
    {
        return 'Review is visible in review grid for select product.';
    }
}
