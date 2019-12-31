<?php

namespace Frontastic\Catwalk\ApiCoreBundle\Monolog;

use Frontastic\Catwalk\ApiCoreBundle\Domain\CustomerService;
use Monolog\Formatter\FormatterInterface;

class JsonFormatter implements FormatterInterface
{
    const LOG_SOURCE = 'catwalk-php';

    /**
     * @var CustomerService
     */
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function format(array $record)
    {
        // Format see https://www.notion.so/frontastic/JSON-Logging-Format-7aa12f53846041f08f4d1526b64bd335
        return json_encode((object)[
            'logSource' => self::LOG_SOURCE,
            // In catwalk there is always just 1 project, the current one
            'project' => $this->getProjectId(),
            'customer' => $this->getCustomer(),

            '@timestamp' => (isset($record['datetime']) && ($record['datetime'] instanceof \DateTimeInterface)
                ? ($record['datetime']->format('c'))
                : (new \DateTimeImmutable('now'))->format('c')),
            'message' => $record['message'],
            'severity' => strtoupper($record['level_name']),

            'channel' => $record['channel'],
            'level' => $record['level'],
            'extra' => (object)$record['extra'],
        ]) . "\n";
    }

    public function formatBatch(array $records)
    {
        $message = '';
        foreach ($records as $record) {
            $message .= $this->format($record);
        }

        return $message;
    }

    private function getCustomer(): string
    {
        try {
            return $this->customerService->getCustomer()->name;
        } catch (\Throwable $e) {
            return 'unknown-customer';
        }
    }

    /**
     * Trying to get the project id. If we encounter an error (most likely we are not in a project folder then), we will
     * return 'catwalk' as projectId here.
     *
     * @return string
     */
    private function getProjectId(): string
    {
        try {
            return $this->customerService->getCustomer()->projects[0]->projectId;
        } catch (\Throwable $e) {
            return 'catwalk';
        }
    }
}
