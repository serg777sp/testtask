<?php

namespace App\Models\Doc2;

use Doctrine\ORM\Mapping as ORM;
/**
 * Description of User
 *
 * @author serg
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User {

    public function __construct($name, $password, $info) {
	$this->name = $name;
	$this->password = $password;
	$this->info = $info;
	$this->created_at = date('Y-m-d H:i:s', time());
    }

     /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     */
    private $info;

    /**
     * @ORM\Column(type="string")
     */
    private $created_at;
}

