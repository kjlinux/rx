<?php

use App\Models\ExaminationType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $avantBras = ExaminationType::where('code', 'like', '%ABFP%')->first();
        $avantBras->forceFill(['z_coefficient' => 20])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Avant-bras Gauche F/P',
            'code' => 'ABFPG',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Avant-bras Droit F/P',
            'code' => 'ABFPD',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        $bras = ExaminationType::where('code', 'like', '%BFP_H%')->first();
        $bras->forceFill(['z_coefficient' => 20])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Bras (Humérus) Gauche F/P',
            'code' => 'BFP_HG',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Bras (Humérus) Droit F/P',
            'code' => 'BFP_HD',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        $cheville = ExaminationType::where('code', 'like', '%CHFP%')->first();
        $cheville->forceFill(['name' => 'Chevilles', 'z_coefficient' => 20])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Cheville Gauche F/P',
            'code' => 'CHFPG',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Cheville Droite F/P',
            'code' => 'CHFPD',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        $cuisse = ExaminationType::where('code', 'like', '%CFFP%')->first();
        $cuisse->forceFill(['name' => 'Cuisses', 'z_coefficient' => 24])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Cuisse Gauche (fémur) F/P',
            'code' => 'CFFPG',
            'z_coefficient' => 12,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Cuisse Droite (fémur) F/P',
            'code' => 'CFFPD',
            'z_coefficient' => 12,
            'examination_group_id' => 5,
        ]);

        $epauleFace = ExaminationType::where('code', 'like', '%EF%')->first();
        $epauleFace->forceFill(['name' => 'Épaules face', 'z_coefficient' => 20])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Épaule Gauche face',
            'code' => 'EFG',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Épaule Droite face',
            'code' => 'EFD',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        $epauleFp = ExaminationType::where('code', 'like', '%EFP%')->first();
        $epauleFp->forceFill(['name' => 'Épaules F/P', 'z_coefficient' => 24])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Épaule Gauche F/P',
            'code' => 'EFPG',
            'z_coefficient' => 12,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Épaule Droite F/P',
            'code' => 'EFPD',
            'z_coefficient' => 12,
            'examination_group_id' => 4,
        ]);

        $epauleFpCC = ExaminationType::where('code', 'like', '%EFPCC%')->first();
        $epauleFpCC->forceFill(['name' => 'Épaules F/P + cliché comparatif', 'z_coefficient' => 48])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Épaule Gauche F/P + cliché comparatif',
            'code' => 'EFPCCG',
            'z_coefficient' => 24,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Épaule Droite F/P + cliché comparatif',
            'code' => 'EFPCCD',
            'z_coefficient' => 24,
            'examination_group_id' => 4,
        ]);

        $epauleF3 = ExaminationType::where('code', 'like', '%EP3I%')->first();
        $epauleF3->forceFill(['name' => 'Épaules face, 3 incidences ( F+RI+RE )', 'z_coefficient' => 48])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Épaule Gauche face, 3 incidences ( F+RI+RE )',
            'code' => 'EP3IG',
            'z_coefficient' => 24,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Épaule Droite face, 3 incidences ( F+RI+RE )',
            'code' => 'EP3ID',
            'z_coefficient' => 24,
            'examination_group_id' => 4,
        ]);

        $genou = ExaminationType::where('code', 'like', '%GFP%')->first();
        $genou->forceFill(['name' => 'Genoux F/P', 'z_coefficient' => 20])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Genou Gauche F/P',
            'code' => 'GFPG',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Genou Droit F/P',
            'code' => 'GFPD',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        $jambe = ExaminationType::where('code', 'like', '%JFP%')->first();
        $jambe->forceFill(['name' => 'Jambes F/P', 'z_coefficient' => 20])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Jambe Gauche F/P',
            'code' => 'JFPG',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Jambe Droite F/P',
            'code' => 'JFPD',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        $main = ExaminationType::where('code', 'like', '%MFP%')->first();
        $main->forceFill(['name' => 'Mains F/P', 'z_coefficient' => 20])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Main Gauche F/P',
            'code' => 'MFPG',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Main Droite F/P',
            'code' => 'MFPD',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        $omoplateFace = ExaminationType::where('code', 'like', '%OF%')->first();
        $omoplateFace->forceFill(['name' => 'Omoplates face', 'z_coefficient' => 20])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Omoplate Gauche face',
            'code' => 'OFG',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Omoplate Droite face',
            'code' => 'OFD',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        $omoplateFp = ExaminationType::where('code', 'like', '%OFP%')->first();
        $omoplateFp->forceFill(['name' => 'Omoplates F/P', 'z_coefficient' => 24])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Omoplate Gauche F/P',
            'code' => 'OFPG',
            'z_coefficient' => 12,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Omoplate Droite F/P',
            'code' => 'OFPD',
            'z_coefficient' => 12,
            'examination_group_id' => 4,
        ]);

        $piedOrteils = ExaminationType::where('code', 'like', '%PFO%')->first();
        $piedOrteils->forceFill(['name' => 'Pieds F/ ¾ (orteils)', 'z_coefficient' => 20])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Pied Gauche F/ ¾ (orteils)',
            'code' => 'PFOG',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Pied Droit F/ ¾ (orteils)',
            'code' => 'PFOD',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        $pied = ExaminationType::where('code', 'like', '%PIFP%')->first();
        $pied->forceFill(['name' => 'Pieds F/P', 'z_coefficient' => 20])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Pied Gauche F/P',
            'code' => 'PIFPG',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Pied Droit F/P',
            'code' => 'PIFPD',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        $piedCharge = ExaminationType::where('code', '=', 'PC')->first();
        $piedCharge->forceFill(['name' => 'Pieds en charge', 'z_coefficient' => 28])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Pied Gauche en charge',
            'code' => 'PCG',
            'z_coefficient' => 14,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Pied Droit en charge',
            'code' => 'PCD',
            'z_coefficient' => 14,
            'examination_group_id' => 5,
        ]);

        $poignet = ExaminationType::where('code', 'like', '%POFP%')->first();
        $poignet->forceFill(['name' => 'Poignets F/P', 'z_coefficient' => 20])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Poignet Gauche F/P',
            'code' => 'POFPG',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Poignet Droit F/P',
            'code' => 'POFPD',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        $orteil = ExaminationType::where('code', 'like', '%ORFP%')->first();
        $orteil->forceFill(['name' => 'Orteils F/P', 'z_coefficient' => 20])->save();

        DB::table('examinations_type')->insert([
            'name' => 'Orteil Gauche F/P',
            'code' => 'ORFPG',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Orteil Droit F/P',
            'code' => 'ORFPD',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
