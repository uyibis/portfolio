<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportPostsToProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projects:import-posts {--dry-run : Show what would be imported without writing to the database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy existing records from posts into projects (skips slugs that already exist).';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        $postsCount = DB::table('posts')->count();
        $projectsCount = DB::table('projects')->count();

        $this->info('Posts: ' . $postsCount);
        $this->info('Projects (before): ' . $projectsCount);
        $this->line($dryRun ? 'Dry run: no changes will be written.' : 'Importing...');

        $inserted = 0;
        $skipped = 0;

        DB::table('posts')
            ->orderBy('id')
            ->chunkById(200, function ($rows) use (&$inserted, &$skipped, $dryRun) {
                foreach ($rows as $row) {
                    $exists = DB::table('projects')->where('slug', $row->slug)->exists();
                    if ($exists) {
                        $skipped++;
                        continue;
                    }

                    $data = [
                        'title' => $row->title,
                        'slug' => $row->slug,
                        'description' => $row->description,
                        'views' => $row->views ?? 0,
                        'featured_image' => $row->featured_image,
                        'publish' => (bool) ($row->publish ?? false),
                        'created_at' => $row->created_at,
                        'updated_at' => $row->updated_at,
                    ];

                    if (!$dryRun) {
                        DB::table('projects')->insert($data);
                    }

                    $inserted++;
                }
            });

        $this->newLine();
        $this->info('Inserted: ' . $inserted);
        $this->info('Skipped (slug exists): ' . $skipped);

        if (!$dryRun) {
            $this->info('Projects (after): ' . DB::table('projects')->count());
        }

        return self::SUCCESS;
    }
}
