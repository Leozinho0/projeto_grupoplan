<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class BaseModelObserver
{
    public function creating($model)
    {
        if (Schema::hasColumn($model->getTable(), 'uuid') && ! $model->uuid) {
            $model->uuid = (string) Str::uuid();
        }

        if (Auth::check() && Schema::hasColumn($model->getTable(), 'created_by') && ! $model->created_by) {
            $model->created_by = Auth::user()->id;
            $model->updated_by = Auth::user()->id;
        }
    }

    public function updating($model)
    {
        if (Auth::check() && Schema::hasColumn($model->getTable(), 'updated_by')) {
            $model->updated_by = Auth::user()->id;
        }
    }

    public function deleting($model)
    {
        if (Auth::check() && Schema::hasColumn($model->getTable(), 'deleted_by')) {
            $model->deleted_by = Auth::user()->id;
            $model->save();
        }
    }
}
