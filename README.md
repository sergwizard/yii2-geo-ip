Yii 2 GeoIP extension
=====================
This extension allows you to get geo data by ip address.

Currently available:

* All fields of the database Maxmind


## Install

Run

```bash
$ php composer.phar require sergwizard/yii2-geo-ip "~1.0"
```

#### OR 

add to your `composer.json`

```json
{
    "require": {
        "sergwizard/yii2-geo-ip": "~1.0"
    }
}
```

and run

```bash
$ php composer update
```


## Usage

### Like component

```php
<?php

$config = [
    ...
    'components' => [
        'geoip' => ['class' => 'sergwizard\GeoIP\GeoIP'],
    ]
    ...
];
```

somewhere in code

```php
$ip = Yii::$app->geoip->ip(); // current user ip

$ip = Yii::$app->geoip->ip("208.113.83.165");

```

To see all the available properties, you need to do the following:

```php
var_dump($ip);die;

```

The result can be like :

```php
object(sergwizard\geoIp\Result)[46]
  protected 'data' => 
    array (size=7)
      'city' => 
        array (size=2)
          'geoname_id' => int 5099836
          'names' => 
            array (size=4)
              ...
      'continent' => 
        array (size=3)
          'code' => string 'NA' (length=2)
          'geoname_id' => int 6255149
          'names' => 
            array (size=8)
              ...
      'country' => 
        array (size=3)
          'geoname_id' => int 6252001
          'iso_code' => string 'US' (length=2)
          'names' => 
            array (size=8)
              ...
      'location' => 
        array (size=5)
          'accuracy_radius' => int 1000
          'latitude' => float 40.7209
          'longitude' => float -74.0468
          'metro_code' => int 501
          'time_zone' => string 'America/New_York' (length=16)
      'postal' => 
        array (size=1)
          'code' => string '07302' (length=5)
      'registered_country' => 
        array (size=3)
          'geoname_id' => int 6252001
          'iso_code' => string 'US' (length=2)
          'names' => 
            array (size=8)
              ...
      'subdivisions' => 
        array (size=1)
          0 => 
            array (size=3)
              ...
  protected 'attributes' => 
    array (size=2)
      'location' => 
        object(sergwizard\geoIp\ProperCreator)[48]
          public 'arr' => 
            array (size=0)
              ...
          public 'accuracy_radius' => int 1000
          public 'latitude' => float 40.7209
          public 'longitude' => float -74.0468
          public 'metro_code' => int 501
          public 'time_zone' => string 'America/New_York' (length=16)
      'subdivisions' => 
        object(sergwizard\geoIp\ProperCreator)[49]
          public 'arr' => 
            array (size=1)
              ...

```



### Base usage

```php

$ip = Yii::$app->geoip->ip("208.113.83.165")//or Yii::$app->geoip->ip() for current user


//Select the desired property, according to the tree, which showed

$ip->country->names->en;//string 'United States'
$ip->country->names->ru;//string 'США'
$ip->country->geoname_id;//int 6252001
$ip->country->iso_code;//string 'US'


$ip->city->geoname_id;//int 5099836
$ip->city->names->en;//string 'Jersey City'
$ip->city->names->ru;//string 'Джерси-Сити'

$ip->location->latitude;//float 40.7209
$ip->location->longitude;//float -74.0468
$ip->location->metro_code;//int 501
$ip->location->time_zone;//string 'America/New_York'

$ip->postal->code;//string '07302'

$ip->registered_country->geoname_id;//int 6252001
$ip->registered_country->iso_code;// string 'US'
$ip->registered_country->names;//string 'America/New_York'

$ip->subdivisions->arr[0]->names->en//string 'New Jersey'

//etc.
```

### Provide a custom database (for example, if you own a licence)

```php
<?php

$config = [
    ...
    'components' => [
        'geoip' => [
            'class' => 'sergwizard\GeoIP\GeoIP',
            'dbPath' => Yii::getAlias('@example/maxmind/database/city.mmdb')
        ],
    ]
    ...
];
```


This product includes GeoLite2 data created by MaxMind, available from http://www.maxmind.com
