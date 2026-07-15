<?php

namespace App\Modules\Institute\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstituteListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->type?->name,
            'type_slug' => $this->type?->slug,
            'logo_url' => $this->logo_url,
            'curriculums' => $this->curriculums?->pluck('name'),
            'district' => $this->district?->name,
            'area' => $this->area?->name,
            'estimated_monthly_fee' => $this->estimated_monthly_fee,
            'admission_status' => $this->current_admission_status,
            'verification_badge' => $this->verification_status,
            'key_facts' => $this->key_facts,
        ];
    }
}
