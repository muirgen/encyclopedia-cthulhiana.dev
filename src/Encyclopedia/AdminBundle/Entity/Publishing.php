<?php

namespace Encyclopedia\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publishing
 *
 * @ORM\Table(name="publishing", indexes={@ORM\Index(name="title", columns={"title", "author"}), @ORM\Index(name="id_lang", columns={"id_lang"})})
 * @ORM\Entity
 */
class Publishing
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
     * @ORM\Column(name="title", type="string", length=250, nullable=false)
     */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=250, nullable=true)
     */
    private $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=250, nullable=false)
     */
    private $author;
    
    /**
     * @var string
     *
     * @ORM\Column(name="collection", type="string", length=250, nullable=true)
     */
    private $collection;
    
    /**
     * @var string
     *
     * @ORM\Column(name="collection_number", type="string", length=100, nullable=true)
     */
    private $collectionNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="publisher", type="string", length=250, nullable=true)
     */
    private $publisher;
    
    /**
     * @var string
     *
     * @ORM\Column(name="publish_month", type="string", length=50, nullable=true)
     */
    private $publishMonth;
    
    /**
     * @var \Year
     * 
     * @ORM\Column(name="publish_year", columnDefinition="YEAR")
     */
    private $publishYear;

    /**
     * @var string
     *
     * @ORM\Column(name="classification", type="string", length=250, nullable=false)
     */
    private $classification;

    /**
     * @var string
     *
     * @ORM\Column(name="type_number", type="string", length=30, nullable=true)
     */
    private $typeNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="ref_number", type="string", length=250, nullable=true)
     */
    private $refNumber;

    /**
     * @var \Lang
     *
     * @ORM\ManyToOne(targetEntity="Lang")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lang", referencedColumnName="id")
     * })
     */
    private $languages;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Oeuvres", inversedBy="publishing", cascade={"persist","remove"})
     * @ORM\JoinTable(name="oeuvres_publishing",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_publishing", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_oeuvre", referencedColumnName="id")
     *   }
     * )
     */
    private $oeuvres;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->oeuvres = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set title
     *
     * @param string $title
     * @return Publishing
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     * @return Publishing
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string 
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Publishing
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set collection
     *
     * @param string $collection
     * @return Publishing
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * Get collection
     *
     * @return string 
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Set collectionNumber
     *
     * @param string $collectionNumber
     * @return Publishing
     */
    public function setCollectionNumber($collectionNumber)
    {
        $this->collectionNumber = $collectionNumber;

        return $this;
    }

    /**
     * Get collectionNumber
     *
     * @return string 
     */
    public function getCollectionNumber()
    {
        return $this->collectionNumber;
    }

    /**
     * Set publisher
     *
     * @param string $publisher
     * @return Publishing
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return string 
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set publishMonth
     *
     * @param string $publishMonth
     * @return Publishing
     */
    public function setPublishMonth($publishMonth)
    {
        $this->publishMonth = $publishMonth;

        return $this;
    }

    /**
     * Get publishMonth
     *
     * @return string 
     */
    public function getPublishMonth()
    {
        return $this->publishMonth;
    }

    /**
     * Set publishYear
     *
     * @param string $publishYear
     * @return Publishing
     */
    public function setPublishYear($publishYear)
    {
        $this->publishYear = $publishYear;

        return $this;
    }

    /**
     * Get publishYear
     *
     * @return string 
     */
    public function getPublishYear()
    {
        return $this->publishYear;
    }

    /**
     * Set classification
     *
     * @param string $classification
     * @return Publishing
     */
    public function setClassification($classification)
    {
        $this->classification = $classification;

        return $this;
    }

    /**
     * Get classification
     *
     * @return string 
     */
    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * Set typeNumber
     *
     * @param string $typeNumber
     * @return Publishing
     */
    public function setTypeNumber($typeNumber)
    {
        $this->typeNumber = $typeNumber;

        return $this;
    }

    /**
     * Get typeNumber
     *
     * @return string 
     */
    public function getTypeNumber()
    {
        return $this->typeNumber;
    }

    /**
     * Set refNumber
     *
     * @param string $refNumber
     * @return Publishing
     */
    public function setRefNumber($refNumber)
    {
        $this->refNumber = $refNumber;

        return $this;
    }

    /**
     * Get refNumber
     *
     * @return string 
     */
    public function getRefNumber()
    {
        return $this->refNumber;
    }

    /**
     * Set languages
     *
     * @param \Encyclopedia\AdminBundle\Entity\Lang $languages
     * @return Publishing
     */
    public function setLanguages(\Encyclopedia\AdminBundle\Entity\Lang $languages = null)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * Get languages
     *
     * @return \Encyclopedia\AdminBundle\Entity\Lang 
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Add oeuvres
     *
     * @param \Encyclopedia\AdminBundle\Entity\Oeuvres $oeuvres
     * @return Publishing
     */
    public function addOeuvre(\Encyclopedia\AdminBundle\Entity\Oeuvres $oeuvres)
    {
        $this->oeuvres[] = $oeuvres;

        return $this;
    }

    /**
     * Remove oeuvres
     *
     * @param \Encyclopedia\AdminBundle\Entity\Oeuvres $oeuvres
     */
    public function removeOeuvre(\Encyclopedia\AdminBundle\Entity\Oeuvres $oeuvres)
    {
        $this->oeuvres->removeElement($oeuvres);
    }

    /**
     * Get oeuvres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOeuvres()
    {
        return $this->oeuvres;
    }
}
