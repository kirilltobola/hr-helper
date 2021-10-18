<?php

namespace App\Rules\Cv;

use Illuminate\Contracts\Validation\Rule;

class MaxLengthWithoutTags implements Rule
{

    private int $maxLen;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($maxLen)
    {
        $this->maxLen = $maxLen;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return mb_strlen(strip_tags($value), 'UTF-8') < $this->maxLen;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Длинна не должна превышать '.$this->maxLen.' символов.';
    }
}
