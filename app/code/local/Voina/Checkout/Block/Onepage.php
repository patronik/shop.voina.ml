<?php

class Voina_Checkout_Block_Onepage extends Mage_Checkout_Block_Onepage_Abstract
{
    /**
     * Get 'one step checkout' step data
     *
     * @return array
     */
    public function getSteps()
    {
        $steps = array();
        $stepCodes = $this->_getStepCodes();

        if ($this->isCustomerLoggedIn()) {
            $stepCodes = array_diff($stepCodes, array('login'));
        }

        foreach ($stepCodes as $step) {
            $steps[$step] = $this->getCheckout()->getStepData($step);
        }

        $steps['shipping']['allow'] = true;

        return $steps;
    }

    /**
     * Get active step
     *
     * @return string
     */
    public function getActiveStep()
    {
        return 'shipping';
    }
}
