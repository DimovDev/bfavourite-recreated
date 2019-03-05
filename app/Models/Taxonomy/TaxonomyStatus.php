<?php

namespace App\Models\Taxonomy;

use App\Models\Status;

class TaxonomyStatus extends Status
{
    protected $statuses = ['not active', 'active', 'system'];
}
