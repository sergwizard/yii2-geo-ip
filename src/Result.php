<?php


namespace sergwizard\geoIp;

/**
 * Class Result
 * @package sergwizard\geoIp
 * @author sergwizard <coder3000web@gmail.com>
 *
 * @property object|null city
 * @property object|null continent
 * @property object|null country
 * @property object|null location
 * @property object|null postal
 * @property object|null registered_country
 * @property object|null subdivisions
 */
class Result extends ResultBase {
    
    /*
     * @param array $data
     * @return object or null
     */
    protected function getCity($data) {
        return isset($data['city']) ? new ProperCreator($data['city']) : null;
    }

    /*
     * @param array $data
     * @return object|null
     */
    protected function getContinent($data) {
        return isset($data['continent']) ? new ProperCreator($data['continent']) : null;
    }
    
    /*
     * @param array $data
     * @return object|null
     */
    protected function getCountry($data) {
        return isset($data['country']) ? new ProperCreator($data['country']) : null;
    }

    /*
     * @param array $data
     * @return object|null
     */
    protected function getLocation($data) {
        return isset($data['location']) ? new ProperCreator($data['location']) : null;
    }

    /*
     * @param array $data
     * @return object|null
     */
    protected function getPostal($data) {
        return isset($data['postal']) ? new ProperCreator($data['postal']) : null;
    }
    
    /*
     * @param array $data
     * @return object|null
     */
    protected function getRegisteredCountry($data) {
        return isset($data['registered_country']) ? new ProperCreator($data['registered_country']) : null;
    }

    
    /*
     * Base usage:
     *            $ip = Yii::$app->geoip->ip("208.113.83.165");
     *            var_dump($ip->subdivisions->arr[0]->names->en);
     * 
     * @param array $data
     * @return object|null
     */
    protected function getSubdivisions($data) {
        return isset($data['subdivisions']) ? new ProperCreator($data['subdivisions']) : null;
    }
    
}
