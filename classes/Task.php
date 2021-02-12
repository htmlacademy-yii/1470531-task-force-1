<?php

namespace classes;

use Exception;

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_STARTED = 'started';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';
    const STATUS_FAILED = 'failed';
    const ACTION_RESPOND = 'respond';
    const ACTION_CANCEL = 'cancel';
    const ACTION_REFUSE = 'refuse';
    const ACTION_COMPLETE = 'complete';

    private int $creatorId;
    private int $userId;
    private string $currentStatus = self::STATUS_NEW;

    public function __construct(int $creatorId, int $userId)
    {
        $this->creatorId = $creatorId;
        $this->userId = $userId;
    }

    public function create(): string
    {
        if ($this->userId === $this->creatorId) {
            $this->currentStatus = self::STATUS_NEW;

            return $this->currentStatus;
        } else {
            throw new Exception('Пользователь должен быть создателем задачи');
        }
    }

    public function start(): string
    {
        if ($this->userId === $this->creatorId) {
            $this->currentStatus = self::STATUS_STARTED;

            return $this->currentStatus;
        } else {
            throw new Exception('Пользователь должен быть создателем задачи');
        }
    }

    public function complete(): string
    {
        if ($this->userId === $this->creatorId) {
            $this->currentStatus = self::STATUS_COMPLETED;

            return $this->currentStatus;
        } else {
            throw new Exception('Пользователь должен быть создателем задачи');
        }
    }

    public function cancel(): string
    {
        if ($this->userId === $this->creatorId) {
            $this->currentStatus = self::STATUS_CANCELED;

            return $this->currentStatus;
        } else {
            throw new Exception('Пользователь должен быть создателем задачи');
        }
    }

    public function fail(): string
    {
        if ($this->userId !== $this->creatorId) {
            $this->currentStatus = self::STATUS_FAILED;

            return $this->currentStatus;
        } else {
            throw new Exception('Пользователь не должен быть создателем задачи');
        }
    }

    public function getAvailableStatuses(): array
    {
        switch ($this->currentStatus) {
            case self::STATUS_NEW:
                return [
                    self::STATUS_STARTED => $this->getTranslatedConstant(self::STATUS_STARTED),
                    self::STATUS_CANCELED => $this->getTranslatedConstant(self::STATUS_CANCELED)
                ];
            case self::STATUS_STARTED:
                return [
                    self::STATUS_COMPLETED => $this->getTranslatedConstant(self::STATUS_COMPLETED),
                    self::STATUS_FAILED => $this->getTranslatedConstant(self::STATUS_FAILED)
                ];
        }
    }

    public function getCurrentStatus(): string
    {
        return $this->currentStatus;
    }

    private function getTranslatedConstant(string $constant): string
    {
        switch ($constant) {
            case self::STATUS_NEW:
                return 'Новое';
            case self::STATUS_STARTED:
                return 'В работе';
            case self::STATUS_CANCELED:
                return 'Отменено';
            case self::STATUS_FAILED:
                return 'Провалено';
            case self::STATUS_COMPLETED:
            case self::ACTION_COMPLETE:
                return 'Выполнено';
            case self::ACTION_RESPOND:
                return 'Откликнуться';
            case self::ACTION_CANCEL:
                return 'Отменить';
            case self::ACTION_REFUSE:
                return 'Отказаться';
        }
    }
}
