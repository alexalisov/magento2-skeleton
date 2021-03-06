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

require __DIR__ . '/../../../../../app/bootstrap.php';
$includePath = new \Magento\Framework\Autoload\IncludePath();
spl_autoload_register([$includePath, 'load']);
$bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $_SERVER);

$mtfRoot = dirname(dirname(dirname(__FILE__)));
$mtfRoot = str_replace('\\', '/', $mtfRoot);
define('MTF_BP', $mtfRoot);
define('MTF_TESTS_PATH', MTF_BP . '/tests/app/');

$paths = [
    MTF_BP,
    MTF_BP . '/lib',
    MTF_BP . '/tests/app',
    MTF_BP . '/generated',
    MTF_BP . '/vendor/magento/mtf',
    MTF_BP . '/vendor/phpunit/phpunit'
];
$includePath->addIncludePath($paths);

$om = $bootstrap->getObjectManager();
/** @var \Mtf\Util\Generate\Factory $generator */
$generator = $om->create('Mtf\Util\Generate\Factory');
$generator->launch();
\Mtf\Util\Generate\GenerateResult::displayResults();
