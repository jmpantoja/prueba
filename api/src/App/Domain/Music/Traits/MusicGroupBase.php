<?php
/**
 * This file is part of the planb project.
 *
 * (c) jmpantoja <jmpantoja@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Domain\Music\Traits;

use App\Domain\Music\Album;
use App\Domain\Music\AlbumList;
use App\Domain\Music\Event\MusicGroupHasBeenCreated;
use App\Domain\Music\Event\MusicGroupHasBeenUpdated;
use App\Domain\Music\MusicGroupId;
use App\Domain\Music\VO\Country;
use App\Domain\Music\VO\GroupName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Tangram\Domain\Event\DomainEventInterface;

trait MusicGroupBase
{
    private GroupName $name;

    private Country $country;

    private Collection $albums;

    private MusicGroupId $id;

    public function __construct(GroupName $name, Country $country, array $albums)
    {
        $this->id = new MusicGroupId();
        $this->albums = new ArrayCollection();

        $this->initialize($name, $country, $albums);
        $this->notify(new MusicGroupHasBeenCreated($this));
    }

    abstract public function notify(DomainEventInterface $domainEvent): void;

    public function update(GroupName $name, Country $country, array $albums): static
    {
        $this->initialize($name, $country, $albums);
        $this->notify(new MusicGroupHasBeenUpdated($this));

        return $this;
    }

    private function initialize(GroupName $name, Country $country, array $albums): static
    {
        $this->name = $name;
        $this->country = $country;
        //	$this->putAlbums($albums);

        return $this;
    }

    public function putAlbums(?iterable $albums): static
    {
        if (is_null($albums)) {
            return $this;
        }

        $this->albums()
            ->compareWith($albums)
            ->inserts([$this, 'addAlbum'])
            ->removes([$this, 'removeAlbum']);

        return $this;
    }

    public function addAlbum(Album $album): static
    {
        if ($this->albums->contains($album)) {
            return $this;
        }
        $this->albums->add($album);

        return $this;
    }

    public function removeAlbum(Album $album): static
    {
        if (!$this->albums->contains($album)) {
            return $this;
        }
        $this->albums->removeElement($album);

        return $this;
    }

    public function id(): MusicGroupId
    {
        return $this->id;
    }

    public function name(): GroupName
    {
        return $this->name;
    }

    public function country(): Country
    {
        return $this->country;
    }

    public function albums(): AlbumList
    {
        return AlbumList::collect($this->albums);
    }
}
