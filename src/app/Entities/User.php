<?php
declare(strict_types=1);

namespace App\Entities;

use DateTime;
use Exception;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private DateTime $created;
    private ?DateTime $deleted;
    private string $notes;

    /**
     * User constructor.
     * @param int $id
     * @param string $name
     * @param string $email
     * @param DateTime $created
     * @param DateTime|null $deleted
     * @param string $notes
     */
    public function __construct(int $id, string $name, string $email, DateTime $created, ?DateTime $deleted, string $notes)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->created = $created;
        $this->deleted = $deleted;
        $this->notes = $notes;
    }

    /**
     * @param array $state
     * @return User
     * @throws Exception
     */
    public static function fromState(array $state): User
    {
        return new self(
            intval($state['id']),
            $state['name'],
            $state['email'],
            new DateTime($state['created']),
            $state['deleted'] ? new DateTime($state['deleted']) : null,
            $state['notes']
        );
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * @param DateTime $created
     */
    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }

    /**
     * @return DateTime
     */
    public function getDeleted(): DateTime
    {
        return $this->deleted;
    }

    /**
     * @param DateTime $deleted
     */
    public function setDeleted(DateTime $deleted): void
    {
        $this->deleted = $deleted;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }
}