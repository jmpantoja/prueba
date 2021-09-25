<?php

declare(strict_types=1);

namespace App\Behat\Context;

use Assert\Assertion;
use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Doctrine\DBAL\Connection;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
final class ApiContext implements Context
{
	/** @var KernelInterface */
	private $kernel;

	private ?Response $response;

	/**
	 * @var Connection
	 */
	private $connection;

	private array $options;

	private string $missingResponseError = 'The request has not been made yet, so no response object exists.';

	public function __construct(KernelInterface $kernel, ParameterBagInterface $parameters)
	{
		$this->baseUrl = $parameters->get('behat_base_url');
		$this->kernel = $kernel;
		$this->connection = $kernel->getContainer()->get('doctrine')->getManager()->getConnection();

		$this->options = [
			'parameters' => [],
			'cookies' => [],
			'files' => [],
			'server' => [
				'CONTENT_TYPE' => 'application/ld+json',
				'HTTP_ACCEPT' => 'application/ld+json',
			],
			'content' => null,
		];
	}

	/** @BeforeScenario */
	public function before(BeforeScenarioScope $event)
	{
		$this->connection->beginTransaction();
	}

	/** @AfterScenario */
	public function after(AfterScenarioScope $event)
	{
		$this->connection->rollBack();
	}

	/**
	 * @Given The request body
	 */
	public function theRequestBody(PyStringNode $content)
	{
		$this->options['content'] = (string) $content;
	}

	/**
	 * @When I request :method to :path
	 */
	public function iRequestTo(string $method, string $uri)
	{
		$this->options['uri'] = sprintf('%s/%s', ...[
			rtrim($this->baseUrl, '/'),
			ltrim($uri, '/'),
		]);

		$this->options['method'] = $method;

		$this->response = $this->kernel->handle(Request::create(...$this->options));
	}

	/**
	 * @Then The response code is :code
	 */
	public function theResponseCodeIs(int $code)
	{
		Assertion::same(...[
			$code,
			$this->response->getStatusCode(),
			sprintf('Se ha devuelto el código "%s" (se esperaba: %s)', $this->response->getStatusCode(), $code),
		]);
	}

	/**
	 * @Then The response body contains
	 */
	public function theResponseBodyContains(PyStringNode $expected)
	{
		$differ = new ArrayDiff();

		$differ->addFunction('regExp', fn () => true);

		$content = json_decode($this->response->getContent(), true);
		$expected = json_decode((string) $expected, true);
		$differ->compare($expected, $content);

		return true;
	}
}
