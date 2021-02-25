<?php


namespace Taskforce\Models\Actions;


class CancelAction extends AbstractAction
{
    public function __construct(int $creatorId, ?int $executorId, int $userId)
    {
        parent::__construct($creatorId, $executorId, $userId);

        $this->name = 'Отмена';
        $this->internalName = 'cancel';
    }

    public function isAllowed(): bool
    {
        return $this->creatorId === $this->userId;
    }
}
