<?php


namespace Taskforce\Models\Actions;


class CompleteAction extends AbstractAction
{
    public function __construct(int $creatorId, int $executorId, int $userId)
    {
        parent::__construct($creatorId, $executorId, $userId);

        $this->name = 'Выполнено';
        $this->internalName = 'complete';
    }

    public function isAllowed(): bool
    {
        return $this->creatorId === $this->userId;
    }
}
