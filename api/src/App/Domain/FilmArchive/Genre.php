<?php

namespace App\Domain\FilmArchive;

use App\Domain\FilmArchive\Builder\GenreInput;
use App\Domain\FilmArchive\Event\GenreHasBeenCreated;
use App\Domain\FilmArchive\Event\GenreHasBeenUpdated;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Tangram\Domain\Model\Entity;
use Tangram\Domain\Model\EntityId;
use Tangram\Domain\Model\Traits\NotifyEvents;

class Genre implements Entity
{
    use NotifyEvents;

    /**
     * @var GenreId
     */
    private GenreId $id;

    /**
     * @var string
     */
    private string $name;

    private Collection $movies;

    public function __construct(string $name)
    {
        $this->id = new GenreId();
        $this->name = $name;
        $this->movies = new ArrayCollection();
        $this->notify(new GenreHasBeenCreated($this));
    }

    public function update(string $name): self
    {
        $this->name = $name;
        $this->notify(new GenreHasBeenUpdated($this));
        return $this;
    }

    public function id(): GenreId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return Collection
     */
    public function movies(): MovieList
    {
        return MovieList::collect($this->movies);
    }


}
