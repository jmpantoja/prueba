<?php

namespace spec\App\Infrastructure\Importer;

use App\Infrastructure\Importer\CacheStorage;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class CacheStorageSpec extends ObjectBehavior
{
	public function let(ParameterBagInterface $bag)
	{
		$this->beConstructedWith($bag);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(CacheStorage::class);
	}

	public function it_gets_directory_path_properly(ParameterBagInterface $bag)
	{
		$bag->get('kernel.project_dir')->willReturn('/root');
		$this->pathToStorage()->shouldReturn('/root/data');
	}
}
