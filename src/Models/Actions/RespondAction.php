<?php


namespace Taskforce\Models\Actions;


class RespondAction extends AbstractAction
{
    public function __construct(int $creatorId, int $executorId, int $userId)
    {
        parent::__construct($creatorId, $executorId, $userId);

        $this->name = 'Откликнуться';
        $this->internalName = 'respond';
    }

    public function isAllowed(): bool
    {
        return is_null($this->executorId) && $this->userId;
    }
}
