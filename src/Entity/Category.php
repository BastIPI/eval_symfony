<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BlogPost", mappedBy="category", orphanRemoval=false)
     */
    private $blogposts;

    public function __construct()
    {
        $this->blogposts = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|BlogPost[]
     */
    public function getBlogposts(): Collection
    {
        return $this->blogposts;
    }

    public function addBlogpost(BlogPost $blogpost): self
    {
        if (!$this->blogposts->contains($blogpost)) {
            $this->blogposts[] = $blogpost;
            $blogpost->setCategory($this);
        }

        return $this;
    }

    public function removeBlogpost(BlogPost $blogpost): self
    {
        if ($this->products->contains($blogpost)) {
            $this->products->removeElement($blogpost);
            
            if ($blogpost->getCategory() === $this) {
                $blogpost->setCategory(null);
            }
        }

        return $this;
    }

}
