<?php 


$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/');
$I->see('Search Flickr!');
$I->click('Search Photos on Flickr');
$I->amOnPage('/site/login');
$I->see("Don't have an account, Register Here");
$I->click("Register Here");

$I->expectTo('Get username validation error');
$I->amOnPage('/site/signup');
$I->fillField('input[name="SignupForm[username]"]','anilkonsal');
$I->fillField('input[name="SignupForm[email]"]', '');
$I->fillField('input[name="SignupForm[password]"]', '');
$I->click('Sign Up');

$I->see('Username cannot be blank');

$I->expectTo('Get redirected on Login page when I am not logged in and try to access search form');
$I->amOnPage('/site/search-index');
$I->see('Login');