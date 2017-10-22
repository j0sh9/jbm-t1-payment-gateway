<?php
/*
Plugin Name: _T1 Payment Gateway
Description: Legality Disclaimers for the T1 Merchant Processor
Version: 1.0
*/

add_filter( 'wc_authorize_net_aim_emulation_payment_form_default_credit_card_fields' , 't1_uk_payment_method_disclamiers' );
function t1_uk_payment_method_disclamiers($fields) {	
	$fields['t1_disclaimer_1'] = array(
		'type'          => 'checkbox',
		'id'			=> 't1_payment_disclaimer_1',
		'name'			=> 't1_payment_disclaimer_1',
		'class'         => array('t1-payment-method-disclaimer form-row-wide'),
		'label'         => __('By making a purchase on our website, you certify you are at least 18 years of age.'),
		'required'   	=> true,
		'value'			=> '0'
	);
	$fields['t1_disclaimer_2'] = array(
		'type'          => 'checkbox',
		'id'			=> 't1_payment_disclaimer_2',
		'name'			=> 't1_payment_disclaimer_2',
		'class'         => array('t1-payment-method-disclaimer form-row-wide'),
		'label'         => __('Because we use a U.K.-based credit card processor, your bank may charge you a small processing fee, usually about 1-2% of the transaction.'),
		'required'   	=> true,
		'value'			=> '0'
	);
	$fields['t1_disclaimer_3'] = array(
		'type'          => 'checkbox',
		'id'			=> 't1_payment_disclaimer_3',
		'name'			=> 't1_payment_disclaimer_3',
		'class'         => array('t1-payment-method-disclaimer form-row-wide'),
		'label'         => __('Because we use a U.K.-based credit card processor, if your card is declined, please contact your bank, and ask them to allow this international transaction to go through.'),
		'required'   	=> true,
		'value'			=> '0'
	);
	$fields['t1_disclaimer_4'] = array(
		'type'          => 'checkbox',
		'id'			=> 't1_payment_disclaimer_4',
		'name'			=> 't1_payment_disclaimer_4',
		'class'         => array('t1-payment-method-disclaimer form-row-wide'),
		'label'         => __('Credit/Debit Card, charges on your statement will appear as <strong>"ISODIOL8559796751 8559796751"</strong>.'),
		'required'   	=> true,
		'value'			=> '0'
	);
	return $fields;
}
add_action('woocommerce_checkout_process', 't1_uk_payment_method_disclamiers_validate');

function t1_uk_payment_method_disclamiers_validate() {
	if ( $_POST['payment_method'] == 'authorize_net_aim_emulation' ) {
		if ( ! $_POST['t1_payment_disclaimer_1'] ) {
				wc_add_notice( __( 'Please agree to the Credit Card Age Disclaimer.' ), 'error' );
		}
		if ( ! $_POST['t1_payment_disclaimer_2'] ) {
				wc_add_notice( __( 'Please agree to the Credit Card Processing Fee Disclaimer.' ), 'error' );
		}
		if ( ! $_POST['t1_payment_disclaimer_3'] ) {
				wc_add_notice( __( 'Please agree to the Credit Card International Transaction Disclaimer.' ), 'error' );
		}
		if ( ! $_POST['t1_payment_disclaimer_4'] ) {
				wc_add_notice( __( 'Please agree to the Credit Card Payment Descriptor Disclaimer.' ), 'error' );
		}
	}
}
?>
