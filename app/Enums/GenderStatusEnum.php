<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GenderStatusEnum extends Enum
{
    const MALE = 'nam';
    const FEMALE = 'nữ';
    const UNKNOWN = 'không xác định';
}
