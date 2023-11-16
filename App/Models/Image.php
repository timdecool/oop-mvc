<?php
namespace App\Models;
use App\Models\AbstractTable;
use DateTime;

class Image extends AbstractTable {
    // Properties
    private ?string $src = null;
    private ?string $title = null;
    private ?string $description = null;
    private ?string $author = null;
    private ?string $authorLink = null;
    private ?DateTime $dateAdded = null;
    private ?DateTime $dateUpdated = null;
    private ?int $idUser = null;

    /**
     * Get the value of src
     */
    public function getSrc(): ?string
    {
        return $this->src;
    }

    /**
     * Set the value of src
     */
    public function setSrc(?string $src): void
    {
        $this->src = $src;
    }

    /**
     * Get the value of title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get the value of author
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * Set the value of author
     */
    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }

    /**
     * Get the value of author_link
     */
    public function getAuthorLink(): ?string
    {
        return $this->authorLink;
    }

    /**
     * Set the value of author_link
     */
    public function setAuthorLink(?string $authorLink): void
    {
        $this->authorLink = $authorLink;
    }

    /**
     * Get the value of dateAdded
     */
    public function getDateAdded(): ?\DateTime
    {
        return $this->dateAdded;
    }

    /**
     * Set the value of dateAdded
     */
    public function setDateAdded(?\DateTime $dateAdded): void
    {
        $this->dateAdded = $dateAdded;
    }

    /**
     * Get the value of dateUpdated
     */
    public function getDateUpdated(): ?\DateTime
    {
        return $this->dateUpdated;
    }

    /**
     * Set the value of dateUpdated
     */
    public function setDateUpdated(?\DateTime $dateUpdated): void
    {
        $this->dateUpdated = $dateUpdated;
    }

    /**
     * Get the value of idUser
     */
    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     */
    public function setIdUser(?int $idUser): void
    {
        $this->idUser = $idUser;
    }

    public function validate() {
        $errors = [];

        if(empty($this->src)) {
            $errors[] = "Veuillez renseigner la source de l'image.";
        } else if(!str_starts_with($this->src,"https://") && !str_starts_with($this->src,"./uploads")) {
            $errors[] = "La source n'est pas valide.";
        }

        if(empty($this->title)) {
            $errors[] = "Veuillez renseigner le titre de l'image.";
        }

        if(empty($this->author)) {
            $errors[] = "Veuillez renseigner l'auteur de l'image.";
        }

        if(empty($this->authorLink)) {
            $errors[] = "Veuillez renseigner un lien vers le travail de l'auteur.";
        } else if(!(str_starts_with($this->authorLink,"https://"))) {
            $errors[] = "Le lien vers le travail de l'auteur n'est pas un lien https valide.";
        }

        if(empty($this->description)) {
            $errors[] = "Veuillez renseigner la description de l'image.";
        }

        return $errors;
    }

    public function toArray() {
        return [$this->src,$this->title,$this->author,$this->authorLink,$this->description];
    }

    public function clean(?array $input):void {
        $this->setTitle(trim(strip_tags($input['title'])));
        $this->setAuthor(trim(strip_tags($input['author'])));
        $this->setAuthorLink(trim(strip_tags($input['author-link'])));
        $this->setDescription(trim(strip_tags($input['description'])));
    }
}