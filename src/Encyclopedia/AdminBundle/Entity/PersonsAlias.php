<?php

namespace Encyclopedia\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonsAlias
 *
 * @ORM\Table(name="persons_alias")
 * @ORM\Entity
 * 
 */
class PersonsAlias {
   
    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    protected $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="Persons", inversedBy="alias")
     * @ORM\JoinColumn(name="id_person", referencedColumnName="id")
     */
    private $id_person;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return PersonsAlias
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set id_person
     *
     * @param \Encyclopedia\AdminBundle\Entity\Persons $idPerson
     * @return PersonsAlias
     */
    public function setIdPerson(\Encyclopedia\AdminBundle\Entity\Persons $idPerson = null)
    {
        $this->id_person = $idPerson;

        return $this;
    }

    /**
     * Get id_person
     *
     * @return \Encyclopedia\AdminBundle\Entity\Persons 
     */
    public function getIdPerson()
    {
        return $this->id_person;
    }
}
