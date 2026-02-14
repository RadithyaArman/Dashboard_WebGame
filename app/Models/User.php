<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use App\Services\MailService;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notifiable;
use function Symfony\Component\Clock\now;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Reset Password
    public function sendPasswordResetNotification($token)
    {
        $url = url("/reset-password/$token?email={$this->email}");

        $mailer = new MailService();
        $mailer->sendMail(
            $this->email,
            'Reset Password',
            "Click this link to reset your password:<br><a href='$url'>$url</a>"
        );
    }

    // Email Verification
    public function sendEmailVerificationNotification()
    {
        $url = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $this->id, 'hash' => sha1($this->email)]
        );

        $mailer = new MailService();
        $mailer->sendMail(
            $this->email,
            'Verify Email',
            "Click to verify email:<br><a href='$url'>$url</a>"
        );
    }
}
