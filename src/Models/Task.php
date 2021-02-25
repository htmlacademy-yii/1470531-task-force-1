<?php

namespace Taskforce\Models;

use Taskforce\Exceptions\PermissionException;
use Taskforce\Models\Actions\AbstractAction;
use Taskforce\Models\Actions\CancelAction;
use Taskforce\Models\Actions\CompleteAction;
use Taskforce\Models\Actions\RefuseAction;
use Taskforce\Models\Actions\RespondAction;

class Task
{
    public const STATUS_NEW = 'new';
    public const STATUS_STARTED = 'started';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELED = 'canceled';
    public const STATUS_FAILED = 'failed';

    private int $creatorId;
    private ?int $executorId;
    private int $userId;
    private string $currentStatus = self::STATUS_NEW;

    private AbstractAction $Cancel;
    private AbstractAction $Complete;
    private AbstractAction $Refuse;
    private AbstractAction $Respond;

    public function __construct(int $creatorId, ?int $executorId, int $userId)
    {
        $this->creatorId = $creatorId;
        $this->executorId = $executorId;
        $this->userId = $userId;

        $this->Cancel = new CancelAction($creatorId, $executorId, $userId);
        $this->Complete = new CompleteAction($creatorId, $executorId, $userId);
        $this->Refuse = new RefuseAction($creatorId, $executorId, $userId);
        $this->Respond = new RespondAction($creatorId, $executorId, $userId);
    }

    public function create(): string
    {
        if ($this->userId === $this->creatorId) {
            $this->currentStatus = self::STATUS_NEW;

            return $this->currentStatus;
        }

        throw new PermissionException('Пользователь должен быть создателем задачи');
    }

    public function start(): string
    {
        if ($this->Respond->isAllowed()) {
            $this->currentStatus = self::STATUS_STARTED;

            return $this->currentStatus;
        }

        throw new PermissionException('Пользователь должен быть создателем задачи');
    }

    public function complete(): string
    {
        if ($this->Complete->isAllowed()) {
            $this->currentStatus = self::STATUS_COMPLETED;

            return $this->currentStatus;
        }

        throw new PermissionException('Пользователь должен быть создателем задачи');
    }

    public function cancel(): string
    {
        if ($this->Cancel->isAllowed()) {
            $this->currentStatus = self::STATUS_CANCELED;

            return $this->currentStatus;
        }

        throw new PermissionException('Пользователь должен быть создателем задачи');
    }

    public function fail(): string
    {
        if ($this->Refuse->isAllowed()) {
            $this->currentStatus = self::STATUS_FAILED;

            return $this->currentStatus;
        }

        throw new PermissionException('Пользователь не должен быть создателем задачи');
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
            default:
                return [];
        }
    }

    public function getAvailableAction(): string
    {
        switch ($this->currentStatus) {
            case self::STATUS_NEW:
                if ($this->Cancel->isAllowed()) {
                    return $this->Cancel->getInternalName();
                }

                if ($this->Respond->isAllowed()) {
                    return $this->Respond->getInternalName();
                }
                break;
            case self::STATUS_STARTED:
                if ($this->Complete->isAllowed()) {
                    return $this->Complete->getInternalName();
                }

                if ($this->Refuse->isAllowed()) {
                    return $this->Refuse->getInternalName();
                }
                break;
            default:
                return '';
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
                return 'Выполнено';
            default:
                return '';
        }
    }
}
