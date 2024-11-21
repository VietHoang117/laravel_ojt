<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AttendanceStatusEnum extends Enum
{
    const VALID = 'Hợp lệ';
    const INVALID = 'Không hợp lệ';
}
