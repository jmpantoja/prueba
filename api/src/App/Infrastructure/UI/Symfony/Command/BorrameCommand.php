<?php

namespace App\Infrastructure\UI\Symfony\Command;

use App\Application\Music\SaveAlbum;
use App\Domain\Music\Album;
use App\Domain\Vocabulary\Repository\EntryRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Tactician\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\SerializerInterface;

class BorrameCommand extends Command
{
	protected static $defaultName = 'app:borrame';
	protected static $defaultDescription = 'Para hacer pruebas';
	private EntryRepository $repository;
	private SerializerInterface $serializer;
	private EntityManagerInterface $entityManager;
	private CommandBus $commandBus;

	public function __construct(EntityManagerInterface $entityManager, CommandBus $commandBus, SerializerInterface $serializer)
	{
		parent::__construct(self::$defaultName);

		$this->entityManager = $entityManager;
		$this->commandBus = $commandBus;
		$this->serializer = $serializer;
	}

	protected function configure(): void
	{
		$this->setDescription(self::$defaultDescription);
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$io = new SymfonyStyle($input, $output);

		$data = [
			'@id' => '/albums/017ccdb2-2dec-e2db-64ad-ceea2cb231f3',
			'name' => 'revolver',
			'releaseAt' => 1965,
			'price' => [
				'amount' => 12,
				'currency' => 'euro',
			],
			'group' => [
				'@id' => '/music_groups/017cc1cf-6861-4081-0c44-094f23f70999',
				'@type' => 'MusicGroup',
				'name' => 'The Beatles',
				'country' => 'UK',
//				'albums' => [],
			],
		];

		$album = $this->serializer->denormalize($data, Album::class, 'jsonld');

		$this->commandBus->handle(new SaveAlbum($album));

		return Command::SUCCESS;
	}
}
