<?php

use Behat\Behat\Context\ClosuredContextInterface,
	Behat\Behat\Context\TranslatedContextInterface,
	Behat\Behat\Context\BehatContext,
	Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
	Behat\Gherkin\Node\TableNode;


/**
 * Features context.
 */
class FeatureContext extends BehatContext {

	/**
	 * Initializes context.
	 * Every scenario gets it's own context object.
	 *
	 * @param array $parameters context parameters (set them up through behat.yml)
	 */
	public function __construct(array $parameters)	{
		$this->useContext( 'nette', new NetteContext( $parameters ) );
		$this->useContext( 'detailPage', new DetailPageContext( $parameters ) );
		$this->useContext( 'experimentsImport', new ExperimentsImportContext( $parameters ) );
		$this->useContext( 'experimentsListPage', new ExperimentsListContext( $parameters ) );
		$this->useContext( 'tasksImport', new TasksImportContext( $parameters ) );
	}

}