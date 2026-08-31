<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class SchoolSetting extends Model
{
    private const CURRENT_BINDING = 'school-setting.current';

    public const DEFAULT_SCHOOL_NAME = 'SIT DARUL FIKRI MAKASSAR';

    /** Short variant for very narrow viewports if needed. */
    public const DEFAULT_SCHOOL_NAME_SHORT = 'SIT DARUL FIKRI MKS';

    protected $fillable = [
        'school_name',
        'logo',
        'phone',
        'address',
        'email',
        'whatsapp_number',
        'maps_embed_url',
        'instagram_url',
        'facebook_url',
        'youtube_url',
    ];

    /**
     * Always return a displayable name — falls back to the canonical default
     * so the hero pill, footer, and <title> never render empty when the admin
     * hasn't saved settings yet.
     */
    protected function schoolName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value !== null && trim($value) !== '' ? $value : self::DEFAULT_SCHOOL_NAME,
        );
    }

    /**
     * Memoized per request/test via the container (not a static property),
     * so it can't leak stale data across HTTP requests or PHPUnit tests
     * sharing the same PHP process.
     */
    public static function current(): self
    {
        if (app()->bound(self::CURRENT_BINDING)) {
            return app(self::CURRENT_BINDING);
        }

        $instance = static::firstOrCreate(['id' => 1]);
        app()->instance(self::CURRENT_BINDING, $instance);

        return $instance;
    }
}
