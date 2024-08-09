<?php

namespace App\Rules;

use App\Models\Location;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LocationUnique implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exists = Location::where('saloon_id', request()->user()->userable_id)
            ->where('name', $value)
            ->exists();

        if ($exists) {
            $fail('validation.location_unique')->translate();
        }
    }
}
