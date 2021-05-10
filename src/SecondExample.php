<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting;

use LukasLangen\Workshop\UnitTesting\Dependencies\HandlerInterface;
use LukasLangen\Workshop\UnitTesting\Dependencies\NullHandler;
use LukasLangen\Workshop\UnitTesting\Dependencies\RequestHandler;
use LukasLangen\Workshop\UnitTesting\Dependencies\ResponseHandler;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use function array_key_exists;

final class SecondExample
{
    private const TYPE_MAPPING = [
        'request' => RequestHandler::class,
        'response' => ResponseHandler::class
    ];

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(ContainerInterface $container, LoggerInterface $logger)
    {
        $this->container = $container;
        $this->logger = $logger;
    }

    /**
     * This method should return an instance of HandlerInterface::class depending on a $type string.
     * The instances are all registered in the ContainerInterface::class instance given into the SecondExample::class
     * by their respective fully qualified class names.
     *
     * The mapping should look like this:
     * 'request' => RequestHandler::class
     * 'response' => ResponseHandler::class
     * default => NullHandler::class
     *
     * If the default case is reached, the method should also log a message with the info status.
     *
     * Example 1:
     *     Input: 'some-gibberish'
     *     Output: Instance of NullHandler::class
     *     Side-Effects: Logs "Mapping for type 'some-gibberish' doesn't exist."
     *
     * Example 2:
     *     Input: 'request'
     *     Output: Instance of RequestHandler::class
     *     Side-Effects: none
     */
    public function create(string $type): HandlerInterface
    {
        if (!array_key_exists($type, self::TYPE_MAPPING)) {
            $this->logger->info("Mapping for type '$type' doesn't exist");
            return $this->container->get(NullHandler::class);
        }

        $className = self::TYPE_MAPPING[$type];

        return new $className();
    }
}
