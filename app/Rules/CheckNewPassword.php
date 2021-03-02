<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckNewPassword implements Rule
{
    /** @var string */
    private $passwordConfirm;

    /** @var string */
    private $attribute;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $password)
    {
        $this->passwordConfirm = $password;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->attribute = $attribute;
        return ($this->passwordConfirm === $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->attribute === 'new_password') {
            return 'A :attribute deve ser igual a confirmação da nova senha!';
        }

        return 'A :attribute deve ser igual a nova senha!';
    }

}
