<?php

namespace App\Console\Commands;

use App\Neo;
use Illuminate\Console\Command;

class GetNeo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getneo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $today = date('Y-m-d');
        $beforeYesterday = date('Y-m-d', strtotime("- 2 day"));

        $c = curl_init("https://api.nasa.gov/neo/rest/v1/feed?start_date=$beforeYesterday&end_date=$today&detailed=true&api_key=xdjGTxhi798FgHEzrl0WncgMyiOhP0UXwMtPoR9C");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $page = curl_exec($c);
        $nears = json_decode($page, true);
        foreach ($nears['near_earth_objects'] as $dateKey => $addParams) {
            foreach ($addParams as $k=>$v) {
                $neo = new Neo();
                $neo->date = $dateKey;
                $neo->reference = $v['neo_reference_id'];
                $neo->name = $v['name'];
                $neo->speed = $v['close_approach_data'][0]['relative_velocity']['kilometers_per_hour'];
                $neo->is_hazardous = $v['is_potentially_hazardous_asteroid'];
                $neo->save();
            }
        }
        curl_close($c);
        $this->output->writeln('Command has finished');
    }
}
