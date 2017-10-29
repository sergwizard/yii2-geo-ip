<?php
namespace sergwizard\geoIp;

use Yii;
use yii\base\UnknownPropertyException;

/**
 * ProperCreator convertsvan array items to object properties.
 *
 * @package sergwizard\geoIp
 * @author sergwizard <coder3000web@gmail.com>
 * 
 */
class ProperCreator {

    /**
     * @var array
     */
    public $arr = null;

    /**
     * Constructor.
     */
    public function __construct($array = null) {
        //make object properties from array keys
        if($array && is_array($array)){
            foreach ($array as $k => $v){
                if(is_array($v)){
                    if(is_numeric($k)){
                        $this->arr[$k] = new self($v);
                    }else{
                        $this->$k = new self($v);
                    }
                    
                }else{
                    $this->$k = $v;
                }
                
            }
        }
        
        
        
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
    public function __get($property)
    {
      if (isset($this->$property)) {
        return $this->$property;
      }
    }
    
    public function __isset($property){
        if(!property_exists($this, $property)){
            throw new UnknownPropertyException(__CLASS__ . '::'. $property);
        }
        return $this->$property;    
    }

    
}
