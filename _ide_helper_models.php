<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $path
 * @property string $size
 * @property string $type
 * @property string $mime_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUuid($value)
 */
	class File extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $unique_id
 * @property string $token_title
 * @property string|null $restrictions
 * @property string|null $permissions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $expires_at
 * @property string|null $last_used_at
 * @property string|null $refreshed_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|JWTToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JWTToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JWTToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|JWTToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JWTToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JWTToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JWTToken whereLastUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JWTToken wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JWTToken whereRefreshedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JWTToken whereRestrictions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JWTToken whereTokenTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JWTToken whereUniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JWTToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JWTToken whereUserId($value)
 */
	class JWTToken extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @package App\Models
 * @property int $id
 * @property string $uuid
 * @property string $first_name
 * @property string $last_name
 * @property int $is_admin
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $avatar
 * @property string $address
 * @property string $phone_number
 * @property int $is_marketing
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $last_login_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JWTToken> $jwtTokens
 * @property-read int|null $jwt_tokens_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsMarketing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUuid($value)
 */
	class User extends \Eloquent {}
}

