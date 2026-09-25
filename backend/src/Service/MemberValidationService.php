<?php

namespace App\Service;

use App\Entity\Member;
use App\Repository\MemberRepository;

class MemberValidationService
{
    private $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function validate(Member $member): bool {
        return false;
    }

    public function exists(Member $member) : bool {
        return false;
    }
}