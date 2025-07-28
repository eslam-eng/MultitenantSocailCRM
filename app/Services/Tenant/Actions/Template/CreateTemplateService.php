<?php

namespace App\Services\Tenant\Actions\Template;

use App\DTOs\Template\TemplateDTO;
use App\Models\Template;
use App\Models\TemplateButton;
use App\Models\TemplateParameter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateTemplateService
{
    private function getQuery(): Builder
    {
        return Template::query();
    }

    /**
     * @throws \Throwable
     */
    public function handle(TemplateDTO $templateDTO)
    {
        return DB::transaction(function () use ($templateDTO) {
            $template = $this->getQuery()->create($templateDTO->toArray());

            $this->createTemplateButtons($template->id, $templateDTO->template_buttons);
            $this->createTemplateParameters($template->id, $templateDTO->template_parms);

            return $template;
        });
    }

    private function createTemplateButtons(string $templateId, ?array $templateButtons): void
    {
        if (empty($templateButtons)) {
            return;
        }

        $templateButtonsData = [];
        foreach ($templateButtons as $button) {
            $templateButtonsData[] = [
                'template_id' => $templateId,
                'button_type' => Arr::get($button, 'button_type'),
                'button_text' => Arr::get($button, 'button_text'),
                'action_value' => Arr::get($button, 'action_value'),
                'background_color' => Arr::get($button, 'background_color'),
                'text_color' => Arr::get($button, 'text_color'),
                'sort_order' => Arr::get($button, 'quick_replay'),
            ];
        }

        TemplateButton::query()->insert($templateButtonsData);
    }

    private function createTemplateParameters(string $templateId, ?array $templateParams): void
    {
        if (empty($templateParams)) {
            return;
        }

        $templateParamsData = [];
        foreach ($templateParams as $param) {
            $templateParamsData[] = [
                'template_id' => $templateId,
                'variable_name' => Arr::get($param, 'variable_name'),
                'default_value' => Arr::get($param, 'default_value'),
                'is_required' => Arr::get($param, 'is_required'),
                'integration_source' => Arr::get($param, 'integration_source'),
            ];
        }

        TemplateParameter::query()->insert($templateParamsData);
    }
}
