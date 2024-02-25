<?php


class Tes extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;
     
    /**
     *
     * @var string
     */
    public $name;
     
    /**
     *
     * @var string
     */
    public $sex;
     
    /**
     *
     * @var string
     */
    public $religion;

    /**
     *
     * @var string
     */
    public $phone;
    
    /**
     *
     * @var string
     */
    public $address;
    
    /**
     *
     * @var string
     */
    public $nik;
     
    /**
     * Independent Column Mapping.
     */
    public function columnMap() {
        return array(
            'id' => 'id', 
            'name' => 'name', 
            'sex' => 'sex', 
            'religion' => 'religion',
            'phone' => 'phone',
            'address' => 'address',
            'nik' => 'nik'
        );
    }

}