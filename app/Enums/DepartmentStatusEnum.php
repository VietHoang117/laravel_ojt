<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DepartmentStatusEnum extends Enum
{
    const DEACTIVATED = 'deactivated';
    const ACTIVATED = 'activated';

    public static function labels()
    {
        return [
            self::DEACTIVATED => __('Hủy kích hoạt'),
            self::ACTIVATED => __('Kích hoạt')
        ];
    }

}
