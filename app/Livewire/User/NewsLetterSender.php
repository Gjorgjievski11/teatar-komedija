<?php

namespace App\Livewire\User;

use App\Models\Newsletter;
use Livewire\Attributes\Validate;
use Livewire\Component;

class NewsLetterSender extends Component
{
    public $email;

    public $message;

    public function store()
    {
        $this->validate([
            'email' => 'required|email|unique:newsletters,email',
        ], [
            'email.required' => 'Е-поштата е задолжителна.',
            'email.unique' => 'Оваа е-пошта веќе е пријавена.',
            'email.email' => 'Внесете валидна е-пошта.',
        ]);

        $newsletter = Newsletter::create([
            'email' => $this->email,
        ]);

        if ($newsletter) {
            $this->message = 'Ви благодариме за пријавата.';
        }
    }

    public function render()
    {
        return view('livewire.user.news-letter-sender');
    }
}
