<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExaminationType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('examinations_type')->insert([
            'name' => 'Crâne face (Nez front plaque)',
            'code' => 'CF_NFP',
            'z_coefficient' => 10,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Crâne face/profil',
            'code' => 'CFP',
            'z_coefficient' => 12,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Blondeau (les sinus de la face)',
            'code' => 'B_SF',
            'z_coefficient' => 10,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Hirtz',
            'code' => 'H',
            'z_coefficient' => 12,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Crâne face basse',
            'code' => 'CFB',
            'z_coefficient' => 12,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Crâne face haute',
            'code' => 'CFH',
            'z_coefficient' => 12,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Worms',
            'code' => 'W',
            'z_coefficient' => 12,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Schuller D et G (bouche fermée + bouche ouverte)',
            'code' => 'SDG_BFBO',
            'z_coefficient' => 24,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Stenvers D et G',
            'code' => 'SDG',
            'z_coefficient' => 12,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Chaussée III',
            'code' => 'CIII',
            'z_coefficient' => 15,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Selle turcique profil (hypophyse)',
            'code' => 'STP_H',
            'z_coefficient' => 8,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Selle turcique face/profil (hypophyse)',
            'code' => 'STFP_H',
            'z_coefficient' => 12,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Cavum',
            'code' => 'C',
            'z_coefficient' => 10,
            'examination_group_id' => 1,
        ]);


        DB::table('examinations_type')->insert([
            'name' => 'Larynx face/profil',
            'code' => 'LFP',
            'z_coefficient' => 10,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Os propre du nez (OPN) profil',
            'code' => 'OPNP',
            'z_coefficient' => 10,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Os propre du nez (OPN) face /profil',
            'code' => 'OPNFP',
            'z_coefficient' => 15,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Orbites D et G (recherche de corps étrangers intraoculaire)',
            'code' => 'ODG_RCEI',
            'z_coefficient' => 12,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Maxillaire défilé droit et gauche',
            'code' => 'MDDG',
            'z_coefficient' => 16,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Articulation temporo-maxillaire (ATM) D et G (bouche ouverte puis bouche fermée)',
            'code' => 'ATDG_BOPF',
            'z_coefficient' => 16,
            'examination_group_id' => 1,
        ]);


        DB::table('examinations_type')->insert([
            'name' => 'Recherche d’apophyse styloïde : incidence face basse+menton dégagé D et G',
            'code' => 'RASIFBMDDG',
            'z_coefficient' => 24,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Télémandibule',
            'code' => 'T',
            'z_coefficient' => 8,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Fente sphénoïdale/coté',
            'code' => 'FSC',
            'z_coefficient' => 12,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Corps étrangers oculaires',
            'code' => 'CEO',
            'z_coefficient' => 15,
            'examination_group_id' => 1,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Poumons face',
            'code' => 'PF',
            'z_coefficient' => 10,
            'examination_group_id' => 2,
        ]);


        DB::table('examinations_type')->insert([
            'name' => 'Poumons face/profil',
            'code' => 'PFP',
            'z_coefficient' => 15,
            'examination_group_id' => 2,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Cœur ou télécœur face/profil',
            'code' => 'CTFP',
            'z_coefficient' => 15,
            'examination_group_id' => 2,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Cœur oblique',
            'code' => 'CO',
            'z_coefficient' => 25,
            'examination_group_id' => 2,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Sternum face/profil',
            'code' => 'SFP',
            'z_coefficient' => 15,
            'examination_group_id' => 2,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Articulation sterno claviculaire',
            'code' => 'ASC',
            'z_coefficient' => 12,
            'examination_group_id' => 2,
        ]);


        DB::table('examinations_type')->insert([
            'name' => 'Thorax osseux ou Gril Costal face',
            'code' => 'TOGCF',
            'z_coefficient' => 12,
            'examination_group_id' => 2,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Thorax osseux ou Gril Costal face/profil',
            'code' => 'TOFCFP',
            'z_coefficient' => 15,
            'examination_group_id' => 2,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Rachis cervical face',
            'code' => 'RCF',
            'z_coefficient' => 8,
            'examination_group_id' => 3,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Rachis cervical face/profil',
            'code' => 'RCFP',
            'z_coefficient' => 12,
            'examination_group_id' => 3,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Rachis cervical F/P ¾ D et G',
            'code' => 'RCFPDG',
            'z_coefficient' => 24,
            'examination_group_id' => 3,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Rachis dorsal face',
            'code' => 'RDF',
            'z_coefficient' => 10,
            'examination_group_id' => 3,
        ]);


        DB::table('examinations_type')->insert([
            'name' => 'Rachis dorsal face/profil',
            'code' => 'RDFP',
            'z_coefficient' => 15,
            'examination_group_id' => 3,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Rachis dorsal F/P ¾ D et G',
            'code' => 'RDFPDG',
            'z_coefficient' => 30,
            'examination_group_id' => 3,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Rachis lombaire F/P',
            'code' => 'RLFP',
            'z_coefficient' => 15,
            'examination_group_id' => 3,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Rachis lombaire F/P ¾ D et G',
            'code' => 'RLFPDG',
            'z_coefficient' => 30,
            'examination_group_id' => 3,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Rachis lombaire F/P + flexion/extension (étude dynamique)',
            'code' => 'RLFPFE_ED',
            'z_coefficient' => 30,
            'examination_group_id' => 3,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Rachis lombaire incidence localisée L5-S1 face',
            'code' => 'RLILLSF',
            'z_coefficient' => 10,
            'examination_group_id' => 3,
        ]);


        DB::table('examinations_type')->insert([
            'name' => 'Rachis lombaire incidence localisée L5-S1 F/P',
            'code' => 'RLILLSFP',
            'z_coefficient' => 15,
            'examination_group_id' => 3,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Rachis dorso-lombaire F/P',
            'code' => 'RDLFP',
            'z_coefficient' => 30,
            'examination_group_id' => 3,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Rachis dorso-lombaire F/P (recherche de scoliose) : rachis entier',
            'code' => 'RDLFP_RS',
            'z_coefficient' => 54,
            'examination_group_id' => 3,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Épaule face',
            'code' => 'EF',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Épaule F/P',
            'code' => 'EFP',
            'z_coefficient' => 12,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Épaule F/P + cliché comparatif',
            'code' => 'EFPCC',
            'z_coefficient' => 24,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Épaule face, 3 incidences ( F+RI+RE )',
            'code' => 'EP3I',
            'z_coefficient' => 24,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Omoplate face',
            'code' => 'OF',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Omoplate F/P',
            'code' => 'OFP',
            'z_coefficient' => 12,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => '1 Clavicule face',
            'code' => '1CF',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => '2 Clavicules face',
            'code' => '2CF',
            'z_coefficient' => 15,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Bras (Humérus) F/P',
            'code' => 'BFP_H',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Coude F/P',
            'code' => 'COFP',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Avant-bras F/P',
            'code' => 'ABFP',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Poignet F/P',
            'code' => 'POFP',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Main F/P',
            'code' => 'MFP',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Doigt F/P',
            'code' => 'DFP',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Scaphoïde',
            'code' => 'S',
            'z_coefficient' => 10,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Age osseux',
            'code' => 'AO',
            'z_coefficient' => 15,
            'examination_group_id' => 4,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Bassin face',
            'code' => 'BF',
            'z_coefficient' => 12,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Bassin face + ¾ D ou G ( F/P )',
            'code' => 'BFDG_FP',
            'z_coefficient' => 15,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Bassin face + ¾ D et G',
            'code' => 'BFDG',
            'z_coefficient' => 20,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Bassin + ¾ alaire + ¾ obturateur',
            'code' => 'BAO',
            'z_coefficient' => 20,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Hanche face',
            'code' => 'HF',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);


        DB::table('examinations_type')->insert([
            'name' => 'Hanche face + ¾ D ou G (F/P)',
            'code' => 'HFDG_FP',
            'z_coefficient' => 15,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Hanche face + ¾ D et G',
            'code' => 'HFDG',
            'z_coefficient' => 20,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Articulation sacro-iliaque face',
            'code' => 'ASIF',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Coccyx F/P',
            'code' => 'COCFP',
            'z_coefficient' => 15,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Sacrum F/P',
            'code' => 'SAFP',
            'z_coefficient' => 15,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Cuisse (fémur) F/P',
            'code' => 'CFFP',
            'z_coefficient' => 12,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Genou F/P',
            'code' => 'GFP',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Jambe F/P',
            'code' => 'JFP',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Cheville F/P',
            'code' => 'CHFP',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Orteil F/P',
            'code' => 'ORFP',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Pied F/P',
            'code' => 'PIFP',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);


        DB::table('examinations_type')->insert([
            'name' => 'Pied F/ ¾ (orteils)',
            'code' => 'PFO',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Pied en charge',
            'code' => 'PC',
            'z_coefficient' => 14,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Calcanéum F/P',
            'code' => 'CAFP',
            'z_coefficient' => 10,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Pied bot en charge D et G F/P',
            'code' => 'PBCDGFP',
            'z_coefficient' => 20,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Défilé femoro patellaire / angle',
            'code' => 'DFPA',
            'z_coefficient' => 6,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Pangonogramme (Enfant de 0 à 2 ans)',
            'code' => 'PAN',
            'z_coefficient' => 33,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'ASP face',
            'code' => 'ASPF',
            'z_coefficient' => 10,
            'examination_group_id' => 6,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'ASP F/P',
            'code' => 'ASP_FP',
            'z_coefficient' => 15,
            'examination_group_id' => 6,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'T.O',
            'code' => 'TO',
            'z_coefficient' => 30,
            'examination_group_id' => 6,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'T.G.D',
            'code' => 'TGD',
            'z_coefficient' => 35,
            'examination_group_id' => 6,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'T.O.G.D',
            'code' => 'TOGD',
            'z_coefficient' => 65,
            'examination_group_id' => 6,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Lavement baryté',
            'code' => 'LB',
            'z_coefficient' => 40,
            'examination_group_id' => 6,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Lavement baryté double contraste',
            'code' => 'LBDC',
            'z_coefficient' => 60,
            'examination_group_id' => 6,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Transit du grêle',
            'code' => 'TG',
            'z_coefficient' => 45,
            'examination_group_id' => 6,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'U.I.V',
            'code' => 'UIV',
            'z_coefficient' => 50,
            'examination_group_id' => 7,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'U.C.R',
            'code' => 'UCR',
            'z_coefficient' => 45,
            'examination_group_id' => 7,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'U.C.R + UCAM',
            'code' => 'UCRUCAM',
            'z_coefficient' => 60,
            'examination_group_id' => 7,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Mammographie',
            'code' => 'MAMMO',
            'z_coefficient' => 30,
            'examination_group_id' => 8,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Galactographie 1 sein',
            'code' => 'G1S',
            'z_coefficient' => 35,
            'examination_group_id' => 8,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Galactographie 2 seins',
            'code' => 'G2S',
            'z_coefficient' => 45,
            'examination_group_id' => 8,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'H.S.G',
            'code' => 'HSG',
            'z_coefficient' => 35,
            'examination_group_id' => 8,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Contenu utérin',
            'code' => 'CU',
            'z_coefficient' => 15,
            'examination_group_id' => 8,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Radiopelvimétrie',
            'code' => 'RP',
            'z_coefficient' => 30,
            'examination_group_id' => 8,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Fistulographie',
            'code' => 'FISTULO',
            'z_coefficient' => 30,
            'examination_group_id' => 9,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Artrographie',
            'code' => 'ARTRO',
            'z_coefficient' => 40,
            'examination_group_id' => 9,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Sacco radiculographie',
            'code' => 'SR',
            'z_coefficient' => 55,
            'examination_group_id' => 9,
        ]);
    }
}
