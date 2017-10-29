<?php


namespace sergwizard\geoIp;


use Yii;
use yii\base\UnknownPropertyException;


/**
 * ResultBase contains magic methods __construct, __get, __set, .
 *
 * @package sergwizard\geoIp
 * @author sergwizard <coder3000web@gmail.com>
 * 
 */
class ResultBase {
    /**
     * @var array
     */
    protected $data;

    /**
     * @var array
     */
    protected $attributes = [];

    
    /**
     * Constructor.
     */
    public function __construct($data) {
        $this->data = $data;
    }

    
    /**
     * Returns the value of a property.
     * This method will check in the following order and act accordingly:
     *
     *  - a property defined by a getter: return the getter result
     *
     * @param string $name the property name
     * @return mixed the property value
     * @throws UnknownPropertyException if the property is not defined
     * 
     */
    public function __get($name) {
        $getter = $this->nameCreator($name);
        unset($this->attributes[$name]);
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        } elseif (method_exists($this, $getter)) {
            $value = $this->$getter($this->data);
            $this->$name = $value;
            return $value;
        }

        throw new UnknownPropertyException(__CLASS__ . '::'. $name);
    }

    
    /**
     * Sets the value of a property to array attributes.
     * 
     * @param string $name the property name
     * @param string $value the property value
     */
    public function __set($name, $value) {
        $this->attributes[$name] = $value;
    }
    
    /**
     * Checks if a property is set, i.e. defined and not null.
     * will be implicitly called when executing `isset($object->property)`
     *
     * Note that if the property is not defined, false will be returned.
     * @param string $name the property name
     * @return bool whether the named property is set (not null).
     * 
     */
    public function __isset($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter() !== null;
        } else {
            return false;
        }
    }
    
    private function nameCreator($name)
    {
        $array = explode ( "_", $name );
        $string = '';
        
        foreach($array as $item){
            $string .= ucfirst($item);
        }
        
        return 'get' . $string;
    }
    
    
}
