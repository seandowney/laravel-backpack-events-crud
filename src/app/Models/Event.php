<?php

namespace SeanDowney\BackpackEventsCrud\app\Models;

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
	protected $fillable = [
        'title', 'speaker', 'slug', 'start_time', 'end_time', 'body',
        'ticket_vendor_id', 'ticket_vendor', 'venue_id', 'meta_description', 'status'
    ];
    protected $dates = ['start_time', 'end_time'];

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

    /**
	 * Get the Next event
	 *
	 * @return Event
	 */
	public function next()
	{
		return $this->published()
				->where('start_time', '>', date('Y-m-d H:is:s'))
				->first();

	}//end next()


	/**
	 * Get the Upcoming events
	 *
	 * @return Event
	 */
	public function upcoming()
	{
		return $this->published()
				->where('start_time', '>', date('Y-m-d H:is:s'))
				->limit(5)
				->get();

	}//end upcoming()


	/**
	 * Get the Last event
	 *
	 * @return Event
	 */
	public function prev()
	{
		return $this->published()
				->where('start_time', '<', date('Y-m-d H:is:s'))
				->first();

	}//end prev()


	/*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/
}
