<?php


namespace Taskforce\Models\Actions;


abstract class AbstractAction
{
    protected string $name;
    protected string $internalName;
    protected int $creatorId;
    protected int $executorId;
    protected int $userId;

    public function __construct(int $creatorId, int $executorId, int $userId)
    {
        $this->creatorId = $creatorId;
        $this->executorId = $executorId;
        $this->userId = $userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getInternalName(): string
    {
        return $this->internalName;
    }

    abstract public function isAllowed(): bool;
}
