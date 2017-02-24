<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/');
$I->see('Sourse Url');

$I->fillField('#links-sourse_url','');
if(method_exists($I, 'wait')){
    $I->wait(1);
}

$I->checkOption('#links-checkbox');
if(method_exists($I, 'wait')){
    $I->wait(1);
}
$I->see('Sourse Url cannot be blank');

$I->fillField('#links-sourse_url','http://shortlink.loc/blla-bla/long-blablabla');
if(method_exists($I, 'wait')){
    $I->wait(1);
}
$I->fillField('#links-short_url','');
if(method_exists($I, 'wait')){
    $I->wait(1);
}
$I->click('#links-sourse_url');
if(method_exists($I, 'wait')){
    $I->wait(1);
}
$I->fillField('#links-short_url','http://shortlink.loc/русские-буквы');
if(method_exists($I, 'wait')){
    $I->wait(1);
}
$I->click('#links-sourse_url');
if(method_exists($I, 'wait')){
    $I->wait(1);
}
$I->fillField('#links-short_url','http://shortlink.loc/shortlink');
if(method_exists($I, 'wait')){
    $I->wait(1);
}
$I->click('#p');
if(method_exists($I, 'wait')){
    $I->wait(5);
}

$I->fillField('#links-time_of_death','2017-01-27 00:00:00');
if(method_exists($I, 'wait')){
    $I->wait(1);
}
$I->click('#links-short_url');
$I->click('button.send');
if(method_exists($I, 'wait')){
    $I->wait(2);
}
$I->see('http://shortlink.loc/shortlink');
if(method_exists($I, 'wait')){
    $I->wait(1);
}

$I->click('#result');
if(method_exists($I, 'wait')){
    $I->wait(1);
}

$I->click('Статистика');
if(method_exists($I, 'wait')){
    $I->wait(5);
}



