<?php
    // Define an absolute path to the project root
    $rootPath = realpath(__DIR__ . '/../'); // 'realpath' is used to resolve the absolute path

    // Include the Composer autoloader
    require_once $rootPath . '/vendor/autoload.php';

    // Load the .env file located at the root of the project
    $dotenv = Dotenv\Dotenv::createImmutable($rootPath);
    $dotenv->load();

    // Check if the required environment variables are set
    if (!isset($_ENV['HOST_DB'], $_ENV['DATABASENAME'], $_ENV['USER_DB'], $_ENV['PASSWORD_DB'])) {
        die("The necessary environment variables are not set.");
    }

    // Retrieve the environment variables
    $HOST = $_ENV['HOST_DB'];
    $DBNAME = $_ENV['DATABASENAME'];
    $USER = $_ENV['USER_DB'];
    $PASSWORD = $_ENV['PASSWORD_DB'];

    // Connect to the database
    $DB = mysqli_connect($HOST, $USER, $PASSWORD, $DBNAME);

    // Check the connection
    if (!$DB) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Set the character set for the connection
    mysqli_set_charset($DB, "utf8");
?>
