<?php

require 'app/code/core/Mage/Checkout/controllers/OnepageController.php';

class Voina_Checkout_OnepageController extends Mage_Checkout_OnepageController
{
    /**
     * Shipping address save action
     */
    public function saveShippingAction()
    {
        if ($this->_expireAjax()) {
            return;
        }

        if ($this->isFormkeyValidationOnCheckoutEnabled() && !$this->_validateFormKey()) {
            return;
        }

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('shipping', array());
            $customerAddressId = $this->getRequest()->getPost('shipping_address_id', false);
            $data['country_id'] = 'UA';
            $result1 = $this->getOnepage()->saveShipping($data, $customerAddressId);
            $result2 = $this->getOnepage()->saveBilling($data, $customerAddressId);

            if (!isset($result1['error']) && !isset($result2['error'])) {
                $result['goto_section'] = 'shipping_method';
                $result['update_section'] = array(
                    'name' => 'shipping-method',
                    'html' => $this->_getShippingMethodsHtml()
                );
            }
            $this->_prepareDataJSON($result);
        }
    }
}
