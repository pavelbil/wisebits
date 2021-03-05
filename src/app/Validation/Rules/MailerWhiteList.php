<?php

namespace App\Validation\Rules;

use App\Repositories\WhiteListRepository;
use Respect\Validation\Rules\AbstractRule;

/**
 * Class MailerWhiteList
 * @package App\Validation\Rules
 */
class MailerWhiteList extends AbstractRule
{

    /**
     * @var WhiteListRepository
     */
    private WhiteListRepository $repository;

    /**
     * MailerWhiteList constructor.
     * @param WhiteListRepository $repository
     */
    public function __construct(WhiteListRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param mixed $input
     * @return bool
     */
    public function validate($input): bool
    {
        $mailer = $this->getMailerByEmail($input);
        return $this->repository->isExist($mailer);
    }

    /**
     * @param $email
     * @return string
     */
    public function getMailerByEmail($email): string
    {
        return substr($email, strrpos($email, '@'));
    }
}