<?php

namespace BhaktijKoli\LaravelDialogflow\Traits;

use BhaktijKoli\LaravelDialogflow\EntityTypeHelper;
use Google\Cloud\Dialogflow\V2\EntityType\Entity;

trait HasDialogFlowEntity
{
    /**
     * Get Entity Value
     *
     * @return string
     */
    public function entityValue(): string
    {
        return $this->name;
    }

    /**
     * Sync Values with DialogFlow Entity
     *
     * @return void
     */
    public static function sync()
    {
        $name = explode('\\', get_class())[count(explode('\\', get_class())) - 1];
        $entites =  [];
        foreach (Self::all() as $m) {
            $entites[] = new Entity([
                'value' => $m->entityValue()
            ]);
        }
        EntityTypeHelper::update($name, $entites);
    }

    /**
     * Eloquent Boot Event
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        Self::saved(function ($model) {
            Self::sync();
        });
        Self::updated(function ($model) {
            Self::sync();
        });
        Self::deleted(function ($model) {
            Self::sync();
        });
    }
}
