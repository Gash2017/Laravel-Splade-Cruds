<?php

namespace App\Tables;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;

class Posts extends AbstractTable
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
        return Post::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $categories = Category::pluck('name','id')->toArray();

        $table
            ->column('id', canBeHidden: false,sortable: true,searchable: true)
            ->column('title', canBeHidden: false,sortable: true,searchable: true)
            ->column('slug',sortable: true,searchable: true)
            ->column('category_id',sortable: true,searchable: true)
            ->column('description',sortable: true,searchable: true)
            ->column('category.name')

            ->selectFilter('category_id',$categories )
            ->withGlobalSearch(columns: ['title', 'slug'])
            ->column('action', exportAs: false)
            // ->bulkAction(
            //     label: 'Touch timestamp',
            //     each: fn (Post $post) => $post->touch(),
            //     before: fn () => info('Touching the selected projects'),
            //     after: fn () => Toast::info('Timestamps updated!')
            // )
            ->bulkAction(
                label: 'Delete Post',
                each: fn (Post $post) => $post->delete(),
                // before: fn () => info('Touching the selected projects'),
                after: fn () => Toast::info('Post deleted!')
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
