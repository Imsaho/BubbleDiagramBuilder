<?php

namespace BubbleDiagramBundle\Security;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use BubbleDiagramBundle\Entity\Building;
use BubbleDiagramBundle\Entity\User;

class BuildingVoter implements VoterInterface {

    const VIEW = 'view';
    const EDIT = 'edit';

    //const DELETE = 'delete';

    public function supportsAttribute($attribute) {
        return (!in_array($attribute, array(
                    self::VIEW,
                    self::EDIT)));
    }

    public function supportsClass($class) {
        $supportedClass = 'BubbleDiagramBundle\Entity\Building';
        return $supportedClass === $class || is_subclass_of($class, $supportedClass);
    }

    public function vote(TokenInterface $token, $building, array $attributes) {

        if (!$this->supportsClass(get_class($building))) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        if (1 !== count($attributes)) {
            throw new \InvalidArgumentException(
            "Only one argument is allowed for VIEW or EDIT"
            );
        }

        $attribute = $attributes[0];

        if (!$this->supportsAttribute($attribute)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        $user = $token->getUser();

        if (!$user instanceof User) {
            return VoterInterface::ACCESS_DENIED;
        }

        switch ($attribute) {
            case self::VIEW:
                if (canEdit($building, $user)) {
                    return VoterInterface::ACCESS_GRANTED;
                }
                break;
            case self::EDIT:
                if (canEdit($building, $user)) {
                    return VoterInterface::ACCESS_GRANTED;
                }
                break;
        }
        return VoterInterface::ACCESS_DENIED;
    }

//    protected function voteOnAttribute($attribute, $subject, TokenInterface $token) {
//        $user = $token->getUser();
//        if (!$user instanceof User) {
//            return false;
//        }
//
//        $building = $subject;
//
//        switch ($attribute) {
//            case self::VIEW:
//                return $this->canView($building, $user);
//            case self::EDIT:
//                return $this->canEdit($building, $user);
//        }
//        throw new \LogicException("This statement should not be reached!");
//    }
//
//    private function canView(Building $building, User $user) {
//        if ($this->canEdit($building, $user)) {
//            return true;
//        }
//    }
//
    private function canEdit(Building $building, User $user) {
        $userCollection = $building->getTeam()->getUsers();
        $users = $userCollection->map(function($entity) {
                    return $entity;
                })->toArray();
        return in_array($user, $users);
    }

}