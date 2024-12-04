<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class LeaveStatusEnum extends Enum
{
    const DRAFT = 'Nháp';
    const SEND = 'Gửi';
    const REFUSE = 'Từ chối';
    const ACCEPT = 'Chấp Nhận';
}
