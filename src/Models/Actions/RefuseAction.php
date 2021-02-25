<?php


namespace Taskforce\Models\Actions;


class RefuseAction extends AbstractAction
{
    public function __construct(int $creatorId, ?int $executorId, int $userId)
    {
        parent::__construct($creatorId, $executorId, $userId);

        $this->name = 'Отказаться';
        $this->internalName = 'refuse';
    }

    public function isAllowed(): bool
    {
        return $this->executorId === $this->userId;
    }
}
