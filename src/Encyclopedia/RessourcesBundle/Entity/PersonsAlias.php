<?php

namespace Encyclopedia\RessourcesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonsAlias
 *
 * @ORM\Table(name="persons_alias", indexes={@ORM\Index(name="id_person", columns={"id_person"})})
 * @ORM\Entity
 */
class PersonsAlias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var \Persons
     *
     * @ORM\ManyToOne(targetEntity="Persons")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_person", referencedColumnName="id")
     * })
     */
    private $idPerson;



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
     * Set idPerson
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Persons $idPerson
     * @return PersonsAlias
     */
    public function setIdPerson(\Encyclopedia\RessourcesBundle\Entity\Persons $idPerson = null)
    {
        $this->idPerson = $idPerson;

        return $this;
    }

    /**
     * Get idPerson
     *
     * @return \Encyclopedia\RessourcesBundle\Entity\Persons 
     */
    public function getIdPerson()
    {
        return $this->idPerson;
    }
}
