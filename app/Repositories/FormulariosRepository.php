<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class FormulariosRepository
{
    public function tabela(): array
    {
        return DB::connection('mysql_wp')
            ->table('wp_wpforms_entries as wpf')
            ->leftJoin('wp_terreno_entries as wpt', 'wpt.entry_id', '=', 'wpf.entry_id')
            ->select(
                'wpf.entry_id',
                'wpf.form_id',
                'wpf.fields',
                'wpf.date',
                'wpt.terreno_id'
            )
            ->where('wpf.form_id', 1916)
            ->orderByDesc('wpf.date')
            ->get()
            ->toArray();
    }
}
