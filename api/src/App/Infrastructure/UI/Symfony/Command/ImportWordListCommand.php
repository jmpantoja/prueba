<?php

namespace App\Infrastructure\UI\Symfony\Command;

use App\Domain\Vocabulary\Entry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class ImportWordListCommand extends Command
{
	protected static $defaultName = 'vocabulary:import:list';
	protected static $defaultDescription = 'Importa la lista de palabras';
	private string $pathToStorage;
	private Serializer $serializer;
	private EntityManagerInterface $entityManager;

	public function __construct(ParameterBagInterface $parameterBag, SerializerInterface $serializer, EntityManagerInterface $entityManager)
	{
		parent::__construct();
		$this->pathToStorage = sprintf('%s/data', $parameterBag->get('kernel.project_dir'));
		$this->serializer = $serializer;
		$this->entityManager = $entityManager;
	}

	protected function configure(): void
	{
		$this->setDescription(self::$defaultDescription);
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		ini_set('memory_limit', '1G');

		$io = new SymfonyStyle($input, $output);
		$finder = new Finder();
		$files = $finder->files()->in($this->pathToStorage)->sortByName();

		foreach ($files as $file) {
			/** @var Entry $entry */
			$entry = $this->serializer->deserialize($file->getContents(), Entry::class, 'json');

			$totalMeanings = $entry->meanings()->count();
			if ($totalMeanings > 0) {
				$this->entityManager->persist($entry);
			}

			$io->writeln($file->getPath());
		}

		$this->entityManager->flush();

		return Command::SUCCESS;
	}
}
