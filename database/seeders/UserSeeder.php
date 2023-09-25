<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sexos = ['Masculino', 'Femenino'];
        $genPa = env('sap_gen');


        $superadmin = User::create([
            'name'              => 'Superadmin',
            'email'             => 'superadminDemco@superadmin.com',
            'password'          => bcrypt($genPa.'super0.+-*'.$genPa),
            // 'password'          => bcrypt('superadmin0+-*/'),
            'email_verified_at' => date('Y-m-d H:i'),
            'sexo' => $sexos[rand(0, 1)],
            'identificacion' => '11232454',
            'celular' => '11232454',

        ]);
        $superadmin->assignRole('superadmin');

        $nombreAdmin = 'Admin';
        $App = env('APP_NAME');
        $admin = User::create([
            'name'              => "$nombreAdmin $App",
            'email'             => "$nombreAdmin$App"."@gmail.com", //Admindemco@gmail.com
            'password'          => bcrypt($genPa.'0.+-*'.$genPa),  //123_demco0.+-*123_demco
            'email_verified_at' => date('Y-m-d H:i'),
            'sexo' => $sexos[rand(0, 1)],
            'identificacion' => '11232411',
            'celular' => '11232454',
        ]);
        $admin->assignRole('admin');

        $trabajador = User::create([
            'name'              => 'trabajador',
            'email'             => 'trabajador@trabajador.com',
            'password'          => bcrypt('trabajador00+*'),
            'email_verified_at' => date('Y-m-d H:i'),
            'sexo' => $sexos[rand(0, 1)],
            'identificacion' => '11232412',
            'celular' => '11232454',
        ]);
        $trabajador->assignRole('trabajador');

        $nombresGenericos = [
            'jose' => '1152888999',
            'Emerson' => '333444667',
        ];

        $genero = 'Masculino';
        // $genero = 'Femenino';
        foreach ($nombresGenericos as $key => $value) {
            $yearRandom = (rand(15, 39));
            $anios = Carbon::now()->subYears($yearRandom)->format('Y-m-d H:i');
            $unUsuario = User::create([
                'name'              => $key,
                'email'             => $key . '@' . $key . '.com',
                'password'          => bcrypt($genPa.'asd+-*'),
                'email_verified_at' => date('Y-m-d H:i'),
                'identificacion' => $value,
                'celular' => '123456',


                'fecha_nacimiento' => $anios,
                'sexo' => $genero,
            ]);
            
            if($genero)
                $unUsuario->assignRole('trabajador');
            else
                $unUsuario->assignRole('supervisor');
            
            $genero++;
        }

        // 'CORTE', //1
        // 'DOBLEZ', //2
        // 'SOLDADURA', //3
        // 'PULIDA', //4
        // 'ENSAMBLE', //5
        // 'COBRE', //6
        // 'CABLEADO', //7
        // 'INGENIERIA MECANICA', //8
        // 'INGENIERIA ELECTRICA' //9

        
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1117534477'.'*'),  'area' => 'INGENIERIA', 'cargo'=> 'AUXILIAR DE INGENIERIA',                        'name' => 'LUIS MIGUEL CARDENAS ORTIZ', 'identificacion'=> '1117534477', 'email'=> 'luismcartiz@gmail.com', 'celular' => '3013489695', 'centrotrabajo_id' => 8 ]); $tempuser->assignRole('supervisor');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1123731641'.'*'), 'area' =>'INGENIERIA',	'cargo'=>'DISEÑADOR ELECTRICO A',	                        'name' => 'ALFREDO ANDRES SIERRA ROMERO', 'identificacion' =>	'1123731641', 'email' => 'sierraalfredo547@gmail.com'	,'celular' => '3117958848' , 'centrotrabajo_id' => 9 ]); $tempuser->assignRole('supervisor');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1035441773'.'*'), 'area' =>'INGENIERIA',	'cargo'=>'DISEÑADOR ELECTRICO B',	                        'name' => 'JOHN BAIRON GUTIERREZ PULGARIN', 'identificacion' =>	'1035441773', 'email' => 'bairon.pulgarin@gmail.com'	,'celular' => '3225757747' , 'centrotrabajo_id' => 9 ]); $tempuser->assignRole('supervisor');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1066749869'.'*'), 'area' =>'INGENIERIA',	'cargo'=>'DISEÑADOR ELECTRICO A',	                        'name' => 'JOSE LUIS SUAREZ PALENCIA', 'identificacion' =>	    '1066749869', 'email' => 'joseluissp18@gmail.com'	    ,'celular' => '3506299070' , 'centrotrabajo_id' => 8 ]); $tempuser->assignRole('supervisor');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1128275831'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'OFICIAL FORMADOR MECANICO',                       'name' => 'DIEGO MAURICIO POSADA CASTRO', 'identificacion' =>	    '1128275831',          'email' => 'diegoposada9200@gmail.com'	       ,'celular' => '3024026011'  , 'centrotrabajo_id' => 5 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('98624639'.'*'),   'area' =>'PRODUCCION',	'cargo'=>'SUBOFICIAL ELECTRICO A',	                        'name' => 'LEON DARIO RESTREPO LOPEZ', 'identificacion' =>	    '98624639',                'email' => 'leondr74@hotmail.com'	           ,'celular' => '3104045349'  , 'centrotrabajo_id' => 7 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1036650824'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'SUBOFICIAL MECANICO A',	                        'name' => 'JOHN WILSON BECERRA PALACIOS', 'identificacion' =>	    '1036650824',          'email' => 'john_becerra1@hotmail.com'	       ,'celular' => '3016672405'  , 'centrotrabajo_id' => 6 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1063281202'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'SUBOFICIAL MECANICO B',	                        'name' => 'JORGE ALBERTO OQUENDO ENSUNCHO', 'identificacion' =>	    '1063281202',          'email' => 'joroquendo14@hotmail.com'	       ,'celular' => '3136737548'  , 'centrotrabajo_id' => 5 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1104864701'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'SUBOFICIAL MECANICO B',	                        'name' => 'WILSON ANDRES MARTINEZ GARCIA', 'identificacion' =>	    '1104864701',          'email' => 'jmartinezgoez@gmail.com'	           ,'celular' => '3114104905'  , 'centrotrabajo_id' => 5 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1017130088'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'SUBOFICIAL MECANICO B',	                        'name' => 'DIEGO ANDRES RUA GARCES', 'identificacion' =>	    '1017130088',              'email' => 'diegoarua.g@gmail.com'	           ,'celular' => '3135797289'  , 'centrotrabajo_id' => 5 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1018343086'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'SUBOFICIAL MECANICO A',	                        'name' => 'JORGE ALBERTO ARBELAEZ SUCERQUIA', 'identificacion' =>	    '1018343086',      'email' => 'cheo1232010@hotmail.com'	           ,'celular' => '3217882771'  , 'centrotrabajo_id' => 5 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1090229206'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'SUBOFICIAL MECANICO B',	                        'name' => 'CRISTHIAN  ALEJANDRO CARDENAS BASTOS', 'identificacion' =>	    '1090229206',  'email' => 'cristhiancardenas020@gmail.com'	   ,'celular' => '3105598629'  , 'centrotrabajo_id' => 5 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1020417565'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'AYUDANTE ELECTRICO',  	                        'name' => 'CARLOS MARIO CALLE CORREA', 'identificacion' =>	    '1020417565',              'email' => 'cmac.c0925@gmail.com'	           ,'celular' => '3059125461'  , 'centrotrabajo_id' => 7 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1000920908'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'AYUDANTE ELECTRICO',  	                        'name' => 'JUAN MANUEL RAIGOSA MESA', 'identificacion' =>	    '1000920908',              'email' => 'raigozaj21@gmail.com'	           ,'celular' => '3008413392'  , 'centrotrabajo_id' => 7 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1152220358'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'AYUDANTE MECANICO',  	                            'name' => 'RUBEN DARIO GOMEZ GALLO', 'identificacion' =>	    '1152220358',              'email' => 'r.gomez753@pascualbravo.edu.co'	   ,'celular' => '3004068751'  , 'centrotrabajo_id' => 5 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1047434668'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'AYUDANTE MECANICO',  	                            'name' => 'DANNER ALEXANDER POLO ACOSTA', 'identificacion' =>	    '1047434668',          'email' => 'dannerpoloacosta@gmail.com'	       ,'celular' => '3145426447'  , 'centrotrabajo_id' => 5 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1000306895'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'AYUDANTE ELECTRICO',  	                        'name' => 'ESTIVEN MOISES CARVAJAL CARTAGENA', 'identificacion' =>	    '1000306895',      'email' => 'carvajalsteven05@gmail.com'	       ,'celular' => '3127504104'  , 'centrotrabajo_id' => 7 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1063366681'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'AYUDANTE ELECTRICO',  	                        'name' => 'RAMIRO ANDRES RODRIGUEZ BELEÑO', 'identificacion' =>	    '1063366681',          'email' => 'ramiro1530luz@gmail.com'	           ,'celular' => '3006541662'  , 'centrotrabajo_id' => 7 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1007405308'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'AYUDANTE ELECTRICO',  	                        'name' => 'JUAN FELIPE PARRA DAZA', 'identificacion' =>	    '1007405308',                  'email' => 'juanfelipecj@gmail.com'	           ,'celular' => '3245872668'  , 'centrotrabajo_id' => 7 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1004366557'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'AYUDANTE MECANICO',  	                            'name' => 'ANGEL ESTEBAN RIVERA HERNANDEZ', 'identificacion' =>	    '1004366557',          'email' => 'angelrivera00017@gmail.com'	       ,'celular' => '3226521169'  , 'centrotrabajo_id' => 4 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1105390050'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'AYUDANTE MECANICO',  	                            'name' => 'JUAN ANDRES COLON GARCIA', 'identificacion' =>	    '1105390050',              'email' => 'juancolon1610@gmail.com'	           ,'celular' => '3238124882'  , 'centrotrabajo_id' => 2 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('98621410'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'AYUDANTE MECANICO',  	                                'name' => 'DIEGO ALEXANDER VALENCIA MONCADA', 'identificacion' =>	    '98621410',        'email' => 'diegodrums003@gmail.com'	           ,'celular' => ''            , 'centrotrabajo_id' => 1 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1065666125'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'AYUDANTE ELECTRICO',  	                        'name' => 'GUILLERMO ANTONIO RAMIREZ DIOSA', 'identificacion' =>	    '1065666125',      'email' => 'guillermoramirezdiosa@gmail.com'	   ,'celular' => ''            , 'centrotrabajo_id' => 7 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('78302632'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'SOLDADOR',	                                        'name' => 'WILMER ANTONIO PEREZ BERMUDEZ', 'identificacion' =>	    '78302632',            'email' => 'wilmerperezbermudez@hotmail.com'	   ,'celular' => '3136502696'  , 'centrotrabajo_id' => 3 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1005709821'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'SOLDADOR',	                                    'name' => 'JONATAN DAVID PEREZ ZUÑIGA', 'identificacion' =>	    '1005709821',              'email' => 'jdpz1717@gmail.com'	               ,'celular' => ''            , 'centrotrabajo_id' => 3 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('98622641'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'OPERARIO DE MAQUINA CORTE',	                        'name' => 'JHON FREDY GARZON RESTREPO', 'identificacion' =>	    '98622641',                'email' => 'jhonfredygarzon@yahoo.es'	       ,'celular' => '3022307691'  , 'centrotrabajo_id' => 1 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1007904614'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'APRENDIZ TÉCNICO EN INSTALACIONES ELECTRICAS',	'name' => 'ANDRES FELIPE URANGO MIRANDA', 'identificacion' =>	    '1007904614',          'email' => 'urangomirandaa@gmail.com'	       ,'celular' => '3148316071'  , 'centrotrabajo_id' => 7 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1127623493'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'APRENDIZ TECNOLOGO EN AUTOMATIZACIÓN INDUSTRIAL',	'name' => 'JESUS GABRIEL GUZMAN GUILLEN', 'identificacion' =>	    '1127623493',          'email' => 'gab.guzmanj@gmail.com'	           ,'celular' => '3023077130'  , 'centrotrabajo_id' => 7 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('PT6574483PEP941902105011980'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'AYUDANTE ELECTRICO',  	        'name' => 'ANGEL GUSTAVO ARAUJO', 'identificacion' =>	    'PT6574483PEP941902105011980', 'email' => 'lordgustavo5180@gmail.com'	       ,'celular' => '3046228612'  , 'centrotrabajo_id' => 7 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1214719370'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'SUBOFICIAL ELECTRICO B',	                        'name' => 'ALEJANDRO CAMPILLO ALANDETE', 'identificacion' =>	    '1214719370',          'email' => 'alejandro.alan@hotmail.es'	       ,'celular' => '3045488328'  , 'centrotrabajo_id' => 7 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1035428697'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'AYUDANTE MECANICO',  	                            'name' => 'DANILO MUÑOZ TORO', 'identificacion' =>	    '1035428697',                      'email' => 'danilomunoztoro536@gmail.com'	   ,'celular' => '3195630941'  , 'centrotrabajo_id' => 6 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1000442297'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'AYUDANTE ELECTRICO',  	                        'name' => 'NEISER MOSQUERA PALACIOS', 'identificacion' =>	    '1000442297',              'email' => 'neiserjob26@gmail.com'	           ,'celular' => '3023848144'  , 'centrotrabajo_id' => 7 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1020497197'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'AYUDANTE ELECTRICO',  	                        'name' => 'SANTIAGO GALEANO SUZAREZ', 'identificacion' =>	    '1020497197',              'email' => 'santy688suarez@gmail.com'	       ,'celular' => '3007204189'  , 'centrotrabajo_id' => 6 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('1001133466'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'SOLDADOR',	                                    'name' => 'ESTEBAN CHAVARRIAGA CASTAÑO', 'identificacion' =>	    '1001133466',          'email' => 'estebanchavarriagacastano@gmail.com','celular' => ''            , 'centrotrabajo_id' => 5 ]); $tempuser->assignRole('trabajador');
        $tempuser = User::create(['sexo' => 'Masculino','password'=>bcrypt('PPT4910698'.'*'), 'area' =>'PRODUCCION',	'cargo'=>'OPERARIO DE MAQUINA CORTE',	                    'name' => 'ORLANDO RAFAEL PUERTA RODRIGUEZ', 'identificacion' =>	    'PPT4910698',      'email' => 'orlando07imc@gmail.com'	           ,'celular' => '3227254881'  , 'centrotrabajo_id' => 2 ]); $tempuser->assignRole('trabajador');
    }
}
