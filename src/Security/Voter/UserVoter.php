<?php

namespace App\Security\Voter;

use App\Entity\Decision;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{
    const VIEW = 'view';
    const DELETE = 'delete';
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::VIEW,self::DELETE])
            && $subject instanceof \App\Entity\Decision;
    }

    /**
     * @param string $attribute
     * @param Decision $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof User) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        /**
         * @var Decision $decision
         */
        $decision = $subject;
        switch ($attribute) {
            case self::VIEW:
                return $user === $decision->getUser();
                break;

        }
          //throw new \LogicException('accès interdit .....');
        return false;
    }
    /*
    private function canView(Decision $decision,User $user){
        if($this->canView($decision,$user)){
            return true;
        }
        return $decision->getContent();
    }
    */
}
