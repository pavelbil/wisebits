<?php
declare(strict_types=1);

namespace App\Entities;

use DateTime;
use Exception;

class User
{
    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?DateTime $created;
    private ?DateTime $deleted;
    private ?string $notes;

    /**
     * User constructor.
     * @param int|null $id
     * @param string|null $name
     * @param string|null $email
     * @param DateTime|null $created
     * @param DateTime|null $deleted
     * @param string|null $notes
     */
    public function __construct(int $id = null, string $name = null, string $email = null, DateTime $created = null, ?DateTime $deleted = null, string $notes = null)
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
     * @return int|null
     */
    public function getId(): ?int
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
     * @return DateTime
     */
    public function getDeleted(): DateTime
    {
        return $this->deleted;
    }

    /**
     * @return string|null
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * @param string|null $notes
     */
    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    }
}