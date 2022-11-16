<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'dob',
        'email',
        'phone',
        'addresse',
        'pays',
        'division',
        'type_employé',
        'role',
        'description',
        'date_du_debut',
        'profile_picture',
        'password',
        'service_id',
        'fichier1',
        'fichier1_name',
        'fichier2',
        'fichier2_name',
        'fichier3',
        'fichier3_name',
        'fichier4',
        'fichier4_name',
        'fichier5',
        'fichier5_name',
        'fichier6',
        'fichier6_name',
        'status',
        'last_seen'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    
    public function activités()
    {
        return $this->belongsTo(Activité::class);
    }

    public function avertissements()
    {
        return $this->hasMany(Avertissement::class);
    }

    public function contrat()
    {
        return $this->hasOne(Contrat::class);
    }

    public function suggestions()
    {
        return $this->hasMany(Suggestion::class);
    }


    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function conges()
    {
        return $this->hasMany(Conge::class);
    }


    public function stockages()
    {
        return $this->hasMany(Stockage::class);
    }

    public function rapports()
    {
        return $this->hasMany(Rapport::class);
    }

    public function reunions()
    {
        return $this->belongsToMany(Reunion::class);
    }

    public function fiches_de_paie()
    {
        return $this->hasMany(FicheDePaie::class);
    }
   
}
