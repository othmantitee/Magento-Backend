<?php
/**
 * Refer to LICENSE.txt distributed with the Temando Shipping module for notice of license
 */
namespace Temando\Shipping\Rest\Response\Type\Completion\Attributes\Shipment\Error;

/**
 * Temando API Completion Shipment Error Source Response Type
 *
 * @package  Temando\Shipping\Rest
 * @author   Christoph Aßmann <christoph.assmann@netresearch.de>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     http://www.temando.com/
 */
class Source
{
    /**
     * @var string
     */
    private $pointer;

    /**
     * @return string
     */
    public function getPointer()
    {
        return $this->pointer;
    }

    /**
     * @param string $pointer
     * @return void
     */
    public function setPointer($pointer)
    {
        $this->pointer = $pointer;
    }
}
