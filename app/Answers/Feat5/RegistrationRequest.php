<?php


namespace App\Answers\Feat5;


use Illuminate\Http\Request;

class RegistrationRequest
{
    public string $name;
    public string $surname;
    public string $email;
    public string $password;
    public string $password_repeat;

    public function __construct(Request $request)
    {
        $this->name = $request->input('name') ?? '';
        $this->surname = $request->input('surname') ?? '';
        $this->email = $request->input('email') ?? '';
        $this->password = $request->input('password') ?? '';
        $this->password_repeat = $request->input('password_repeat') ?? '';
    }

    /**
     * @throws InputsAreEmpty
     * @throws InvalidEmail
     * @throws DifferentPasswords
     */
    public function ensureDataIsValid()
    {
        if ($this->someInputsAreEmpty()) throw new InputsAreEmpty();
        if ($this->emailIsInvalid()) throw new InvalidEmail();
        if ($this->passwordsAreNotEqual()) throw new DifferentPasswords();
    }

    private function someInputsAreEmpty(): bool
    {
        return
            str($this->name)->isEmpty() ||
            str($this->surname)->isEmpty() ||
            str($this->email)->isEmpty() ||
            str($this->password)->isEmpty() ||
            str($this->password_repeat)->isEmpty();
    }

    private function emailIsInvalid(): bool
    {
        return !str($this->email)->contains('@');
    }

    private function passwordsAreNotEqual(): bool
    {
        return !($this->password === $this->password_repeat);
    }
}
