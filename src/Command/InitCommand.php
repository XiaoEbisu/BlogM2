<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputArgument;

class InitCommand extends Command
{
  // the name of the command (the part after "bin/console")
  protected static $defaultName = 'app:init';

  /**
   * @var EntityManager
   */
  protected $em;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->em = $entityManager;
    parent::__construct();
  }

  protected function configure()
  {
    $this->addArgument(
      'reset',
      InputArgument::OPTIONAL,
      'Reset route'
    )->setDescription('Init blog');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $application = $this->getApplication();
    $application->setAutoExit(false);

    $output->writeln(['*********        Dropping DataBase        *********']);

    $options = ['command' => 'doctrine:database:drop', "--force" => true];
    $application->run(
      new \Symfony\Component\Console\Input\ArrayInput($options)
    );

    $output->writeln(['*********        Creating DataBase        *********']);
    $options = [
      'command' => 'doctrine:database:create',
      "--if-not-exists" => true,
    ];
    $application->run(new ArrayInput($options));

    $connection = $this->em->getConnection();
    $connection->getConfiguration()->setSQLLogger(null);

    $checkSchema = $connection->prepare(
      "SELECT schema_name FROM information_schema.schemata WHERE schema_name = :name"
    );
    $checkSchema->bindValue('name', 'blog');
    $checkSchema->execute();
    $checkSchemaResults = $checkSchema->fetchAll();

    /*
    if (isset($checkSchemaResults) && !empty($checkSchemaResults)) {
      $output->writeln(['*********        Drop Tables              *********']);

      $options = ['command' => 'doctrine:schema:drop', "--force" => true];
      $application->run(new ArrayInput($options));

      $statement = $connection->prepare("DROP SCHEMA blog");
      $statement->execute();

      $output->writeln(['*********        CREATE Tables              *********']);

      $statement = $connection->prepare("CREATE SCHEMA blog");
      $statement->execute();
      
    }

    if (empty($checkSchemaResults)) {
      $statement = $connection->prepare("CREATE SCHEMA blog");
      $statement->execute();
    }
    */
    $output->writeln(['*********         Updating Schema         *********']);

    //Create de Schema
    $options = ['command' => 'doctrine:schema:update', "--force" => true];
    $application->run(new ArrayInput($options));

    $output->writeln(['*********          Load Fixtures          *********']);

    //Loading Fixtures
    $options = [
      'command' => 'doctrine:fixtures:load',
      "--no-interaction" => true,
    ];
    $application->run(new ArrayInput($options));

    return Command::SUCCESS;

    // or return this if some error happened during the execution
    // (it's equivalent to returning int(1))
    // return Command::FAILURE;
  }
}

?>
