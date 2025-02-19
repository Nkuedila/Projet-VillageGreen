<?php

namespace App\Security\Voter;

use App\Entity\Users;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UsersVoter extends Voter
{
    public const ADD = 'user_add';
    public const EDIT = 'user_edit';
    public const DELETE = 'user_delete';

    private Security $security;
    private LoggerInterface $logger;

    public function __construct(Security $security, LoggerInterface $logger)
    {
        $this->security = $security;
        $this->logger = $logger;
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::ADD, self::EDIT, self::DELETE], true) && $subject instanceof Users;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof Users) {
            $this->logger->warning("Access denied: Anonymous user tried to {$attribute} a user.");
            return false;
        }

        $this->logger->info("Checking {$attribute} permission for user {$user->getEmail()}");

        if ($this->security->isGranted('ROLE_ADMIN')) {
            $this->logger->info("Access granted: ROLE_ADMIN can {$attribute}.");
            return true;
        }

        if ($this->security->isGranted('ROLE_CLIENT_PARTICULIER')) {
            if (in_array($attribute, [self::EDIT], true) && !$subject->getNumeroSiret()) {
                $this->logger->info("Access granted: ROLE_CLIENT_PARTICULIER can {$attribute} a user without numeroSiret.");
                return true;
            }
            $this->logger->warning("Access denied: ROLE_CLIENT_PARTICULIER tried to {$attribute} a user with numeroSiret.");
            return false;
        }

        if ($this->security->isGranted('ROLE_CLIENT_PROFESSIONEL')) {
            if (in_array($attribute, [self::ADD, self::EDIT], true) && $subject->getNumeroSiret()) {
                $this->logger->info("Access granted: ROLE_CLIENT_PROFESSIONEL can {$attribute} a user with numeroSiret.");
                return true;
            }
            $this->logger->warning("Access denied: ROLE_CLIENT_PROFESSIONEL tried to {$attribute} a user without numeroSiret.");
            return false;
        }

        $this->logger->warning("Access denied: User {$user->getEmail()} does not have permission to {$attribute}.");
        return false;
    }
}
