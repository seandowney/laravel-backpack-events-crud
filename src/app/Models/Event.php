<?php

namespace Dowser\BackpackEventsCrud\app\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Event extends Model
{
	use CrudTrait;
    use Sluggable;
    use SluggableScopeHelpers;

     /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

	protected $table = 'events';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];
	protected $fillable = ['title', 'speaker', 'slug', 'ticket_vendor_id', 'ticket_vendor', 'venue_id', 'start_time', 'body', 'meta_description', 'status'];
    protected $dates = ['start_time'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_or_title',
            ],
        ];
    }

	/*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/

    /**
	 * Return the URL to the post.
	 *
	 * @return string
	 */
	public function url()
	{
		return route('view-event', $this->slug);
	}

	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/
    public function scopePublished($query)
    {
        return $query->where('status', 1)
            ->orderBy('start_time', 'DESC');
    }


	/*
	|--------------------------------------------------------------------------
	| ACCESORS
	|--------------------------------------------------------------------------
	*/

    // The slug is created automatically from the "name" field if no slug exists.
    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->title;
    }

	/*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/
}
