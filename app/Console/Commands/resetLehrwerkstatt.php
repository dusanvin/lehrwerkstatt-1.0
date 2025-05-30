<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class resetLehrwerkstatt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lehrwerkstatt:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Neue Runde für Lehr:werkstatt vorbereiten';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->warn('Warnung: Dieser Befehl bereitet die Lehr:werkstatt auf eine neue Runde vor und löscht Daten.');
        
        $this->error('Abbruch mit [strg+c]');

        // berechnet Auswahl: dieser bzw. nächster Jahrgang
        $current = Carbon::now()->year.'/'.substr(Carbon::now()->year + 1, -2);
        $next = (Carbon::now()->year + 1).'/'.substr((Carbon::now()->year + 2), -2);
        $year = $this->choice('Für welchen Jahrgang ist die neue Runde?', [$current, $next]);

        // config auslesen und bisherigen jahrgang string mit neuem ausgewähltem ersetzen
        $file = base_path('/config/site_vars.php');
        $config = file_get_contents($file);
        $pattern = "/(['\"]jahrgang['\"]\s*=>\s*)(['\"][^'\"]*['\"])/";
        $newConfig = preg_replace($pattern, "$1'$year'", $config);
        file_put_contents($file, $newConfig);

        $code = $this->ask('Wie soll das Kennwort lauten?');
        DB::table('registration_codes')->truncate();  // alte codes löschen
        DB::table('registration_codes')->insert(['code' => $code]);  // neuen code hinzu
        
        // Daten der letztjährigen Student*innen löschen, 
        // auch möglich: nur bereits gematchte
        DB::table('users')->where('role', 'stud')->delete();

        // Neu auszufüllende Felder zurücksetzen
        DB::table('users')->where('role', 'lehr')->update(['is_evaluable' => 0]);
        DB::table('users')->where('role', 'lehr')->update(['is_available' => 1]);
        
        DB::table('users')->update([
            'survey_data' => DB::raw("JSON_SET(survey_data, 
                '$.teilnahmebedingungen', '',
                '$.registrierungscode', '',
                '$.zustimmung_schul', '',
                '$.bestaetigung', ''
            )")
        ]);
        DB::statement("UPDATE users SET survey_data = json_remove(survey_data, '$.wunschtandem')");
        
        // // Löschen der bisherigen Nachrichten
        DB::table('messenger_messages')->truncate();
        DB::table('messenger_participants')->truncate();
        DB::table('messenger_threads')->truncate();

        // // Löscht Bilder von gelöschten Accounts
        $filenames1 = DB::table('image_files')
            ->join('users', 'image_files.user_id', '=', 'users.id')
            ->pluck('image_files.filename')
            ->map(function ($filename) {
                return str_replace('user/', '', $filename);
            })->toArray();

        $filenames2 = array_diff(scandir('storage/app/user'), array('.', '..'));

        $files = array_diff($filenames2, $filenames1);

        foreach ($files as $file) {
            unlink('storage/app/user/'.$file);
            $this->info($file.' '.'deleted');
        }


        $this->info('Jahrgang:'.$year);
        $this->info('Kennwort:'.$code);
        $this->call('config:cache');  // neue werte laden

        $this->line('Die Lehr:werkstatt wurde aktualisiert.');

    }
    
}
