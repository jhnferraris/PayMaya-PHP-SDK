<?php

// To test, execute this in your terminal `$ php sampler-checkout.php`

echo "Hello world!" . "\n";
require __DIR__  . '/vendor/autoload.php';

use PayMaya\PayMayaSDK;
use PayMaya\API\Checkout;
use PayMaya\Model\Checkout\ItemAmount;
use PayMaya\Model\Checkout\Buyer;

PayMayaSDK::getInstance()->initCheckout("<change to your public key>", "<change to your secret key>", "SANDBOX");

$itemCheckout = new Checkout();
$buyer = new Buyer();
$buyer->firstName = "john";
$buyer->lastName = "doe";
$itemCheckout->buyer = $buyer;

// Item
$itemAmount = new ItemAmount();
$itemAmount->currency = "PHP";
$itemAmount->value = "7000.00";

$itemCheckout->totalAmount = $itemAmount;
$itemCheckout->requestReferenceNumber = "123456789";
$itemCheckout->redirectUrl = array(
	"success" => "https://shop.com/success",
	"failure" => "https://shop.com/failure",
	"cancel" => "https://shop.com/cancel"
	);

$itemCheckout->execute();

echo $itemCheckout->id . "\n"; // Checkout ID

echo $itemCheckout->url . "\n"; // Checkout URL
