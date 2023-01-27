<?php

namespace App\Tables;

use App\Models\Category;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;

class Categories extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Category::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
        ->column('id', canBeHidden: false,sortable: true,searchable: true)
        ->column('name', canBeHidden: false,sortable: true,searchable: true)
        ->column('slug',sortable: true,searchable: true)
        ->column('updated_at')
        ->withGlobalSearch(columns: ['name', 'slug'])
        ->column('action', exportAs: false)
        ->bulkAction(
            label: 'Touch timestamp',
            each: fn (Category $category) => $category->touch(),
            before: fn () => info('Touching the selected projects'),
            after: fn () => Toast::info('Timestamps updated!')
        )
        ->bulkAction(
            label: 'Delete Categoey',
            each: fn (Category $category) => $category->delete(),
            // before: fn () => info('Touching the selected projects'),
            after: fn () => Toast::info('Category deleted!')
        )
        ->export()
        ->paginate(15);
        // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
