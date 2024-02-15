<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: FileRepository::class)]
class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $storedName = null;

    #[ORM\Column(length: 255)]
    private ?string $originalName = null;

    #[ORM\Column(length: 5)]
    private ?string $extension = null;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    private ?UploadedFile $file = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStoredName(): ?string
    {
        return $this->storedName;
    }

    public function setStoredName(string $storedName): self
    {
        $this->storedName = $storedName;

        return $this;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(string $originalName): self
    {
        $this->originalName = $originalName;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    public function setFile(?UploadedFile $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function __toString()
    {
        return $this->originalName;
    }

    public function setLocalFile(string $folder)
    {
        if (!is_dir('./img/'.$folder)) mkdir('./img/'.$folder);

        $ext = pathinfo($this->file->getClientOriginalName(), PATHINFO_EXTENSION);
        $name = str_replace('.' . $ext, '', $this->file->getClientOriginalName());
        $this->setOriginalName($name)
            ->setExtension($ext);

        $i = null;
        if (file_exists('./img/' . $folder . '/' . $this->file->getClientOriginalName())) {
            $i = 0;
            while (file_exists('./img/' . $folder . '/' . $name . $i . $ext)) {
                $i++;
            }
            $i++;
        }
        
        if ($i === null) {
            $this->setStoredName($name)
            ->setPath('/img/' . $folder . '/' . $name . '.' . $ext);
        } else {
            $this->setStoredName($name . $i)
            ->setPath('/img/' . $folder . '/' . $name . $i . '.' . $ext);
        }
    }
}
