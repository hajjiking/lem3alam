<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $role
 * @property string|null $phone
 * @property string|null $bio
 * @property array|null $bio_translations
 * @property string|null $profile_image
 * @property string|null $city
 * @property string|null $address
 * @property float|null $rating
 * @property float|null $hourly_rate
 * @property bool $is_verified
 * @property \Illuminate\Support\Carbon|null $verified_at
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Collection|Task[] $tasks
 * @property-read Collection|TaskApplication[] $applications
 * @property-read Collection|Review[] $reviews
 * @property-read Collection|Review[] $givenReviews
 * @property-read Collection|Message[] $sentMessages
 * @property-read Collection|Message[] $receivedMessages
 * @property-read Collection|PortfolioItem[] $portfolioItems
 * @property-read Collection|PortfolioItem[] $activePortfolioItems
 * @property-read Collection|PortfolioItem[] $featuredPortfolioItems
 * @property-read Collection|Skill[] $skills
 * @property-read Collection|Skill[] $verifiedSkills
 * @property-read Collection|Review[] $reviewsAsTasker
 * @property-read Collection|Review[] $reviewsAsClient
 * @property-read Collection|Review[] $approvedReviews
 * @property-read Collection|Review[] $featuredReviews
 *
 * @method bool isTasker()
 * @method bool isClient()
 * @method bool isAdmin()
 * @method string getBio()
 * @method float getAverageRating()
 * @method int getTotalReviews()
 * @method array getRatingBreakdown()
 * @method Collection getRecentReviews(int $limit = 5)
 * @method void updateRatingStats()
 * @method HasMany tasks()
 * @method HasMany applications()
 * @method HasMany reviews()
 * @method HasMany givenReviews()
 * @method HasMany sentMessages()
 * @method HasMany receivedMessages()
 * @method HasMany portfolioItems()
 * @method HasMany activePortfolioItems()
 * @method HasMany featuredPortfolioItems()
 * @method BelongsToMany skills()
 * @method BelongsToMany verifiedSkills()
 * @method HasMany reviewsAsTasker()
 * @method HasMany reviewsAsClient()
 * @method HasMany approvedReviews()
 * @method HasMany featuredReviews()
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'admin_role',
        'phone',
        'phone_verified_at',
        'bio',
        'bio_translations',
        'profile_image',
        'city',
        'address',
        'latitude',
        'longitude',
        'rating',
        'total_reviews',
        'status',
        'suspended_until',
        'banned_at',
        'ban_reason',
        'is_verified',
        'verified_at',
        'skills',
        'hourly_rate',
        'available',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'suspended_until' => 'datetime',
            'banned_at' => 'datetime',
            'password' => 'hashed',
            'bio_translations' => 'array',
            'skills' => 'array',
            'hourly_rate' => 'decimal:2',
            'rating' => 'decimal:2',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'is_verified' => 'boolean',
            'available' => 'boolean',
        ];
    }

    // Relationships
    public function tasks()
    {
        return $this->hasMany(Task::class, 'client_id');
    }

    public function applications()
    {
        return $this->hasMany(TaskApplication::class, 'tasker_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'reviewee_id');
    }

    public function givenReviews()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function portfolioItems()
    {
        return $this->hasMany(PortfolioItem::class)->ordered();
    }

    public function activePortfolioItems()
    {
        return $this->hasMany(PortfolioItem::class)->active()->ordered();
    }

    public function featuredPortfolioItems()
    {
        return $this->hasMany(PortfolioItem::class)->featured()->ordered();
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skills')
            ->withPivot(['experience_level', 'years_experience', 'description', 'is_verified', 'verified_at'])
            ->withTimestamps();
    }

    public function verifiedSkills()
    {
        return $this->belongsToMany(Skill::class, 'user_skills')
            ->wherePivot('is_verified', true)
            ->withPivot(['experience_level', 'years_experience', 'description', 'is_verified', 'verified_at'])
            ->withTimestamps();
    }

    // Review relationships
    public function reviewsAsTasker()
    {
        return $this->hasMany(Review::class, 'tasker_id');
    }

    public function reviewsAsClient()
    {
        return $this->hasMany(Review::class, 'client_id');
    }

    public function approvedReviews()
    {
        return $this->hasMany(Review::class, 'tasker_id')->approved();
    }

    public function featuredReviews()
    {
        return $this->hasMany(Review::class, 'tasker_id')->featured();
    }

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class, 'actor_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    // Helper methods
    public function isClient()
    {
        return $this->role === 'client';
    }

    public function isTasker()
    {
        return $this->role === 'tasker';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSuperAdmin(): bool
    {
        if (! $this->isAdmin()) {
            return false;
        }

        return $this->admin_role === null || $this->admin_role === 'super_admin';
    }

    public function hasPermission(string $permissionKey): bool
    {
        if (! $this->isAdmin()) {
            return false;
        }

        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($this->relationLoaded('permissions')) {
            return $this->permissions->contains('key', $permissionKey);
        }

        return $this->permissions()->where('key', $permissionKey)->exists();
    }

    public function hasAnyPermission(array $permissionKeys): bool
    {
        foreach ($permissionKeys as $key) {
            if ($this->hasPermission((string) $key)) {
                return true;
            }
        }

        return false;
    }

    public function isBanned(): bool
    {
        return $this->banned_at !== null;
    }

    public function isSuspended(): bool
    {
        if ($this->status === 'suspended') {
            return true;
        }

        return $this->suspended_until !== null
            && \Illuminate\Support\Carbon::parse($this->suspended_until)->isFuture();
    }

    public function getBio($locale = 'fr')
    {
        if ($this->bio_translations && isset($this->bio_translations[$locale])) {
            return $this->bio_translations[$locale];
        }

        return $this->bio;
    }

    // Rating and review methods
    public function getAverageRating()
    {
        $avg = Review::approved()
            ->where(function ($q) {
                $q->where('tasker_id', $this->id)
                    ->orWhere('reviewee_id', $this->id);
            })
            ->avg('rating');

        return $avg ?: 0;
    }

    public function getTotalReviews()
    {
        return Review::approved()
            ->where(function ($q) {
                $q->where('tasker_id', $this->id)
                    ->orWhere('reviewee_id', $this->id);
            })->count();
    }

    public function getRatingBreakdown()
    {
        $breakdown = [];
        for ($i = 1; $i <= 5; $i++) {
            $breakdown[$i] = $this->approvedReviews()->where('rating', $i)->count();
        }

        return $breakdown;
    }

    public function getRecentReviews($limit = 5)
    {
        return Review::approved()
            ->where(function ($q) {
                $q->where('tasker_id', $this->id)
                    ->orWhere('reviewee_id', $this->id);
            })
            ->recent()
            ->limit($limit)
            ->get();
    }

    public function updateRatingStats()
    {
        $this->update([
            'rating' => $this->getAverageRating(),
            'total_reviews' => $this->getTotalReviews(),
        ]);
    }

    public function hasReviewFromClient(int $clientId, ?int $taskId = null): bool
    {
        $query = $this->reviewsAsTasker()->where('client_id', $clientId);

        if ($taskId) {
            $query->where('task_id', $taskId);
        }

        return $query->exists();
    }
}
