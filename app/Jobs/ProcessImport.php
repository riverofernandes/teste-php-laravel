<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $item;

    /**
     * Create a new job instance.
     */
    public function __construct($item)
    {
        $this->item = $item;
    }

    /**
     * Execute the job.
     * 
     * @return void
     */
    public function handle(): void
    {
        $category = Category::firstOrCreate([
            'name' => $this->item['categoria']
        ]);

        Document::firstOrCreate([
            'category_id' => $category->id,
            'title' => $this->item['titulo'],
            'contents' => $this->item['conteúdo']
        ]);
    }
}
