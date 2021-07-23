<?php

namespace App\Console\Commands;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ParsingData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parsing:data';

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
     * @return int
     */
    public function handle()
    {
        dump('start');
        $response = Http::withOptions([
            'debug' => true,
        ])->get('http://jsonplaceholder.typicode.com/posts');
        $objects = $response->object();
        foreach ($objects as $object)
        {
            $ar[] = [
                'name' => $object->title,
                'slug' => Str::slug($object->title),
                'description' => $object->body,
                'category_id' => rand(1,5),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        }
        Product::query()->insert($ar);
        dump('end');
    }
}
