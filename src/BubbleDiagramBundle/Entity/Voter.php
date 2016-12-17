<?php

namespace BubbleDiagramBundle\Entity;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

abstract class Voter implements VoterInterface {
    
    abstract protected function supports($attribute, $subject);
    abstract protected function voteOnAttribute($attribute, $subject, TokenInterface $token);
    
}

