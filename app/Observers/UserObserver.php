<?php

namespace App\Observers;

use App\Models\AlternatifKriteria;
use App\Models\LabelKriteria;
use App\Models\User;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Bobots;
use App\Models\Normalisasi;
use App\Models\Preferensi;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {   
        $alternatifs = ['hakn', 'dikcy win', 'Daffa', 'Siti', 'Rahma Dewi', 'Rizqi Riddho'];
        $createdAlternatifs = [];
        foreach ($alternatifs as $value) {
            $createdAlternatifs[] = Alternatif::create([
                'a' => $value,
                'user_id' => $user->id,
            ]);
        }

        $krs = [
            ['kategori' => 1, 'c1' => 5, 'c2' => 4, 'c3' => 4, 'c4' => 4, 'c5' => 4],
            ['kategori' => 1, 'c1' => 4, 'c2' => 5, 'c3' => 4, 'c4' => 4, 'c5' => 4],
            ['kategori' => 1, 'c1' => 4, 'c2' => 3, 'c3' => 4, 'c4' => 4, 'c5' => 3],
            ['kategori' => 1, 'c1' => 4, 'c2' => 3, 'c3' => 3, 'c4' => 4, 'c5' => 3],
            ['kategori' => 1, 'c1' => 3, 'c2' => 3, 'c3' => 4, 'c4' => 3, 'c5' => 3],
            ['kategori' => 1, 'c1' => 3, 'c2' => 3, 'c3' => 3, 'c4' => 4, 'c5' => 4],
            ['kategori' => 1, 'c1' => 4, 'c2' => 3, 'c3' => 4, 'c4' => 4, 'c5' => 3],
            ['kategori' => 1, 'c1' => 4, 'c2' => 3, 'c3' => 3, 'c4' => 4, 'c5' => 3],
            ['kategori' => 1, 'c1' => 3, 'c2' => 3, 'c3' => 4, 'c4' => 3, 'c5' => 3],
            ['kategori' => 1, 'c1' => 3, 'c2' => 3, 'c3' => 3, 'c4' => 4, 'c5' => 4],
        ];

        $createdKriterias = [];
        foreach ($createdAlternatifs as $index => $alternatif) {
            $createdKriterias[] = Kriteria::create([
                'user_id' => $user->id,
                'alt_id' => $alternatif->id,
                'kategori' => $krs[$index]['kategori'],
                'c1' => $krs[$index]['c1'],
                'c2' => $krs[$index]['c2'],
                'c3' => $krs[$index]['c3'],
                'c4' => $krs[$index]['c4'],
                'c5' => $krs[$index]['c5'],
            ]);
        }

        Bobots::create([
            'b1' => 25,
            'b2' => 10,
            'b3' => 20,
            'b4' => 20,
            'b5' => 25,
            'user_id' => $user->id,
        ]);

        $norms = [
            ['c1' => 1, 'c2' => 0.8, 'c3' => 1, 'c4' => 1, 'c5' => 1],
            ['c1' => 0.8, 'c2' => 1, 'c3' => 1, 'c4' => 1, 'c5' => 1],
            ['c1' => 0.8, 'c2' => 0.6, 'c3' => 1, 'c4' => 1, 'c5' => 0.75],
            ['c1' => 0.8, 'c2' => 0.6, 'c3' => 0.75, 'c4' => 1, 'c5' => 0.75],
            ['c1' => 0.6, 'c2' => 0.6, 'c3' => 1, 'c4' => 0.75, 'c5' => 0.75],
            ['c1' => 0.6, 'c2' => 0.6, 'c3' => 0.75, 'c4' => 1, 'c5' => 1],
            ['c1' => 0.8, 'c2' => 0.6, 'c3' => 1, 'c4' => 1, 'c5' => 0.75],
            ['c1' => 0.8, 'c2' => 0.6, 'c3' => 0.75, 'c4' => 1, 'c5' => 0.75],
            ['c1' => 0.6, 'c2' => 0.6, 'c3' => 1, 'c4' => 0.75, 'c5' => 0.75],
            ['c1' => 0.6, 'c2' => 0.6, 'c3' => 0.75, 'c4' => 1, 'c5' => 1],
        ];

        foreach ($createdKriterias as $index => $kriteria) {
            Normalisasi::create([
                'kr_id' => $kriteria->id,
                'c1' => $norms[$index]['c1'],
                'c2' => $norms[$index]['c2'],
                'c3' => $norms[$index]['c3'],
                'c4' => $norms[$index]['c4'],
                'c5' => $norms[$index]['c5'],
                'user_id' => $user->id,
            ]);
        }

        foreach ($createdKriterias as $index => $kriteria) {
            Preferensi::create([
                'kr_id' => $kriteria->id,
                'user_id' => $user->id,
            ]);
        }
        
        

        // $alter = ALternatif::class();
        // $kri = Kriteria::class();

        // AlternatifKriteria::create([
        //     'alternatif_id' => $alter->id,
        //     'kriteria_id' => $kri->id,
        // ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
