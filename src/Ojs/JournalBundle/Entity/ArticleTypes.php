<?php

namespace Ojs\JournalBundle\Entity;

use APY\DataGridBundle\Grid\Mapping as GRID;
use Ojs\Common\Entity\GenericEntityTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Prezent\Doctrine\Translatable\Annotation as Prezent;
use Prezent\Doctrine\Translatable\Entity\AbstractTranslatable;
use Ojs\JournalBundle\Entity\ArticleTypesTranslation;
use JMS\Serializer\Annotation as JMS;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * ArticleTypes
 * @GRID\Source(columns="id,name,description")
 * @ExclusionPolicy("all")
 */
class ArticleTypes extends AbstractTranslatable
{
    use GenericEntityTrait;

    /**
     * @var integer
     * @GRID\Column(title="id")
     * @Expose
     */
    protected $id;

    /**
     * @var string
     * @GRID\Column(title="name")
     * @Expose
     */
    private $name;

    /**
     * @var string
     * @GRID\Column(title="description")
     * @Expose
     */
    private $description;

    /**
     * @Prezent\Translations(targetEntity="Ojs\JournalBundle\Entity\ArticleTypesTranslation")
     * @Expose
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * Translation helper method
     * @param null $locale
     * @return mixed|null|\Ojs\JournalBundle\Entity\ArticleTypesTranslation
     */
    public function translate($locale = null)
    {
        if (null === $locale) {
            $locale = $this->currentLocale;
        }
        if (!$locale) {
            throw new \RuntimeException('No locale has been set and currentLocale is empty');
        }
        if ($this->currentTranslation && $this->currentTranslation->getLocale() === $locale) {
            return $this->currentTranslation;
        }
        $defaultTranslation = $this->translations->get($this->getDefaultLocale());
        if (!$translation = $this->translations->get($locale)) {
            $translation = new ArticleTypesTranslation();
            if(!is_null($defaultTranslation)){
                $translation->setName($defaultTranslation->getName());
                $translation->setDescription($defaultTranslation->getDescription());
            }
            $translation->setLocale($locale);
            $this->addTranslation($translation);
        }
        $this->currentTranslation = $translation;
        return $translation;
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

    // Proxy getters and setters
    /**
     * Set name
     *
     * @param  string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->translate()->setName($name);
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->translate()->getName();
    }

    /**
     * Set description
     *
     * @param  string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->translate()->setDescription($description);
        return $this;
    }

    public function display()
    {
        return get_object_vars($this);
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->translate()->getDescription();
    }

    public function __toString()
    {
        if(!is_string($this->getName())){
            return $this->translations->first()->getName();
        }else{
            return $this->getName();
        }
    }
}
