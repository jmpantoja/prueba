<?php

namespace App\Infrastructure\UI\Symfony\Command;

use App\Domain\Vocabulary\Entry;
use App\Infrastructure\Importer\WordGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class CreateWordListCommand extends Command
{
	const LAST_LEVEL = 20;
	const LAST_PAGE = 100;

	protected static $defaultName = 'vocabulary:create:list';
	protected static $defaultDescription = 'Crea una lista de palabras en ingles, clasificadas por frecuencia';
	private WordGenerator $generator;
	private DenormalizerInterface $normalizer;

	public function __construct(WordGenerator $generator, DenormalizerInterface $normalizer)
	{
		parent::__construct();

		$this->generator = $generator;
		$this->normalizer = $normalizer;
	}

	protected function configure(): void
	{
		$this->setDescription(self::$defaultDescription);
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$io = new SymfonyStyle($input, $output);

		$entries = $this->generator->import(1, 1);

		dump($entries);
		exit();

		$entry = $this->normalizer->denormalize($entries[0], Entry::class);

		dump($entry);
		exit();

		//        $writer = Writer::createFromPath(__DIR__ . '/words.csv', 'w+');
//

//
		//        $io->progressStart(self::LAST_LEVEL * self::LAST_PAGE);
//
		//        for ($level = 1; $level <= self::LAST_LEVEL; $level++) {
		//            for ($page = 1; $page <= self::LAST_PAGE; $page++) {
		//                $records = $this->generator->import($level, $page);
//
		//                foreach ($records as $record) {
		//                    $writer->insertOne([json_encode($record)]);
		//                }
		//                $io->progressAdvance(1);
		//            }
		//        }
//
		//        $io->progressFinish();

		return Command::SUCCESS;
	}
}
