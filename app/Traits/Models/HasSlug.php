<?php

namespace App\Traits\Models;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function ($item) {
            $from = $item->slugFrom();
            $base = str($item->{$from} ?? '')->slug()->toString();

            // если вдруг title пустой
            if (blank($base)) {
                $base = 'item';
            }

            $slug = $base;
            $i = 2;

            while ($item->newQuery()->where('slug', $slug)->exists()) {
                $slug = "{$base}-{$i}";
                $i++;
            }

            $item->slug = $slug;
        });
    }

    public function slugFrom(): string
    {
        return 'title';
    }
}
