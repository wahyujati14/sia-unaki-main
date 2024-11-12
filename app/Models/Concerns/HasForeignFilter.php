<?php

namespace App\Models\Concerns;

trait HasForeignFilter {
    public function scopeOfForeignId($query, $column, $id = null) {
        $query->when($id, function($query) use ($column, $id) {
            $query->where($column, $id);
        });
    }
}