<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class DedupeCategories extends Command
{
    protected $signature = 'categories:dedupe
        {--execute : Actually apply changes (otherwise dry-run)}
        {--by=base : base (name) or locale (name_translations for a locale)}
        {--locale= : Locale key when using --by=locale (e.g. ar, fr, en)}';

    protected $description = 'Merge and delete duplicate categories by normalized name + same parent_id. Moves tasks/skills/portfolio items and children to the kept category.';

    public function handle(): int
    {
        $execute = (bool) $this->option('execute');
        $by = (string) ($this->option('by') ?? 'base');
        $locale = (string) ($this->option('locale') ?? '');

        $by = $by === 'locale' ? 'locale' : 'base';
        if ($by === 'locale' && $locale === '') {
            $locale = config('app.locale', 'ar');
        }

        $groupsQuery = DB::table('categories');
        $nameExpr = $by === 'locale'
            ? "COALESCE(JSON_UNQUOTE(JSON_EXTRACT(name_translations, '$.\"{$locale}\"')), name)"
            : 'name';

        $groups = $groupsQuery
            ->selectRaw("TRIM(LOWER({$nameExpr})) as norm_name, parent_id, COUNT(*) as c")
            ->groupBy('norm_name', 'parent_id')
            ->having('c', '>', 1)
            ->get();

        if ($groups->isEmpty()) {
            $this->info('No duplicate category groups found.');
            return self::SUCCESS;
        }

        $this->warn(
            ($execute ? 'EXECUTE' : 'DRY-RUN')
            .': Found '.$groups->count().' duplicate group(s) (by='.$by.($by === 'locale' ? ', locale='.$locale : '').').'
        );

        $deleted = 0;
        $movedTasks = 0;
        $movedSkills = 0;
        $movedPortfolio = 0;
        $movedChildren = 0;

        $runner = function () use (
            $groups,
            $execute,
            &$deleted,
            &$movedTasks,
            &$movedSkills,
            &$movedPortfolio,
            &$movedChildren
        ) {
            foreach ($groups as $g) {
                $q = Category::query()->whereRaw("TRIM(LOWER({$nameExpr})) = ?", [$g->norm_name]);
                if ($g->parent_id === null) {
                    $q->whereNull('parent_id');
                } else {
                    $q->where('parent_id', $g->parent_id);
                }

                /** @var Collection<int, Category> $cats */
                $cats = $q->orderBy('id')->get();
                if ($cats->count() < 2) {
                    continue;
                }

                $keep = $cats->first();
                $this->line('');
                $this->line('Keep #'.$keep->id.' name="'.$keep->name.'" parent_id='.(string) ($keep->parent_id ?? 'null').' (dupes: '.($cats->count() - 1).')');

                foreach ($cats->slice(1) as $dup) {
                    $t = DB::table('tasks')->where('category_id', $dup->id)->update(['category_id' => $keep->id]);
                    $s = DB::table('skills')->where('category_id', $dup->id)->update(['category_id' => $keep->id]);
                    $p = DB::table('portfolio_items')->where('category_id', $dup->id)->update(['category_id' => $keep->id]);
                    $c = DB::table('categories')->where('parent_id', $dup->id)->update(['parent_id' => $keep->id]);

                    if ($execute) {
                        DB::table('categories')->where('id', $dup->id)->delete();
                    }

                    $deleted += $execute ? 1 : 0;
                    $movedTasks += (int) $t;
                    $movedSkills += (int) $s;
                    $movedPortfolio += (int) $p;
                    $movedChildren += (int) $c;

                    $this->line(
                        ' - '.($execute ? 'deleted' : 'would delete').' #'.$dup->id
                        .' moved tasks='.$t
                        .' skills='.$s
                        .' portfolio='.$p
                        .' children='.$c
                    );
                }
            }
        };

        if ($execute) {
            DB::transaction($runner);
        } else {
            $runner();
        }

        $this->line('');
        $this->info('Moved: tasks='.$movedTasks.' skills='.$movedSkills.' portfolio_items='.$movedPortfolio.' children='.$movedChildren);
        $this->info('Deleted: '.$deleted);
        if (! $execute) {
            $this->comment('Run again with --execute to apply changes.');
        }

        return self::SUCCESS;
    }
}
